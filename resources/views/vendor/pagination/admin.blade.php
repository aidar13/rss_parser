@if ($paginator->hasPages())
    <div class="text-right">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="previous_page disabled"><span><i class="icon-chevron-left"></i></span></li>
            @else
                <li class="previous_page"><a href="{{ $paginator->previousPageUrl() }}">
                        <span><i class="icon-chevron-left"></i></span></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="dots disabled"><span>...</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page === $paginator->currentPage())
                            <li class="active"><a href="#">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next_page"><a href="{{ $paginator->nextPageUrl() }}"><i class="icon-chevron-right"></i></a></li>
            @else
                <li class="next_page disabled"><a href="#"><i class="icon-chevron-right"></i></a></li>
            @endif
        </ul>
    </div>
@endif
