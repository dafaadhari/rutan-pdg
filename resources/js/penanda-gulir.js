/**
 * Penanda gulir (scroll spy) untuk halaman satu-halaman per kategori.
 * - Seksi: elemen [data-seksi] ber-id slug.
 * - Penanda: elemen [data-penanda="slug"] (daftar isi, bar chip HP, dropdown navbar)
 *   mendapat atribut data-aktif + aria-current saat seksinya sedang dibaca.
 */
export function pasangPenandaGulir() {
    const seksi = Array.from(document.querySelectorAll('[data-seksi]'));
    if (!seksi.length) return;

    const penanda = Array.from(document.querySelectorAll('[data-penanda]'));
    const barChip = document.querySelector('[data-chip-bar]');
    const header = document.querySelector('[data-header-sticky]');
    let aktif = null;

    // Batas atas area baca = tinggi header sticky (+ bar chip bila tampil) + sedikit ruang.
    // Minimal setara scroll-margin seksi, supaya seksi yang dituju lewat tautan langsung ditandai.
    const batasAtas = (s) => Math.max(
        (header ? header.offsetHeight : 72) + (barChip && barChip.offsetParent ? barChip.offsetHeight : 0) + 24,
        (parseFloat(getComputedStyle(s).scrollMarginTop) || 0) + 8,
    );

    function tentukan() {
        let id = seksi[0].id;

        for (const s of seksi) {
            if (s.getBoundingClientRect().top - batasAtas(s) <= 0) id = s.id;
        }

        // Di dasar halaman, seksi terakhir yang pendek tetap bisa ditandai
        const diDasar = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 4;
        if (diDasar && window.scrollY > 0) id = seksi[seksi.length - 1].id;

        if (id === aktif) return;
        aktif = id;

        for (const el of penanda) {
            const cocok = el.dataset.penanda === id;
            el.toggleAttribute('data-aktif', cocok);
            if (cocok) el.setAttribute('aria-current', 'location');
            else el.removeAttribute('aria-current');
        }

        // Geser bar chip agar chip aktif terlihat (tanpa menggulir halaman)
        const chip = barChip?.querySelector(`[data-penanda="${CSS.escape(id)}"]`);
        if (chip && barChip.offsetParent) {
            barChip.scrollTo({ left: chip.offsetLeft - (barChip.clientWidth - chip.offsetWidth) / 2, behavior: 'smooth' });
        }
    }

    let antre = false;
    window.addEventListener('scroll', () => {
        if (antre) return;
        antre = true;
        requestAnimationFrame(() => {
            antre = false;
            tentukan();
        });
    }, { passive: true });
    window.addEventListener('resize', tentukan);
    window.addEventListener('hashchange', tentukan);
    tentukan();
}
