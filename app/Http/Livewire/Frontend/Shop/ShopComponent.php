<?php

namespace App\Http\Livewire\Frontend\Shop;

use Livewire\Component;

class ShopComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.shop.shop-component', ['page_title' => 'Shop'])->layout('frontend.layouts.app', ['page_title' => 'Shop']);
    }
}
