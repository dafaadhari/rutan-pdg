<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Models\Halaman;
use App\Support\Ikon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class HalamanController extends Controller
{
    /**
     * Menampilkan daftar halaman dikelompokkan per kategori.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $kategori = $request->query('kategori');

        $query = Halaman::urut();

        if ($search) {
            $query->where('judul', 'like', "%{$search}%");
        }

        if ($kategori && array_key_exists($kategori, Halaman::KATEGORI)) {
            $query->where('kategori', $kategori);
        }

        $halamanPerKategori = $query->get()->groupBy('kategori');

        // ID halaman yang benar-benar tampil sebagai highlight beranda (maks. per kategori)
        $idHighlight = Halaman::publikasi()
            ->where('tampil_di_beranda', true)
            ->urut()
            ->get(['id', 'kategori'])
            ->groupBy('kategori')
            ->flatMap(fn ($items) => $items->take(HomeController::MAKS_HIGHLIGHT)->pluck('id'))
            ->all();

        $totalHalaman = Halaman::count();
        $totalPublikasi = Halaman::where('status', 'publikasi')->count();
        $totalDraft = Halaman::where('status', 'draft')->count();

        return view('admin.halaman.index', compact(
            'halamanPerKategori',
            'idHighlight',
            'search',
            'kategori',
            'totalHalaman',
            'totalPublikasi',
            'totalDraft'
        ));
    }

    /**
     * Menampilkan form tambah halaman baru.
     */
    public function create(Request $request)
    {
        $halaman = new Halaman([
            'kategori' => array_key_exists($request->query('kategori'), Halaman::KATEGORI)
                ? $request->query('kategori')
                : 'layanan',
            'status' => 'publikasi',
            'ikon' => 'info',
        ]);
        $halaman->urutan = (Halaman::where('kategori', $halaman->kategori)->max('urutan') ?? 0) + 1;

        return view('admin.halaman.create', [
            'halaman' => $halaman,
            'daftarGrup' => $this->daftarGrup(),
        ]);
    }

    /**
     * Menyimpan halaman baru ke basis data.
     */
    public function store(Request $request)
    {
        $validated = $this->validasi($request);
        $validated['slug'] = $this->generateUniqueSlug($validated['slug'] ?: $validated['judul'], $validated['kategori']);

        $halaman = Halaman::create($validated);

        return redirect()->route('admin.halaman.index', ['kategori' => $halaman->kategori])
            ->with('success', "Halaman \"{$halaman->judul}\" berhasil ditambahkan!");
    }

    /**
     * Menampilkan form ubah halaman.
     */
    public function edit(Halaman $halaman)
    {
        return view('admin.halaman.edit', [
            'halaman' => $halaman,
            'daftarGrup' => $this->daftarGrup(),
        ]);
    }

    /**
     * Memperbarui data halaman di basis data.
     */
    public function update(Request $request, Halaman $halaman)
    {
        $validated = $this->validasi($request);
        $validated['slug'] = $this->generateUniqueSlug($validated['slug'] ?: $validated['judul'], $validated['kategori'], $halaman->id);

        $halaman->update($validated);

        return redirect()->route('admin.halaman.index', ['kategori' => $halaman->kategori])
            ->with('success', "Halaman \"{$halaman->judul}\" berhasil diperbarui!");
    }

    /**
     * Menghapus halaman dari basis data.
     */
    public function destroy(Halaman $halaman)
    {
        $halaman->delete();

        return redirect()->route('admin.halaman.index')
            ->with('success', "Halaman \"{$halaman->judul}\" berhasil dihapus!");
    }

    /**
     * Validasi input form halaman.
     */
    protected function validasi(Request $request): array
    {
        $validated = $request->validate([
            'kategori' => ['required', Rule::in(array_keys(Halaman::KATEGORI))],
            'judul' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'ringkasan' => ['nullable', 'string', 'max:120'],
            'ikon' => ['nullable', Rule::in(Ikon::kunci())],
            'grup' => ['nullable', 'string', 'max:50'],
            'urutan' => ['required', 'integer', 'min:0', 'max:999'],
            'status' => ['required', 'in:draft,publikasi'],
            'konten' => ['required', 'string'],
        ], [
            'kategori.required' => 'Kategori halaman wajib dipilih.',
            'kategori.in' => 'Kategori halaman tidak valid.',
            'judul.required' => 'Judul halaman wajib diisi.',
            'judul.max' => 'Judul halaman maksimal 255 karakter.',
            'slug.regex' => 'Slug hanya boleh berisi huruf kecil, angka, dan tanda hubung (contoh: jadwal-besuk).',
            'ringkasan.max' => 'Ringkasan maksimal 120 karakter (ideal ≤ 75 agar tidak terpotong di kartu).',
            'ikon.in' => 'Ikon yang dipilih tidak valid.',
            'grup.max' => 'Grup layanan maksimal 50 karakter.',
            'urutan.required' => 'Nomor urut wajib diisi.',
            'urutan.integer' => 'Nomor urut harus berupa angka.',
            'status.required' => 'Status halaman wajib ditentukan.',
            'status.in' => 'Status halaman tidak valid.',
            'konten.required' => 'Isi konten halaman wajib diisi.',
        ]);

        // Highlight beranda hanya berlaku untuk Layanan & Informasi Publik
        $validated['tampil_di_beranda'] = $validated['kategori'] !== 'tentang-kami'
            && $request->boolean('tampil_di_beranda');

        return $validated;
    }

    /**
     * Daftar grup layanan yang sudah dipakai (untuk saran input).
     */
    protected function daftarGrup(): array
    {
        return Halaman::whereNotNull('grup')->distinct()->orderBy('grup')->pluck('grup')->all();
    }

    /**
     * Helper untuk membuat slug unik per kategori.
     */
    protected function generateUniqueSlug(string $title, string $kategori, ?int $exceptId = null): string
    {
        $baseSlug = Str::slug($title);
        if (empty($baseSlug)) {
            $baseSlug = 'halaman-' . time();
        }

        $slug = $baseSlug;
        $counter = 1;

        while (Halaman::where('kategori', $kategori)
            ->where('slug', $slug)
            ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
            ->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
