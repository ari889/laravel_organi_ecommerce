<?php

namespace App\Http\Livewire\Frontend\Home;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.home.home-component')->layout('frontend.layouts.app', ['page_title' => 'Home']);
    }
}
