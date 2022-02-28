<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Component
{
    use WithPagination;

    public function deleteCategory($id){
        $category = Category::find($id);
        if(Storage::disk('public')->exists($category->image) && $category->image != 'categoryImages/default.png'){
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Category deleted!');
    }

    public function deleteSubcategory($id){
        $category = Subcategory::find($id);

        $category->delete();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Subcategory deleted!');
    }

    public function render()
    {
        $categories = Category::latest()->paginate(10);
        return view('livewire.backend.category.admin-category-controller', ['page_title' => 'Category', 'categories' => $categories])->layout('backend.layouts.app', ['page_title' => 'Category']);
    }
}
