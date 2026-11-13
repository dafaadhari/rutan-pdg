<?php

use App\Models\Halaman;
use App\Models\User;
use Database\Seeders\HalamanSeeder;

function halaman(array $atribut = []): Halaman
{
    return Halaman::create(array_merge([
        'kategori' => 'layanan',
        'slug' => 'jadwal-besuk',
        'judul' => 'Jadwal Besuk',
        'ringkasan' => 'Informasi jam kunjungan.',
        'ikon' => 'kalender',
        'grup' => 'Kunjungan & WBP',
        'konten' => '<p>Isi jadwal besuk.</p>',
        'urutan' => 1,
        'tampil_di_beranda' => true,
        'status' => 'publikasi',
    ], $atribut));
}

function dataForm(array $atribut = []): array
{
    return array_merge([
        'kategori' => 'layanan',
        'judul' => 'Layanan Baru',
        'slug' => '',
        'ringkasan' => 'Ringkasan layanan baru.',
        'ikon' => 'info',
        'grup' => 'Perizinan',
        'urutan' => 5,
        'status' => 'publikasi',
        'tampil_di_beranda' => '1',
        'konten' => '<p>Konten layanan baru.</p>',
    ], $atribut);
}

it('menampilkan seluruh halaman bawaan dari seeder sebagai seksi', function () {
    $this->seed(HalamanSeeder::class);

    // Revisi Humas: 7 Tentang Kami, 3 Layanan, 5 Informasi Publik
    expect(Halaman::count())->toBe(15)
        ->and(Halaman::where('kategori', 'layanan')->urut()->pluck('slug')->all())
        ->toBe(['jadwal-besuk', 'titipan-barang', 'program-integrasi']);

    Halaman::all()->each(function ($h) {
        expect($h->url)->toBe(route($h->kategori) . '#' . $h->slug);
        $this->get(route($h->kategori))->assertOk()
            ->assertSee('id="' . $h->slug . '"', false)
            ->assertSee($h->judul);
    });
});

it('menampilkan semua halaman satu kategori dalam satu halaman dengan penanda gulir', function () {
    halaman();
    halaman(['slug' => 'titipan-barang', 'judul' => 'Titipan Barang', 'urutan' => 2, 'konten' => '<p>Isi titipan.</p>']);

    $html = $this->get('/layanan')
        ->assertOk()
        ->assertSee('Isi jadwal besuk.', false)
        ->assertSee('Isi titipan.', false)
        ->assertSee('data-seksi', false)
        ->assertSee('data-penanda="titipan-barang"', false)
        ->getContent();

    // Seksi berurutan sesuai nomor urut
    expect(strpos($html, 'id="jadwal-besuk"'))->toBeLessThan(strpos($html, 'id="titipan-barang"'));
});

it('mengalihkan tautan lama per halaman ke seksinya', function () {
    halaman();

    $this->get('/layanan/jadwal-besuk')
        ->assertStatus(301)
        ->assertRedirect(route('layanan') . '#jadwal-besuk');
});

it('menyembunyikan halaman draft dari publik dan menu', function () {
    halaman();
    halaman(['slug' => 'rahasia', 'judul' => 'Halaman Rahasia', 'status' => 'draft']);

    $this->get('/layanan/rahasia')->assertNotFound();
    $this->get('/layanan')->assertOk()->assertDontSee('Halaman Rahasia');
    $this->get('/layanan/tidak-ada')->assertNotFound();
    $this->get('/informasi-publik')->assertNotFound();
});

it('menampilkan highlight layanan & informasi publik pilihan admin di beranda', function () {
    foreach (range(1, 5) as $i) {
        halaman(['slug' => "layanan-$i", 'judul' => "Layanan Ke-$i", 'urutan' => $i]);
    }
    halaman(['slug' => 'tersembunyi', 'judul' => 'Layanan Tersembunyi', 'urutan' => 0, 'tampil_di_beranda' => false]);
    halaman(['kategori' => 'informasi-publik', 'slug' => 'lakip', 'judul' => 'LAKIP', 'grup' => null]);
    halaman(['kategori' => 'informasi-publik', 'slug' => 'arsip', 'judul' => 'Arsip', 'grup' => null, 'tampil_di_beranda' => false]);

    $html = $this->get('/')
        ->assertOk()
        ->assertSee(route('layanan'))
        ->assertSee(route('informasi-publik'))
        ->assertDontSee('id="daftar-layanan"', false)
        ->getContent();

    // Maks. 4 highlight layanan sesuai urutan; yang tidak dicentang tidak tampil
    $highlight = (string) str($html)->after('id="layanan"')->before('</section>');
    expect($highlight)
        ->toContain(route('layanan') . '#layanan-1"')
        ->toContain(route('layanan') . '#layanan-4"')
        ->not->toContain(route('layanan') . '#layanan-5"')
        ->not->toContain(route('layanan') . '#tersembunyi"');

    $informasi = (string) str($html)->after('id="informasi-publik"')->before('</section>');
    expect($informasi)
        ->toContain(route('informasi-publik') . '#lakip"')
        ->not->toContain(route('informasi-publik') . '#arsip"');

    // Urutan: highlight layanan → berita → informasi publik → maklumat & pengaduan
    expect(strpos($html, 'id="layanan"'))->toBeLessThan(strpos($html, 'id="berita"'))
        ->and(strpos($html, 'id="berita"'))->toBeLessThan(strpos($html, 'id="informasi-publik"'))
        ->and(strpos($html, 'id="informasi-publik"'))->toBeLessThan(strpos($html, 'id="maklumat"'));
});

