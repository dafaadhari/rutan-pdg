{{--
    Sampul berita. Memakai gambar_sampul bila ada; selain itu fallback bergaya
    (gradien navy + pola titik + logo). Ukuran/rasio diatur lewat class, mis.
    <x-sampul-berita :berita="$b" class="aspect-video rounded-2xl" />
--}}
@props(['berita', 'ukuran' => 'besar'])

<div {{ $attributes->merge(['class' => 'relative overflow-hidden bg-navy-900']) }}>
    @if($berita->gambar_sampul)
        <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="{{ $berita->judul }}" loading="lazy"
             class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-[1.03]">
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-navy-700 via-navy-900 to-navy-950" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-[0.08] bg-[radial-gradient(circle_at_1px_1px,#fff_1px,transparent_0)] [background-size:18px_18px]" aria-hidden="true"></div>
        <div class="absolute -right-10 -bottom-10 w-48 h-48 rounded-full bg-emas-500/10 blur-2xl" aria-hidden="true"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-3">
            <x-logo class="{{ $ukuran === 'besar' ? 'w-14 h-14' : 'w-8 h-8' }}" />
            @if($ukuran === 'besar')
                <span class="mt-3 text-[11px] font-bold uppercase tracking-widest text-emas-300">Humas Rutan Pandeglang</span>
            @endif
        </div>
    @endif
</div>
