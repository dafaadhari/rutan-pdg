{{--
    Logo instansi. Memakai public/images/logo.png bila tersedia,
    selain itu emblem perisai SVG. Ukuran diatur lewat class, mis. <x-logo class="w-11 h-11" />.
--}}
@if($url = \App\Support\Aset::logo())
    <img src="{{ $url }}" alt="Logo Rutan Kelas IIB Pandeglang" {{ $attributes->merge(['class' => 'object-contain shrink-0']) }}>
@else
    <span role="img" aria-label="Logo Rutan Kelas IIB Pandeglang"
          {{ $attributes->merge(['class' => 'inline-flex shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-navy-800 to-navy-950 text-emas-400 ring-1 ring-emas-500/40 shadow-md']) }}>
        <svg class="w-3/5 h-3/5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
        </svg>
    </span>
@endif
