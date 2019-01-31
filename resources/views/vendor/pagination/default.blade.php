@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                <li class="page-item">
                    &lsaquo;
                </li>
            </a>
        @endif

        @if($paginator->currentPage() > 3)
            <a href="{{ $paginator->url(1) }}">
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">1</span>
                </li>
            </a>
        @endif
        @if($paginator->currentPage() > 4)
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                @else
                    <a href="{{ $paginator->url($i) }}">
                        <li class="page-item" aria-current="page">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    </a>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li class="page-item" aria-current="page"><span class="page-link">...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <a href="{{ $paginator->url($paginator->lastPage()) }}">
                <li class="page-item" aria-current="page">
                    <span class="page-link">{{ $paginator->lastPage() }}</span>
                </li>
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="paginationLastTab">
                <li class="page-item" aria-current="page">
                    <span class="page-link">&raquo;</span>
                </li>
            </a>
        @endif

        
</ul>
@endif
