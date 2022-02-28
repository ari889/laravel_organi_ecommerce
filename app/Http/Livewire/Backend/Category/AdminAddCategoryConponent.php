<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Image;

class AdminAddCategoryConponent extends Component
{
    use WithFileUploads;

    public $image;
    public $name;
    public $slug;
    public $category_id;

    public function updated($fields){
        if($this->category_id){
            $this->validateOnly($fields, [
                'image' => 'nullable|mimes:png,jpg,jpeg,gif',
                'name' => 'required|unique:categories,name',
                'category_id' => 'required|integer'
            ]);
        }else{
            $this->validateOnly($fields, [
                'image' => 'nullable|mimes:png,jpg,jpeg,gif',
                'name' => 'required|unique:categories,name'
            ]);
        }
    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function addCategoryOrSubcategory(){
        if($this->category_id){
            $this->validate([
                'image' => 'nullable|mimes:png,jpg,jpeg,gif',
                'name' => 'required|unique:categories,name',
                'category_id' => 'required|integer'
            ]);

            Subcategory::create([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'slug' => $this->slug
            ]);
            $this->name = '';
            $this->slug = '';

            session()->flash('alert-type', 'success');
            session()->flash('message', 'Subcategory added!');
        }else{
            $this->validate([
                'image' => 'nullable|mimes:png,jpg,jpeg,gif',
                'name' => 'required|unique:categories,name'
            ]);

            $path = 'categoryImages/default.png';

            if($this->image){
                $uniqueName = md5(time().rand()).'.'.$this->image->extension();
                $path = $this->image->storeAs('categoryImages', $uniqueName, 'public');
                Image::make('storage/'.$path)->resize(270, 270)->save('storage/categoryImages/'.$uniqueName);
            }

            Category::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $path
            ]);
            $this->name = '';
            $this->slug = '';
            $this->image = '';

            session()->flash('alert-type', 'success');
            session()->flash('message', 'Category added!');
        }

    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.backend.category.admin-add-category-conponent', ['page_title' => 'Category', 'categories' => $categories])->layout('backend.layouts.app', ['page_title' => 'Category']);
    }
}
