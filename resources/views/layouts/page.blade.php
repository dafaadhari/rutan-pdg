@extends('layouts.publik')

@section('judul', $pageTitle)
@section('deskripsi', $halaman->ringkasan ?: 'Informasi resmi Rumah Tahanan Negara Kelas IIB Pandeglang.')

@section('konten')
    <!-- HEADER HALAMAN -->
    <section class="relative overflow-hidden bg-navy-950 text-white">
        <div class="absolute inset-0 opacity-[0.05] bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] [background-size:44px_44px] [mask-image:linear-gradient(to_left,#000,transparent_70%)]" aria-hidden="true"></div>
        <div class="absolute -right-24 -bottom-24 w-96 h-96 rounded-full bg-emas-500/10 blur-3xl" aria-hidden="true"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
            <nav aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-navy-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route($categoryRoute) }}" class="hover:text-white transition">{{ $categoryTitle }}</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" class="text-navy-100">{{ $pageTitle }}</li>
                </ol>
            </nav>

            <p class="mt-6 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-emas-300">
                <span class="w-6 h-px bg-emas-400"></span>
                {{ $categoryTitle }}
            </p>
            <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold tracking-tight break-words">{{ $pageTitle }}</h1>
            @if($halaman->ringkasan)
                <p class="mt-3 max-w-2xl text-base leading-relaxed text-navy-200">{{ $halaman->ringkasan }}</p>
            @endif
        </div>
    </section>

    <!-- KONTEN & SIDEBAR -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

            <article class="lg:col-span-8">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-8 lg:p-10 shadow-sm">
                    <div class="konten-halaman">
                        {!! $halaman->konten !!}
                    </div>
                </div>
                <p class="mt-4 text-xs text-gray-500">
                    Terakhir diperbarui <time datetime="{{ $halaman->updated_at?->toDateString() }}">{{ $halaman->updated_at?->translatedFormat('d F Y') }}</time>
                </p>
            </article>

            <aside class="lg:col-span-4 space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm lg:sticky lg:top-24">
                    <h2 class="px-2 pb-3 text-xs font-bold uppercase tracking-wider text-emas-700 border-b border-gray-100">
                        {{ $categoryTitle }}
                    </h2>

                    <nav aria-label="Menu {{ $categoryTitle }}" class="mt-2 space-y-0.5">
                        @foreach ($menuItems as $slug => $label)
                            @php $aktif = $slug === $currentSlug; @endphp
                            <a href="{{ route($categoryRoute, $slug) }}" @if($aktif) aria-current="page" @endif
                               class="group flex items-center justify-between gap-3 rounded-lg border-l-[3px] px-3 py-2.5 text-sm transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 {{ $aktif ? 'border-emas-500 bg-navy-50 font-semibold text-navy-950' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-navy-950' }}">
                                <span>{{ $label }}</span>
                                <svg class="w-4 h-4 shrink-0 {{ $aktif ? 'text-emas-600' : 'text-gray-300 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endforeach
                    </nav>

                    <!-- Kotak Pengaduan -->
                    <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4">
                        <p class="flex items-center gap-2 text-sm font-bold text-red-800">
                            <x-ikon nama="chat" class="w-4 h-4" />
                            Layanan Pengaduan
                        </p>
                        <p class="mt-1.5 text-sm leading-relaxed text-red-900/80">
                            Sampaikan aspirasi, keluhan, atau laporan pelayanan melalui kanal resmi rutan. Identitas pelapor dijamin kerahasiaannya.
                        </p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <a href="{{ route('layanan', 'pengaduan') }}" class="inline-flex items-center gap-1 rounded-lg bg-red-600 px-3 py-2 text-xs font-bold text-white hover:bg-red-700 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-red-400 focus-visible:ring-offset-2">
                                Sampaikan laporan
                            </a>
                            @if($kontak['whatsapp_pengaduan'])
                                <a href="https://wa.me/{{ $kontak['whatsapp_pengaduan'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 rounded-lg border border-red-300 px-3 py-2 text-xs font-bold text-red-700 hover:bg-red-100 transition">
                                    WhatsApp
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
@endsection
