<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class AdminEditSubcategoryComponent extends Component
{
    public $name;
    public $slug;
    public $category_id;
    public $subcategory_id;

    public function mount($id){
        $subcategory = Subcategory::find($id);
        $this->name = $subcategory->name;
        $this->slug = $subcategory->slug;
        $this->category_id = $subcategory->category_id;
        $this->subcategory_id = $subcategory->id;
    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'name' => 'required|unique:subcategories,name,'.$this->subcategory_id,
            'slug' => 'required|unique:subcategories,name,'.$this->subcategory_id,
            'category_id' => 'required|integer',
        ]);
    }

    public function updateSubcategory(){
        $this->validate([
            'name' => 'required|unique:subcategories,name,'.$this->subcategory_id,
            'slug' => 'required|unique:subcategories,name,'.$this->subcategory_id,
            'category_id' => 'required|integer',
        ]);

        $subcategory = Subcategory::find($this->subcategory_id);
        $subcategory->name = $this->name;
        $subcategory->slug = $this->slug;
        $subcategory->category_id = $this->category_id;
        $subcategory->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Subcategory updated!');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.backend.category.admin-edit-subcategory-component', ['page_title' => 'Edit '.$this->name, 'categories' => $categories])->layout('backend.layouts.app', ['page_title' => 'Edit '.$this->name]);
    }
}
