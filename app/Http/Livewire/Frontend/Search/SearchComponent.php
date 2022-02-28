<?php

namespace App\Http\Livewire\Frontend\Search;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    public $search;

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

    public function mount(){
        $this->fill(request()->only('search'));

        $this->sorting = 'default';
        $this->pagesize = 12;

        $this->min_price = 1;
        $this->max_price = 1000;
    }

    /**
     * add to cart
     */
    public function addToCart($product_id, $product_name, $product_price){
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('frontend.cart.cart-count-component', 'refreshComponent');
    }

    /**
     * add to wishlist
     */
    public function addToWishlist($product_id, $product_name, $product_price){
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('frontend.wishlist.wishlist-count-component', 'refreshComponent');
    }

    /**
     * remove from wishlist
     */
    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $witem){
            if($witem->id == $product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('frontend.wishlist.wishlist-count-component', 'refreshComponent');
                return;
            }
        }
    }

    public function render()
    {
        $categories = Category::all();
        if($this->sorting == 'date'){
            $products = Product::where('name' , 'like', '%'.$this->search.'%')->whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        }else if($this->sorting == 'price'){
            $products = Product::where('name' , 'like', '%'.$this->search.'%')->whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }else if($this->sorting == 'price-desc'){
            $products = Product::where('name' , 'like', '%'.$this->search.'%')->whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }else{
            $products = Product::where('name' , 'like', '%'.$this->search.'%')->whereBetween('regular_price', [$this->min_price, $this->max_price])->paginate($this->pagesize);
        }
        return view('livewire.frontend.search.search-component', ['page_title' => 'Search "'.$this->search.'"', 'categories' => $categories, 'products' => $products])->layout('frontend.layouts.app', ['page_title' => 'Search "'.$this->search.'"']);
    }
}
