<?php

namespace App\Http\Livewire\Frontend\Register;

use Livewire\Component;

class UserRegisterComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.register.user-register-component', ['page_title' => 'Register'])->layout('frontend.layouts.app', ['page_title' => 'Register']);
    }
}
