@php
    // Kelompokkan hari yang sesi kunjungannya identik, mis. "Senin & Rabu"
    $grupJadwal = [];
    foreach ($jadwalKunjungan as $hari => $sesi) {
        $teks = collect($sesi)
            ->map(fn ($s) => str_replace(':', '.', $s['mulai']) . '–' . str_replace(':', '.', $s['selesai']))
            ->implode(' & ') . ' WIB';
        $grupJadwal[$teks][] = $namaHari[$hari];
    }

    // Ikon media sosial (hanya ditampilkan bila URL diisi di config/rutan.php)
    $ikonSosial = [
        'instagram' => ['label' => 'Instagram', 'path' => 'M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4zm5 5a4 4 0 100 8 4 4 0 000-8zm5.5-1.5h.01'],
        'facebook' => ['label' => 'Facebook', 'path' => 'M14 8h3V4h-3a4 4 0 00-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8z'],
        'youtube' => ['label' => 'YouTube', 'path' => 'M3 8.5A3.5 3.5 0 016.5 5h11A3.5 3.5 0 0121 8.5v7a3.5 3.5 0 01-3.5 3.5h-11A3.5 3.5 0 013 15.5v-7zM10 9v6l5-3-5-3z'],
        'x' => ['label' => 'X (Twitter)', 'path' => 'M4 4l16 16M20 4L4 20'],
    ];
    $sosial = array_filter($kontak['sosial'] ?? []);
    $kelasJudul = 'text-xs font-bold uppercase tracking-wider text-emas-400 mb-4';
    $kelasTautan = 'text-sm text-navy-200 hover:text-white transition focus:outline-none focus-visible:underline';
@endphp

