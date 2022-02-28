<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Mail\OrderMail;
use Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserCheckoutComponent extends Component
{
    public $ship_to_different;
    /**
     * billing details property
     */
    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country;
    public $zipcode;

    /**
     * shipping details property
     */
    public $s_firstname;
    public $s_lastname;
    public $s_email;
    public $s_mobile;
    public $s_line1;
    public $s_line2;
    public $s_city;
    public $s_province;
    public $s_country;
    public $s_zipcode;

    public $paymentmode;
    public $thankyou;

    public function mount(){
        $this->email = Auth::user()->email;
    }

    /**
     * place order
     */
    public function placeOrder(){
        $this->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required',
            'line1' => 'required|string',
            'line2' => 'nullable|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'country' => 'required|string',
            'zipcode' => 'required|integer',
            'paymentmode' => 'required|string',
        ]);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];
        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->email = $this->email;
        $order->mobile = $this->mobile;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->zipcode = $this->zipcode;
        $order->status = 'ordered';
        $order->is_shipping_different = $this->ship_to_different ? 1 : 0;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }

        if($this->ship_to_different){
            $this->validate([
                's_firstname' => 'required|string',
                's_lastname' => 'required|string',
                's_email' => 'required|email',
                's_mobile' => 'required',
                's_line1' => 'required|string',
                's_line2' => 'nullable|string',
                's_city' => 'required|string',
                's_province' => 'required|string',
                's_country' => 'required|string',
                's_zipcode' => 'required|integer'
            ]);

            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->firstname = $this->s_firstname;
            $shipping->lastname = $this->s_lastname;
            $shipping->email = $this->s_email;
            $shipping->mobile = $this->s_mobile;
            $shipping->line1 = $this->s_line1;
            $shipping->line2 = $this->s_line2;
            $shipping->city = $this->s_city;
            $shipping->province = $this->s_province;
            $shipping->country = $this->s_country;
            $shipping->zipcode = $this->s_zipcode;
            $shipping->save();
        }

        if($this->paymentmode == 'cod'){
            $this->makeTransection($order->id, 'pending');
            $this->resetCart();
        }

        $this->sendOrderConfirmationEmail($order);
    }

    /**
     * send order confirmation email
     */
    public function sendOrderConfirmationEmail($order){
        Mail::to($order->email)->send(new OrderMail($order));
    }

    /**
     * verify checkout
     */
    public function verifyCheckout(){
        if($this->thankyou){
            return redirect()->route('thankyou');
        }
    }

    /**
     * make transaction
     */
    public function makeTransection($order_id, $status){
        $transaction = new Transection();

        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $this->paymentmode;
        $transaction->status = $status;
        $transaction->save();
    }

    /**
     * reset cart after order
     */
    public function resetCart(){
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }


    public function render()
    {
        $this->verifyCheckout();
        return view('livewire.frontend.checkout.user-checkout-component', ['page_title' => 'Checkout'])->layout('frontend.layouts.app', ['page_title' => 'Checkout']);
    }
}
