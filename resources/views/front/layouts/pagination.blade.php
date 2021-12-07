{{-- <div class="text-center flex gap-5 justify-center items-center">
        <a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1"><</a>
        <a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white bg-primary text-white p-1">1</a>
        <a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">2</a>
        <a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">3</a>
        <a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">4</a>
        <a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">5</a>
        <a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">></a>
    </div> --}}

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="text-center flex gap-5 justify-center items-center">
        <div class="flex justify-between flex-1 sm:hidden mb-5">
            @if ($paginator->onFirstPage())
                <span class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
            <div class="my-5">
                <span class="relative z-0 inline-flex shadow-sm">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white bg-primary text-white p-1">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-primary p-1" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
