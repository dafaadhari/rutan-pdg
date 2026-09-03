# Blueprint & Dokumentasi Proyek: Portal Informasi Rutan Kelas IIB Pandeglang

Dokumen ini adalah acuan kerja (blueprint) utama bagi AI Agent / Assistant di text editor untuk memahami arsitektur teknis, desain, dan status pengerjaan portal resmi **Rutan Kelas IIB Pandeglang** (di bawah naungan Kementerian Imigrasi dan Pemasyarakatan RI).

---

## 1. Tech Stack & Dependensi
* **Framework:** Laravel (Latest)
* **Architecture:** Monolith Blade Murni (Tanpa Filament / Livewire agar 100% kompatibel dengan InfinityFree & Anti-Bot Shield).
* **Styling & CSS:** Tailwind CSS + Vite
* **Database:** MySQL (`rutan_pdg`)
* **Authentication:** Custom Laravel Auth Guard (`users` table, HTTP Session).
* **Helper Tools:** `concurrently` (menjalankan `php artisan serve` dan `npm run dev` secara bersamaan via `npm run serve`).

---

## 2. Skema Database

### A. Tabel `beritas`
* `id` (Primary Key, BigInt)
* `judul` (String, 255)
* `slug` (String, Unique)
* `konten` (Text)
* `gambar_sampul` (String, Nullable - Menyimpan path file `storage/berita/...`)
* `status` (Enum: `'draft'`, `'publikasi'`, Default: `'draft'`)
* `timestamps` (`created_at`, `updated_at`)

### B. Tabel System Bawaan
* `users` (Menyimpan data akun admin, e.g. `admin@rutan.go.id`)
* `sessions` (Menyimpan state login & session ID)

---

## 3. Design System & Identitas Visual
Portal ini dirancang sebagai **Portal Layanan Publik & Humas Pemerintahan Resmi**.

* **Primary Color / Palette:** Dominan menggunakan **`bg-gray-900`** (Charcoal/Dark Slate) dikombinasikan dengan warna `gray-800` untuk card/panel, serta aksen teks putih dan abu-abu terang.
* **Komponen Halaman Publik (`welcome.blade.php`):**
  * **Top Bar:** Identitas Kementerian Imigrasi dan Pemasyarakatan RI.
  * **Header/Navbar:** Logo Rutan, Judul Instansi, dan Link Navigasi.
  * **Hero Section (Split Layout):** Sambutan resmi & foto gedung.
  * **Panel Layanan Publik (Quick Access):** Grid 4 kotak (Jadwal Besuk, Titipan Barang, Program Integrasi, Pengaduan).
  * **Seksi Publikasi / Berita:** Layout asimetris (1 Berita Utama Sorotan + Daftar Berita Samping).
  * **Footer:** Alamat instansi, nomor kontak, dan jam operasional.

---

## 4. Status Pengerjaan Terkini (Current Progress)
* [x] Inisialisasi proyek Laravel `rutan-pdg` & Git repository.
* [x] Konfigurasi Database MySQL & Migration (`beritas`, `users`, `sessions`).
* [x] Perancangan UI Halaman Depan Publik (`resources/views/welcome.blade.php`) tema `bg-gray-900`.
* [x] Konfigurasi `package.json` & `concurrently` (`npm run serve`).
* [x] **Pembersihan Filament & Livewire (Tahap 1 - Berjalan):**
  * [x] **Langkah 1:** Menghapus registrasi `AdminPanelProvider::class` di `bootstrap/providers.php`.
  * [x] **Langkah 2:** Menghapus direktori `app/Filament` dan `app/Providers/Filament`.
  * [x] **Langkah 3:** Menghapus aset `public/css/filament`, `public/js/filament`, dan `public/vendor/livewire`.

---

## 5. Checkpoint & Target Selanjutnya (Resume Setelah Break)

### A. Selesaikan Pembersihan Filament (Immediate Tasks)
1. **Langkah 4:** Jalankan perintah di terminal untuk menghapus package:
   ```powershell
   composer remove filament/filament
   ```
2. **Langkah 5:** Bersihkan cache aplikasi:
   ```powershell
   php artisan optimize:clear
   ```
3. **Langkah 6:** Verifikasi routing:
   ```powershell
   php artisan route:list
   ```

### B. Tahap Pengembangan Custom Blade Admin & Publik
1. **Pembuatan Autentikasi Admin:**
   * Membuat `app/Http/Controllers/AuthController.php` (login, proses autentikasi, logout).
   * Membuat view form login `resources/views/login.blade.php` (tema `bg-gray-900`).
2. **Manajemen Berita (CRUD Admin):**
   * Membuat `app/Http/Controllers/Admin/BeritaController.php`.
   * Membuat views:
     * `resources/views/admin/berita/index.blade.php` (list berita, badge status, pagination).
     * `resources/views/admin/berita/create.blade.php` (form tambah berita & upload gambar).
     * `resources/views/admin/berita/edit.blade.php` (form edit berita & ganti gambar).
3. **Penyimpanan Berkas Media:**
   * Menjalankan `php artisan storage:link` untuk symlink direktori `public/storage`.
4. **Modul Publik Berita:**
   * Menghubungkan query berita dinamis di `welcome.blade.php`.
   * Membuat view detail berita `resources/views/berita/show.blade.php` (`/berita/{slug}`).
5. **Data Dummy & Seeder:**
   * Menyiapkan `BeritaSeeder` untuk mengisi sampel giat rutan.
6. **Persiapan Deployment:**
   * Konfigurasi `.env` produksi & struktur `public_html` untuk shared hosting InfinityFree.