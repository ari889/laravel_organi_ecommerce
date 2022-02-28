<?php

namespace App\Http\Livewire\Backend\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
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
    public $newImage;
    public $images;
    public $newImages;
    public $category_id;
    public $product_id;

    public function mount($id){
        $product = Product::find($id);

        $this->name              = $product->name;
        $this->slug              = $product->slug;
        $this->short_description = $product->short_description;
        $this->description       = $product->description;
        $this->regular_price     = $product->regular_price;
        $this->sale_price        = $product->sale_price;
        $this->sku               = str_replace('DIGI_', '', $product->sku);
        $this->stock_status      = $product->stock_status;
        $this->featured          = $product->featured;
        $this->quantity          = $product->quantity;
        $this->image             = $product->image;
        $this->images            = json_decode($product->images);
        $this->category_id       = $product->category_id;
        $this->product_id        = $product->id;
    }

    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'name' => 'required|unique:products,name,'.$this->product_id.'|string',
            'slug' => 'required|unique:products,slug,'.$this->product_id.'|string',
            'short_description' => 'nullable|max:1000|string',
            'description' => 'required|max:5000|string',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'sku' => 'required|integer|unique:products,sku,'.$this->product_id,
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'nullable|integer',
            'newImage' => 'nullable',
            'newImages' => 'nullable',
            'category_id' => 'required|integer',
        ]);
    }

    public function updateProduct(){
        $this->validate([
            'name' => 'required|unique:products,name,'.$this->product_id.'|string',
            'slug' => 'required|unique:products,slug,'.$this->product_id.'|string',
            'short_description' => 'nullable|max:1000|string',
            'description' => 'required|max:5000|string',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'sku' => 'required|integer|unique:products,sku,'.$this->product_id,
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'nullable|integer',
            'newImage' => 'nullable',
            'newImages' => 'nullable',
            'category_id' => 'required|integer',
        ]);

        $imagePath = [];
        if($this->newImage){
            if(Storage::disk('public')->exists(json_decode($this->image)[0])){
                Storage::disk('public')->delete(json_decode($this->image)[0]);
            }
            if(Storage::disk('public')->exists(json_decode($this->image)[1])){
                Storage::disk('public')->delete(json_decode($this->image)[1]);
            }
            $uniqueNameFull = md5(time().rand()).'-full.'.$this->newImage->extension();
            $uniqueNameSm= md5(time().rand()).'-sm.'.$this->newImage->extension();
            $fullPath = $this->newImage->storeAs('productImages', $uniqueNameFull, 'public');
            $smPath = $this->newImage->storeAs('productImages', $uniqueNameSm, 'public');
            Image::make('storage/'.$smPath)->resize(270, 270)->save('storage/productImages/'.$uniqueNameSm);
            array_push($imagePath, $fullPath);
            array_push($imagePath, $smPath);
        }else{
            $imagePath = json_decode($this->image);
        }

        $imageName = [];
        if($this->newImages){
            foreach($this->images as $image){
                if(Storage::disk('public')->exists($image)){
                    Storage::disk('public')->delete($image);
                }
            }
            foreach($this->newImages as $key=>$image){
                $uniqueName = md5(time().rand()).$key.'.'.$image->extension();
                $path = $image->storeAs('productImages', $uniqueName, 'public');
                Image::make('storage/'.$path)->resize(540, 560)->save('storage/productImages/'.$uniqueName);
                array_push($imageName, $path);
            }
        }else{
            $imageName = $this->images;
        }

        $product = Product::find($this->product_id);
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
        return view('livewire.backend.product.admin-edit-product-component', ['page_title' => 'Add Product', 'categories' => $categories])->layout('backend.layouts.app', ['page_title' => 'Add Product']);
    }
}
