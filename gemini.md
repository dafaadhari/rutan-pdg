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
* [x] **Pembersihan Total Filament & Livewire (100% Blade Monolith):**
  * [x] Menghapus registrasi `AdminPanelProvider::class` di `bootstrap/providers.php`.
  * [x] Menghapus direktori `app/Filament` dan `app/Providers/Filament`.
  * [x] Menghapus aset `public/css/filament`, `public/js/filament`, dan `public/vendor/livewire`.
  * [x] Menghapus dependensi `"filament/filament"` dari `composer.json`.
* [x] **Modul Autentikasi Admin (Blade & HTTP Session):**
  * [x] `app/Http/Controllers/AuthController.php` (login form, autentikasi aman, logout).
  * [x] View form login `resources/views/auth/login.blade.php` (tema formal `bg-gray-950`).
* [x] **Modul Dasbor & Manajemen Berita Admin (CRUD Blade):**
  * [x] Layout admin `resources/views/layouts/admin.blade.php` (top bar, identitas instansi, flash alerts).
  * [x] `app/Http/Controllers/Admin/BeritaController.php` (index, create, store, edit, update, destroy, unique slug generator, auto delete old image).
  * [x] View daftar berita `resources/views/admin/berita/index.blade.php` (tabel thumbnail, badge status, filter pencarian, pagination).
  * [x] View form tambah berita `resources/views/admin/berita/create.blade.php` (live slug preview, image preview client-side).
  * [x] View form edit berita `resources/views/admin/berita/edit.blade.php` (pratinjau sampul lama & opsi ganti gambar).
* [x] **Modul Publik Beranda & Detail Berita:**
  * [x] Rute publik & admin di `routes/web.php` dengan proteksi middleware `auth` dan `guest`.
  * [x] Integrasi data dinamis di `resources/views/welcome.blade.php` (1 berita utama + 3 sampingan, link detail, link akses admin).
  * [x] View detail berita `resources/views/berita/show.blade.php` (breadcrumb, metadata humas, konten terformat, sidebar artikel terkini).
  * [x] **Navbar Resmi Multi-Level Dropdown ([resources/views/partials/navbar.blade.php](file:///c:/Users/HP/rutan-pdg/resources/views/partials/navbar.blade.php)):**
    * Navigasi standar portal Ditjenpas Kemenimipas RI (Home, Tentang Kami, Layanan, Informasi Publik, Berita).
    * Sub-menu dropdown lengkap dan responsif dengan dukungan mobile drawer accordion.
* [x] **Modul Halaman Dropdown Navigasi (23 Halaman Statis):**
  * [x] `app/Http/Controllers/PageController.php` (routing dinamis slug → view dengan penanganan 404).
  * [x] `resources/views/layouts/page.blade.php` (layout 2 kolom: konten + sidebar navigasi kategori, breadcrumb, footer resmi).
  * [x] **Tentang Kami (8/8 halaman):** Motto dan Logo, Sejarah, UPT, Profil Organisasi, Profil Pejabat, Struktur Organisasi, Strategi Organisasi, Kontak Kami.
  * [x] **Layanan Publik (7/7 halaman):** Permohonan Data dan Informasi, Media Massa, SIMONEV Bama, Perizinan Penelitian, Perizinan Magang, Perizinan Peliputan, Pengaduan.
  * [x] **Informasi Publik (8/8 halaman):** LAKIP, DIPA, Laporan Tahunan, Laporan Keuangan, Rencana Strategis, IKU, Perjanjian Kinerja, Hasil Survei SPAK/SPKP.
* [x] **Data Seeder Awal:**
  * [x] `database/seeders/AdminUserSeeder.php` (`admin@rutan.go.id` / `password`).
  * [x] `database/seeders/BeritaSeeder.php` (artikel giat resmi rutan berstatus publikasi & draft).
  * [x] `database/seeders/DatabaseSeeder.php`.

---

## 5. Panduan Menjalankan & Deployment

### A. Menjalankan di Komputer Lokal (Local Environment Setup)
1. **Pastikan stack PHP & MySQL terpasang:**
   * Sangat disarankan mengunduh dan memasang **Laragon** (atau XAMPP) yang sudah memaketkan PHP 8.2+, Composer, dan MySQL.
2. **Install Dependensi & Konfigurasi Basis Data:**
   ```powershell
   composer install
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   ```
3. **Jalankan Aplikasi:**
   ```powershell
   npm install
   npm run serve
   ```
   *(Atau secara manual: `php artisan serve` di satu terminal dan `npm run dev` di terminal lainnya).*

4. **Kredensial Login Admin Default:**
   * URL: `http://127.0.0.1:8000/admin/login`
   * Email: `admin@rutan.go.id`
   * Password: `password`

### B. Persiapan Deployment InfinityFree / Shared Hosting
* Export database MySQL lokal dan import ke phpMyAdmin hosting.
* Tempatkan file inti Laravel di luar direktori publik (misal: `/home/user/laravel-app/`).
* Pindahkan isi folder `public/` ke direktori `public_html/` atau `htdocs/`.
* Sesuaikan path di `index.php` untuk mengarah ke vendor dan bootstrap laravel.
* Atur `.env` produksi (`APP_ENV=production`, `APP_DEBUG=false`, kredensial DB hosting).