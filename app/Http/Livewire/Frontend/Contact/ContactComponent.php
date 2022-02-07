<?php

namespace App\Http\Livewire\Frontend\Contact;

use Livewire\Component;

class ContactComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.contact.contact-component', ['page_title' => 'Contact'])->layout('frontend.layouts.app', ['page_title' => 'Contact']);
    }
}
