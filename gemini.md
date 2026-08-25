# Dokumentasi Proyek: Portal Informasi Rutan Kelas IIB Pandeglang

Dokumen ini adalah acuan kerja (blueprint) bagi AI Assistant / Agent di text editor untuk memahami arsitektur, teknologi, dan status pengembangan portal resmi **Rutan Kelas IIB Pandeglang** (di bawah naungan Kementerian Imigrasi dan Pemasyarakatan RI).

---

## 1. Tech Stack & Dependensi
* **Framework:** Laravel (Latest)
* **Admin Panel:** Filament PHP v3 (`^3.2`)
* **Styling & CSS:** Tailwind CSS + Vite
* **Database:** MySQL (`rutan_pdg`)
* **Testing:** Pest (Tersedia, belum diimplementasikan secara masif)
* **Authentication:** Custom via Filament Panel (`/admin`) — Tanpa Jetstream / Breeze.
* **Helper Tools:** `concurrently` (untuk menjalankan `php artisan serve` dan `npm run dev` secara bersamaan melalui perintah `npm run serve`).

---

## 2. Struktur Database & Skema
Proyek ini menggunakan tabel-tabel utama berikut:

### A. Tabel `beritas` (Manajemen Artikel & Publikasi)
* `id` (Primary Key)
* `judul` (String)
* `slug` (String, Unique)
* `konten` (Text / Rich Text)
* `gambar_sampul` (String, Nullable)
* `status` (Enum: `draft`, `publikasi`, Default: `draft`)
* `timestamps` (`created_at`, `updated_at`)

### B. Tabel Bawaan Laravel
* `users` (Digunakan oleh Filament untuk akun admin)
* `sessions` (Menyimpan sesi login dan web state)

---

## 3. Panduan Desain & UI/UX (Design System)
Portal instansi ini **tidak** menggunakan konsep majalah/blog biasa (seperti DOGMA), melainkan berfokus sebagai **Portal Layanan Publik & Humas Pemerintahan**.

* **Primary Color / Tema Warna:** 
  * Dominan menggunakan **`bg-gray-900`** (Abu-abu sangat gelap / charcoal) untuk memancarkan kesan formal, tegas, profesional, dan berwibawa.
* **Komponen Utama Halaman Publik (`welcome.blade.php`):**
  * **Top Bar Kementerian:** Pita hitam tipis di paling atas bertuliskan identitas kementerian.
  * **Navbar Instansi:** Logo Rutan, Judul Instansi, dan navigasi menu utama.
  * **Hero Section (Split Layout):** Sisi kiri teks sambutan dan moto *PASTI*, sisi kanan placeholder visual/foto gedung.
  * **Panel Layanan Publik (Quick Access):** 4 kotak grid menonjol untuk layanan esensial (Jadwal Besuk, Titipan Barang, Program Integrasi, Pengaduan).
  * **Seksi Publikasi / Berita:** Layout asimetris (1 Berita Utama di kiri, Daftar Berita Samping di kanan).
  * **Footer Resmi:** Informasi kontak, alamat (Jl. Raya Pandeglang - Serang), dan jam layanan operasional.

---

## 4. Status Pengerjaan (What's Done)
* [x] Inisialisasi proyek Laravel `rutan-pdg`.
* [x] Konfigurasi database MySQL (`rutan_pdg`).
* [x] Pembuatan Migration & Model untuk tabel `beritas` dan `sessions`.
* [x] Instalasi dan konfigurasi **Filament PHP v3** (`v3.3.55`) beserta akun Super Admin.
* [x] Konfigurasi **BeritaResource** di Filament Admin Panel (Rich Editor, File Upload, Auto Slug, Badge Status).
* [x] Publikasi aset CSS & JS Filament dan Livewire ke direktori `public/`.
* [x] Perancangan dan implementasi layout halaman depan publik (`resources/views/welcome.blade.php`) dengan tema `bg-gray-900`.
* [x] Integrasi `concurrently` di `package.json` melalui skrip `"serve"`.

---

## 5. Target Selanjutnya (What's Next / Pending Tasks)
Langkah penyesuaian & pengembangan selanjutnya:
1. **Penyesuaian Alur Redirect Create Berita:**
   * Mengubah pengalihan halaman setelah klik *Create/Save* dari halaman Edit ke daftar index berita (`/admin/beritas`).
2. **Klarifikasi & Optimasi Kolom Slug:**
   * Menjelaskan fungsi `slug` untuk SEO URL dan membuat input slug bersifat *read-only* / terisi otomatis tanpa perlu diketik manual.
3. **Kustomisasi Branding & Desain Admin Panel:**
   * Mengubah nama aplikasi dari "Laravel" menjadi **"Rutan Kelas IIB Pandeglang"** di `.env` dan Admin Panel.
   * Menyesuaikan skema warna panel Filament (Primary Color) agar selaras dengan identitas instansi.
4. **Integrasi Data Berita ke Dashboard Publik (`welcome.blade.php`):**
   * Mengambil data berita berkategori `'publikasi'` secara dinamis dari database MySQL ke halaman depan.
   * Menampilkan gambar sampul, judul, tanggal, dan ringkasan isi berita.
5. **Halaman Detail Berita Publik (`/berita/{slug}`):**
   * Membuat rute & tampilan detail berita agar pengunjung publik dapat membaca artikel secara utuh saat berita diklik.
6. **Seeder Data Dummy Berita Publik:**
   * Menyiapkan data seeder berita resmi rutan agar dashboard publik terisi data sampel berkualitas.