<?php

namespace App\Http\Livewire\Backend\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class AdminEditCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $expiry_date;
    public $coupon_id;

    public function mount($id){
        $coupon = Coupon::find($id);
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->cart_value = $coupon->cart_value;
        $this->expiry_date = $coupon->expiry_date;
        $this->coupon_id = $coupon->id;
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'code' => 'required|unique:coupons,code,'.$this->coupon_id,
            'type' => 'required|string',
            'value' => 'required',
            'cart_value' => 'required',
            'expiry_date' => 'required'
        ]);
    }

    public function updateCoupon(){
        $this->validate([
            'code' => 'required|unique:coupons,code,'.$this->coupon_id,
            'type' => 'required|string',
            'value' => 'required',
            'cart_value' => 'required',
            'expiry_date' => 'required'
        ]);
        $coupon = Coupon::find($this->coupon_id);

        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->cart_value = $this->cart_value;
        $coupon->expiry_date = $this->expiry_date;
        $coupon->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Coupon Updated!');
    }


    public function render()
    {
        return view('livewire.backend.coupon.admin-edit-coupon-component', ['page_title' => 'Edit '.$this->code])->layout('backend.layouts.app', ['page_title' => 'Edit '.$this->code]);
    }
}
