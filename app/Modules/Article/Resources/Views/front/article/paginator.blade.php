<div class="nav-pages">
    <ul class="nav">
        @if (!$paginator->onFirstPage())
            <li class="fy">
                <a href="{{$paginator->previousPageUrl()}}">
                <span>
                    <i class="icon-left-open-big"></i>
                    上一页
                </span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active disabled">
                            <a href="javaScript:">
                                <span>{{ $page }}</span></a>
                        </li>
                    @else
                        <li class="page-item"><a href="{{$url}}"><span>{{ $page }}</span></a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="fy">
                <a href="{{ $paginator->nextPageUrl() }}">
                <span>
                    下一页
                    <i class="icon-right-open-big">

                    </i>
                </span>
                </a>
            </li>
        @endif
    </ul>
</div>
