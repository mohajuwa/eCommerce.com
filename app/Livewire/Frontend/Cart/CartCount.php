<?php

namespace App\Livewire\Frontend\Cart;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Livewire\Component;

class CartCount extends Component
{

    public $cartCount;
    protected $listeners = ['CartAddedUpdated' => 'checkCartCout'];

    public function checkCartCout()
    {
        if (Auth::check()) {
            return  $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
        } else {
            return  $this->cartCount = 0;
        }
    }
    
    public function render()
    {
        $this->cartCount = $this->checkCartCout();

        return view('livewire.frontend.cart.cart-count', [
            'cartCount' => $this->cartCount
        ]);
    }
}
