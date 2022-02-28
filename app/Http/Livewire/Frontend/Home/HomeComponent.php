<?php

namespace App\Http\Livewire\Frontend\Home;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\OrderItem;
use Cart;

class HomeComponent extends Component
{
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
        $homeCategories = HomeCategory::find(1);
        $cats = explode(',', $homeCategories->sel_categories);
        $tabCategories = Category::whereIn('id', $cats)->get();
        $no_of_products = $homeCategories->no_of_products;
        $latestProduct = Product::latest()->take(12)->get();
        $onSaleProducts = Product::where('sale_price', '!=', null)->get();
        $orderItems = OrderItem::where('rstatus', 1)->select('product_id')->distinct()->get();
        return view('livewire.frontend.home.home-component', ['categories' => $categories, 'tabCategories' => $tabCategories, 'no_of_products' => $no_of_products, 'latestProduct' => $latestProduct, 'onSaleProducts' => $onSaleProducts, 'orderItems' => $orderItems])->layout('frontend.layouts.app', ['page_title' => 'Home']);
    }
}
