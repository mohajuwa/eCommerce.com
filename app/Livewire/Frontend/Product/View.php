<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $productColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist');

                $this->dispatch('message', [
                    'text' => 'Already added to wishlist',
                    'type' => 'warning',
                    'status' => 409
                ]);


                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                session()->flash('message', 'Added To WishList Successfully ');


                $this->dispatch('wishlistAddedUpdated');

                $this->dispatch('message', [
                    'text' => 'Added To WishList Successfully ',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            session()->flash('message', 'Please Login to Continue');



            $this->dispatch('message', [
                'text' => 'Please Login to Continue',
                'type' => 'error',
                'status' => 401


            ]);
            return false;
        }
    }
    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                // Check for Product Color quantity and add to cart
                if ($this->product->productColors()->count() > 1) {
                    if ($this->productColorSelectedQuantity != NULL) {

                        if (Cart::where('user_id', auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->productColorId)
                            ->exists()
                        ) {
                            $this->dispatch('message', [
                                'text' => 'Product Already Added To Carts With This Color ',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        } else {
                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity > $this->quantityCount) {

                                    // Insert Product to Cart with colors
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' =>  $this->productColorId,
                                        'quantity' => $this->quantityCount

                                    ]);
                                    $this->dispatch('CartAddedUpdated');

                                    $this->dispatch('message', [
                                        'text' => 'Product Added To Cart Successfully',
                                        'type' => 'success',
                                        'status' => 200
                                    ]);
                                } else {
                                    $this->dispatch('message', [
                                        'text' => 'Only   ' . $productColor->quantity . '   Quantity Available',
                                        'type' => 'warning',
                                        'status' => 404
                                    ]);
                                }
                            } else {
                                $this->dispatch('message', [
                                    'text' => 'Out Of Stock',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        }
                    } else {
                        $this->dispatch('message', [
                            'text' => 'Select Your Product Color',
                            'type' => 'info',
                            'status' => 404
                        ]);
                    }
                } else {

                    if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {

                        $this->dispatch('message', [
                            'text' => 'Product Already Added To Carts ',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    } else {


                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity >= $this->quantityCount) {

                                // Insert Product to Cart
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount

                                ]);

                                $this->dispatch('CartAddedUpdated');

                                $this->dispatch('message', [
                                    'text' => 'Product Added To Cart Successfully',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            } else {
                                $this->dispatch('message', [
                                    'text' => 'Only   ' . $this->product->quantity . 'JKSJ   Quantity Available',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatch('message', [
                                'text' => 'Out Of Stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatch('message', [
                    'text' => 'Product Does Not Exist',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatch('message', [
                'text' => 'Please Login to add to cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }
    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor =  $this->product->productColors()->where('id', $productColorId)->first();
        $this->productColorSelectedQuantity = $productColor->quantity;

        if ($this->productColorSelectedQuantity == 0) {
            $this->productColorSelectedQuantity = 'outOfStock';
        }
    }
    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }
    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }


    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category,
        ]);
    }
}
