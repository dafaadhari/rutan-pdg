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
* [x] Instalasi dan konfigurasi **Filament PHP v3** beserta akun Super Admin.
* [x] Perancangan dan implementasi layout halaman depan publik (`resources/views/welcome.blade.php`) dengan tema `bg-gray-900`.
* [x] Integrasi `concurrently` di `package.json` melalui skrip `"serve"`.

---

## 5. Target Selanjutnya (What's Next / Pending Tasks)
Langkah pengembangan selanjutnya yang harus dieksekusi secara bertahap:
1. **Konfigurasi Filament Resource (`BeritaResource`):**
   * Mengatur form input admin (Judul, Slug otorisasi, Textarea/Rich Text Editor untuk Konten, File Upload untuk Gambar Sampul, dan Select untuk Status Draft/Publikasi).
   * Mengatur tabel tampilan data berita di dasbor admin.
2. **Koneksi Database ke Halaman Publik:**
   * Mengambil data berita dari tabel `beritas` (hanya yang berstatus `publikasi`) untuk ditampilkan secara dinamis ke halaman `welcome.blade.php`.
3. **Halaman Detail Berita Publik (`/berita/{slug}`):**
   * Membuat *route*, *controller*, dan *view* khusus untuk membaca artikel secara utuh saat pengguna mengklik salah satu berita.