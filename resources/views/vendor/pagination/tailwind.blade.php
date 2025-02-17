@if ($paginator->hasPages())
    <nav role="navigation" class="flex justify-center mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 mr-2 text-gray-400 bg-gray-200 rounded cursor-not-allowed">← Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-4 py-2 mr-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition">← Previous</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-4 py-2 text-gray-400">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 text-white bg-blue-600 rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 text-blue-600 bg-gray-200 rounded hover:bg-gray-300 transition">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-4 py-2 ml-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition">Next →</a>
        @else
            <span class="px-4 py-2 ml-2 text-gray-400 bg-gray-200 rounded cursor-not-allowed">Next →</span>
        @endif
    </nav>
@endif
