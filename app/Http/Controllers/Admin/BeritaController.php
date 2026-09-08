<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita admin.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = Berita::latest();

        if ($search) {
            $query->where('judul', 'like', "%{$search}%");
        }

        if ($status && in_array($status, ['draft', 'publikasi'])) {
            $query->where('status', $status);
        }

        $beritas = $query->paginate(10)->withQueryString();

        $totalBerita = Berita::count();
        $totalPublikasi = Berita::where('status', 'publikasi')->count();
        $totalDraft = Berita::where('status', 'draft')->count();

        return view('admin.berita.index', compact(
            'beritas',
            'search',
            'status',
            'totalBerita',
            'totalPublikasi',
            'totalDraft'
        ));
    }

    /**
     * Menampilkan form tambah berita baru.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Menyimpan berita baru ke basis data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:draft,publikasi'],
            'konten' => ['required', 'string'],
            'gambar_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 255 karakter.',
            'status.required' => 'Status berita wajib ditentukan.',
            'status.in' => 'Status berita tidak valid.',
            'konten.required' => 'Konten berita wajib diisi.',
            'gambar_sampul.image' => 'Berkas sampul harus berupa gambar.',
            'gambar_sampul.mimes' => 'Format gambar yang didukung: JPG, JPEG, PNG, WEBP.',
            'gambar_sampul.max' => 'Ukuran gambar sampul maksimal 2 MB.',
        ]);

        $slug = $this->generateUniqueSlug($validated['judul']);

        $gambarPath = null;
        if ($request->hasFile('gambar_sampul')) {
            $gambarPath = $request->file('gambar_sampul')->store('berita', 'public');
        }

        Berita::create([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'konten' => $validated['konten'],
            'status' => $validated['status'],
            'gambar_sampul' => $gambarPath,
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Menampilkan form ubah berita.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Memperbarui data berita di basis data.
     */
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:draft,publikasi'],
            'konten' => ['required', 'string'],
            'gambar_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 255 karakter.',
            'status.required' => 'Status berita wajib ditentukan.',
            'status.in' => 'Status berita tidak valid.',
            'konten.required' => 'Konten berita wajib diisi.',
            'gambar_sampul.image' => 'Berkas sampul harus berupa gambar.',
            'gambar_sampul.mimes' => 'Format gambar yang didukung: JPG, JPEG, PNG, WEBP.',
            'gambar_sampul.max' => 'Ukuran gambar sampul maksimal 2 MB.',
        ]);

        // Perbarui slug jika judul berubah
        if ($berita->judul !== $validated['judul']) {
            $berita->slug = $this->generateUniqueSlug($validated['judul'], $berita->id);
        }

        // Penanganan berkas gambar baru
        if ($request->hasFile('gambar_sampul')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar_sampul && Storage::disk('public')->exists($berita->gambar_sampul)) {
                Storage::disk('public')->delete($berita->gambar_sampul);
            }

            $berita->gambar_sampul = $request->file('gambar_sampul')->store('berita', 'public');
        }

        $berita->judul = $validated['judul'];
        $berita->konten = $validated['konten'];
        $berita->status = $validated['status'];
        $berita->save();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus berita dari basis data dan storage.
     */
    public function destroy(Berita $berita)
    {
        // Hapus file gambar fisik dari storage jika ada
        if ($berita->gambar_sampul && Storage::disk('public')->exists($berita->gambar_sampul)) {
            Storage::disk('public')->delete($berita->gambar_sampul);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Helper untuk membuat slug unik yang aman.
     */
    protected function generateUniqueSlug(string $title, ?int $exceptId = null): string
    {
        $baseSlug = Str::slug($title);
        if (empty($baseSlug)) {
            $baseSlug = 'berita-' . time();
        }

        $slug = $baseSlug;
        $counter = 1;

        while (Berita::where('slug', $slug)
            ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
            ->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
