@php
    $settings = new \App\Models\Settings();
@endphp
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> @if($settings->where('name', 'email')->count() > 0) {{ $settings->where('name', 'email')->first()->value }} @endif</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="@if($settings->where('name', 'facebook')->count() > 0) {{ $settings->where('name', 'facebook')->first()->value }} @endif"><i class="fa fa-facebook"></i></a>
                            <a href="@if($settings->where('name', 'twitter')->count() > 0) {{ $settings->where('name', 'twitter')->first()->value }} @endif"><i class="fa fa-twitter"></i></a>
                            <a href="@if($settings->where('name', 'instagram')->count() > 0) {{ $settings->where('name', 'instagram')->first()->value }} @endif"><i class="fa fa-instagram"></i></a>
                            <a href="@if($settings->where('name', 'pinterest')->count() > 0) {{ $settings->where('name', 'pinterest')->first()->value }} @endif"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="frontend/img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Spanis</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            <a href="#"><i class="fa fa-user"></i> Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="frontend/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="@if(request()->routeIs('home')) active @endif"><a href="{{ route('home') }}">Home</a></li>
                        <li class="@if(request()->routeIs('shop')) active @endif"><a href="{{ route('shop') }}">Shop</a></li>
                        <li class="@if(request()->routeIs('blog')) active @endif"><a href="{{ route('blog') }}">Blog</a></li>
                        <li class="@if(request()->routeIs('contact')) active @endif"><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ route('favorite') }}"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>$150.00</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>

<!-- Hero Section Begin -->
<section class="hero @if(!request()->routeIs('home')) hero-normal @endif">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        <li><a href="#">Fresh Meat</a></li>
                        <li><a href="#">Vegetables</a></li>
                        <li><a href="#">Fruit & Nut Gifts</a></li>
                        <li><a href="#">Fresh Berries</a></li>
                        <li><a href="#">Ocean Foods</a></li>
                        <li><a href="#">Butter & Eggs</a></li>
                        <li><a href="#">Fastfood</a></li>
                        <li><a href="#">Fresh Onion</a></li>
                        <li><a href="#">Papayaya & Crisps</a></li>
                        <li><a href="#">Oatmeal</a></li>
                        <li><a href="#">Fresh Bananas</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>@if($settings->where('name', 'phone')->count() > 0) {{ $settings->where('name', 'phone')->first()->value }} @endif</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                @if(request()->routeIs('home'))
                    <div class="hero__item set-bg" data-setbg="frontend/img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
