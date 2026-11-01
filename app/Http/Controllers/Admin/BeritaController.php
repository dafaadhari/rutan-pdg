<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Support\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    /**
     * Ukuran sampul berita (16:9). Unggahan dipotong tengah & dikompres ke WebP.
     */
    public const SAMPUL_LEBAR = 1600;
    public const SAMPUL_TINGGI = 900;

    /**
     * Menampilkan daftar berita admin.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $kategori = $request->query('kategori');

        $query = Berita::latest();

        if ($search) {
            $query->where('judul', 'like', "%{$search}%");
        }

        if ($status && in_array($status, ['draft', 'publikasi'])) {
            $query->where('status', $status);
        }

        if ($kategori && array_key_exists($kategori, Berita::KATEGORI)) {
            $query->where('kategori', $kategori);
        }

        $beritas = $query->paginate(10)->withQueryString();

        $totalBerita = Berita::count();
        $totalPublikasi = Berita::where('status', 'publikasi')->count();
        $totalDraft = Berita::where('status', 'draft')->count();

        return view('admin.berita.index', compact(
            'beritas',
            'search',
            'status',
            'kategori',
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
        $validated = $this->validasi($request);

        Berita::create([
            'judul' => $validated['judul'],
            'slug' => $this->generateUniqueSlug($validated['judul']),
            'kategori' => $validated['kategori'],
            'konten' => $validated['konten'],
            'status' => $validated['status'],
            'gambar_sampul' => Gambar::potongDanSimpan($request->file('gambar_sampul'), 'berita', self::SAMPUL_LEBAR, self::SAMPUL_TINGGI),
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
        $validated = $this->validasi($request, $berita);

        // Perbarui slug jika judul berubah
        if ($berita->judul !== $validated['judul']) {
            $berita->slug = $this->generateUniqueSlug($validated['judul'], $berita->id);
        }

        // Ganti sampul: olah gambar baru, lalu hapus berkas lama
        if ($request->hasFile('gambar_sampul')) {
            $lama = $berita->gambar_sampul;
            $berita->gambar_sampul = Gambar::potongDanSimpan($request->file('gambar_sampul'), 'berita', self::SAMPUL_LEBAR, self::SAMPUL_TINGGI);
            Gambar::hapus($lama);
        }

        $berita->judul = $validated['judul'];
        $berita->kategori = $validated['kategori'];
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
        Gambar::hapus($berita->gambar_sampul);
        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Validasi form berita. Sampul wajib untuk berita baru, dan untuk berita
     * lama yang belum memiliki sampul.
     */
    protected function validasi(Request $request, ?Berita $berita = null): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(array_keys(Berita::KATEGORI))],
            'status' => ['required', 'in:draft,publikasi'],
            'konten' => ['required', 'string'],
            'gambar_sampul' => [
                Rule::requiredIf(! $berita?->gambar_sampul),
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:5120',
                'dimensions:min_width=800,min_height=450',
            ],
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 255 karakter.',
            'kategori.required' => 'Kategori berita wajib dipilih.',
            'kategori.in' => 'Kategori berita tidak valid.',
            'status.required' => 'Status berita wajib ditentukan.',
            'status.in' => 'Status berita tidak valid.',
            'konten.required' => 'Konten berita wajib diisi.',
            'gambar_sampul.required' => 'Gambar sampul wajib diunggah agar berita tampil rapi di portal.',
            'gambar_sampul.image' => 'Berkas sampul harus berupa gambar.',
            'gambar_sampul.mimes' => 'Format gambar yang didukung: JPG, JPEG, PNG, WEBP.',
            'gambar_sampul.max' => 'Ukuran gambar sampul maksimal 5 MB.',
            'gambar_sampul.dimensions' => 'Resolusi sampul minimal 800 × 450 piksel agar tetap tajam.',
        ]);
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
