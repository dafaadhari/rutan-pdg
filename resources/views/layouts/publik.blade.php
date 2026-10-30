@php
    $namaSitus = 'Rutan Kelas IIB Pandeglang';
    // Nilai @section inline sudah di-escape Blade; decode agar tidak ter-escape ganda saat dicetak
    $ambil = fn ($nama) => html_entity_decode(trim($__env->yieldContent($nama)), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $judulHalaman = $ambil('judul');
    $judulLengkap = $judulHalaman ? "{$judulHalaman} - {$namaSitus}" : "{$namaSitus} - Kementerian Imigrasi dan Pemasyarakatan RI";
    $deskripsi = $ambil('deskripsi')
        ?: 'Portal informasi resmi Rumah Tahanan Negara Kelas IIB Pandeglang: jadwal kunjungan, layanan publik, pengaduan, informasi publik, dan berita kegiatan.';
    $gambarOg = $ambil('og_image') ?: \App\Support\Aset::ogDefault();
    $logo = \App\Support\Aset::logo();
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judulLengkap }}</title>
    <meta name="description" content="{{ $deskripsi }}">
    <meta name="theme-color" content="#060d1d">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Pratinjau tautan (WhatsApp, Facebook, X) -->
    <meta property="og:type" content="{{ $ambil('og_type') ?: 'website' }}">
    <meta property="og:site_name" content="{{ $namaSitus }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="{{ $judulHalaman ?: $namaSitus }}">
    <meta property="og:description" content="{{ $deskripsi }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($gambarOg)
        <meta property="og:image" content="{{ $gambarOg }}">
        <meta name="twitter:card" content="summary_large_image">
    @else
        <meta name="twitter:card" content="summary">
    @endif

    <link rel="icon" href="{{ $logo ?? asset('favicon.ico') }}">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased flex flex-col min-h-screen selection:bg-emas-200 selection:text-navy-950">

    <a href="#konten"
       class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[60] focus:rounded-lg focus:bg-emas-400 focus:px-4 focus:py-2 focus:text-sm focus:font-bold focus:text-navy-950 focus:shadow-lg">
        Lewati ke konten
    </a>

    @include('partials.navbar')

    <main id="konten" class="flex-grow">
        @yield('konten')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
