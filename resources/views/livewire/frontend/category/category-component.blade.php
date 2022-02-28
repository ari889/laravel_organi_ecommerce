<div>
    <!-- Breadcrumb Section Begin -->
    <div wire:ignore>
        @include('frontend.includes.breadcrumb', ['page_title' => $page_title])
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @foreach($categories as $category)
                                <li><a href="{{ route('category', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price: <span class="text-danger" style="font-size: 16px;">${{ $min_price }}</span> - <span class="text-danger" style="font-size: 16px;">${{ $max_price }}</span></h4>
                            <div class="price-range-wrap" wire:ignore>
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="1" data-max="1000">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel" wire:ignore>
                                    @foreach($latest_product as $product)
                                    <div class="latest-prdouct__slider__item">
                                        <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('storage/'.json_decode($product->image)[0]) }}" alt="">
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
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel" wire:ignore>
                                @foreach($on_sale_product as $product)
                                @php
                                    if($product->sale_price){
                                        $price = $product->sale_price;
                                    }else{
                                        $price = $product->regular_price;
                                    }
                                @endphp
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('storage/'.json_decode($product->image)[0]) }}">
                                            <div class="product__discount__percent">
                                                - {{ (($product->regular_price - $product->sale_price) * 100) / $product->regular_price }}%
                                            </div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart" wire:click.prevent="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $price }})"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>{{ $product->category->name }}</span>
                                            <h5><a href="#">{{ $product->name }}</a></h5>
                                            <div class="product__item__price">${{ $product->sale_price }} <span>${{ $product->regular_price }}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-6" wire:ignore>
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select id="sorting" wire:model.debounce.9999999ms="sorting">
                                        <option value="default">Default</option>
                                        <option value="date">Newest</option>
                                        <option value="price">Price : low to high</option>
                                        <option value="price-desc">Price : high to low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6" wire:ignore>
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select id="pagesize" wire:model.debounce.9999999ms="pagesize">
                                        <option value="12">12 per page</option>
                                        <option value="16">16 per page</option>
                                        <option value="20">20 per page</option>
                                        <option value="24">24 per page</option>
                                        <option value="28">28 per page</option>
                                        <option value="32">32 per page</option>
                                        <option value="36">36 per page</option>
                                        <option value="40">40 per page</option>
                                        <option value="44">44 per page</option>
                                        <option value="48">48 per page</option>
                                        <option value="52">52 per page</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="filter__found">
                                    <h6><span>{{ $pagesize }}</span> Products found</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                        @php
                            if($product->sale_price){
                                $price = $product->sale_price;
                            }else{
                                $price = $product->regular_price;
                            }
                        @endphp
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                    <img src="{{ asset('storage/'.json_decode($product->image)[0]) }}" alt="">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart" wire:click.prevent="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $price }})"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <span>{{ $product->category->name }}</span>
                                    <h5><a href="#">{{ $product->name }}</a></h5>
                                    @if($product->sale_price)
                                        <div class="product__item__price">${{ $product->sale_price }} <span>${{ $product->regular_price }}</span></div>
                                    @else
                                    <div class="product__item__price">${{ $product->regular_price }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $products->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
</div>

@push('scripts')
    <script>
        var rangeSlider = $(".price-range"),
            minamount = $("#minamount"),
            maxamount = $("#maxamount"),
            minPrice = rangeSlider.data('min'),
            maxPrice = rangeSlider.data('max');
            rangeSlider.slider({
                range: true,
                min: minPrice,
                max: maxPrice,
                values: [minPrice, maxPrice],
                slide: function (event, ui) {
                    minamount.val(ui.values[0]);
                    maxamount.val(ui.values[1]);
                    @this.set('min_price', ui.values[0]);
                    @this.set('max_price', ui.values[1]);
                }
            });
        minamount.val(rangeSlider.slider("values", 0));
        maxamount.val(rangeSlider.slider("values", 1));

        $(document).on('change', '#sorting', function(){
            @this.set('sorting', $(this).val())
        })
        $(document).on('change', '#pagesize', function(){
            @this.set('pagesize', $(this).val())
        })
    </script>
@endpush
