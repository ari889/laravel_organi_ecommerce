<?php

namespace App\Http\Livewire\Backend\Order;

use App\Models\Order;
use Livewire\Component;

class AdminOrderViewComponent extends Component
{
    public $order_id;
    public function mount($id){
        $this->order_id = $id;
    }
    public function render()
    {
        $order = Order::find($this->order_id);
        return view('livewire.backend.order.admin-order-view-component', ['page_title' => 'View Order', 'order' => $order])->layout('backend.layouts.app', ['page_title' => 'View Order']);
    }
}
