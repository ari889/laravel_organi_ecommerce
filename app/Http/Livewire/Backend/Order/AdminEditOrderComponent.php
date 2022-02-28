<?php

namespace App\Http\Livewire\Backend\Order;

use App\Models\Order;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;

class AdminEditOrderComponent extends Component
{
    public $order_id;
    public $mobile;
    public $email;
    public $line1;
    public $line2;
    public $country;
    public $city;
    public $province;
    public $zipcode;
    public $status;
    public $is_shipping_different;

    public $s_firstname;
    public $s_lastname;
    public $s_mobile;
    public $s_email;
    public $s_line1;
    public $s_line2;
    public $s_country;
    public $s_city;
    public $s_province;
    public $s_zipcode;


    public function mount($id){
        $order = Order::find($id);
        $this->order_id              = $id;
        $this->mobile                = $order->mobile;
        $this->email                 = $order->email;
        $this->line1                 = $order->line1;
        $this->line2                 = $order->line2;
        $this->country               = $order->country;
        $this->city                  = $order->city;
        $this->province              = $order->province;
        $this->zipcode               = $order->zipcode;
        $this->status                = $order->status;
        $this->is_shipping_different = $order->is_shipping_different;

        if($order->is_shipping_different == 1){
            $shipping = Shipping::where('order_id', $id)->first();
            $this->s_firstname = $shipping->firstname;
            $this->s_lastname  = $shipping->lastname;
            $this->s_mobile    = $shipping->mobile;
            $this->s_email     = $shipping->email;
            $this->s_line1     = $shipping->line1;
            $this->s_line2     = $shipping->line2;
            $this->s_country   = $shipping->country;
            $this->s_city      = $shipping->city;
            $this->s_province  = $shipping->province;
            $this->s_zipcode   = $shipping->zipcode;
        }
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'mobile' => 'required',
            'email' => 'required|email',
            'line1' => 'required|string',
            'line2' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'zipcode' => 'required|integer',
            'status' => 'required|string',
            'is_shipping_different' => 'required',
        ]);

        if($this->is_shipping_different == 1){
            $this->validateOnly($fields, [
                's_firstname' => 'required',
                's_lastname' => 'required',
                's_mobile' => 'required',
                's_email' => 'required|email',
                's_line1' => 'required|string',
                's_line2' => 'nullable|string',
                's_country' => 'required|string',
                's_city' => 'required|string',
                's_province' => 'required|string',
                's_zipcode' => 'required|integer',
            ]);
        }
    }

    public function updateOrder(){
        $this->validate([
            'mobile' => 'required',
            'email' => 'required|email',
            'line1' => 'required|string',
            'line2' => 'nullable|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'zipcode' => 'required|integer',
            'status' => 'required|string',
            'is_shipping_different' => 'required',
        ]);

        if($this->is_shipping_different == 1){
            $this->validate([
                's_firstname' => 'required',
                's_lastname' => 'required',
                's_mobile' => 'required',
                's_email' => 'required|email',
                's_line1' => 'required|string',
                's_line2' => 'nullable|string',
                's_country' => 'required|string',
                's_city' => 'required|string',
                's_province' => 'required|string',
                's_zipcode' => 'required|integer',
            ]);
            $shipping = Shipping::where('order_id', $this->order_id)->first();
            if($shipping){
                $shipping->firstname = $this->s_firstname;
                $shipping->lastname = $this->s_lastname;
                $shipping->mobile = $this->s_mobile;
                $shipping->email = $this->s_email;
                $shipping->line1 = $this->s_line1;
                $shipping->line2 = $this->s_line2;
                $shipping->country = $this->s_country;
                $shipping->city = $this->s_city;
                $shipping->province = $this->s_province;
                $shipping->zipcode = $this->s_zipcode;
                $shipping->save();
            }else{
                $new_s = new Shipping();
                $new_s->order_id = $this->order_id;
                $new_s->firstname = $this->s_firstname;
                $new_s->lastname = $this->s_lastname;
                $new_s->mobile = $this->s_mobile;
                $new_s->email = $this->s_email;
                $new_s->line1 = $this->s_line1;
                $new_s->line2 = $this->s_line2;
                $new_s->country = $this->s_country;
                $new_s->city = $this->s_city;
                $new_s->province = $this->s_province;
                $new_s->zipcode = $this->s_zipcode;
                $new_s->save();
            }
        }
        $order = Order::find($this->order_id);
        $order->mobile = $this->mobile;
        $order->email = $this->email;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->country = $this->country;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->zipcode = $this->zipcode;
        $order->status = $this->status;
        if($this->status == 'delivered'){
            $order->delivered_date = Carbon::today();
        }
        $order->is_shipping_different = $this->is_shipping_different;
        $order->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Order Updated');
    }



    public function render()
    {
        $orderItems = OrderItem::where('order_id', $this->order_id)->get();
        return view('livewire.backend.order.admin-edit-order-component', ['page_title' => 'Edit Order', 'orderItems' => $orderItems])->layout('backend.layouts.app', ['page_title' => 'Edit Order']);
    }
}
