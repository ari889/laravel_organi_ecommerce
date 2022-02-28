<div>
    <style>
        .woocommerce-Reviews-title {
            font-size: 15px;
            font-weight: 600;
        }

        .woocommerce-Reviews-title span {
            font-weight: 400;
            font-style: italic;
        }

        .commentlist {
            padding: 0;
        }

        .commentlist li {
            list-style: none;
            display: block;
            width: 100%;
            float: left;
            margin-bottom: 15px;
        }

        .commentlist li .comment_container img {
            max-width: 80px;
            float: left;
        }

        .commentlist li .comment_container .comment-text {
            float: left;
            width: calc(100% - 80px);
            width: -webkit-calc(100% - 80px);
            width: -moz-calc(100% - 80px);
            padding-left: 15px;
        }

        .commentlist li .comment_container .meta {
            margin-bottom: 8px;
        }

        .star-rating {
            font-size: 0;
            position: relative;
            display: inline-block;
        }

        @media screen and (-ms-high-contrast: active),
        (-ms-high-contrast: none) {
            .star-rating {
                overflow: hidden;
            }
        }

        .star-rating::before {
            content: "\f005\f005\f005\f005\f005";
            font-family: FontAwesome;
            font-size: 15px;
            color: #e6e6e6;
        }

        .star-rating span {
            display: inline-block;
            float: left;
            overflow-x: hidden;
            position: absolute;
            top: 0;
            left: 0;
        }

        .star-rating span:before {
            content: "\f005\f005\f005\f005\f005";
            font-family: FontAwesome;
            font-size: 15px;
            color: #efce4a;
        }

        .width-0-percent{
            width: 0%;
        }
        .width-20-percent{
            width: 20%;
        }
        .width-40-percent{
            width: 40%;
        }
        .width-60-percent{
            width: 60%;
        }
        .width-80-percent{
            width: 80%;
        }
        .width-100-percent{
            width: 100%;
        }

    </style>
    @php
    $witems = Cart::instance('wishlist')->content()->pluck('id');
        if($product->sale_price){
            $price = $product->sale_price;
        }else{
            $price = $product->regular_price;
        }
    @endphp
    <!-- Breadcrumb Section Begin -->
    <div wire:ignore>
        @include('frontend.includes.breadcrumb', ['page_title' => $page_title])
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('storage/'.json_decode($product->image)[1]) }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ asset('storage/'.json_decode($product->image)[1]) }}" src="{{ asset('storage/'.json_decode($product->image)[1]) }}" alt="">
                            @foreach(json_decode($product->images) as $image)
                            <img data-imgbigurl="{{ asset('storage/'.$image) }}"
                                src="{{ asset('storage/'.$image) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        @php
                            $avgRating = 0;
                        @endphp
                        @foreach($product->orderItems->where('rstatus', 1) as $orderItem)
                            @php
                                $avgRating = $avgRating + $orderItem->review->rating;
                            @endphp
                        @endforeach
                        <div class="product__details__rating">
                            @for($i=1;$i<=5;$i++)
                                @if($i<=$avgRating)
                                <i class="fa fa-star"></i>
                                @else
                                <i class="fa fa-star-half-o"></i>
                                @endif
                            @endfor
                            <span>({{ $product->orderItems->where('rstatus', 1)->count() }} reviews)</span>
                        </div>
                        <div class="product__details__price">${{ $product->sale_price }} <del class="text-secondary">${{ $product->regular_price }}</del></div>
                        <p>{!! $product->short_description !!}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn" wire:click.prevent="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $price }})">ADD TO CART</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>{{ Str::ucfirst($product->stock_status) }}</span></li>
                            <li><b>Shipping</b> <span><samp>Free shipping</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#description" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#reviews" role="tab"
                                    aria-selected="false">Reviews <span>({{ $product->orderItems->where('rstatus', 1)->count() }})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="description" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Product Description</h6>
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="reviews" role="tabpanel">
                                <ol class="commentlist">
                                    @foreach($product->orderItems->where('rstatus', 1) as $orderItem)
                                    <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                        <div id="comment-20" class="comment_container">
                                            <img alt="" src="{{ asset('frontend/img/default/default.png') }}" height="80" width="80">
                                            <div class="comment-text">
                                                <div class="star-rating">
                                                    <span class="width-{{ $orderItem->review->rating * 20 }}-percent">Rated <strong class="rating">{{ $orderItem->review->rating }}</strong> out of 5</span>
                                                </div>
                                                <p class="meta">
                                                    <strong class="woocommerce-review__author">{{ $orderItem->order->user->name }}</strong>
                                                    <span class="woocommerce-review__dash">–</span>
                                                    <time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >{{ \Carbon\Carbon::parse($orderItem->review->created_at)->format('d F y g:i A') }}</time>
                                                </p>
                                                <div class="description">
                                                    <p>{{ $orderItem->review->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($related_product as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg">
                            <img src="{{ asset('storage/'.json_decode($product->image)[0]) }}" alt="">
                            <ul class="product__item__pic__hover">
                                @if($witems->contains($product->id))
                                    <li class="active"><a href="#" wire:click.prevent="removeFromWishlist({{ $product->id }})"><i class="fa fa-heart"></i></a></li>
                                @else
                                    <li><a href="#" wire:click.prevent="addToWishlist({{ $product->id }}, '{{ $product->name }}', {{ $price }})"><i class="fa fa-heart"></i></a></li>
                                @endif
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="javascript:;"><i class="fa fa-shopping-cart" wire:click.prevent="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $price }})"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h6>
                            @if($product->sale_price)
                            <h5>${{ $product->sale_price }} <del class="text-secondary">{{ $product->regular_price }}</del></h5>
                            @else
                            <h5>${{ $product->regular_price }}</h5>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
</div>
