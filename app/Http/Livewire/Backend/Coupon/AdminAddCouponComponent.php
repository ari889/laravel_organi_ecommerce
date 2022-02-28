<?php

namespace App\Http\Livewire\Backend\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class AdminAddCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $expiry_date;

    public function updated($fields){
        $this->validateOnly($fields, [
            'code' => 'required|unique:coupons,code',
            'type' => 'required|string',
            'value' => 'required|integer',
            'cart_value' => 'required|integer',
            'expiry_date' => 'required'
        ]);
    }

    public function addCoupon(){
        $this->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required|string',
            'value' => 'required|integer',
            'cart_value' => 'required|integer',
            'expiry_date' => 'required'
        ]);

        $coupon = new Coupon();
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->cart_value = $this->cart_value;
        $coupon->expiry_date = $this->expiry_date;
        $coupon->save();

        $this->code = '';
        $this->type = '';
        $this->value = '';
        $this->cart_value = '';
        $this->expiry_date = '';

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Coupon added!');


    }

    public function render()
    {
        return view('livewire.backend.coupon.admin-add-coupon-component', ['page_title' => 'Add Coupon'])->layout('backend.layouts.app', ['page_title' => 'Add Coupon']);
    }
}
