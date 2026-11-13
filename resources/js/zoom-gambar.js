/**
 * Lightbox gambar yang bisa diperbesar (dipakai foto Maklumat Pelayanan).
 * Pemicu: <button data-zoom="url-gambar" data-zoom-alt="teks alternatif">.
 * Kontrol: tombol +/−/reset, roda mouse, klik ganda, geser (drag), cubit (2 jari),
 * keyboard (+, −, 0, Esc).
 */
const MIN = 1;
const MAKS = 6;

export function pasangZoomGambar() {
    const pemicu = document.querySelectorAll('[data-zoom]');
    if (!pemicu.length) return;

    let dialog, wadah, gambar, label;
    let skala = 1;
    let x = 0;
    let y = 0;

    const penunjuk = new Map();
    let cubit = null; // { jarak, skala }
    let geser = null; // { px, py, x, y }

    const tombol = (aksi, labelAria, isi) =>
        `<button type="button" data-aksi="${aksi}" aria-label="${labelAria}" title="${labelAria}"
            class="flex h-10 w-10 items-center justify-center rounded-lg text-white/90 transition hover:bg-white/15 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-400">${isi}</button>`;
    const ikon = (d) =>
        `<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="${d}"/></svg>`;

    function bangun() {
        dialog = document.createElement('dialog');
        dialog.setAttribute('aria-label', 'Pratinjau gambar');
        dialog.className = 'm-0 h-dvh max-h-none w-screen max-w-none bg-transparent p-0 backdrop:bg-navy-950/95';
        dialog.innerHTML = `
            <div class="flex h-full flex-col">
                <div class="flex shrink-0 items-center justify-between gap-3 px-3 py-3 sm:px-5">
                    <p class="truncate text-sm font-semibold text-white" data-judul></p>
                    <div class="flex items-center gap-1 rounded-xl bg-white/10 p-1 backdrop-blur">
                        ${tombol('kecil', 'Perkecil', ikon('M20 12H4'))}
                        <span class="w-14 text-center text-xs font-semibold tabular-nums text-white" data-label>100%</span>
                        ${tombol('besar', 'Perbesar', ikon('M12 4v16m8-8H4'))}
                        ${tombol('reset', 'Ukuran semula', ikon('M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'))}
                        <span class="mx-1 h-6 w-px bg-white/20" aria-hidden="true"></span>
                        ${tombol('tutup', 'Tutup', ikon('M6 18L18 6M6 6l12 12'))}
                    </div>
                </div>
                <div class="relative flex min-h-0 flex-1 touch-none select-none items-center justify-center overflow-hidden" data-wadah>
                    <img alt="" draggable="false" class="max-h-full max-w-full origin-center object-contain will-change-transform" data-gambar>
                </div>
                <p class="shrink-0 px-4 py-3 text-center text-xs text-white/60">Gulir, cubit, atau klik dua kali untuk memperbesar · seret untuk menggeser</p>
            </div>`;
        document.body.appendChild(dialog);

        wadah = dialog.querySelector('[data-wadah]');
        gambar = dialog.querySelector('[data-gambar]');
        label = dialog.querySelector('[data-label]');

        dialog.addEventListener('click', (e) => {
            const aksi = e.target.closest('[data-aksi]')?.dataset.aksi;
            if (aksi === 'besar') zoomKe(skala * 1.5);
            if (aksi === 'kecil') zoomKe(skala / 1.5);
            if (aksi === 'reset') zoomKe(1);
            if (aksi === 'tutup') dialog.close();
        });

        dialog.addEventListener('keydown', (e) => {
            if (e.key === '+' || e.key === '=') zoomKe(skala * 1.5);
            else if (e.key === '-' || e.key === '_') zoomKe(skala / 1.5);
            else if (e.key === '0') zoomKe(1);
        });

        dialog.addEventListener('close', () => {
            document.documentElement.style.overflow = '';
            penunjuk.clear();
            cubit = geser = null;
        });

        wadah.addEventListener('wheel', (e) => {
            e.preventDefault();
            const p = titik(e);
            zoomKe(skala * Math.exp(-e.deltaY * 0.0015), p.x, p.y);
        }, { passive: false });

        wadah.addEventListener('dblclick', (e) => {
            const p = titik(e);
            zoomKe(skala > 1 ? 1 : 2.5, p.x, p.y);
        });

        wadah.addEventListener('pointerdown', (e) => {
            wadah.setPointerCapture(e.pointerId);
            penunjuk.set(e.pointerId, { x: e.clientX, y: e.clientY });
            mulaiGerak();
        });

        wadah.addEventListener('pointermove', (e) => {
            if (!penunjuk.has(e.pointerId)) return;
            penunjuk.set(e.pointerId, { x: e.clientX, y: e.clientY });

            if (penunjuk.size === 2 && cubit) {
                const [a, b] = [...penunjuk.values()];
                const tengah = titik({ clientX: (a.x + b.x) / 2, clientY: (a.y + b.y) / 2 });
                zoomKe(cubit.skala * (jarak(a, b) / cubit.jarak), tengah.x, tengah.y);
            } else if (geser && skala > 1) {
                x = geser.x + (e.clientX - geser.px);
                y = geser.y + (e.clientY - geser.py);
                batasi();
                terapkan();
            }
        });

        const lepas = (e) => {
            penunjuk.delete(e.pointerId);
            mulaiGerak();
        };
        wadah.addEventListener('pointerup', lepas);
        wadah.addEventListener('pointercancel', lepas);
    }

    function mulaiGerak() {
        const nilai = [...penunjuk.values()];
        cubit = nilai.length === 2 ? { jarak: jarak(nilai[0], nilai[1]), skala } : null;
        geser = nilai.length === 1 ? { px: nilai[0].x, py: nilai[0].y, x, y } : null;
        wadah.classList.toggle('cursor-grabbing', nilai.length > 0 && skala > 1);
    }

    const jarak = (a, b) => Math.hypot(a.x - b.x, a.y - b.y) || 1;

    // Koordinat relatif terhadap titik tengah wadah
    function titik(e) {
        const r = wadah.getBoundingClientRect();
        return { x: e.clientX - (r.left + r.width / 2), y: e.clientY - (r.top + r.height / 2) };
    }

    function zoomKe(skalaBaru, px = 0, py = 0) {
        const s = Math.min(MAKS, Math.max(MIN, skalaBaru));
        x = px - (px - x) * (s / skala);
        y = py - (py - y) * (s / skala);
        skala = s;
        if (skala === MIN) x = y = 0;
        batasi();
        terapkan();
    }

    // Jangan biarkan gambar tergeser keluar dari layar
    function batasi() {
        const r = wadah.getBoundingClientRect();
        const maksX = Math.max(0, (gambar.offsetWidth * skala - r.width) / 2);
        const maksY = Math.max(0, (gambar.offsetHeight * skala - r.height) / 2);
        x = Math.min(maksX, Math.max(-maksX, x));
        y = Math.min(maksY, Math.max(-maksY, y));
    }

    function terapkan() {
        gambar.style.transform = `translate(${x}px, ${y}px) scale(${skala})`;
        label.textContent = `${Math.round(skala * 100)}%`;
        wadah.classList.toggle('cursor-grab', skala > 1);
    }

    function buka(src, alt) {
        if (!dialog) bangun();
        skala = 1;
        x = y = 0;
        gambar.src = src;
        gambar.alt = alt;
        dialog.querySelector('[data-judul]').textContent = alt;
        terapkan();
        document.documentElement.style.overflow = 'hidden';
        dialog.showModal();
    }

    pemicu.forEach((el) => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            buka(el.dataset.zoom, el.dataset.zoomAlt || 'Gambar');
        });
    });
}
