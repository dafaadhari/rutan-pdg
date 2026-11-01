<?php

use App\Models\Berita;
use App\Models\Pengaturan;
use App\Models\User;

it('mengarahkan tamu ke halaman login', function () {
    $this->get('/admin')->assertRedirect(route('login'));
});

it('menampilkan dasbor dengan statistik dan hal yang perlu perhatian', function () {
    Berita::create(['judul' => 'Berita Tanpa Sampul', 'slug' => 'tanpa-sampul', 'kategori' => 'kegiatan', 'konten' => '<p>x</p>', 'status' => 'publikasi']);
    Pengaturan::simpan('sambutan', ['tampil' => true, 'judul' => 'x', 'isi' => 'x', 'nama' => 'Nama Kepala Rutan, S.H.', 'jabatan' => 'x', 'foto' => null]);

    $this->actingAs(User::factory()->create(['name' => 'Humas Uji']))
        ->get('/admin')
        ->assertOk()
        ->assertSee('Humas Uji')
        ->assertSee('Berita Tanpa Sampul')
        ->assertSee('1 berita belum memiliki gambar sampul')
        ->assertSee('Sambutan pimpinan masih memakai nama/teks contoh')
        ->assertDontSee('fonts.googleapis');
});

it('menampilkan halaman pengaturan pengumuman dan sambutan', function () {
    $admin = User::factory()->create();

    $this->actingAs($admin)->get('/admin/pengumuman')->assertOk()->assertSee('Banner pengumuman');
    $this->actingAs($admin)->get('/admin/sambutan')->assertOk()->assertSee('Sambutan Kepala Rutan');
    $this->actingAs($admin)->get('/admin/berita/create')->assertOk()->assertSee('Gambar sampul')->assertSee('Kategori');
});
