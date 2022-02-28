<div>
    @php
        $witems = Cart::instance('wishlist')->content()->pluck('id');
    @endphp
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($categories as $category)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('storage/'.$category->image) }}">
                            <h5><a href="{{ route('category', ['slug' => $category->slug]) }}">{{ $category->name }}</a></h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li data-filter="*" class="active">All</li>
                            @foreach($tabCategories as $key=>$category)
                            <li data-filter=".cat_{{ $category->id }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($tabCategories as $key=>$category)
                    @php
                        $c_products = DB::table('products')->where('category_id', $category->id)->get()->take($no_of_products);
                    @endphp
                    @foreach($c_products as $product)
                        @php
                            if($product->sale_price){
                                $price = $product->sale_price;
                            }else{
                                $price = $product->regular_price;
                            }
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6 mix cat_{{ $category->id }}">
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
                                <div class="product__discount__item__text">
                                    {{-- <span>{{ $product->category->name }}</span> --}}
                                    <h5><a href="{{ route('product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h5>
                                    @if($product->sale_price)
                                        <div class="product__item__price">${{ $product->sale_price }} <span>${{ $product->regular_price }}</span></div>
                                    @else
                                    <div class="product__item__price">${{ $product->regular_price }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="frontend/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="frontend/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach($latestProduct as $product)
                            <div class="latest-prdouct__slider__item">
                                <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img wire:ignore src="{{ asset('storage/'.json_decode($product->image)[0]) }}" style="width: 100px !important;max-height: 100px;" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        @if($product->sale_price)
                                        <span>${{ $product->sale_price }} <del class="text-danger" style="font-size: 14px">${{ $product->regular_price }}</del></span>
                                        @else
                                        <span>${{ $product->regular_price }}</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>On Sale products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach($onSaleProducts as $product)
                            <div class="latest-prdouct__slider__item">
                                <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img wire:ignore src="{{ asset('storage/'.json_decode($product->image)[0]) }}" style="width: 100px !important;max-height: 100px;" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        @if($product->sale_price)
                                        <span>${{ $product->sale_price }} <del class="text-danger" style="font-size: 14px">${{ $product->regular_price }}</del></span>
                                        @else
                                        <span>${{ $product->regular_price }}</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach($orderItems as $item)
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="storage/{{ json_decode($item->product->image)[0] }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $item->product->name }}</h6>
                                        @if($item->product->sale_price)
                                        <span>${{ $item->product->sale_price }} <del class="text-danger" style="font-size: 14px">${{ $item->product->regular_price }}</del></span>
                                        @else
                                        <span>${{ $item->product->regular_price }}</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="frontend/img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="frontend/img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="frontend/img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
</div>
