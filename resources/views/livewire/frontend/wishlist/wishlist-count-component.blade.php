<li>
    <a href="{{ route('favorite') }}">
        <i class="fa fa-heart"></i>
        @if(Cart::instance('wishlist')->count() > 0)
            <span>{{ Cart::instance('wishlist')->count() }}</span>
        @endif
    </a>
</li>
