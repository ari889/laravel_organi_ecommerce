<?php

namespace App\Http\Livewire\Backend\Product;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Image;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $images;
    public $category_id;

    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'name' => 'required|unique:products,name|string',
            'slug' => 'required|unique:products,slug|string',
            'short_description' => 'nullable|max:1000|string',
            'description' => 'required|max:5000|string',
            'regular_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'sku' => 'required|integer|unique:products,sku',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'nullable|integer',
            'image' => 'required',
            'images' => 'nullable',
            'category_id' => 'required|integer',
        ]);
    }

    public function addProduct(){
        $this->validate([
            'name' => 'required|unique:products,name|string',
            'slug' => 'required|unique:products,slug|string',
            'short_description' => 'nullable|max:1000|string',
            'description' => 'required|max:5000|string',
            'regular_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'sku' => 'required|integer|unique:products,sku',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'nullable|integer',
            'image' => 'required',
            'images' => 'nullable',
            'category_id' => 'required|integer',
        ]);

        $imagePath = [];
        if($this->image){
            $uniqueNameFull = md5(time().rand()).'-full.'.$this->image->extension();
            $uniqueNameSm= md5(time().rand()).'-sm.'.$this->image->extension();
            $fullPath = $this->image->storeAs('productImages', $uniqueNameFull, 'public');
            $smPath = $this->image->storeAs('productImages', $uniqueNameSm, 'public');
            Image::make('storage/'.$smPath)->resize(270, 270)->save('storage/productImages/'.$uniqueNameSm);
            array_push($imagePath, $fullPath);
            array_push($imagePath, $smPath);
        }

        $imageName = [];
        if($this->images){
            foreach($this->images as $key=>$image){
                $uniqueName = md5(time().rand()).$key.'.'.$image->extension();
                $path = $image->storeAs('productImages', $uniqueName, 'public');
                Image::make('storage/'.$path)->resize(540, 560)->save('storage/productImages/'.$uniqueName);
                array_push($imageName, $path);
            }
        }

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $product->image = json_encode($imagePath);
        $product->images = json_encode($imageName);
        $product->category_id = $this->category_id;
        $product->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Product added!');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.backend.product.admin-add-product-component', ['page_title' => 'Add Product', 'categories' => $categories])->layout('backend.layouts.app', ['page_title' => 'Add Product']);
    }
}
