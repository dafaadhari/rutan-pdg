<?php

use App\Models\Berita;
use App\Models\User;

function buatBeritaTampilan(int $nomor): Berita
{
    $berita = (new Berita)->forceFill([
        'judul' => "Berita Tampilan {$nomor}",
        'slug' => "berita-tampilan-{$nomor}",
        'konten' => "<p>Isi {$nomor}.</p>",
        'status' => 'publikasi',
        'created_at' => now()->subDays($nomor),
    ]);
    $berita->save();

    return $berita;
}

it('menampilkan halaman 404 bermerek', function () {
    $this->get('/halaman-yang-tidak-ada')
        ->assertNotFound()
        ->assertSee('Halaman tidak ditemukan')
        ->assertSee('Kembali ke beranda')
        ->assertSee('action="' . route('berita.index') . '"', false)
        ->assertDontSee('Not Found');
});

it('merender halaman error 500 dan 419 berbahasa Indonesia', function () {
    expect(view('errors.500')->render())
        ->toContain('Terjadi gangguan pada server')
        ->toContain('Kode 500');

    expect(view('errors.419')->render())
        ->toContain('Sesi telah berakhir');
});

it('menampilkan pagination berita bermerek berbahasa Indonesia', function () {
    foreach (range(1, 10) as $i) {
        buatBeritaTampilan($i);
    }

    $this->get('/berita')
        ->assertOk()
        ->assertSee('aria-label="Navigasi halaman"', false)
        ->assertSeeText('Menampilkan 1–9 dari 10 berita')
        ->assertSee('page=2')
        ->assertDontSee('Showing');
});

it('menampilkan tautan instansi terkait yang URL-nya diisi', function () {
    config(['rutan.tautan_instansi' => [
        ['nama' => 'Direktorat Jenderal Pemasyarakatan', 'url' => 'https://www.ditjenpas.go.id'],
        ['nama' => 'Instansi Tanpa URL', 'url' => null],
    ]]);

    $this->get('/berita')
        ->assertOk()
        ->assertSee('Tautan terkait')
        ->assertSee('href="https://www.ditjenpas.go.id"', false)
        ->assertDontSee('Instansi Tanpa URL');
});

it('menampilkan halaman login bergaya baru tanpa Google Fonts', function () {
    $this->get('/admin/login')
        ->assertOk()
        ->assertSee('Masuk ke panel humas')
        ->assertSee('action="' . route('login.post') . '"', false)
        ->assertDontSee('fonts.googleapis');
});

it('tetap bisa masuk dan menolak kredensial salah', function () {
    $admin = User::factory()->create(['email' => 'humas@rutan.go.id']);

    $this->post('/admin/login', ['email' => 'humas@rutan.go.id', 'password' => 'salah'])
        ->assertSessionHasErrors();
    $this->assertGuest();

    $this->post('/admin/login', ['email' => 'humas@rutan.go.id', 'password' => 'password'])
        ->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticatedAs($admin);
});
