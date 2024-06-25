<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OrderInvoiceMail;
use App\Models\DiscountCodeModel;
use App\Models\NotificationModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ShippingChargeModel;
use App\Models\User;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;

class PaymentController extends Controller
{
    private $cart;
    private $paypalClient;

    public function __construct()
    {
        $this->cart = new Cart(app(SessionManager::class), Event::getFacadeRoot(), null, 'cart', 'cart');

        $paypalEnv = new SandboxEnvironment(
            env('PAYPAL_SANDBOX_CLIENT_ID'),
            env('PAYPAL_SANDBOX_CLIENT_SECRET')
        );
        $this->paypalClient = new PayPalHttpClient($paypalEnv);
    }

    public function insertToCart(Request $request)
    {
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->price;

        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSize::getSingle($size_id);
            $price = !empty($getSize->price) ? $getSize->price : 0;
            $total += $price;
        } else {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        $this->cart->add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => [
                'size_id' => $size_id,
                'color_id' => $color_id,
            ],
        ]);

        return redirect()->back();
    }

    public function cart(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('payment.cart', $data);
    }

    public function checkout(Request $request)
    {
        $data['meta_title'] = 'Checkout';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getShippingCharge'] = ShippingChargeModel::getRecordActive();

        return view('payment.checkout', $data);
    }

    public function applyDiscountCode(Request $request)
    {
        $getDiscount = DiscountCodeModel::checkDiscount($request->discount_code);
        $cartContent = $this->cart->getContent();

        $total = 0;

        foreach ($cartContent as $item) {
            $total += $item->price * $item->quantity;
        }

        if (!empty($getDiscount)) {
            if ($getDiscount->type == 'Amount') {
                $discount_amount = $getDiscount->precent_amount;
                $payable_total = $total - $getDiscount->precent_amount;
            } else {
                $discount_amount = ($total * $getDiscount->precent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }

            $json['discount_amount'] = '$' . number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
            $json['status'] = true;
            $json['message'] = "Discount Code Successfully Applied";
        } else {
            $json['discount_amount'] = '$0.00';
            $json['payable_total'] = $total;
            $json['status'] = false;
            $json['message'] = "Discount Code Invalid or Expired";
        }

        echo json_encode($json);
    }

    public function cartDelete($id)
    {
        $this->cart->remove($id);
        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        foreach ($request->cart as $cartItem) {
            $this->cart->update($cartItem['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cartItem['qty'],
                ),
            ));
        }

        return redirect()->back();
    }

    public function placeOrder(Request $request)
    {
        $validate = 0;
        $message = '';

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            if (!empty($request->is_create)) {
                $checkEmail = User::checkEmail($request->email);
                if ($checkEmail) {
                    $validate = 1;
                    $message = "This email address is already registered. Choose another one.";
                } else {
                    $save = new User;
                    $save->name = trim($request->name);
                    $save->email = trim($request->email);
                    $save->password = Hash::make($request->password);
                    $save->save();

                    $user_id = $save->id;
                    $message = "Your account has been successfully registered, please verify your email address.";
                }
            } else {
                $user_id = '';
            }
        }

        if (!$validate) {
            $getShipping = ShippingChargeModel::getSingle($request->shipping);
            $cartContent = $this->cart->getContent();

            $subTotal = 0;
            foreach ($cartContent as $item) {
                $subTotal += $item->price * $item->quantity;
            }
            $cartTotal = $subTotal;

            $payable_total = $cartTotal;
            $discount_amount = 0;
            $discount_code = '';

            if (!empty($request->discount_code)) {
                $getDiscount = DiscountCodeModel::checkDiscount($request->discount_code);
                if ($getDiscount) {
                    $discount_code = $request->discount_code;
                    if ($getDiscount->type == 'Amount') {
                        $discount_amount = $getDiscount->precent_amount;
                        $payable_total -= $getDiscount->precent_amount;
                    } else {
                        $discount_amount = ($payable_total * $getDiscount->precent_amount) / 100;
                        $payable_total -= $discount_amount;
                    }
                }
            }
            $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
            $payable_total += $shipping_amount;

            $order = new OrderModel;
            if (!empty($user_id)) {
                $order->user_id = trim($user_id);
            }
            $order->order_number = random_int(1421312, 9999999);

            $order->first_name = trim($request->first_name);
            $order->last_name = trim($request->last_name);
            $order->company_name = trim($request->company_name);
            $order->country = trim($request->country);
            $order->address_one = trim($request->address_one);
            $order->address_two = trim($request->address_two);
            $order->city = trim($request->city);
            $order->state = trim($request->state);
            $order->post_code = trim($request->post_code);
            $order->phone = trim($request->phone);
            $order->email = trim($request->email);
            $order->note = trim($request->note);
            $order->shipping_id = trim($request->shipping);
            $order->shipping_amount = trim($shipping_amount);
            $order->discount_code = trim($discount_code);
            $order->discount_amount = trim($discount_amount);
            $order->total_amount = trim($payable_total);
            $order->payment_method = trim($request->payment_method);
            $order->status = trim($request->status);
            $order->is_delete = trim($request->is_delete);
            $order->is_payment = trim($request->is_payment);
            $order->payment_data = trim($request->payment_data);
            $order->save();

            foreach ($cartContent as $cartItem) {
                $order_item = new OrderItemModel;
                $order_item->order_id = $order->id;
                $order_item->product_id = $cartItem->id;
                $order_item->quantity = $cartItem->quantity;
                $order_item->price = $cartItem->price;
                $color_id = $cartItem->attributes->color_id;
                if ($color_id) {
                    $getColor = ProductColor::getSingle($color_id);
                    $order_item->color_name = $getColor->getColor->name;
                }
                $size_id = $cartItem->attributes->size_id;
                if ($size_id) {
                    $getSize = ProductSize::getSingle($size_id);
                    $order_item->size_name = $getSize->name;
                    $order_item->size_amount = $getSize->price;
                }
                $order_item->total_price = $cartItem->price * $cartItem->quantity;
                $order_item->save();
            }

            $json['status'] = true;
            $json['message'] = "Order Successfully done.";
            $json['redirect'] = url('checkout/payment?order_id=' . base64_encode($order->id));
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }

        return response()->json($json); // Use response() helper to return JSON
    }

    public function checkoutPayment(Request $request)
    {
        $cartContent = $this->cart->getContent();
        $subTotal = 0;

        foreach ($cartContent as $item) {
            $subTotal += $item->price * $item->quantity;
        }

        $cartTotal = $subTotal;
        if (!empty($cartTotal) && !empty($request->order_id)) {
            $order_id = base64_decode($request->order_id);
            $getOrder = OrderModel::getSingle($order_id);
            if (!empty($getOrder)) {

                if ($getOrder->payment_method == 'cash_on_delivery') {
                    $getOrder->is_payment = 1;
                    $getOrder->save();
                    Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                    $user_id = $getOrder->user_id;
                    $url = url('admin/order/detail/' . $getOrder->id);
                    $message = "New Order Placed #" . $getOrder->order_number;

                    NotificationModel::insertRecord($user_id, $url, $message);
                    $this->cart->clear();

                    return redirect('cart')->with('success', 'Order successfully placed.');
                } else if ($getOrder->payment_method == 'paypal') {
                    try {
                        $paypalRequest = new OrdersCreateRequest();
                        $paypalRequest->prefer('return=representation');
                        $paypalRequest->body = [
                            "intent" => "CAPTURE",
                            "purchase_units" => [[
                                "amount" => [
                                    "currency_code" => "USD",
                                    "value" => $getOrder->total_amount,
                                ],
                                "description" => $getOrder->id,
                            ]],
                            "application_context" => [
                                "cancel_url" => url('checkout'),
                                "return_url" => url('paypal/success-payment'),
                            ],
                        ];

                        $response = $this->paypalClient->execute($paypalRequest);
                        if ($response->statusCode === 201) {
                            foreach ($response->result->links as $link) {
                                if ($link->rel === 'approve') {
                                    return redirect($link->href);
                                }
                            }
                        } else {
                            return redirect('checkout')->with('error', 'PayPal order creation failed');
                        }
                    } catch (HttpException $ex) {
                        return redirect('checkout')->with('error', 'PayPal order creation failed: ' . $ex->getMessage());
                    }
                } else if ($getOrder->payment_method == 'stripe') {
                    // dd($request->all());
                    try {
                        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                        $finalPrice = $getOrder->total_amount * 100; // Convert amount to cents
                        $session = \Stripe\Checkout\Session::create([
                            'payment_method_types' => ['card'],
                            'line_items' => [[
                                'price_data' => [
                                    'currency' => 'usd',
                                    'product_data' => [
                                        'name' => 'ModWir-eCommerce',
                                    ],
                                    'unit_amount' => $finalPrice,
                                ],
                                'quantity' => 1,
                            ]],
                            'mode' => 'payment',
                            'success_url' => url('stripe/payment-success'),
                            'cancel_url' => url('checkout'),
                        ]);

                        $getOrder->stripe_session_id = $session['id'];
                        $getOrder->save();

                        $data['session_id'] = $session['id'];
                        Session::put('stripe_session_id', $session['id']);
                        $data['setPublicKey'] = env('STRIPE_KEY');

                        return view('payment.stripe_charge', $data);
                    } catch (\Exception $ex) {
                        return redirect('checkout')->with('error', 'Stripe session creation failed: ' . $ex->getMessage());
                    }
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function paypalSuccessPayment(Request $request)
    {
        $token = $request->input('token');
        $payerId = $request->input('PayerID');

        if (empty($token) || empty($payerId)) {
            return redirect('checkout')->with('error', 'Payment failed');
        }

        $request = new OrdersCaptureRequest($token);
        $request->prefer('return=representation');

        try {
            $response = $this->paypalClient->execute($request);
            if ($response->statusCode === 201 || $response->statusCode === 200) {
                $transaction = $response->result;
                if ($transaction->status == 'COMPLETED') {
                    $order_id = $transaction->purchase_units[0]->description;
                    $getOrder = OrderModel::getSingle($order_id);
                    if ($getOrder) {
                        $getOrder->is_payment = 1;
                        $getOrder->transaction_id = $transaction->id;

                        $getOrder->payment_data = json_encode($transaction);
                        $getOrder->save();

                        Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

                        $user_id = $getOrder->user_id;
                        $url = url('admin/order/detail/' . $getOrder->id);
                        $message = "New Order Placed #" . $getOrder->order_number;

                        NotificationModel::insertRecord($user_id, $url, $message);

                        $this->cart->clear();

                        return redirect('cart')->with('success', 'Order successfully placed.');
                    } else {
                        return redirect('checkout')->with('error', 'Order not found.');
                    }
                }
            } else {
                return redirect('checkout')->with('error', 'Payment failed');
            }
        } catch (HttpException $ex) {
            return redirect('checkout')->with('error', 'Payment failed: ' . $ex->getMessage());
        }
    }
    public function stripeSuccessPayment(Request $request)
    {
        $trans_id = Session::get('stripe_session_id');
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $getData = \Stripe\Checkout\Session::retrieve($trans_id);
        $getOrder = OrderModel::where('stripe_session_id', $getData->id)->first();

        if (!empty($getOrder) && !empty($getData->id) && $getData->id == $getOrder->stripe_session_id) {
            $getOrder->is_payment = 1;
            $getOrder->transaction_id = $getData->id;
            $getOrder->payment_data = json_encode($getData);
            $getOrder->save();
            Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

            $user_id = $getOrder->user_id;
            $url = url('admin/order/detail/' . $getOrder->id);
            $message = "New Order Placed #" . $getOrder->order_number;

            NotificationModel::insertRecord($user_id, $url, $message);

            $this->cart->clear();
            return redirect('cart')->with('success', 'Order successfully placed');
        } else {
            return redirect('cart')->with('error', 'Due to some error please try again');
        }
    }
}
