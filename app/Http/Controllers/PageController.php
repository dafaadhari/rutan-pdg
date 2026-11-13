<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use App\Models\StrukturOrganisasi;

/**
 * Setiap kategori (Profil, Layanan, Informasi Publik) tampil sebagai satu halaman
 * panjang: tiap halaman menjadi satu seksi, dan sub-menu navbar menjadi penanda gulir.
 */
class PageController extends Controller
{
    public function tentangKami(?string $slug = null)
    {
        return $this->tampilkan('tentang-kami', $slug);
    }

    public function layanan(?string $slug = null)
    {
        return $this->tampilkan('layanan', $slug);
    }

    public function informasiPublik(?string $slug = null)
    {
        return $this->tampilkan('informasi-publik', $slug);
    }

    /**
     * Tanpa slug: tampilkan semua seksi kategori. Dengan slug (tautan lama):
     * alihkan permanen ke seksinya, atau 404 bila halaman tidak ada / draft.
     */
    protected function tampilkan(string $kategori, ?string $slug)
    {
        if ($slug !== null) {
            $ada = Halaman::publikasi()->where('kategori', $kategori)->where('slug', $slug)->exists();
            abort_unless($ada, 404);

            return redirect()->to(route($kategori) . '#' . $slug, 301);
        }

        $halamans = Halaman::publikasi()->where('kategori', $kategori)->urut()->get();
        abort_if($halamans->isEmpty(), 404);

        return view('layouts.page', [
            'halamans' => $halamans,
            'categoryTitle' => Halaman::KATEGORI[$kategori],
            'categoryRoute' => $kategori,
            'deskripsiKategori' => Halaman::DESKRIPSI_KATEGORI[$kategori] ?? null,
            'struktur' => $halamans->contains('slug', Halaman::SLUG_STRUKTUR)
                ? StrukturOrganisasi::pohon()
                : null,
        ]);
    }
}
