<?php

namespace App\Http\Controllers;

use App\Models\Halaman;

class PageController extends Controller
{
    /**
     * Menampilkan halaman kategori Tentang Kami.
     */
    public function tentangKami(?string $slug = null)
    {
        return $this->tampilkan('tentang-kami', $slug);
    }

    /**
     * Menampilkan halaman kategori Layanan.
     */
    public function layanan(?string $slug = null)
    {
        return $this->tampilkan('layanan', $slug);
    }

    /**
     * Menampilkan halaman kategori Informasi Publik.
     */
    public function informasiPublik(?string $slug = null)
    {
        return $this->tampilkan('informasi-publik', $slug);
    }

    /**
     * Mengambil halaman berstatus publikasi berdasarkan kategori & slug.
     * Tanpa slug, tampilkan halaman pertama sesuai urutan menu.
     */
    protected function tampilkan(string $kategori, ?string $slug)
    {
        $menuItems = Halaman::publikasi()
            ->where('kategori', $kategori)
            ->urut()
            ->get(['id', 'kategori', 'slug', 'judul']);

        $slug ??= $menuItems->first()?->slug;

        $halaman = Halaman::publikasi()
            ->where('kategori', $kategori)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('layouts.page', [
            'halaman' => $halaman,
            'currentSlug' => $halaman->slug,
            'pageTitle' => $halaman->judul,
            'categoryTitle' => Halaman::KATEGORI[$kategori],
            'categoryRoute' => $kategori,
            'menuItems' => $menuItems->pluck('judul', 'slug'),
        ]);
    }
}
