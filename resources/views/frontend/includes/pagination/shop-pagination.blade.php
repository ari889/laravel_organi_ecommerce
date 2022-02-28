<style>
    .product__pagination a.active{
        background: #7fad39;
        border-color: #7fad39;
        color: #ffffff;
    }
</style>


@if ($paginator->hasPages())
    <div class="product__pagination">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" class="disabled" rel="prev"><i class="fa fa-long-arrow-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="disabled"><span>{{ $element }}</span></div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="javascript:;" class="active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-long-arrow-right"></i></a>
        @endif
    </div>
@endif
