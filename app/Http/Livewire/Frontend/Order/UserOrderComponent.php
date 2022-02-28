<?php

namespace App\Http\Livewire\Frontend\Order;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserOrderComponent extends Component
{
    public $order_id;

    public function mount($id){
        $this->order_id = $id;
    }


    /**
     * cancel order by user
     */
    public function cancelOrder(){
        $order = Order::find($this->order_id);
        $order->status = 'cancel';
        $order->cancel_date = Carbon::today();
        $order->save();
        session()->flash('order_message', 'Order has been cancelled');
    }

    public function render()
    {
        $order = Order::where('id', $this->order_id)->where('user_id', Auth::user()->id)->first();
        return view('livewire.frontend.order.user-order-component', ['page_title' => 'Order', 'order' => $order])->layout('frontend.layouts.app', ['page_title' => 'Order']);
    }
}
