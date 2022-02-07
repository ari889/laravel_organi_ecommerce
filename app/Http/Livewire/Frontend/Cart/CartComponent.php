<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;

class CartComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.cart.cart-component', ['page_title' => 'Cart'])->layout('frontend.layouts.app', ['page_title' => 'Cart']);
    }
}
