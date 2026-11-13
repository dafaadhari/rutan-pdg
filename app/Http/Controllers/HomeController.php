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

        return view('welcome', [
            'beritaUtama' => $beritaUtama,
            'beritaLainnya' => $beritaLainnya,
            'layananHighlight' => $layananHighlight,
            'informasiHighlight' => $informasiHighlight,
            'sambutan' => Pengaturan::ambil('sambutan', Pengaturan::BAWAAN_SAMBUTAN),
            'maklumat' => config('rutan.maklumat'),
            'maklumatFoto' => Pengaturan::ambil('maklumat', Pengaturan::BAWAAN_MAKLUMAT),
            'saluranPengaduan' => $this->saluranPengaduan(),
        ]);
    }

    /**
     * Saluran pengaduan untuk seksi Maklumat Pelayanan di beranda.
     * Pengaduan diarahkan ke kanal eksternal resmi (SP4N-LAPOR!) dan WhatsApp Humas.
     */
    protected function saluranPengaduan(): array
    {
        $kontak = config('rutan.kontak');

        return array_values(array_filter([
            [
                'judul' => 'SP4N-LAPOR!',
                'ket' => 'Layanan aspirasi & pengaduan online nasional',
                'ikon' => 'megafon',
                'url' => $kontak['lapor'],
                'luar' => true,
            ],
            $kontak['whatsapp_humas'] ? [
                'judul' => 'WhatsApp Humas',
                'ket' => 'Respons pada jam kerja',
                'ikon' => 'telepon',
                'url' => 'https://wa.me/' . $kontak['whatsapp_humas'],
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
