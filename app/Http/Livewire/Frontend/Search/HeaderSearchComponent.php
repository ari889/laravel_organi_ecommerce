<?php

namespace App\Http\Livewire\Frontend\Search;

use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $search;

    public function mount(){
        $this->fill(request()->only('search'));
    }
    public function render()
    {
        return view('livewire.frontend.search.header-search-component');
    }
}
