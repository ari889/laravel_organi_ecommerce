<div>
    <div class="hero__search__form">
        <form action="{{ route('search') }}">
            <input type="text" name="search" placeholder="What do yo u need?" value="{{ $search }}">
            <button type="submit" class="site-btn">SEARCH</button>
        </form>
    </div>
</div>
