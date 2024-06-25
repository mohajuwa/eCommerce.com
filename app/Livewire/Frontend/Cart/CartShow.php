<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{

    public $cart, $totalPrice = 0;

    public   function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {

            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity >= $cartData->quantity) {
                    if ($cartData->quantity > 1) {
                        $cartData->decrement('quantity');
                        // $this->dispatch('message', [
                        //     'text' => 'Quantity Updated',
                        //     'type' => 'success',
                        //     'status' => 200
                        // ]);
                    } else {
                        $this->dispatch('message', [
                            'text' => 'At Least 1 Quantity ',
                            'type' => 'warning',
                            'status' => 201
                        ]);
                    }
                } else {
                    $this->dispatch('message', [
                        'text' => 'Only  ' . $productColor->quantity . '  Quantity Available ',
                        'type' => 'warning',
                        'status' => 201
                    ]);
                }
            } else {
                if ($cartData->product->quantity >= $cartData->quantity) {

                    if ($cartData->quantity > 1) {
                        $cartData->decrement('quantity');

                        // $this->dispatch('message', [
                        //     'text' => 'Quantity Updated ',
                        //     'type' => 'success',
                        //     'status' => 200
                        // ]);
                    } else {
                        $this->dispatch('message', [
                            'text' => 'At Least 1 Quantity ',
                            'type' => 'warning',
                            'status' => 201
                        ]);
                    }
                } else {
                    $this->dispatch('message', [
                        'text' => 'Only ' . $cartData->product->quantity . ' Quantity Available',
                        'type' => 'warning',
                        'status' => 201
                    ]);
                }
            }
        } else {
            $this->dispatch('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }
    public   function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {

            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {

                    $cartData->increment('quantity');
                    // $this->dispatch('message', [
                    //     'text' => 'Quantity Updated',
                    //     'type' => 'success',
                    //     'status' => 200
                    // ]);
                } else {
                    $this->dispatch('message', [
                        'text' => 'Only  ' . $productColor->quantity . '  Quantity Available',
                        'type' => 'warning',
                        'status' => 201
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');

                    // $this->dispatch('message', [
                    //     'text' => 'Quantity Updated',
                    //     'type' => 'success',
                    //     'status' => 200
                    // ]);
                } else {
                    $this->dispatch('message', [
                        'text' => 'Only  ' . $cartData->product->quantity . '  Quantity Available',
                        'type' => 'warning',
                        'status' => 201
                    ]);
                }
            }
        } else {
            $this->dispatch('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }
    public function removeCartItem(int $carId)
    {
        $cartRemoveData =   Cart::where('user_id', auth()->user()->id)->where('id', $carId)->first();
        if ($cartRemoveData) {
            $cartRemoveData->delete();
            $this->dispatch('CartAddedUpdated');
            $this->dispatch('message', [
                'text' => 'Cart Item Removed  Successfully',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            $this->dispatch('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
