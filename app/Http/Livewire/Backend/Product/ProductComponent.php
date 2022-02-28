<?php

namespace App\Http\Livewire\Backend\Product;

use App\Models\Category;
use Livewire\Component;

class ProductComponent extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.backend.product.product-component', ['page_title' => 'Product', 'categories' => $categories])->layout('backend.layouts.app', ['page_title' => 'Product']);
    }
}
