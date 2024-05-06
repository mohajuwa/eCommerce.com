<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DiscountCodeModel;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ShippingChargeModel;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Event;

class PaymentController extends Controller
{
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

        // Instantiate an object of the Cart class with required arguments
        $cart = new Cart(app(SessionManager::class), Event::getFacadeRoot(), null, 'cart', 'cart');

        // Call the add() method on the Cart object
        $cart->add([
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
    public function applay_discount_code(Request $request)
    {
        $getDiscount = DiscountCodeModel::checkDiscount($request->discount_code);
        $cart = new Cart(app(SessionManager::class), Event::getFacadeRoot(), null, 'cart', 'cart');
        $cartContent = $cart->getContent();

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
            $json['message'] = "Discount Code Successfully Applayed";
        } else {
            $json['discount_amount'] = '$ 0.00';
            $json['payable_total'] = $total;
            $json['status'] = false;
            $json['message'] = "Discount Code Invalid or Disappear";
        }
        echo json_encode($json);
    }
    public function cartDelete($id)
    {
        $cart = new Cart(app(SessionManager::class), Event::getFacadeRoot(), null, 'cart', 'cart');

        $cart->remove($id);
        return redirect()->back();

    }
    public function update_cart(Request $request)
    {
        $cart = new Cart(app(SessionManager::class), Event::getFacadeRoot(), null, 'cart', 'cart');

        foreach ($request->cart as $cartItem) {
            $cart->update($cartItem['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cartItem['qty'],
                ),
            ));

        }

        return redirect()->back();

    }
}
