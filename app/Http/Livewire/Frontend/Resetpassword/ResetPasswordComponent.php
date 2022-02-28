<?php

namespace App\Http\Livewire\Frontend\Resetpassword;

use Livewire\Component;

class ResetPasswordComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.resetpassword.reset-password-component', ['page_title' => 'Reset Password'])->layout('frontend.layouts.app', ['page_title' => 'Reset Password']);
    }
}
