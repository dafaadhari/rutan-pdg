import { pasangPenandaGulir } from './penanda-gulir';
import { pasangZoomGambar } from './zoom-gambar';

function mulai() {
    pasangPenandaGulir();
    pasangZoomGambar();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mulai);
} else {
    mulai();
}
