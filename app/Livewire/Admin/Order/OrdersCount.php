<?php
namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class OrdersCount extends Component
{
    public $ordersCount;
    protected $listeners = ['OrderAddedUpdated' => 'updateOrdersCount'];

    public function mount()
    {
        $this->updateOrdersCount();
    }

    public function updateOrdersCount()
    {
        $this->ordersCount = Order::where('status_message', 'in progress')->count();
    }

    public function render()
    {
        return view('livewire.admin.order.orders-count', [
            'ordersCount' => $this->ordersCount
        ]);
    }
}
