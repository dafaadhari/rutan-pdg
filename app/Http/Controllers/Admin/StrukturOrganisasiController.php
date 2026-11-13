<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use App\Support\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

/**
 * Kelola bagan struktur organisasi (tampil di seksi Struktur Organisasi, halaman Profil).
 */
class StrukturOrganisasiController extends Controller
{
    /**
     * Ukuran foto pejabat (potret 4:5).
     */
    public const FOTO_LEBAR = 600;
    public const FOTO_TINGGI = 750;

    public function index()
    {
        return view('admin.struktur.index', [
            'daftar' => StrukturOrganisasi::daftarBertingkat(),
        ]);
    }

    public function create(Request $request)
    {
        $atasan = $request->filled('atasan') ? StrukturOrganisasi::find($request->integer('atasan')) : null;

        $jabatan = new StrukturOrganisasi([
            'parent_id' => $atasan?->id,
            'urutan' => StrukturOrganisasi::where('parent_id', $atasan?->id)->count() + 1,
        ]);

        return view('admin.struktur.create', [
            'jabatan' => $jabatan,
            'opsiAtasan' => StrukturOrganisasi::daftarBertingkat(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = Gambar::potongDanSimpan($request->file('foto'), 'struktur', self::FOTO_LEBAR, self::FOTO_TINGGI);
        }

        StrukturOrganisasi::create($data);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Jabatan "' . $data['jabatan'] . '" berhasil ditambahkan.');
    }

    public function edit(StrukturOrganisasi $struktur)
    {
        $tidakBoleh = $struktur->idDenganBawahan();

        return view('admin.struktur.edit', [
            'jabatan' => $struktur,
            // Atasan tidak boleh dirinya sendiri atau bawahannya (mencegah bagan melingkar)
            'opsiAtasan' => array_values(array_filter(
                StrukturOrganisasi::daftarBertingkat(),
                fn ($baris) => ! in_array($baris['jabatan']->id, $tidakBoleh, true)
            )),
        ]);
    }

    public function update(Request $request, StrukturOrganisasi $struktur)
    {
        $data = $this->validasi($request, $struktur);

        if ($request->hasFile('foto')) {
            $data['foto'] = Gambar::potongDanSimpan($request->file('foto'), 'struktur', self::FOTO_LEBAR, self::FOTO_TINGGI);
            Gambar::hapus($struktur->foto);
        } elseif ($request->boolean('hapus_foto')) {
            Gambar::hapus($struktur->foto);
            $data['foto'] = null;
        }

        $struktur->update($data);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Jabatan "' . $struktur->jabatan . '" berhasil diperbarui.');
    }

    /**
     * Hapus jabatan; bawahannya naik ke atasan jabatan yang dihapus.
     */
    public function destroy(StrukturOrganisasi $struktur)
    {
        DB::transaction(function () use ($struktur) {
            StrukturOrganisasi::where('parent_id', $struktur->id)->update(['parent_id' => $struktur->parent_id]);
            Gambar::hapus($struktur->foto);
            $struktur->delete();
        });

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Jabatan "' . $struktur->jabatan . '" berhasil dihapus.');
    }

    protected function validasi(Request $request, ?StrukturOrganisasi $struktur = null): array
    {
        $tidakBoleh = $struktur ? $struktur->idDenganBawahan() : [];

        return $request->validate([
            'jabatan' => ['required', 'string', 'max:150'],
            'nama' => ['nullable', 'string', 'max:150'],
            'nip' => ['nullable', 'string', 'max:30', 'regex:/^[0-9 ]+$/'],
            'parent_id' => ['nullable', 'integer', Rule::exists('struktur_organisasis', 'id'), Rule::notIn($tidakBoleh)],
            'urutan' => ['required', 'integer', 'min:1', 'max:999'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120', 'dimensions:min_width=300,min_height=375'],
        ], [
            'jabatan.required' => 'Nama jabatan wajib diisi.',
            'jabatan.max' => 'Nama jabatan maksimal 150 karakter.',
            'nama.max' => 'Nama pejabat maksimal 150 karakter.',
            'nip.regex' => 'NIP hanya boleh berisi angka dan spasi.',
            'nip.max' => 'NIP maksimal 30 karakter.',
            'parent_id.exists' => 'Atasan yang dipilih tidak ditemukan.',
            'parent_id.not_in' => 'Atasan tidak boleh jabatan itu sendiri atau bawahannya.',
            'urutan.required' => 'Nomor urut wajib diisi.',
            'urutan.min' => 'Nomor urut minimal 1.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Format foto yang didukung: JPG, JPEG, PNG, WEBP.',
            'foto.max' => 'Ukuran foto maksimal 5 MB.',
            'foto.dimensions' => 'Resolusi foto minimal 300 × 375 piksel.',
        ]);
    }
}
