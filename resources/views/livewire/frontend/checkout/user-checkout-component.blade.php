<div>
    <!-- Breadcrumb Section Begin -->
    <div wire:ignore>
        @include('frontend.includes.breadcrumb', ['page_title' => $page_title])
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form wire:submit.prevent="placeOrder">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" wire:model="firstname">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" wire:model="lastname">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" wire:model="country">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Address line 1" class="checkout__input__add"
                                    wire:model="line1">
                                <input type="text" placeholder="Address line 2" wire:model="line2">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" wire:model="city">
                            </div>
                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <input type="text" wire:model="province">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" wire:model="zipcode">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" wire:model="mobile">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" wire:model="email">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc" value="1" wire:model="ship_to_different">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            @if($ship_to_different)
                            <h4>Shipping Details</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" wire:model="s_firstname">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" wire:model="s_lastname">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Address line 1" class="checkout__input__add"
                                    wire:model="s_line1">
                                <input type="text" placeholder="Address line 2" wire:model="s_line2">
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" wire:model="s_country">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" wire:model="s_city">
                            </div>
                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <input type="text" wire:model="s_province">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" wire:model="s_zipcode">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" wire:model="s_mobile">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" wire:model="s_email">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach(Cart::instance('cart')->content() as $item)
                                    <li>{{ Str::limit($item->model->name, 10, '...') }} <span>${{ $item->price }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @if(Session::has('checkout'))
                                <div class="checkout__order__subtotal">Subtotal
                                    <span>${{ Session::get('checkout')['subtotal'] }}</span></div>
                                <div class="checkout__order__total">Discount
                                    <span>${{ Session::get('checkout')['discount'] }}</span></div>
                                <div class="checkout__order__total">Tax
                                    <span>${{ Session::get('checkout')['tax'] }}</span></div>
                                <div class="checkout__order__total">Total
                                    <span>${{ Session::get('checkout')['total'] }}</span></div>
                                @endif
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="cod"
                                        id="cod" wire:model="paymentmode">
                                    <label class="form-check-label" for="cod">
                                        Cash on delivery
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="paypal"
                                        id="paypal" wire:model="paymentmode">
                                    <label class="form-check-label" for="paypal">
                                        Paypal
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
</div>
