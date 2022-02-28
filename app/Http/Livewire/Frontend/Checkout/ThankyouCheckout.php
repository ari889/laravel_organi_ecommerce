<?php

namespace App\Http\Livewire\Frontend\Checkout;

use Livewire\Component;

class ThankyouCheckout extends Component
{
    public function render()
    {
        return view('livewire.frontend.checkout.thankyou-checkout', ['page_title' => 'Thankyou'])->layout('frontend.layouts.app', ['page_title' => 'Thankyou']);
    }
}
