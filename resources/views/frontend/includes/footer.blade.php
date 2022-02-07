@php
    $settings = new \App\Models\Settings();
@endphp
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route('home') }}"><img src="frontend/img/logo.png" alt=""></a>
                    </div>
                    <ul>
                        <li>Address: @if($settings->where('name', 'address')->count() > 0) {{ $settings->where('name', 'address')->first()->value }} @endif</li>
                        <li>Phone: @if($settings->where('name', 'phone')->count() > 0) {{ $settings->where('name', 'phone')->first()->value }} @endif</li>
                        <li>Email: @if($settings->where('name', 'email')->count() > 0) {{ $settings->where('name', 'email')->first()->value }} @endif</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">About Our Shop</a></li>
                        <li><a href="#">Secure Shopping</a></li>
                        <li><a href="#">Delivery infomation</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Our Sitemap</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Innovation</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Join Our Newsletter Now</h6>
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="@if($settings->where('name', 'facebook')->count() > 0) {{ $settings->where('name', 'facebook')->first()->value }} @endif"><i class="fa fa-facebook"></i></a>
                        <a href="@if($settings->where('name', 'instagram')->count() > 0) {{ $settings->where('name', 'instagram')->first()->value }} @endif"><i class="fa fa-instagram"></i></a>
                        <a href="@if($settings->where('name', 'twitter')->count() > 0) {{ $settings->where('name', 'twitter')->first()->value }} @endif"><i class="fa fa-twitter"></i></a>
                        <a href="@if($settings->where('name', 'pinterest')->count() > 0) {{ $settings->where('name', 'pinterest')->first()->value }} @endif"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            @if($settings->where('name', 'footer_text')->count() > 0) {!! $settings->where('name', 'footer_text')->first()->value !!} @endif
                        </p>
                    </div>
                    <div class="footer__copyright__payment"><img src="frontend/img/payment-item.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</footer>
