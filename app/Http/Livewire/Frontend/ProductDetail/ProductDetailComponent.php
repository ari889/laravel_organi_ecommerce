<?php

namespace App\Http\Livewire\Frontend\ProductDetail;

use App\Models\Product;
use Livewire\Component;
use Cart;

class ProductDetailComponent extends Component
{
    public $slug;

    public function mount($slug){
        $this->slug = $slug;
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
        $product = Product::where('slug', $this->slug)->first();
        $related_product = Product::where('category_id', $product->category_id)->where('slug', '!=', $this->slug)->inRandomOrder()->take(4)->get();
        return view('livewire.frontend.product-detail.product-detail-component', ['page_title' => $product->name, 'product' => $product, 'related_product' => $related_product])->layout('frontend.layouts.app', ['page_title' => $product->name]);
    }
}
