1. Executive Summary & Objective
Nama Proyek: Portal Informasi Resmi & Dasbor Admin Rutan Kelas IIB Pandeglang

Tujuan Proyek: Mengembangkan portal web resmi sebagai media publikasi informasi, pengumuman, serta transparansi layanan publik Rutan Kelas IIB Pandeglang (Kemenimipas RI). Proyek ini disusun sebagai portofolio/penilaian akhir magang dengan standar desain profesional dan arsitektur yang aman untuk shared hosting gratis.

Target Pengguna:

Masyarakat / Keluarga WBP (Publik): Mengakses informasi jadwal besuk, pengaduan, dan berita giat rutan.

Petugas Humas / Admin Rutan: Mengelola artikel berita dan pengumuman secara mandiri.

2. Technical Scope & Constraint
Architecture Pattern: MVC (Model-View-Controller) Laravel Murni.

Deployment Target: InfinityFree / Shared Hosting (cPanel).

Constraints (Batasan Penting):

No Single Page Application / AJAX Polling Framework: Menghindari dependensi berat (seperti Livewire/Filament) agar request tidak diblokir oleh sistem proteksi anti-bot InfinityFree.

Penyimpanan Berkas: Gambar disukai dalam format terkompresi (WebP/JPG) max 2MB di direktori storage/app/public/berita.

3. Functional Requirements
A. Modul Publik (Guest User)
Halaman Utama (/):

Top bar identitas Kementerian Imigrasi dan Pemasyarakatan RI.

Hero Section dengan moto PASTI dan visual gedung rutan.

Quick Access Panel (4 Layanan: Jadwal Besuk, Titipan Barang, Program Integrasi, Pengaduan).

Showcase Berita: Menampilkan 1 berita utama (sorotan) dan 3 berita samping secara dinamis dari database (status = 'publikasi').

Halaman Detail Berita (/berita/{slug}):

Membaca isi berita secara utuh berdasarkan slug URL yang ramah SEO.

Menampilkan gambar sampul, tanggal terbit, nama penulis/humas, dan tombol kembali.

B. Modul Admin (Authenticated User)
Autentikasi Admin (/admin/login):

Form login aman berbasis HTTP POST dengan validasi kredensial email & password (users table).

Proteksi session & penanganan error autentikasi.

Manajemen Berita (CRUD) (/admin/berita):

List Data: Tabel daftar berita dengan status badge (draft/publikasi), penomoran halaman (pagination), dan thumbnail gambar.

Create: Form tambah berita (Judul, Status, Upload Gambar Sampul, Isi Konten). Generating slug otomatis dari judul.

Edit: Form pembaruan berita beserta opsi ganti gambar sampul (gambar lama otomatis terhapus dari server).

Delete: Hapus data berita disertai penghapusan berkas gambar dari media penyimpanan.

4. Non-Functional Requirements
UI/UX Design: Mengusung tema bg-gray-900 (Charcoal/Dark Elegant) yang memberikan kesan formal, tegas, dan berwibawa.

Performance: Lightweight load tanpa JS overhead berat.

Security: Proteksi CSRF (@csrf), enkripsi password (bcrypt), sanitasi berkas upload, dan proteksi middleware auth.