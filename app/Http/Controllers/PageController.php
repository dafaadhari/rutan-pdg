<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menu navigasi untuk kategori Tentang Kami.
     */
    protected array $tentangKamiMenu = [
        'motto-dan-logo' => 'Motto dan Logo',
        'sejarah' => 'Sejarah',
        'unit-pelaksana-teknis' => 'Unit Pelaksana Teknis',
        'profil-organisasi' => 'Profil Organisasi',
        'profil-pejabat' => 'Profil Pejabat',
        'struktur-organisasi' => 'Struktur Organisasi',
        'strategi-organisasi' => 'Strategi Organisasi',
        'kontak-kami' => 'Kontak Kami',
    ];

    /**
     * Menu navigasi untuk kategori Layanan.
     */
    protected array $layananMenu = [
        'permohonan-data-dan-informasi' => 'Permohonan Data dan Informasi',
        'media-massa' => 'Media Massa',
        'simonev-bama' => 'SIMONEV Bama Kemenimipas',
        'perizinan-penelitian' => 'Perizinan Penelitian',
        'perizinan-magang' => 'Perizinan Magang',
        'perizinan-peliputan' => 'Perizinan Peliputan',
        'pengaduan' => 'Pengaduan',
    ];

    /**
     * Menu navigasi untuk kategori Informasi Publik.
     */
    protected array $informasiPublikMenu = [
        'lakip' => 'LAKIP',
        'dipa' => 'DIPA',
        'laporan-tahunan' => 'Laporan Tahunan',
        'laporan-keuangan' => 'Laporan Keuangan',
        'rencana-strategis' => 'Rencana Strategis',
        'iku' => 'IKU (Indikator Kinerja Utama)',
        'perjanjian-kinerja' => 'Perjanjian Kinerja',
        'hasil-survei-spak-spkp' => 'Hasil Survei SPAK/SPKP',
    ];

    /**
     * Menampilkan halaman kategori Tentang Kami.
     */
    public function tentangKami(string $slug = 'motto-dan-logo')
    {
        if (!array_key_exists($slug, $this->tentangKamiMenu)) {
            abort(404);
        }

        return view("pages.tentang-kami.{$slug}", [
            'currentSlug' => $slug,
            'pageTitle' => $this->tentangKamiMenu[$slug],
            'categoryTitle' => 'Tentang Kami',
            'categoryRoute' => 'tentang-kami',
            'menuItems' => $this->tentangKamiMenu,
        ]);
    }

    /**
     * Menampilkan halaman kategori Layanan.
     */
    public function layanan(string $slug = 'permohonan-data-dan-informasi')
    {
        if (!array_key_exists($slug, $this->layananMenu)) {
            abort(404);
        }

        return view("pages.layanan.{$slug}", [
            'currentSlug' => $slug,
            'pageTitle' => $this->layananMenu[$slug],
            'categoryTitle' => 'Layanan Publik',
            'categoryRoute' => 'layanan',
            'menuItems' => $this->layananMenu,
        ]);
    }

    /**
     * Menampilkan halaman kategori Informasi Publik.
     */
    public function informasiPublik(string $slug = 'lakip')
    {
        if (!array_key_exists($slug, $this->informasiPublikMenu)) {
            abort(404);
        }

        return view("pages.informasi-publik.{$slug}", [
            'currentSlug' => $slug,
            'pageTitle' => $this->informasiPublikMenu[$slug],
            'categoryTitle' => 'Informasi Publik',
            'categoryRoute' => 'informasi-publik',
            'menuItems' => $this->informasiPublikMenu,
        ]);
    }
}
