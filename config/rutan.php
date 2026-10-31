<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Jadwal Kunjungan (Besuk) & Titipan Barang
    |--------------------------------------------------------------------------
    |
    | Sumber tunggal jadwal kunjungan untuk kartu "Jadwal Kunjungan" di
    | beranda dan kolom footer. Kunci hari mengikuti Date.getDay()
    | JavaScript (0 = Minggu ... 6 = Sabtu). Hari yang tidak tercantum
    | berarti tidak ada layanan kunjungan. Titipan barang mengikuti
    | jadwal yang sama.
    |
    */

    'jadwal_kunjungan' => [
        1 => [
            ['mulai' => '08:30', 'selesai' => '12:00'],
            ['mulai' => '13:30', 'selesai' => '14:00'],
        ],
        3 => [
            ['mulai' => '08:30', 'selesai' => '12:00'],
            ['mulai' => '13:30', 'selesai' => '14:00'],
        ],
        6 => [
            ['mulai' => '08:30', 'selesai' => '12:00'],
        ],
    ],

    'nama_hari' => [
        0 => 'Minggu',
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
    ],

    /*
    |--------------------------------------------------------------------------
    | Kontak & Media Sosial Resmi
    |--------------------------------------------------------------------------
    |
    | Dipakai di topbar, footer, dan kotak pengaduan. Nilai null berarti
    | belum tersedia sehingga elemennya tidak ditampilkan.
    | whatsapp_pengaduan ditulis format internasional tanpa tanda +,
    | contoh: 6281234567890.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Maklumat Pelayanan
    |--------------------------------------------------------------------------
    |
    | Janji layanan yang tampil di beranda (format baku PermenPAN-RB
    | No. 15 Tahun 2014). Sesuaikan dengan maklumat resmi yang dipajang
    | di ruang layanan Rutan.
    |
    */

    'maklumat' => [
        'isi' => 'Dengan ini, kami menyatakan sanggup menyelenggarakan pelayanan sesuai standar pelayanan yang telah ditetapkan, dan apabila tidak menepati janji ini, kami siap menerima sanksi sesuai peraturan perundang-undangan yang berlaku.',
        'penanda_tangan' => 'Kepala Rumah Tahanan Negara Kelas IIB Pandeglang',
        'komitmen' => ['Layanan Gratis', 'Bebas Pungli', 'Tolak Gratifikasi'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tautan Instansi Terkait
    |--------------------------------------------------------------------------
    |
    | Ditampilkan di footer. URL null tidak ditampilkan; isi bila alamat
    | resmi sudah dipastikan.
    |
    */

    'tautan_instansi' => [
        ['nama' => 'Kementerian Imigrasi dan Pemasyarakatan', 'url' => 'https://www.kemenimipas.go.id'],
        ['nama' => 'Direktorat Jenderal Pemasyarakatan', 'url' => 'https://www.ditjenpas.go.id'],
        ['nama' => 'Kanwil Ditjen Pemasyarakatan Banten', 'url' => null],
        ['nama' => 'SP4N-LAPOR!', 'url' => 'https://www.lapor.go.id'],
        // Belum terverifikasi dari server (situs tidak merespons pemeriksaan otomatis)
        ['nama' => 'Ombudsman RI', 'url' => null],
    ],

    'kontak' => [
        'alamat' => 'Jl. Raya Pandeglang - Serang, Pandeglang, Banten',
        'telepon' => '(0253) 201234',
        'email' => 'info@rutanpandeglang.go.id',
        'whatsapp_pengaduan' => null,
        'peta' => null,
        'sosial' => [
            'instagram' => null,
            'facebook' => null,
            'youtube' => null,
            'x' => null,
        ],
    ],

];
