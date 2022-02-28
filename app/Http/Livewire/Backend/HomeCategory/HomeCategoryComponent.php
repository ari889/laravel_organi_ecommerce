<?php

namespace App\Http\Livewire\Backend\HomeCategory;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class HomeCategoryComponent extends Component
{
    public $selected_categories = [];
    public $noofproducts;

    public function mount(){
        $category = HomeCategory::find(1);
        $this->selected_categories = explode(',', $category->sel_categories);
        $this->noofproducts = $category->no_of_products;
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'selected_categories' => 'required',
            'noofproducts' => 'required|integer'
        ]);
    }

    public function updateHomeCategories(){
        $this->validate([
            'selected_categories' => 'required',
            'noofproducts' => 'required|integer'
        ]);

        $category = HomeCategory::find(1);
        $category->sel_categories = implode(',', $this->selected_categories);
        $category->no_of_products = $this->noofproducts;
        $category->save();

        session()->flash('message', 'Home category updated!');
    }


    public function render()
    {
        $categories = Category::all();
        return view('livewire.backend.home-category.home-category-component', ['page_title' => 'Home Category', 'categories' => $categories])->layout('backend.layouts.app', ['page_title' => 'Home Category']);
    }
}
