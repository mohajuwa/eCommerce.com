<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class OrdersDisplay extends Component
{
    public $ordersCount;
    protected $listeners = ['OrderListdUpdated' => 'checkOrderCout'];

    public function checkOrderCout()
    {
        
        return   $this->ordersCount = Order::where('status_message', 'in progress')->latest()->get()->take(5);
    }

    public function render()
    {
        $this->ordersCount = $this->checkOrderCout();

        return view('livewire.admin.order.orders-display', [
            'ordersCount' => $this->ordersCount

        ]);
    }
}
