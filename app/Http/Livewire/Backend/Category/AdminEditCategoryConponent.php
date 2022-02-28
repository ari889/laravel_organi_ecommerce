<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminEditCategoryConponent extends Component
{
    public $name;
    public $slug;
    public $category_id;

    public function mount($id){
        $category = Category::find($id);
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->category_id = $category->id;
    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'name' => 'required|unique:categories,name,'.$this->category_id,
            'slug' => 'required|unique:categories,slug,'.$this->category_id
        ]);
    }

    public function updateCategory(){
        $this->validate([
            'name' => 'required|unique:categories,name,'.$this->category_id,
            'slug' => 'required|unique:categories,slug,'.$this->category_id
        ]);
        $category = Category::find($this->category_id);

        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Category updated!');
    }

    public function render()
    {
        return view('livewire.backend.category.admin-edit-category-conponent', ['page_title' => 'Edit '.$this->name])->layout('backend.layouts.app', ['page_title' => 'Edit '.$this->name]);
    }
}
