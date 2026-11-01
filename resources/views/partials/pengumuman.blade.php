{{--
    Banner pengumuman penting (atas halaman publik).
    Data: $pengumuman (array dari Pengaturan 'pengumuman'). $pratinjau = true di form admin (tanpa tombol tutup).
--}}
@php
    $pratinjau = $pratinjau ?? false;
    $gaya = [
        'info' => ['bg-navy-800 text-white', 'bg-white/15 text-white', 'text-white hover:text-emas-300', 'text-navy-200 hover:text-white hover:bg-white/10'],
        'penting' => ['bg-emas-400 text-navy-950', 'bg-navy-950 text-emas-300', 'text-navy-950 hover:text-navy-700', 'text-navy-900 hover:bg-navy-950/10'],
        'darurat' => ['bg-red-600 text-white', 'bg-white text-red-700', 'text-white hover:text-red-100', 'text-red-100 hover:text-white hover:bg-white/10'],
    ][$pengumuman['tingkat'] ?? 'penting'] ?? null;
    $label = \App\Models\Pengaturan::TINGKAT_PENGUMUMAN[$pengumuman['tingkat'] ?? 'penting'] ?? 'Penting';
    // Kunci penutupan berubah bila teks/tanggal diubah, sehingga pengumuman baru tampil lagi
    $kunci = 'pengumuman-' . substr(md5(($pengumuman['teks'] ?? '') . '|' . ($pengumuman['diperbarui'] ?? '')), 0, 12);
@endphp

@if($gaya)
    <div @unless($pratinjau) id="banner-pengumuman" data-kunci="{{ $kunci }}" @endunless role="region" aria-label="Pengumuman {{ $label }}"
         class="{{ $gaya[0] }}">
        <div class="max-w-7xl mx-auto flex items-start gap-3 px-4 py-2.5 sm:items-center sm:px-6 lg:px-8">
            <x-ikon nama="megafon" class="mt-0.5 h-5 w-5 shrink-0 sm:mt-0" />
            <p class="min-w-0 flex-1 text-sm leading-snug">
                <span class="mr-2 inline-block rounded px-1.5 py-0.5 align-middle text-[11px] font-extrabold uppercase tracking-wider {{ $gaya[1] }}">{{ $label }}</span>
                <span class="font-medium">{{ $pengumuman['teks'] }}</span>
                @if(!empty($pengumuman['tautan']))
                    <a href="{{ str_starts_with($pengumuman['tautan'], '/') ? url($pengumuman['tautan']) : $pengumuman['tautan'] }}"
                       @unless(str_starts_with($pengumuman['tautan'], '/')) target="_blank" rel="noopener" @endunless
                       class="ml-1 whitespace-nowrap font-bold underline underline-offset-2 {{ $gaya[2] }}">{{ $pengumuman['label_tautan'] ?: 'Selengkapnya' }} <x-panah /></a>
                @endif
            </p>
            @unless($pratinjau)
                <button type="button" data-tutup-banner aria-label="Tutup pengumuman"
                        class="-mr-1 shrink-0 rounded-md p-1 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-current {{ $gaya[3] }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            @endunless
        </div>
    </div>

    @unless($pratinjau)
        <script>
            // Banner yang sudah ditutup tidak ditampilkan lagi sampai pengumumannya berubah
            (function () {
                const banner = document.getElementById('banner-pengumuman');
                if (!banner) return;
                const kunci = banner.dataset.kunci;
                try { if (localStorage.getItem(kunci) === 'tutup') banner.remove(); } catch (e) {}
                const tombol = banner.querySelector('[data-tutup-banner]');
                if (tombol) tombol.addEventListener('click', function () {
                    banner.remove();
                    try { localStorage.setItem(kunci, 'tutup'); } catch (e) {}
                });
            })();
        </script>
    @endunless
@endif
