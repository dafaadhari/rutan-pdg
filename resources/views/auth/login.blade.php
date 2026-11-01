<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="theme-color" content="#060d1d">
    <title>Masuk Dasbor Pengelola - Rutan Kelas IIB Pandeglang</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-navy-950 font-sans text-gray-800 antialiased flex flex-col selection:bg-emas-200 selection:text-navy-950">
    <div class="pointer-events-none fixed inset-0 opacity-[0.05] bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] [background-size:44px_44px] [mask-image:radial-gradient(ellipse_at_center,#000_25%,transparent_75%)]" aria-hidden="true"></div>
    <div class="pointer-events-none fixed -top-40 left-1/2 -translate-x-1/2 w-[640px] h-[640px] rounded-full bg-emas-500/10 blur-3xl" aria-hidden="true"></div>

    <main class="relative flex flex-1 flex-col items-center justify-center px-5 py-12">
        <div class="w-full max-w-md">
            <!-- Identitas -->
            <a href="{{ url('/') }}" class="mx-auto flex w-fit items-center gap-3 text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-400 rounded-lg">
                <x-logo class="w-12 h-12" />
                <span class="leading-tight">
                    <span class="block text-xs text-navy-300">Kemenimipas Republik Indonesia</span>
                    <span class="block text-base font-extrabold">Rutan Kelas IIB Pandeglang</span>
                </span>
            </a>

            <!-- Kartu Login -->
            <div class="mt-8 rounded-2xl bg-white px-6 py-8 shadow-2xl shadow-black/40 sm:px-10">
                <p class="text-xs font-bold uppercase tracking-widest text-emas-700">Dasbor Pengelola</p>
                <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-navy-950">Masuk ke panel humas</h1>
                <p class="mt-1 text-sm text-gray-600">Kelola berita dan halaman informasi portal.</p>

                @if(session('success'))
                    <div class="mt-6 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800" role="status">
                        <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mt-6 flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                        <svg class="w-5 h-5 shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="font-semibold">Gagal masuk</p>
                            <ul class="mt-1 list-disc list-inside space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form class="mt-6 space-y-5" action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-navy-950">Alamat email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required autofocus
                               value="{{ old('email') }}"
                               placeholder="admin@rutan.go.id"
                               class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-navy-950 placeholder-gray-400 shadow-sm transition focus:border-emas-500 focus:outline-none focus:ring-2 focus:ring-emas-500/30">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-navy-950">Kata sandi</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               placeholder="••••••••"
                               class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-navy-950 placeholder-gray-400 shadow-sm transition focus:border-emas-500 focus:outline-none focus:ring-2 focus:ring-emas-500/30">
                    </div>

                    <label for="remember" class="flex w-fit cursor-pointer items-center gap-2 text-sm text-gray-700">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 accent-navy-900">
                        Ingat sesi login
                    </label>

                    <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-emas-500 px-4 py-3 text-sm font-bold text-navy-950 shadow-md shadow-emas-500/20 transition hover:bg-emas-400 active:scale-[0.99] focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 focus-visible:ring-offset-2">
                        Masuk
                    </button>
                </form>
            </div>

            <div class="mt-6 flex flex-col items-center gap-2 text-sm">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 font-semibold text-navy-200 hover:text-white transition focus:outline-none focus-visible:underline">
                    <span aria-hidden="true"><x-panah arah="kiri" /></span> Kembali ke portal publik
                </a>
                <p class="text-xs text-navy-400">&copy; {{ date('Y') }} Rutan Kelas IIB Pandeglang</p>
            </div>
        </div>
    </main>
</body>
</html>