<!-- FOOTER RESMI -->
<footer id="kontak" class="bg-navy-950 text-navy-200 border-t-4 border-emas-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10">

        <!-- Identitas -->
        <div class="sm:col-span-2 lg:col-span-4">
            <div class="flex items-center gap-3">
                <x-logo class="w-12 h-12" />
                <div class="leading-tight">
                    <p class="text-xs text-navy-300">Kemenimipas Republik Indonesia</p>
                    <p class="text-lg font-extrabold text-white">Rutan Kelas IIB Pandeglang</p>
                </div>
            </div>
            <p class="mt-4 text-sm leading-relaxed text-navy-200 max-w-sm">
                Unit Pelaksana Teknis Pemasyarakatan di bawah naungan Kantor Wilayah Kementerian Imigrasi dan Pemasyarakatan Banten.
            </p>
            <ul class="mt-4 flex flex-wrap gap-2 text-[11px] font-bold">
                <li class="px-2.5 py-1 rounded-full border border-emas-500/40 text-emas-300">WBK</li>
                <li class="px-2.5 py-1 rounded-full border border-emas-500/40 text-emas-300">WBBM</li>
                <li class="px-2.5 py-1 rounded-full border border-emas-500/40 text-emas-300">PASTI Berakhlak</li>
            </ul>
            @if($sosial)
                <ul class="mt-5 flex gap-2">
                    @foreach ($sosial as $kunci => $url)
                        @continue(!isset($ikonSosial[$kunci]))
                        <li>
                            <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ $ikonSosial[$kunci]['label'] }} Rutan Pandeglang"
                               class="w-9 h-9 rounded-lg bg-navy-900 border border-navy-800 flex items-center justify-center text-navy-200 hover:text-emas-400 hover:border-emas-500/50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $ikonSosial[$kunci]['path'] }}"/>
                                </svg>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Tautan Layanan -->
        <div class="lg:col-span-2">
            <h2 class="{{ $kelasJudul }}">Layanan</h2>
            <ul class="space-y-2.5">
                @foreach ($layananFooter as $layanan)
                    <li><a href="{{ route('layanan', $layanan->slug) }}" class="{{ $kelasTautan }}">{{ $layanan->judul }}</a></li>
                @endforeach
                <li><a href="{{ route('layanan') }}" class="{{ $kelasTautan }} font-semibold text-white">Semua layanan &rarr;</a></li>
            </ul>
        </div>

        <!-- Tautan Informasi -->
        <div class="lg:col-span-2">
            <h2 class="{{ $kelasJudul }}">Informasi</h2>
            <ul class="space-y-2.5">
                <li><a href="{{ route('tentang-kami') }}" class="{{ $kelasTautan }}">Tentang Kami</a></li>
                <li><a href="{{ route('informasi-publik') }}" class="{{ $kelasTautan }}">Informasi Publik</a></li>
                <li><a href="{{ route('berita.index') }}" class="{{ $kelasTautan }}">Berita & Kegiatan</a></li>
                <li><a href="{{ route('home') }}#maklumat" class="{{ $kelasTautan }}">Maklumat &amp; Pengaduan</a></li>
            </ul>
        </div>

        <!-- Jadwal & Kontak -->
        <div class="sm:col-span-2 lg:col-span-4 space-y-6">
            <div>
                <h2 class="{{ $kelasJudul }}">Jadwal Kunjungan</h2>
                <ul class="space-y-1.5 text-sm">
                    @foreach ($grupJadwal as $jam => $hari)
                        <li>
                            <span class="font-semibold text-white">{{ collect($hari)->join(', ', ' & ') }}:</span>
                            <span class="tabular-nums">{{ $jam }}</span>
                        </li>
                    @endforeach
                    <li>Hari lain & libur nasional: tidak ada kunjungan</li>
                </ul>
                <p class="mt-2 text-xs text-navy-300">Titipan barang mengikuti jadwal kunjungan. Seluruh layanan gratis.</p>
            </div>

            <div>
                <h2 class="{{ $kelasJudul }}">Kontak</h2>
                <ul class="space-y-1.5 text-sm">
                    @if($kontak['alamat'])
                        <li>
                            {{ $kontak['alamat'] }}
                            @if($kontak['peta'])
                                · <a href="{{ $kontak['peta'] }}" target="_blank" rel="noopener" class="font-semibold text-emas-400 hover:text-emas-300">Lihat di peta</a>
                            @endif
                        </li>
                    @endif
                    @if($kontak['telepon'])
                        <li>Telp. <a href="tel:{{ preg_replace('/[^0-9+]/', '', $kontak['telepon']) }}" class="{{ $kelasTautan }}">{{ $kontak['telepon'] }}</a></li>
                    @endif
                    @if($kontak['email'])
                        <li class="break-all">Email <a href="mailto:{{ $kontak['email'] }}" class="{{ $kelasTautan }}">{{ $kontak['email'] }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Tautan Instansi Terkait -->
    @php $tautanInstansi = collect(config('rutan.tautan_instansi'))->filter(fn ($t) => $t['url']); @endphp
    @if($tautanInstansi->isNotEmpty())
        <div class="border-t border-navy-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col lg:flex-row lg:items-center gap-3 lg:gap-6">
                <h2 class="shrink-0 text-xs font-bold uppercase tracking-wider text-emas-400">Tautan terkait</h2>
                <ul class="flex flex-wrap gap-x-6 gap-y-2">
                    @foreach ($tautanInstansi as $tautan)
                        <li>
                            <a href="{{ $tautan['url'] }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1 text-sm text-navy-200 hover:text-white transition focus:outline-none focus-visible:underline">
                                {{ $tautan['nama'] }} <span class="text-navy-400" aria-hidden="true">&nearr;</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="border-t border-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col md:flex-row justify-between items-center gap-2 text-center md:text-left text-xs text-navy-300">
            <p>&copy; {{ date('Y') }} Rutan Kelas IIB Pandeglang · Kementerian Imigrasi dan Pemasyarakatan RI.</p>
            <a href="{{ route('login') }}" class="hover:text-white transition focus:outline-none focus-visible:underline">Akses Admin</a>
        </div>
    </div>
</footer>
