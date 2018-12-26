@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        @if($paginator->currentPage() > 3)
            <li class="page-item disabled" aria-disabled="true"><span class="page-link"><a href="{{ $paginator->url(1) }}">1</a></span></li>
        @endif
        @if($paginator->currentPage() > 4)
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                @else
                <li class="page-item" aria-current="page"><span class="page-link"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></span></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li class="page-item" aria-current="page"><span class="page-link">...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="page-item" aria-current="page"><span class="page-link"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></span></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item" aria-current="page"><span class="page-link"><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></span></li>
        @endif
    </ul>
@endif
