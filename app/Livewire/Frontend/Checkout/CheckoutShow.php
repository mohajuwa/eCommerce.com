<?php

namespace App\Livewire\Frontend\Checkout;

use App\Mail\PlaceOrderMailable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\WebsiteInfoOrder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Rules\ValidateGoogleMapsUrlAndComments;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0, $websiteInformations;

    public $fullname, $email, $phone, $pincode, $address, $payment_mode = null, $payment_id = null, $review;
    public $url;
    public $comments = '';
    public $noComments = false; // Define the noComments property
    public $hasReview = false;


    protected  $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];
    protected $messages = [
        'url.validate_google_maps_url' => 'The URL must be a valid Google Maps URL.',
    ];

    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by Paypal';

        $codOrder = $this->placeOrder();
        if ($codOrder) {

            Cart::where('user_id', auth()->user()->id)->delete();

            try {
                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
                // Mail sent successfully


            } catch (\Exception $e) {
            }
            $this->dispatch('OrderAddedUpdated');

            session()->flash('message', 'Order Placed Successfully');
            $this->dispatch('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200


            ]);

            return redirect()->to('thank-you');
        } else {
            $this->dispatch('message', [
                'text' => 'something went wrong',
                'type' => 'error',
                'status' => 500


            ]);
        }
    }
    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        if ($this->hasReview) {
            return [
                'fullname' => 'required|string|max:121',
                'email' => 'required|email|max:121',
                'phone' => 'required|string|max:11|min:9',
                'pincode' => 'required|string|max:6|min:6',
                'address' => 'required|string|max:500',
                'url' => 'required|validate_google_maps_url',
                'comments' => 'nullable|string',


            ];
        } else {
            return [
                'fullname' => 'required|string|max:121',
                'email' => 'required|email|max:121',
                'phone' => 'required|string|max:11|min:9',
                'pincode' => 'required|string|max:6|min:6',
                'address' => 'required|string|max:500',



            ];
        }
    }
    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'modwir.' . Str::random(10),
            'fullname' => $this->fullname,
            'email' =>  $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);
        foreach ($this->carts as $cartItem) {

            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product ? $cartItem->product->selling_price : 0,

            ]);

            if ($cartItem->product_color_id != NULL) {
                $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            } else {
                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }
        if ($this->hasReview) {
            $websiteInfo = WebsiteInfoOrder::create([
                'order_id' => $order->id,
                'url' => $this->url,
                'comments' => $this->comments

            ]);
        }




        return $order;
    }
    public function codOrder()
    {
        $this->payment_mode = 'Cash On Delivery';
        $codOrder = $this->placeOrder();
        if ($codOrder) {



            Cart::where('user_id', auth()->user()->id)->delete();
            try {
                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
                // Mail sent successfully


            } catch (\Exception $e) {
            }
            $this->dispatch('OrderAddedUpdated');

            session()->flash('message', 'Order Placed Successfully');
            $this->dispatch('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200


            ]);

            return redirect()->to('thank-you');
        } else {
            $this->dispatch('message', [
                'text' => 'something went wrong',
                'type' => 'error',
                'status' => 500


            ]);
        }
    }
    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($this->carts as $cartItem) {
            // Check if product is available before accessing properties
            if ($cartItem->product) {
                // Increment totalProductAmount only if product exists
                $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
            }
        }

        return $this->totalProductAmount;
    }
    public function handleNoCommentsCheckbox()
    {
        if ($this->noComments) {
            $this->comments = ''; // Clear comments when checkbox is checked
        }
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->phone = auth()->user()->userDetail->phone ?? null;
        $this->pincode = auth()->user()->userDetail->pin_code ?? null;
        $this->address = auth()->user()->userDetail->address ?? null;


        // $this->phone = auth()->user()->phone;
        $this->totalProductAmount = $this->totalProductAmount();
        $this->review = Cart::where('user_id', auth()->user()->id)->get();

        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount,
            'review' => $this->review,


        ]);
    }
}
