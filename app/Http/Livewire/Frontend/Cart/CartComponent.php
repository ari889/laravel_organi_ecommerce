<?php

namespace App\Http\Livewire\Frontend\Cart;

use Cart;
use App\Models\Coupon;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $texAfterDiscount;
    public $totalAfterDiscount;


    /**
     * remove product from cart
     */
    public function destroy($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('frontend.cart.cart-count-component', 'refreshComponent');
    }

    /**
     * increase product quantity
     */
    public function increaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty+1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('frontend.cart.cart-count-component', 'refreshComponent');
    }

    /**
     * increase product quantity
     */
    public function decreaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty-1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('frontend.cart.cart-count-component', 'refreshComponent');
    }

    /**
     * apply coupon
     */
    public function applyCouponCode(){
        $coupon = Coupon::where('code', $this->couponCode)->where('expiry_date', '>=', Carbon::today())->where('cart_value', '<=', floatval(Cart::instance('cart')->subtotal(2, '.', '')))->first();

        if(!$coupon){
            session()->flash('coupon_message', 'Coupon code is invalid');
            return;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
    }

    /**
     * calculate coupon discount
     */
    public function calculateDiscount(){
        if(session()->has('coupon')){
            if(session()->get('coupon')['type'] == 'fixed'){
                $this->discount = session()->get('coupon')['value'];
            }else{
                $this->discount = (floatval(Cart::instance('cart')->subtotal(2, '.', '')) * session()->get('coupon')['value']) / 100;
            }
            $this->subtotalAfterDiscount = floatval(Cart::instance('cart')->subtotal(2, '.', '')) - $this->discount;
            $this->texAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax')) / 100;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->texAfterDiscount;
        }
    }

    /**
     * remove coupon
     */
    public function removeCoupon(){
        session()->forget('coupon');
    }

    /**
     * check redirect
     */
    public function checkout(){
        if(Auth::check()){
            return redirect()->route('checkout');
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * set amount for checkout
     */
    public function setAmountForCheckout(){
        if(!Cart::instance('cart')->count() > 0){
            session()->forget('checkout');
        }

        if(session()->has('coupon')){
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->texAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        }else{
            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(2, '.', ''),
                'tax' => Cart::instance('cart')->tax(2, '.', ''),
                'total' => Cart::instance('cart')->total(2, '.', '')
            ]);
        }
    }

    public function render()
    {
        if(session()->has('coupon')){
            if(floatval(Cart::instance('cart')->subtotal(2, '.', '')) < floatval(session()->get('coupon')['cart_value'])){
                session()->forget('coupon');
            }else{
                $this->calculateDiscount();
            }
        }

        $this->setAmountForCheckout();

        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
        }


        return view('livewire.frontend.cart.cart-component', ['page_title' => 'Cart'])->layout('frontend.layouts.app', ['page_title' => 'Cart']);
    }
}