it('mengabaikan opsi beranda untuk halaman Tentang Kami', function () {
    $this->actingAs(User::factory()->create())
        ->post('/admin/halaman', dataForm(['kategori' => 'tentang-kami', 'tampil_di_beranda' => '1']));

    expect(Halaman::firstWhere('kategori', 'tentang-kami')->tampil_di_beranda)->toBeFalse();
});

it('mewajibkan login untuk manajemen halaman', function () {
    $this->get('/admin/halaman')->assertRedirect(route('login'));
    $this->post('/admin/halaman', dataForm())->assertRedirect(route('login'));
});

it('memungkinkan admin menambah halaman dengan slug otomatis', function () {
    $this->actingAs(User::factory()->create())
        ->post('/admin/halaman', dataForm())
        ->assertRedirect();

    $halaman = Halaman::firstWhere('judul', 'Layanan Baru');

    expect($halaman)->not->toBeNull()
        ->and($halaman->slug)->toBe('layanan-baru')
        ->and($halaman->tampil_di_beranda)->toBeTrue();

    $this->get('/layanan')->assertOk()->assertSee('Konten layanan baru.', false);
});

it('membuat slug unik per kategori', function () {
    halaman(['slug' => 'layanan-baru', 'judul' => 'Layanan Baru']);
    $admin = User::factory()->create();

    $this->actingAs($admin)->post('/admin/halaman', dataForm());
    $this->actingAs($admin)->post('/admin/halaman', dataForm(['kategori' => 'tentang-kami']));

    expect(Halaman::where('kategori', 'layanan')->pluck('slug')->sort()->values()->all())
        ->toBe(['layanan-baru', 'layanan-baru-1'])
        ->and(Halaman::where('kategori', 'tentang-kami')->value('slug'))->toBe('layanan-baru');
});

it('memvalidasi input halaman', function () {
    $this->actingAs(User::factory()->create())
        ->post('/admin/halaman', dataForm(['kategori' => 'asal', 'ikon' => 'tidak-ada', 'slug' => 'Slug Salah', 'konten' => '']))
        ->assertSessionHasErrors(['kategori', 'ikon', 'slug', 'konten']);
});

it('memungkinkan admin mengubah dan menghapus halaman', function () {
    $halaman = halaman();
    $admin = User::factory()->create();

    $this->actingAs($admin)
        ->put("/admin/halaman/{$halaman->id}", dataForm([
            'judul' => 'Jadwal Kunjungan',
            'slug' => 'jadwal-besuk',
            'status' => 'draft',
            'tampil_di_beranda' => null,
        ]))
        ->assertRedirect();

    $halaman->refresh();
    expect($halaman->judul)->toBe('Jadwal Kunjungan')
        ->and($halaman->status)->toBe('draft')
        ->and($halaman->tampil_di_beranda)->toBeFalse();
    $this->get('/layanan/jadwal-besuk')->assertNotFound();

    $this->actingAs($admin)->delete("/admin/halaman/{$halaman->id}")->assertRedirect();
    expect(Halaman::count())->toBe(0);
});

it('menampilkan halaman admin daftar, tambah, dan ubah', function () {
    $halaman = halaman();
    $admin = User::factory()->create();

    $this->actingAs($admin)->get('/admin/halaman')->assertOk()->assertSee('Jadwal Besuk');
    $this->actingAs($admin)->get('/admin/halaman/create')->assertOk()->assertSee('tinymce', false);
    $this->actingAs($admin)->get("/admin/halaman/{$halaman->id}/edit")->assertOk()->assertSee('Perbarui Halaman');
});

it('menampilkan maklumat pelayanan & saluran pengaduan eksternal di beranda', function () {
    $html = $this->get('/')->assertOk()->assertDontSee('id="jadwal-kunjungan"', false)->getContent();
    $maklumat = (string) str($html)->after('id="maklumat"')->before('</section>');

    expect(strpos($html, 'id="maklumat"'))->toBeGreaterThan(strpos($html, 'id="berita"'))
        ->and($maklumat)
        ->toContain(e(config('rutan.maklumat.isi')))
        ->toContain('https://www.lapor.go.id')
        ->toContain('https://wa.me/628111733390')
        ->toContain('Kotak Pengaduan')
        // Halaman pengaduan internal sudah dihapus
        ->not->toContain('/layanan/pengaduan');
});

