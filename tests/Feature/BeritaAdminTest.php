<?php

use App\Models\Berita;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->admin = User::factory()->create();
});

function dataBerita(array $atribut = []): array
{
    return array_merge([
        'judul' => 'Pelatihan Kemandirian Warga Binaan',
        'kategori' => 'kegiatan',
        'status' => 'publikasi',
        'konten' => '<p>Isi berita.</p>',
    ], $atribut);
}

it('menolak berita baru tanpa gambar sampul', function () {
    $this->actingAs($this->admin)
        ->post('/admin/berita', dataBerita())
        ->assertSessionHasErrors('gambar_sampul');

    expect(Berita::count())->toBe(0);
});

it('mewajibkan kategori yang valid', function () {
    $this->actingAs($this->admin)
        ->post('/admin/berita', dataBerita([
            'kategori' => 'asal',
            'gambar_sampul' => UploadedFile::fake()->image('sampul.jpg', 1200, 800),
        ]))
        ->assertSessionHasErrors('kategori');
});

it('memotong sampul ke 16:9 dan mengompres ke WebP', function () {
    $this->actingAs($this->admin)
        ->post('/admin/berita', dataBerita([
            'kategori' => 'pengumuman',
            'gambar_sampul' => UploadedFile::fake()->image('foto-kegiatan.jpg', 2000, 1500),
        ]))
        ->assertRedirect(route('admin.berita.index'));

    $berita = Berita::first();
    expect($berita->kategori)->toBe('pengumuman')
        ->and($berita->gambar_sampul)->toStartWith('berita/')->toEndWith('.webp');

    Storage::disk('public')->assertExists($berita->gambar_sampul);
    $info = getimagesizefromstring(Storage::disk('public')->get($berita->gambar_sampul));
    expect([$info[0], $info[1], $info['mime']])->toBe([1600, 900, 'image/webp']);
});

it('menolak sampul beresolusi terlalu kecil', function () {
    $this->actingAs($this->admin)
        ->post('/admin/berita', dataBerita(['gambar_sampul' => UploadedFile::fake()->image('kecil.jpg', 400, 300)]))
        ->assertSessionHasErrors('gambar_sampul');
});

it('tidak mewajibkan sampul baru saat mengubah berita yang sudah bersampul, dan mengganti sampul lama', function () {
    $this->actingAs($this->admin)->post('/admin/berita', dataBerita([
        'gambar_sampul' => UploadedFile::fake()->image('a.jpg', 1600, 900),
    ]));
    $berita = Berita::first();
    $sampulLama = $berita->gambar_sampul;

    $this->actingAs($this->admin)
        ->put("/admin/berita/{$berita->id}", dataBerita(['judul' => 'Judul Diperbarui', 'kategori' => 'rilis-pers']))
        ->assertSessionHasNoErrors();
    expect($berita->refresh()->judul)->toBe('Judul Diperbarui')
        ->and($berita->kategori)->toBe('rilis-pers')
        ->and($berita->gambar_sampul)->toBe($sampulLama);

    $this->actingAs($this->admin)
        ->put("/admin/berita/{$berita->id}", dataBerita(['gambar_sampul' => UploadedFile::fake()->image('b.png', 1000, 1000)]))
        ->assertSessionHasNoErrors();
    Storage::disk('public')->assertMissing($sampulLama);
    Storage::disk('public')->assertExists($berita->refresh()->gambar_sampul);
});

it('mewajibkan sampul saat mengubah berita lama yang belum bersampul', function () {
    $berita = Berita::create(dataBerita(['slug' => 'lama-tanpa-sampul']));

    $this->actingAs($this->admin)
        ->put("/admin/berita/{$berita->id}", dataBerita())
        ->assertSessionHasErrors('gambar_sampul');
});

it('memfilter berita berdasarkan kategori di admin dan publik', function () {
    Berita::create(dataBerita(['judul' => 'Info Kunjungan Lebaran', 'slug' => 'info-kunjungan', 'kategori' => 'pengumuman']));
    Berita::create(dataBerita(['judul' => 'Senam Pagi Bersama', 'slug' => 'senam-pagi', 'kategori' => 'kegiatan']));

    $this->actingAs($this->admin)->get('/admin/berita?kategori=pengumuman')
        ->assertOk()->assertSee('Info Kunjungan Lebaran')->assertDontSee('Senam Pagi Bersama');

    $this->get('/berita?kategori=pengumuman')
        ->assertOk()
        ->assertSee('Info Kunjungan Lebaran')
        ->assertDontSee('Senam Pagi Bersama')
        ->assertSee('aria-current="page"', false);

    $this->get('/berita/senam-pagi')->assertOk()->assertSee('Kegiatan');
});
