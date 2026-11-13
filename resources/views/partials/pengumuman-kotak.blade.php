{{--
    Isi kotak pop-up pengumuman. Dipakai oleh partials/pengumuman (publik) dan pratinjau admin.
    Data: $pengumuman (Pengaturan 'pengumuman'), $pratinjau (bool).
    Atribut data-pv-* dipakai pratinjau langsung di admin (admin/pengaturan/pengumuman).
--}}
@php
    $pratinjau = $pratinjau ?? false;
    $gayaTingkat = \App\Models\Pengaturan::GAYA_PENGUMUMAN;
    $tingkat = $pengumuman['tingkat'] ?? 'penting';
    [$aksen, $lencana] = $gayaTingkat[$tingkat] ?? $gayaTingkat['penting'];
    $label = \App\Models\Pengaturan::TINGKAT_PENGUMUMAN[$tingkat] ?? 'Penting';
    $judul = trim($pengumuman['judul'] ?? '') ?: 'Pengumuman';
    $teks = $pengumuman['teks'] ?: ($pratinjau ? 'Teks pengumuman akan tampil di sini.' : '');
    $tautan = $pengumuman['tautan'] ?? null;
    $tautanLuar = $tautan && ! str_starts_with($tautan, '/');
    $selesai = ! empty($pengumuman['selesai']) ? \Illuminate\Support\Carbon::parse($pengumuman['selesai']) : null;
@endphp

<div class="overflow-hidden rounded-2xl bg-white text-left">
    <div data-pv="aksen" class="h-1.5 {{ $aksen }}" aria-hidden="true"></div>
    <div class="p-6 sm:p-7">
        <div class="flex items-start justify-between gap-4">
            <span data-pv="lencana" class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[11px] font-extrabold uppercase tracking-wider {{ $lencana }}">
                <x-ikon nama="megafon" class="h-4 w-4" />
                <span data-pv="label">{{ $label }}</span>
            </span>
            @unless($pratinjau)
                <button type="button" data-tutup aria-label="Tutup pengumuman"
                        class="-mr-2 -mt-2 rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-navy-950 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            @endunless
        </div>

        <h2 @unless($pratinjau) id="judul-popup-pengumuman" @endunless data-pv="judul" class="mt-4 text-xl font-extrabold tracking-tight text-navy-950">{{ $judul }}</h2>
        <p data-pv="teks" class="mt-2 whitespace-pre-line text-[15px] leading-relaxed text-gray-700">{{ $teks }}</p>
        @if($selesai || $pratinjau)
            <p data-pv="selesai" class="mt-3 text-xs text-gray-500 {{ $selesai ? '' : 'hidden' }}">
                Berlaku sampai <span data-pv="tanggal">{{ $selesai?->translatedFormat('d F Y') }}</span>
            </p>
        @endif

        <div class="mt-6 flex flex-wrap justify-end gap-2">
            @if($tautan || $pratinjau)
                <a href="{{ $tautan ? ($tautanLuar ? $tautan : url($tautan)) : '#' }}" data-tautan data-pv="tautan"
                   @if($tautanLuar) target="_blank" rel="noopener" @endif
                   @if($pratinjau) tabindex="-1" onclick="return false" @endif
                   class="inline-flex items-center gap-1.5 rounded-lg bg-navy-950 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-navy-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 focus-visible:ring-offset-2 {{ $tautan ? '' : 'hidden' }}">
                    <span data-pv="label-tautan">{{ $pengumuman['label_tautan'] ?: 'Selengkapnya' }}</span> <x-panah :arah="$tautanLuar ? 'serong' : 'kanan'" />
                </a>
            @endif
            <button type="button" @unless($pratinjau) data-tutup @else tabindex="-1" @endunless
                    class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500">
                Tutup
            </button>
        </div>
    </div>
</div>
