<?php

use App\Models\Berita;

function berita(array $atribut = []): Berita
{
    static $nomor = 0;
    $nomor++;

    // forceFill agar created_at (tidak fillable) bisa diatur untuk uji urutan & tanggal
    $berita = (new Berita)->forceFill(array_merge([
        'judul' => "Berita Uji {$nomor}",
        'slug' => "berita-uji-{$nomor}",
        'konten' => "<p>Isi berita uji {$nomor}.</p>",
        'status' => 'publikasi',
    ], $atribut));
    $berita->save();

    return $berita;
}

it('menampilkan arsip berita publikasi saja', function () {
    berita(['judul' => 'Kegiatan Pembinaan', 'slug' => 'kegiatan-pembinaan']);
    berita(['judul' => 'Berita Rahasia', 'slug' => 'berita-rahasia', 'status' => 'draft']);

    $this->get('/berita')
        ->assertOk()
        ->assertSee('Kegiatan Pembinaan')
        ->assertDontSee('Berita Rahasia');
});

it('membagi arsip berita per 9 item', function () {
    foreach (range(1, 10) as $i) {
        berita(['created_at' => now()->subDays($i)]);
    }

    $halaman1 = $this->get('/berita')->assertOk()->getContent();
    expect(substr_count($halaman1, '<article'))->toBe(9);

    $halaman2 = $this->get('/berita?page=2')->assertOk()->getContent();
    expect(substr_count($halaman2, '<article'))->toBe(1);
});

it('mencari berita berdasarkan judul', function () {
    berita(['judul' => 'Jadwal Kunjungan Lebaran', 'slug' => 'jadwal-kunjungan-lebaran']);
    berita(['judul' => 'Pelatihan Kemandirian', 'slug' => 'pelatihan-kemandirian']);

    $this->get('/berita?q=kunjungan')
        ->assertOk()
        ->assertSee('Jadwal Kunjungan Lebaran')
        ->assertDontSee('Pelatihan Kemandirian');
});

it('menampilkan tanggal berbahasa Indonesia', function () {
    berita(['slug' => 'tanggal-uji', 'created_at' => '2026-08-25 10:00:00']);

    $this->get('/berita')->assertSee('25 Agustus 2026');
    $this->get('/berita/tanggal-uji')->assertSee('Selasa, 25 Agustus 2026');
});

it('menampilkan detail berita dengan meta OpenGraph tanpa slug teknis', function () {
    berita(['judul' => 'Rilis Resmi Humas & Kegiatan', 'slug' => 'rilis-resmi-humas']);

    $this->get('/berita/rilis-resmi-humas')
        ->assertOk()
        ->assertSee('<title>Rilis Resmi Humas &amp; Kegiatan - Rutan Kelas IIB Pandeglang</title>', false)
        ->assertSee('<meta property="og:title" content="Rilis Resmi Humas &amp; Kegiatan">', false)
        ->assertSee('<meta property="og:type" content="article">', false)
        ->assertDontSee('>rilis-resmi-humas<', false);
});

it('menyembunyikan detail berita draft', function () {
    berita(['slug' => 'masih-draft', 'status' => 'draft']);

    $this->get('/berita/masih-draft')->assertNotFound();
});

it('memakai logo.png bila tersedia, selain itu emblem cadangan', function () {
    $path = public_path('images/logo.png');
    expect(is_file($path))->toBeFalse();

    $this->get('/berita')->assertOk()
        ->assertSee('role="img" aria-label="Logo Rutan Kelas IIB Pandeglang"', false)
        ->assertDontSee('images/logo.png');

    try {
        file_put_contents($path, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='));

        $this->get('/berita')->assertOk()
            ->assertSee('<img src="' . asset('images/logo.png') . '" alt="Logo Rutan Kelas IIB Pandeglang"', false)
            ->assertSee('<meta property="og:image" content="' . asset('images/logo.png') . '">', false);
    } finally {
        @unlink($path);
    }
});
