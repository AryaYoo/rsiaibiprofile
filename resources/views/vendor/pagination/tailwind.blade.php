@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between flex-wrap gap-4 py-3">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-xs font-bold text-gray-400 bg-white border border-gray-200 cursor-default rounded-xl">
                    &laquo; Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-xs font-bold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                    &laquo; Sebelumnya
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-xs font-bold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                    Berikutnya &raquo;
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-xs font-bold text-gray-400 bg-white border border-gray-200 cursor-default rounded-xl">
                    Berikutnya &raquo;
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between w-full">
            <div>
                <p class="text-xs text-gray-500">
                    Menampilkan
                    <span class="font-bold text-gray-800">{{ $paginator->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-bold text-gray-800">{{ $paginator->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-bold text-gray-800">{{ $paginator->total() }}</span>
                    data
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex items-center gap-1">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="@lang('pagination.previous')" class="relative inline-flex items-center justify-center w-9 h-9 text-xs font-bold text-gray-300 bg-white border border-gray-200 cursor-default rounded-xl">
                            <i class="fas fa-chevron-left text-[10px]"></i>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="relative inline-flex items-center justify-center w-9 h-9 text-xs font-bold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-all shadow-sm">
                            <i class="fas fa-chevron-left text-[10px]"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true" class="relative inline-flex items-center justify-center w-9 h-9 text-xs font-bold text-gray-400 bg-white border border-gray-200 cursor-default rounded-xl">{{ $element }}</span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="relative inline-flex items-center justify-center w-9 h-9 text-xs font-extrabold text-white bg-emerald-600 border border-emerald-600 rounded-xl shadow-sm">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="relative inline-flex items-center justify-center w-9 h-9 text-xs font-bold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-all shadow-sm">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="relative inline-flex items-center justify-center w-9 h-9 text-xs font-bold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-all shadow-sm">
                            <i class="fas fa-chevron-right text-[10px]"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="@lang('pagination.next')" class="relative inline-flex items-center justify-center w-9 h-9 text-xs font-bold text-gray-300 bg-white border border-gray-200 cursor-default rounded-xl">
                            <i class="fas fa-chevron-right text-[10px]"></i>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
