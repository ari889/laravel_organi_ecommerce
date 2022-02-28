<?php

namespace App\Http\Livewire\Frontend\Shop;

use Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShopComponent extends Component
{
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

    public function mount(){
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
        $on_sale_product = Product::where('sale_price', '!=', null)->inRandomOrder()->limit(6)->get();
        $latest_product = Product::latest()->limit(9)->get();
        if($this->sorting == 'date'){
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->latest()->paginate($this->pagesize);
        }else if($this->sorting == 'price'){
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }else if($this->sorting == 'price-desc'){
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }else{
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])->paginate($this->pagesize);
        }
        $categories = Category::all();

        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.frontend.shop.shop-component', ['page_title' => 'Shop', 'products' => $products, 'on_sale_product' => $on_sale_product, 'latest_product' => $latest_product, 'categories' => $categories])->layout('frontend.layouts.app', ['page_title' => 'Shop']);
    }
}
