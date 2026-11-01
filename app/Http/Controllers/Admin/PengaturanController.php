<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Support\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class PengaturanController extends Controller
{
    /**
     * Ukuran foto pimpinan (potret 4:5).
     */
    public const FOTO_LEBAR = 800;
    public const FOTO_TINGGI = 1000;

    /**
     * Status banner pengumuman: aktif | terjadwal | kedaluwarsa | nonaktif.
     */
    public static function statusPengumuman(array $pengumuman): string
    {
        if (empty($pengumuman['aktif']) || empty($pengumuman['teks'])) {
            return 'nonaktif';
        }

        $hariIni = now()->toDateString();

        if (! empty($pengumuman['mulai']) && $hariIni < $pengumuman['mulai']) {
            return 'terjadwal';
        }

        if (! empty($pengumuman['selesai']) && $hariIni > $pengumuman['selesai']) {
            return 'kedaluwarsa';
        }

        return 'aktif';
    }

    /**
     * Form banner pengumuman.
     */
    public function editPengumuman()
    {
        $pengumuman = Pengaturan::ambil('pengumuman', Pengaturan::BAWAAN_PENGUMUMAN);

        return view('admin.pengaturan.pengumuman', [
            'pengumuman' => $pengumuman,
            'status' => self::statusPengumuman($pengumuman),
        ]);
    }

    /**
     * Simpan banner pengumuman.
     */
    public function updatePengumuman(Request $request)
    {
        $validated = $request->validate([
            'tingkat' => ['required', Rule::in(array_keys(Pengaturan::TINGKAT_PENGUMUMAN))],
            'teks' => [Rule::requiredIf($request->boolean('aktif')), 'nullable', 'string', 'max:200'],
            'tautan' => ['nullable', 'string', 'max:255', 'regex:/^(https?:\/\/|\/)/'],
            'label_tautan' => ['nullable', 'string', 'max:30'],
            'mulai' => ['nullable', 'date'],
            'selesai' => ['nullable', 'date', 'after_or_equal:mulai'],
        ], [
            'tingkat.in' => 'Tingkat pengumuman tidak valid.',
            'teks.required' => 'Teks pengumuman wajib diisi bila banner diaktifkan.',
            'teks.max' => 'Teks pengumuman maksimal 200 karakter agar tetap ringkas.',
            'tautan.regex' => 'Tautan harus diawali "/" (halaman portal) atau "https://".',
            'label_tautan.max' => 'Label tautan maksimal 30 karakter.',
            'selesai.after_or_equal' => 'Tanggal berakhir tidak boleh sebelum tanggal mulai.',
        ]);

        Pengaturan::simpan('pengumuman', [
            'aktif' => $request->boolean('aktif'),
            'tingkat' => $validated['tingkat'],
            'teks' => $validated['teks'] ?? '',
            'tautan' => $validated['tautan'] ?? null,
            'label_tautan' => $validated['label_tautan'] ?: 'Selengkapnya',
            'mulai' => isset($validated['mulai']) ? Carbon::parse($validated['mulai'])->toDateString() : null,
            'selesai' => isset($validated['selesai']) ? Carbon::parse($validated['selesai'])->toDateString() : null,
        ]);

        return redirect()->route('admin.pengumuman.edit')
            ->with('success', 'Banner pengumuman berhasil diperbarui!');
    }

    /**
     * Form sambutan pimpinan.
     */
    public function editSambutan()
    {
        return view('admin.pengaturan.sambutan', [
            'sambutan' => Pengaturan::ambil('sambutan', Pengaturan::BAWAAN_SAMBUTAN),
        ]);
    }

    /**
     * Simpan sambutan pimpinan (foto diolah ke WebP potret 4:5).
     */
    public function updateSambutan(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:120'],
            'isi' => ['required', 'string', 'max:2000'],
            'nama' => ['required', 'string', 'max:120'],
            'jabatan' => ['required', 'string', 'max:120'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120', 'dimensions:min_width=400,min_height=500'],
        ], [
            'judul.required' => 'Judul sambutan wajib diisi.',
            'isi.required' => 'Isi sambutan wajib diisi.',
            'isi.max' => 'Isi sambutan maksimal 2.000 karakter agar tetap ringkas di beranda.',
            'nama.required' => 'Nama pimpinan wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Format foto yang didukung: JPG, JPEG, PNG, WEBP.',
            'foto.max' => 'Ukuran foto maksimal 5 MB.',
            'foto.dimensions' => 'Resolusi foto minimal 400 × 500 piksel.',
        ]);

        $lama = Pengaturan::ambil('sambutan', Pengaturan::BAWAAN_SAMBUTAN);
        $foto = $lama['foto'] ?? null;

        if ($request->hasFile('foto')) {
            $foto = Gambar::potongDanSimpan($request->file('foto'), 'pimpinan', self::FOTO_LEBAR, self::FOTO_TINGGI);
            Gambar::hapus($lama['foto'] ?? null);
        } elseif ($request->boolean('hapus_foto')) {
            Gambar::hapus($foto);
            $foto = null;
        }

        Pengaturan::simpan('sambutan', [
            'tampil' => $request->boolean('tampil'),
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'foto' => $foto,
        ]);

        return redirect()->route('admin.sambutan.edit')
            ->with('success', 'Sambutan pimpinan berhasil diperbarui!');
    }
}
