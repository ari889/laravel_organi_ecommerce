<?php

namespace App\Http\Livewire\Frontend\ForgetPassword;

use Livewire\Component;

class UserForgetPasswordComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.forget-password.user-forget-password-component', ['page_title' => 'Forget Password'])->layout('frontend.layouts.app', ['page_title' => 'Forget Password']);
    }
}
