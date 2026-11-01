{{--
    Layout halaman error. Sengaja mandiri (tanpa navbar/footer & tanpa query database)
    agar tetap tampil walaupun database bermasalah (500/503).
--}}
@php
    $kontak = config('rutan.kontak');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="theme-color" content="#060d1d">
    <title>@yield('judul') - Rutan Kelas IIB Pandeglang</title>
    @fonts
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-navy-950 font-sans text-white antialiased flex flex-col">
    <div class="pointer-events-none fixed inset-0 opacity-[0.05] bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] [background-size:44px_44px] [mask-image:radial-gradient(ellipse_at_center,#000_20%,transparent_70%)]" aria-hidden="true"></div>
    <div class="pointer-events-none fixed -top-32 left-1/2 -translate-x-1/2 w-[640px] h-[640px] rounded-full bg-emas-500/10 blur-3xl" aria-hidden="true"></div>

    <header class="relative max-w-5xl w-full mx-auto px-6 py-6">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-400 rounded-lg">
            <x-logo class="w-11 h-11" />
            <span class="leading-tight">
                <span class="block text-xs text-navy-300">Kemenimipas Republik Indonesia</span>
                <span class="block text-base font-extrabold">Rutan Kelas IIB Pandeglang</span>
            </span>
        </a>
    </header>

    <main class="relative flex-grow flex items-center">
        <div class="max-w-5xl w-full mx-auto px-6 py-16">
            <p class="text-sm font-bold uppercase tracking-widest text-emas-400">Kode @yield('kode')</p>
            <h1 class="mt-3 text-4xl sm:text-5xl font-extrabold tracking-tight">@yield('judul')</h1>
            <p class="mt-4 max-w-xl text-base sm:text-lg leading-relaxed text-navy-200">@yield('pesan')</p>

            <div class="mt-9 flex flex-wrap gap-3">
                <a href="{{ url('/') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-emas-500 px-6 py-3 text-sm font-bold text-navy-950 hover:bg-emas-400 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-300 focus-visible:ring-offset-2 focus-visible:ring-offset-navy-950">
                    <span aria-hidden="true"><x-panah arah="kiri" /></span> Kembali ke beranda
                </a>
                @yield('aksi')
            </div>

            @yield('tambahan')
        </div>
    </main>

    <footer class="relative border-t border-white/10">
        <div class="max-w-5xl mx-auto px-6 py-5 flex flex-col sm:flex-row sm:justify-between gap-2 text-xs text-navy-300">
            <p>&copy; {{ date('Y') }} Rutan Kelas IIB Pandeglang · Kementerian Imigrasi dan Pemasyarakatan RI</p>
            <p class="flex flex-wrap gap-x-4">
                @if($kontak['telepon'])
                    <span>Telp. {{ $kontak['telepon'] }}</span>
                @endif
                @if($kontak['email'])
                    <a href="mailto:{{ $kontak['email'] }}" class="hover:text-white">{{ $kontak['email'] }}</a>
                @endif
            </p>
        </div>
    </footer>
</body>
</html>