it('menampilkan jadwal kunjungan resmi di footer', function () {
    halaman();

    // Footer di halaman informasi memakai sumber jadwal dari config/rutan.php
    $footer = (string) str($this->get('/layanan')->getContent())->after('<footer');
    expect($footer)
        ->toContain('Jadwal Kunjungan')
        ->toContain('Senin &amp; Rabu:')
        ->toContain('08.30–12.00 &amp; 13.30–14.00 WIB')
        ->toContain('Sabtu:')
        ->not->toContain('Kamis');
});

it('menghapus blok judul ganda di awal konten lewat migration', function () {
    $ganda = halaman([
        'slug' => 'ganda',
        'konten' => "<div class=\"space-y-6\">\n    <div class=\"border-b border-gray-150 pb-4\">\n        <h2>Judul Lama</h2>\n        <p>Subjudul lama.</p>\n    </div>\n\n    <p>Isi tetap.</p>\n</div>",
    ]);
    $lain = halaman([
        'slug' => 'lain',
        'konten' => '<p>Paragraf pembuka.</p><div class="border-b border-gray-150 pb-4"><h2>Bukan di awal</h2></div>',
    ]);

    (require database_path('migrations/2026_10_30_000000_hapus_judul_ganda_konten_halaman.php'))->up();

    expect($ganda->refresh()->konten)
        ->not->toContain('Judul Lama')
        ->not->toContain('border-gray-150')
        ->toContain('<p>Isi tetap.</p>')
        ->and($lain->refresh()->konten)->toContain('Bukan di awal');
});

it('membatasi ringkasan maksimal 120 karakter', function () {
    $admin = User::factory()->create();

    $this->actingAs($admin)
        ->post('/admin/halaman', dataForm(['judul' => 'Terlalu Panjang', 'ringkasan' => str_repeat('a', 121)]))
        ->assertSessionHasErrors('ringkasan');

    $this->actingAs($admin)
        ->post('/admin/halaman', dataForm(['judul' => 'Pas Batas', 'ringkasan' => str_repeat('a', 120)]))
        ->assertSessionHasNoErrors();

    expect(Halaman::where('judul', 'Pas Batas')->exists())->toBeTrue()
        ->and(Halaman::where('judul', 'Terlalu Panjang')->exists())->toBeFalse();
});

it('merampingkan konten lama sesuai revisi Humas lewat migration', function () {
    foreach ([
        ['tentang-kami', 'unit-pelaksana-teknis', 'Unit Pelaksana Teknis'],
        ['tentang-kami', 'profil-organisasi', 'Profil Organisasi'],
        ['tentang-kami', 'profil-pejabat', 'Profil Pejabat'],
        ['tentang-kami', 'kontak-kami', 'Kontak Kami'],
        ['layanan', 'media-massa', 'Media Massa'],
        ['layanan', 'pengaduan', 'Pengaduan'],
        ['informasi-publik', 'dipa', 'DIPA'],
        ['informasi-publik', 'lakip', 'LAKIP'],
    ] as [$kategori, $slug, $judul]) {
        halaman(['kategori' => $kategori, 'slug' => $slug, 'judul' => $judul, 'grup' => null]);
    }
    \App\Models\Berita::create(['judul' => 'Rilis', 'slug' => 'rilis', 'kategori' => 'rilis-pers', 'konten' => '<p>x</p>', 'status' => 'publikasi']);
    User::factory()->create(['name' => 'Super Admin']);

    (require database_path('migrations/2026_11_13_000001_revisi_humas_konten.php'))->up();

    expect(Halaman::where('kategori', 'tentang-kami')->pluck('slug')->sort()->values()->all())
        ->toBe(['kontak-kami', 'profil', 'visi-misi'])
        ->and(Halaman::firstWhere('slug', 'profil')->judul)->toBe('Profil')
        ->and(Halaman::firstWhere('slug', 'profil')->konten)->toContain('Tugas Pokok')
        ->and(Halaman::firstWhere('slug', 'visi-misi')->konten)->not->toContain('Tugas Pokok')
        ->and(Halaman::firstWhere('slug', 'kontak-kami')->konten)
        ->toContain('rutanpandeglang@gmail.com')
        ->not->toContain('Jadwal Pelayanan Kunjungan')
        ->and(Halaman::where('kategori', 'layanan')->exists())->toBeFalse()
        ->and(Halaman::where('kategori', 'informasi-publik')->pluck('slug')->all())->toBe(['lakip'])
        ->and(\App\Models\Berita::first()->kategori)->toBe('kegiatan')
        ->and(User::first()->name)->toBe('Humas');
});

it('tidak menautkan panel admin dari situs publik', function () {
    halaman();

    foreach (['/', '/layanan', '/berita'] as $url) {
        $this->get($url)->assertOk()
            ->assertDontSee('Akses Admin')
            ->assertDontSee('href="' . route('login') . '"', false);
    }

    // Pengelola tetap bisa masuk lewat /admin
    $this->get('/admin')->assertRedirect(route('login'));
});

it('menampilkan kontak resmi terbaru di topbar dan footer', function () {
    halaman();

    $this->get('/layanan')->assertOk()
        ->assertSee('rutanpandeglang@gmail.com')
        ->assertSee('08111733390')
        ->assertSee('Jl. Raya Pandeglang 2');
});
