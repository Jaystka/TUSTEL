@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="w-full sm:w-auto sm:mr-auto">
    <div class="pagination">
        @if ($paginator->onFirstPage())
        <span class="page-item">
            <span class="page-link">
                <i class="w-4 h-4" data-feather="chevrons-left"></i>
            </span>
        </span>
        @else
        <span class="page-item">
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
                <i class="w-4 h-4" data-feather="chevrons-left"></i>
            </a>
        </span>
        @endif



        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <span aria-disabled="true" class="page-item" aria-label="{{ __('pagination.previous') }}">
            <span class="page-link" aria-hidden="true">
                <i class="w-4 h-4" data-feather="chevron-left"></i>
            </span>
        </span>
        @else
        <span class="page-item">
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link"
                aria-label="{{ __('pagination.previous') }}">
                <i class="w-4 h-4" data-feather="chevron-left"></i>
            </a>
        </span>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <span aria-disabled="true" class="page-item">
            <span class="page-link">{{ $element }}</span>
        </span>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span class="page-item active" aria-current="page">
            <span class="page-link">{{ $page }}</span>
        </span>
        @else
        <div class="page-item">
            <a href="{{ $url }}" class="page-link" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                {{ $page }}
            </a>
        </div>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <span class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link"
                aria-label="{{ __('pagination.next') }}">
                <i class="w-4 h-4" data-feather="chevron-right"></i>
            </a>
        </span>
        @else
        <span class="page-item" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
            <span class="page-link" aria-hidden="true">
                <i class="w-4 h-4" data-feather="chevron-right"></i>
            </span>
        </span>
        @endif

        @if ($paginator->hasMorePages())
        <span class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
                <i class="w-4 h-4" data-feather="chevrons-right"></i>
            </a>
        </span>
        @else
        <span class="page-item">
            <span class="page-link"><i class="w-4 h-4" data-feather="chevrons-right"></i></span>
        </span>
        @endif
    </div>
</nav>
@endif