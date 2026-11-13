{{--
    Satu halaman per kategori: setiap Halaman menjadi satu seksi (#slug).
    Daftar isi (desktop) & bar chip (HP) menandai seksi yang sedang dibaca (resources/js/penanda-gulir.js).
--}}
@extends('layouts.publik')

@section('judul', $categoryTitle)
@section('deskripsi', $deskripsiKategori ?: 'Informasi resmi Rumah Tahanan Negara Kelas IIB Pandeglang.')

@section('konten')
    <!-- HEADER KATEGORI -->
    <section class="relative overflow-hidden bg-navy-950 text-white">
        <div class="absolute inset-0 opacity-[0.05] bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] [background-size:44px_44px] [mask-image:linear-gradient(to_left,#000,transparent_70%)]" aria-hidden="true"></div>
        <div class="absolute -right-24 -bottom-24 w-96 h-96 rounded-full bg-emas-500/10 blur-3xl" aria-hidden="true"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
            <nav aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-navy-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" class="text-navy-100">{{ $categoryTitle }}</li>
                </ol>
            </nav>

            <p class="mt-5 text-xs font-bold uppercase tracking-widest text-emas-300">Rutan Kelas IIB Pandeglang</p>
            <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold tracking-tight break-words">{{ $categoryTitle }}</h1>
            @if($deskripsiKategori)
                <p class="mt-2 max-w-2xl text-[15px] leading-relaxed text-navy-200">{{ $deskripsiKategori }}</p>
            @endif
        </div>
    </section>

    <!-- PENANDA SUB-BAB (HP & tablet) -->
    <nav aria-label="Sub-bab {{ $categoryTitle }}" class="lg:hidden sticky top-[68px] z-30 border-b border-gray-200 bg-white/95 backdrop-blur">
        <div data-chip-bar class="relative flex gap-2 overflow-x-auto px-4 py-2.5 sm:px-6 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @foreach ($halamans as $halaman)
                <a href="#{{ $halaman->slug }}" data-penanda="{{ $halaman->slug }}"
                   class="shrink-0 whitespace-nowrap rounded-full border border-gray-200 bg-white px-3.5 py-1.5 text-sm font-medium text-gray-600 transition hover:border-navy-300 hover:text-navy-950 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 data-aktif:border-navy-950 data-aktif:bg-navy-950 data-aktif:text-white">
                    {{ $halaman->judul }}
                </a>
            @endforeach
        </div>
    </nav>

    <!-- SEKSI & DAFTAR ISI -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-10">
        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_15rem] xl:grid-cols-[minmax(0,1fr)_16rem] gap-6 lg:gap-8">

            <div class="min-w-0 space-y-4 lg:space-y-5">
                @foreach ($halamans as $halaman)
                    <section id="{{ $halaman->slug }}" data-seksi aria-labelledby="judul-{{ $halaman->slug }}"
                             class="scroll-mt-32 lg:scroll-mt-28 rounded-xl border border-gray-200 bg-white p-4 sm:p-6 shadow-sm">
                        <header class="mb-4 flex items-center gap-3 border-b border-gray-100 pb-4">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-navy-950 text-emas-400" aria-hidden="true">
                                <x-ikon :nama="$halaman->ikon" class="h-[18px] w-[18px]" />
                            </span>
                            <div class="min-w-0">
                                <h2 id="judul-{{ $halaman->slug }}" class="text-lg sm:text-xl font-extrabold tracking-tight text-navy-950 break-words">{{ $halaman->judul }}</h2>
                                @if($halaman->ringkasan)
                                    <p class="mt-0.5 text-sm leading-snug text-gray-500">{{ $halaman->ringkasan }}</p>
                                @endif
                            </div>
                        </header>

                        @if(trim(strip_tags($halaman->konten, '<img><table><iframe>')) !== '')
                            <div class="konten-halaman">
                                {!! $halaman->konten !!}
                            </div>
                        @endif

                        @if($halaman->slug === \App\Models\Halaman::SLUG_STRUKTUR && $struktur !== null)
                            <div class="mt-5">
                                <x-bagan-organisasi :pohon="$struktur" />
                            </div>
                        @endif

                        <p class="mt-4 text-xs text-gray-400">
                            Diperbarui <time datetime="{{ $halaman->updated_at?->toDateString() }}">{{ $halaman->updated_at?->translatedFormat('d F Y') }}</time>
                        </p>
                    </section>
                @endforeach
            </div>

            <aside class="min-w-0">
                <div class="space-y-4 lg:sticky lg:top-24">
                    <!-- Daftar isi (desktop) -->
                    <div class="hidden lg:block rounded-xl border border-gray-200 bg-white p-3 shadow-sm">
                        <h2 class="px-2.5 pt-1 pb-2.5 text-xs font-bold uppercase tracking-wider text-emas-700 border-b border-gray-100">
                            {{ $categoryTitle }}
                        </h2>
                        <nav aria-label="Daftar isi {{ $categoryTitle }}" class="mt-2 space-y-0.5">
                            @foreach ($halamans as $halaman)
                                <a href="#{{ $halaman->slug }}" data-penanda="{{ $halaman->slug }}"
                                   class="group flex items-center gap-2.5 rounded-lg border-l-[3px] border-transparent px-2.5 py-1.5 text-sm text-gray-600 transition hover:bg-gray-50 hover:text-navy-950 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 data-aktif:border-emas-500 data-aktif:bg-navy-50 data-aktif:font-semibold data-aktif:text-navy-950">
                                    <x-ikon :nama="$halaman->ikon" class="h-[16px] w-[16px] shrink-0 text-gray-400 transition-colors group-hover:text-emas-600 group-data-aktif:text-emas-600" />
                                    <span class="truncate">{{ $halaman->judul }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    <!-- Bantuan -->
                    <div class="rounded-xl border border-navy-100 bg-navy-50 p-4">
                        <p class="flex items-center gap-2 text-sm font-bold text-navy-950">
                            <x-ikon nama="chat" class="h-4 w-4 text-emas-600" />
                            Butuh bantuan?
                        </p>
                        <p class="mt-1.5 text-[13px] leading-relaxed text-gray-600">
                            Hubungi Humas untuk pertanyaan layanan, atau sampaikan pengaduan melalui SP4N-LAPOR!
                        </p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @if($kontak['whatsapp_humas'])
                                <a href="https://wa.me/{{ $kontak['whatsapp_humas'] }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-1.5 rounded-lg bg-navy-950 px-3 py-2 text-xs font-bold text-white transition hover:bg-navy-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 focus-visible:ring-offset-2">
                                    WhatsApp Humas
                                </a>
                            @endif
                            <a href="{{ $kontak['lapor'] }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1 rounded-lg border border-navy-200 bg-white px-3 py-2 text-xs font-bold text-navy-950 transition hover:border-navy-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500">
                                SP4N-LAPOR! <x-panah arah="serong" class="h-3.5 w-3.5" />
                            </a>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
@endsection
