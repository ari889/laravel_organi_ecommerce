<?php

namespace App\Http\Livewire\Frontend\Favorite;

use Livewire\Component;
use Cart;

class FavoriteComponent extends Component
{
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

    /**
     * add to cart
     */
    public function removeProductFromWishlistToCart($rowId){
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('frontend.wishlist.wishlist-count-component', 'refreshComponent');
        $this->emitTo('frontend.cart.cart-count-component', 'refreshComponent');
    }


    public function render()
    {
        return view('livewire.frontend.favorite.favorite-component', ['page_title' => 'Favorite'])->layout('frontend.layouts.app', ['page_title' => 'Favorite']);
    }
}
