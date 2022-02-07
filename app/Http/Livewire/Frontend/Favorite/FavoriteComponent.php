<?php

namespace App\Http\Livewire\Frontend\Favorite;

use Livewire\Component;

class FavoriteComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.favorite.favorite-component', ['page_title' => 'Favorite'])->layout('frontend.layouts.app', ['page_title' => 'Favorite']);
    }
}
