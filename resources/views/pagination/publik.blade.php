{{-- Pagination publik bermerek (navy + emas, berbahasa Indonesia). Pakai: $items->links('pagination.publik') --}}
@if ($paginator->hasPages())
    @php
        $kelasTombol = 'inline-flex items-center gap-1 rounded-lg border px-4 py-2 text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500';
        $kelasAktif = 'border-gray-200 bg-white text-navy-900 hover:border-navy-300 hover:bg-navy-50';
        $kelasMati = 'border-gray-200 bg-gray-50 text-gray-400 cursor-not-allowed';
    @endphp

    <nav role="navigation" aria-label="Navigasi halaman" class="flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-200 pt-6">
        <p class="hidden sm:block text-sm text-gray-600">
            Menampilkan <span class="font-semibold text-navy-950">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</span>
            dari <span class="font-semibold text-navy-950">{{ $paginator->total() }}</span> berita
        </p>
        <p class="sm:hidden text-sm text-gray-600">
            Halaman <span class="font-semibold text-navy-950">{{ $paginator->currentPage() }}</span> dari {{ $paginator->lastPage() }}
        </p>

        <div class="flex items-center gap-1.5">
            {{-- Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span class="{{ $kelasTombol }} {{ $kelasMati }}" aria-disabled="true">
                    <span aria-hidden="true">&lsaquo;</span> Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="{{ $kelasTombol }} {{ $kelasAktif }}">
                    <span aria-hidden="true">&lsaquo;</span> Sebelumnya
                </a>
            @endif

            {{-- Nomor halaman (desktop) --}}
            <span class="hidden sm:flex items-center gap-1.5">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-2 text-sm text-gray-400" aria-hidden="true">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="inline-flex h-10 min-w-10 items-center justify-center rounded-lg bg-navy-950 px-3 text-sm font-bold text-white">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" aria-label="Ke halaman {{ $page }}"
                                   class="inline-flex h-10 min-w-10 items-center justify-center rounded-lg border border-gray-200 bg-white px-3 text-sm font-semibold text-navy-900 hover:border-navy-300 hover:bg-navy-50 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </span>

            {{-- Berikutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="{{ $kelasTombol }} {{ $kelasAktif }}">
                    Berikutnya <span aria-hidden="true">&rsaquo;</span>
                </a>
            @else
                <span class="{{ $kelasTombol }} {{ $kelasMati }}" aria-disabled="true">
                    Berikutnya <span aria-hidden="true">&rsaquo;</span>
                </span>
            @endif
        </div>
    </nav>
@endif
