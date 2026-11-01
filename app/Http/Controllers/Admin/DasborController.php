<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Models\Berita;
use App\Models\Halaman;
use App\Models\Pengaturan;

class DasborController extends Controller
{
    /**
     * Ringkasan kondisi portal untuk petugas humas.
     */
    public function index()
    {
        $statistik = [
            'berita' => Berita::count(),
            'beritaPublikasi' => Berita::where('status', 'publikasi')->count(),
            'beritaDraft' => Berita::where('status', 'draft')->count(),
            'halaman' => Halaman::count(),
            'halamanDraft' => Halaman::where('status', 'draft')->count(),
        ];

        $pengumuman = Pengaturan::ambil('pengumuman', Pengaturan::BAWAAN_PENGUMUMAN);
        $sambutan = Pengaturan::ambil('sambutan', Pengaturan::BAWAAN_SAMBUTAN);

        $beritaTerbaru = Berita::latest()->take(5)->get(['id', 'judul', 'slug', 'kategori', 'status', 'gambar_sampul', 'created_at']);

        // Hal yang perlu ditindaklanjuti humas
        $perhatian = array_values(array_filter([
            ($tanpaSampul = Berita::whereNull('gambar_sampul')->count()) > 0 ? [
                'teks' => "{$tanpaSampul} berita belum memiliki gambar sampul",
                'url' => route('admin.berita.index'),
                'aksi' => 'Lengkapi sampul',
            ] : null,
            ($highlightInfo = Halaman::publikasi()->where('kategori', 'informasi-publik')->where('tampil_di_beranda', true)->count()) === 0 ? [
                'teks' => 'Belum ada dokumen Informasi Publik yang ditampilkan di beranda (0/' . HomeController::MAKS_HIGHLIGHT . ')',
                'url' => route('admin.halaman.index', ['kategori' => 'informasi-publik']),
                'aksi' => 'Pilih highlight',
            ] : null,
            str_starts_with($sambutan['nama'] ?? '', 'Nama Kepala Rutan') || empty($sambutan['nama']) ? [
                'teks' => 'Sambutan pimpinan masih memakai nama/teks contoh',
                'url' => route('admin.sambutan.edit'),
                'aksi' => 'Perbarui sambutan',
            ] : null,
            empty($sambutan['foto']) ? [
                'teks' => 'Foto Kepala Rutan belum diunggah',
                'url' => route('admin.sambutan.edit'),
                'aksi' => 'Unggah foto',
            ] : null,
        ]));

        return view('admin.dasbor', [
            'statistik' => $statistik,
            'pengumuman' => $pengumuman,
            'statusPengumuman' => PengaturanController::statusPengumuman($pengumuman),
            'beritaTerbaru' => $beritaTerbaru,
            'perhatian' => $perhatian,
        ]);
    }
}
