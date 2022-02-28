<div>
    <style>
        .product__item__pic__hover li.active a{
            background: #7fad39;
            border-color: #7fad39;
            color: #fff;
        }
    </style>
    <!-- Breadcrumb Section Begin -->
    <div wire:ignore>
        @include('frontend.includes.breadcrumb', ['page_title' => $page_title])
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title product__discount__title">
                        <h2>Wishlist Items</h2>
                    </div>
                    @if(Cart::instance('wishlist')->content()->count() > 0)
                    <div class="row">
                        @foreach(Cart::instance('wishlist')->content() as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                    <img src="{{ asset('storage/'.json_decode($item->model->image)[0]) }}" alt="">
                                    <ul class="product__item__pic__hover">
                                        <li class="active"><a href="#"><i class="fa fa-heart" wire:click.prevent="removeFromWishlist({{ $item->model->id }})"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart" wire:click.prevent="removeProductFromWishlistToCart('{{ $item->rowId }}')"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <span>{{ $item->model->category->name }}</span>
                                    <h5><a href="{{ route('product.detail', ['slug' => $item->model->slug]) }}">{{ $item->model->name }}</a></h5>
                                    @if($item->model->sale_price)
                                        <div class="product__item__price">${{ $item->model->sale_price }} <span>${{ $item->model->regular_price }}</span></div>
                                    @else
                                    <div class="product__item__price">${{ $item->model->regular_price }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="jumbotron jumbotron-fluid text-center">
                        <div class="container">
                          <h1 class="display-4">No items found in the wishlist.</h1>
                          <p class="lead">Please add some product from the <a href="{{ route('shop') }}">Shop</a> page for checkout.</p>
                        </div>
                      </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
</div>
