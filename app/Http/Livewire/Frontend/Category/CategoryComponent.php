<?php

namespace App\Http\Livewire\Frontend\Category;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    use WithPagination;


    /**
     * sorting product
     */
    public $sorting;
    public $pagesize;

    /**
     * price range
     */
    public $min_price;
    public $max_price;
    public $slug;


    public function mount($slug){
        $this->slug = $slug;
        $this->sorting = 'default';
        $this->pagesize = 12;

        $this->min_price = 1;
        $this->max_price = 1000;
    }

    public function addToCart($product_id, $product_name, $product_price){
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Product added to cart!');
        return redirect()->route('cart');
    }

    public function render()
    {
        $category = Category::select('id', 'name')->where('slug', $this->slug)->first();
        if($this->sorting == 'date'){
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->where('category_id', $category->id)->latest()->paginate($this->pagesize);
        }else if($this->sorting == 'price'){
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->where('category_id', $category->id)->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }else if($this->sorting == 'price-desc'){
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->where('category_id', $category->id)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }else{
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->where('category_id', $category->id)->paginate($this->pagesize);
        }
        $on_sale_product = Product::where('sale_price', '!=', null)->inRandomOrder()->limit(6)->get();
        $latest_product = Product::latest()->limit(9)->get();
        $categories = Category::all();
        return view('livewire.frontend.category.category-component', ['page_title' => $category->name, 'products' => $products, 'on_sale_product' => $on_sale_product, 'latest_product' => $latest_product, 'categories' => $categories])->layout('frontend.layouts.app', ['page_title' => $category->name]);
    }
}
