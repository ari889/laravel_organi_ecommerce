<?php

namespace App\Http\Livewire\Frontend\Login;

use Livewire\Component;

class LoginComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.login.login-component', ['page_title' => 'Login'])->layout('frontend.layouts.app', ['page_title' => 'Login']);
    }
}
