<div>
    <!-- Breadcrumb Section Begin -->
    <div wire:ignore>
        @include('frontend.includes.breadcrumb', ['page_title' => $page_title])
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        @if(Cart::instance('cart')->count() > 0)
                        @if(Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Cart::instance('cart')->content() as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset('storage/'.json_decode($item->model->image)[0]) }}" width="100" alt="">
                                        <a href="{{ route('product.detail', ['slug' => $item->model->slug]) }}"><h5>{{ $item->model->name }}</h5></a>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{ ($item->model->sale_price) ? $item->model->sale_price : $item->model->regular_price }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <span class="dec qtybtn" wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')">-</span>
                                                <input type="text" value="{{ $item->qty }}">
                                                <span class="inc qtybtn" wire:click.prevent="increaseQuantity('{{ $item->rowId }}')">+</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{ $item->subtotal }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="#" wire:click.prevent="destroy('{{ $item->rowId }}')"><span class="icon_close"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="jumbotron jumbotron-fluid text-center">
                            <div class="container">
                              <h1 class="display-4">No items found in the cart.</h1>
                              <p class="lead">Please add some product from the <a href="{{ route('shop') }}">Shop</a> page and save product to wishlist.</p>
                            </div>
                          </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    @if(!Session::has('coupon'))
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            @if(Session::has('coupon_message'))
                            <div class="alert alert-danger">
                                {{ Session::get('coupon_message') }}
                            </div>
                            @enderror
                            <form wire:submit.prevent="applyCouponCode">
                                <div>
                                    <input type="text" class="form-control @error('couponCode') is-invalid @enderror" placeholder="Enter your coupon code" wire:model="couponCode">
                                    @error('couponCode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="site-btn mt-3">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            @if(Session::has('coupon'))
                                <li>Discount ( {{ Session::get('coupon')['code'] }} ) <a href="#" class="text-danger" wire:click.prevent="removeCoupon">&times;</a> <span>${{ number_format($discount, 2) }}</span></li>
                                <li>Subtotal with discount <span>${{ number_format($subtotalAfterDiscount, 2) }}</span></li>
                                <li>Tax after discount <span>${{ number_format($texAfterDiscount, 2) }}</span></li>
                                <li>Shipping <span>Free Shipping</span></li>
                                <li>Total after discounte <span>${{ number_format($totalAfterDiscount, 2) }}</span></li>
                            @else
                                <li>Subtotal <span>${{ Cart::instance('cart')->subtotal() }}</span></li>
                                <li>Tax <span>${{ Cart::instance('cart')->tax() }}</span></li>
                                <li>Shipping <span>Free Shipping</span></li>
                                <li>Total <span>${{ Cart::instance('cart')->total() }}</span></li>
                            @endif
                        </ul>
                        <a href="#" class="primary-btn" wire:click.prevent="checkout">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
</div>
