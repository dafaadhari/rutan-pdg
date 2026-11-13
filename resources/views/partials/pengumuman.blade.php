{{--
    Pop-up pengumuman: tampil sekali bagi pengunjung yang baru masuk ke portal publik.
    Setelah ditutup tidak muncul lagi sampai pengumumannya diubah (kunci = hash teks + waktu ubah).
    Data: $pengumuman (Pengaturan 'pengumuman' yang sedang aktif).
--}}
@php
    $kunci = 'pengumuman-' . substr(md5(($pengumuman['judul'] ?? '') . '|' . ($pengumuman['teks'] ?? '') . '|' . ($pengumuman['diperbarui'] ?? '')), 0, 12);
@endphp

<dialog id="popup-pengumuman" data-kunci="{{ $kunci }}" aria-labelledby="judul-popup-pengumuman"
        class="m-auto w-[min(32rem,calc(100%-2rem))] max-w-none rounded-2xl bg-transparent p-0 shadow-2xl shadow-navy-950/40 backdrop:bg-navy-950/60 backdrop:backdrop-blur-sm">
    @include('partials.pengumuman-kotak', ['pengumuman' => $pengumuman, 'pratinjau' => false])
</dialog>

<script>
    (function () {
        const popup = document.getElementById('popup-pengumuman');
        if (!popup || typeof popup.showModal !== 'function') return;

        const kunci = popup.dataset.kunci;
        let sudahDitutup = false;
        try { sudahDitutup = localStorage.getItem(kunci) === 'tutup'; } catch (e) {}
        if (sudahDitutup) { popup.remove(); return; }

        const tandai = function () {
            try { localStorage.setItem(kunci, 'tutup'); } catch (e) {}
        };

        popup.addEventListener('close', tandai);
        popup.querySelectorAll('[data-tutup]').forEach(function (tombol) {
            tombol.addEventListener('click', function () { popup.close(); });
        });
        popup.querySelector('[data-tautan]')?.addEventListener('click', tandai);
        // Klik di luar kotak (latar) menutup pop-up
        popup.addEventListener('click', function (e) {
            if (e.target === popup) popup.close();
        });

        popup.showModal();
    })();
</script>
