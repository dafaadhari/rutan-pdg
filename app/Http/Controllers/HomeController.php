<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Halaman;
use App\Models\Pengaturan;

class HomeController extends Controller
{
    /**
     * Jumlah maksimal highlight per kategori di beranda.
     */
    public const MAKS_HIGHLIGHT = 4;

    /**
     * Menampilkan halaman utama portal.
     */
    public function index()
    {
        $beritas = Berita::publikasi()->latest()->take(4)->get();
        $beritaUtama = $beritas->first();
        $beritaLainnya = $beritas->slice(1, 3); // Ambil 3 berita sampingan

        $halamanPublik = Halaman::publikasi()
            ->whereIn('kategori', ['layanan', 'informasi-publik'])
            ->urut()
            ->get(['id', 'kategori', 'slug', 'judul', 'ringkasan', 'ikon', 'tampil_di_beranda']);

        $layanan = $halamanPublik->where('kategori', 'layanan');

        // Highlight dipilih admin lewat opsi "Tampilkan di beranda", sesuai urutan menu
        $layananHighlight = $layanan->where('tampil_di_beranda', true)
            ->take(self::MAKS_HIGHLIGHT)
            ->values();

        $informasiHighlight = $halamanPublik->where('kategori', 'informasi-publik')
            ->where('tampil_di_beranda', true)
            ->take(self::MAKS_HIGHLIGHT)
            ->values();

        $halamanPengaduan = $layanan->firstWhere('slug', 'pengaduan');

        return view('welcome', [
            'beritaUtama' => $beritaUtama,
            'beritaLainnya' => $beritaLainnya,
            'layananHighlight' => $layananHighlight,
            'informasiHighlight' => $informasiHighlight,
            'halamanPengaduan' => $halamanPengaduan,
            'sambutan' => Pengaturan::ambil('sambutan', Pengaturan::BAWAAN_SAMBUTAN),
            'maklumat' => config('rutan.maklumat'),
            'saluranPengaduan' => $this->saluranPengaduan($halamanPengaduan),
        ]);
    }

    /**
     * Saluran pengaduan untuk seksi Maklumat Pelayanan di beranda.
     * Kanal tanpa data (halaman pengaduan draft, WhatsApp kosong) tidak ditampilkan.
     */
    protected function saluranPengaduan(?Halaman $halamanPengaduan): array
    {
        $whatsapp = config('rutan.kontak.whatsapp_pengaduan');

        return array_values(array_filter([
            $halamanPengaduan ? [
                'judul' => 'Pengaduan Online',
                'ket' => 'Kanal resmi pengaduan Rutan Pandeglang',
                'ikon' => 'chat',
                'url' => $halamanPengaduan->url,
                'luar' => false,
            ] : null,
            [
                'judul' => 'SP4N-LAPOR!',
                'ket' => 'Layanan aspirasi & pengaduan online nasional',
                'ikon' => 'megafon',
                'url' => 'https://www.lapor.go.id',
                'luar' => true,
            ],
            $whatsapp ? [
                'judul' => 'WhatsApp Pengaduan',
                'ket' => 'Respons pada jam kerja',
                'ikon' => 'telepon',
                'url' => 'https://wa.me/' . $whatsapp,
                'luar' => true,
            ] : null,
            [
                'judul' => 'Kotak Pengaduan',
                'ket' => 'Tersedia di ruang tunggu layanan kunjungan',
                'ikon' => 'dokumen',
                'url' => null,
                'luar' => false,
            ],
        ]));
    }
}
