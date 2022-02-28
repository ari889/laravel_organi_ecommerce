<?php

namespace App\Http\Livewire\Backend\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class AdminCouponComponent extends Component
{
    public function render()
    {
        return view('livewire.backend.coupon.admin-coupon-component', ['page_title' => 'Coupon'])->layout('backend.layouts.app', ['page_title' => 'Coupon']);
    }
}
