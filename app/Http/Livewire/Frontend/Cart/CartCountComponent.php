<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;

class CartCountComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.frontend.cart.cart-count-component');
    }
}
