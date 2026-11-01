<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaPublikController extends Controller
{
    /**
     * Arsip berita berstatus publikasi dengan filter kategori & pencarian judul.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));
        $kategori = $request->query('kategori');
        $kategori = array_key_exists((string) $kategori, Berita::KATEGORI) ? $kategori : null;

        $beritas = Berita::publikasi()
            ->when($kategori, fn ($query) => $query->where('kategori', $kategori))
            ->when($q !== '', fn ($query) => $query->where('judul', 'like', "%{$q}%"))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('berita.index', compact('beritas', 'q', 'kategori'));
    }

    /**
     * Detail berita berdasarkan slug.
     */
    public function show(string $slug)
    {
        $berita = Berita::where('slug', $slug)->publikasi()->firstOrFail();
        $beritaTerbaru = Berita::publikasi()
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(4)
            ->get();

        return view('berita.show', compact('berita', 'beritaTerbaru'));
    }
}
