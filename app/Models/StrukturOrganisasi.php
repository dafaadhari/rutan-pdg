<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Satu jabatan dalam bagan struktur organisasi. parent_id = atasan langsung.
 */
class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasis';

    protected $fillable = ['parent_id', 'jabatan', 'nama', 'nip', 'foto', 'urutan'];

    protected function casts(): array
    {
        return [
            'parent_id' => 'integer',
            'urutan' => 'integer',
        ];
    }

    public function atasan(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function bawahan(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('urutan')->orderBy('id');
    }

    /**
     * Seluruh jabatan tersusun sebagai pohon (satu query). Setiap node memiliki
     * relasi "bawahan" yang sudah terisi; yang dikembalikan adalah akar-akarnya.
     */
    public static function pohon(): Collection
    {
        $semua = static::query()->orderBy('urutan')->orderBy('id')->get();
        $perAtasan = $semua->groupBy(fn ($j) => $j->parent_id ?? 0);

        foreach ($semua as $jabatan) {
            $jabatan->setRelation('bawahan', $perAtasan->get($jabatan->id, new Collection));
        }

        // Jabatan yang atasannya tidak ada (data yatim) diperlakukan sebagai akar
        $ids = $semua->pluck('id')->flip();

        return $semua->filter(fn ($j) => $j->parent_id === null || ! $ids->has($j->parent_id))->values();
    }

    /**
     * Daftar datar berurutan pohon beserta kedalaman, untuk tabel admin & pilihan atasan.
     *
     * @return array<int, array{jabatan: self, kedalaman: int}>
     */
    public static function daftarBertingkat(): array
    {
        $hasil = [];
        $telusuri = function ($nodes, int $kedalaman) use (&$telusuri, &$hasil) {
            foreach ($nodes as $node) {
                $hasil[] = ['jabatan' => $node, 'kedalaman' => $kedalaman];
                $telusuri($node->bawahan, $kedalaman + 1);
            }
        };
        $telusuri(static::pohon(), 0);

        return $hasil;
    }

    /**
     * ID jabatan ini beserta seluruh bawahannya (untuk mencegah atasan melingkar).
     */
    public function idDenganBawahan(): array
    {
        $anak = static::query()->get(['id', 'parent_id'])->groupBy(fn ($j) => $j->parent_id ?? 0);
        $ids = [];
        $antrian = [$this->id];

        while ($antrian) {
            $id = array_shift($antrian);
            $ids[] = $id;
            foreach ($anak->get($id, []) as $bawahan) {
                $antrian[] = $bawahan->id;
            }
        }

        return $ids;
    }

    /**
     * Inisial nama/jabatan untuk avatar cadangan.
     */
    public function getInisialAttribute(): string
    {
        $sumber = $this->nama ?: $this->jabatan;
        $kata = preg_split('/\s+/', trim(preg_replace('/[^\pL\s]/u', ' ', $sumber)));

        return mb_strtoupper(collect($kata)->filter()->take(2)->map(fn ($k) => mb_substr($k, 0, 1))->join(''));
    }
}
