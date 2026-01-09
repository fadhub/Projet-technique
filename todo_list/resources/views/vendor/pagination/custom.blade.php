@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center gap-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-50 text-gray-300 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-50 text-gray-500 hover:bg-gray-100 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="w-9 h-9 flex items-center justify-center rounded-lg bg-primary-600 text-white font-semibold">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-50 text-gray-500 hover:bg-gray-100 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            </a>
        @else
            <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-50 text-gray-300 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            </span>
        @endif
    </nav>
@endif
