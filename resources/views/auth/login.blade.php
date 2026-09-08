<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Rutan Kelas IIB Pandeglang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-950 font-['Inter',sans-serif] text-gray-100 antialiased flex flex-col justify-between selection:bg-amber-500 selection:text-gray-900">

    <!-- Top Accent Bar -->
    <div class="w-full h-1.5 bg-gradient-to-r from-amber-500 via-red-600 to-blue-700"></div>

    <div class="flex min-h-[calc(100vh-120px)] flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 mb-4 group transition-transform duration-200 hover:scale-105">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 flex items-center justify-center shadow-lg shadow-black/40">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                    </svg>
                </div>
            </a>
            <span class="inline-block text-[11px] font-semibold tracking-widest text-amber-400 uppercase bg-amber-950/40 border border-amber-800/60 px-3 py-1 rounded-full mb-2">
                Kemenimipas RI
            </span>
            <h2 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                Dasbor Pengelola
            </h2>
            <p class="mt-1 text-sm text-gray-400">
                Rutan Kelas IIB Pandeglang
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-gray-900/80 backdrop-blur-xl border border-gray-800 px-6 py-8 shadow-2xl shadow-black/60 rounded-2xl sm:px-10">
                
                @if(session('success'))
                    <div class="mb-5 rounded-lg bg-emerald-950/50 border border-emerald-800/80 p-4 text-sm text-emerald-300 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 rounded-lg bg-red-950/50 border border-red-800/80 p-4 text-sm text-red-300 flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <span class="font-medium">Terjadi kesalahan:</span>
                            <ul class="mt-1 list-disc list-inside text-xs space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form class="space-y-5" action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-medium uppercase tracking-wider text-gray-300">
                            Alamat Email
                        </label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                value="{{ old('email') }}"
                                placeholder="admin@rutan.go.id"
                                class="block w-full rounded-lg border border-gray-700 bg-gray-800/90 px-3.5 py-2.5 text-white placeholder-gray-500 shadow-sm focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm transition duration-150">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-medium uppercase tracking-wider text-gray-300">
                            Kata Sandi
                        </label>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                placeholder="••••••••"
                                class="block w-full rounded-lg border border-gray-700 bg-gray-800/90 px-3.5 py-2.5 text-white placeholder-gray-500 shadow-sm focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm transition duration-150">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 rounded border-gray-700 bg-gray-800 text-amber-500 focus:ring-amber-500 focus:ring-offset-gray-900">
                            <label for="remember" class="ml-2 block text-xs text-gray-300">
                                Ingat sesi login
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-amber-500 px-4 py-2.5 text-sm font-semibold text-gray-950 shadow-md hover:bg-amber-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 transition duration-150 active:scale-[0.99]">
                            Masuk ke Dasbor
                        </button>
                    </div>
                </form>

                <div class="mt-6 border-t border-gray-800 pt-5 text-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-amber-400 transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Portal Publik
                    </a>
                </div>
            </div>

            <p class="mt-6 text-center text-xs text-gray-500">
                Sistem Informasi & Publikasi Internal &copy; {{ date('Y') }} Rutan Pandeglang.
            </p>
        </div>
    </div>

</body>
</html>
