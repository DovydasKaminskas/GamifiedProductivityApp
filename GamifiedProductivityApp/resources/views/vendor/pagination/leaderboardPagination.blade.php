@if ($paginator->hasPages())
    <nav>
        <ul class="pagination" >
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                    <li class="disabledLeft" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        {{--                    <span aria-hidden="true">&lsaquo;</span>--}}
                        <i aria-hidden="true" class="fa-solid fa-angle-left px-3 py-1"></i>
                    </li>
            @else
                <li class="enabledLeft">
                    <a class="px-3 py-1" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i aria-hidden="true" class="fa-solid fa-angle-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled px-3" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span class="px-3">{{ $page }}</span></li>
                        @else
                            <li><a class="px-3 py-1" style="" href="{{ $url }}">{{ $page }}</a></li>
{{--                            <a style="" href="{{ $url }}"><li class="px-3">{{ $page }}</li></a>--}}
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="enabledRight">
                    <a class="enabledRight px-3 py-1" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i aria-hidden="true" class="fa-solid fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="disabledRight"  aria-disabled="true" aria-label="@lang('pagination.next')">
                    <i aria-hidden="true" class="fa-solid fa-angle-right px-3 py-1"></i>
                </li>
            @endif
        </ul>
    </nav>
@endif
