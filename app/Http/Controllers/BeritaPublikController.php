<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaPublikController extends Controller
{
    /**
     * Arsip berita berstatus publikasi dengan pencarian judul.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $beritas = Berita::publikasi()
            ->when($q !== '', fn ($query) => $query->where('judul', 'like', "%{$q}%"))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('berita.index', compact('beritas', 'q'));
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
