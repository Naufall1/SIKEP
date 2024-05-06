<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demografi extends Model
{
    use HasFactory;

    protected $table = 'demografi';
    protected $primaryKey = 'demografi_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'jenis',
    ];

    public static function getDataUsia($keterangan) {
        $data = [];

        $dataUsia = Warga::selectRaw('
                CASE
                    WHEN (YEAR(NOW()) - YEAR(tanggal_lahir)) BETWEEN 0 AND 8 THEN "0-8"
                    WHEN (YEAR(NOW()) - YEAR(tanggal_lahir)) BETWEEN 9 AND 16 THEN "9-16"
                    WHEN (YEAR(NOW()) - YEAR(tanggal_lahir)) BETWEEN 17 AND 24 THEN "17-24"
                    WHEN (YEAR(NOW()) - YEAR(tanggal_lahir)) BETWEEN 25 AND 32 THEN "25-32"
                    WHEN (YEAR(NOW()) - YEAR(tanggal_lahir)) BETWEEN 33 AND 40 THEN "33-40"
                    WHEN (YEAR(NOW()) - YEAR(tanggal_lahir)) BETWEEN 41 AND 48 THEN "41-48"
                    WHEN (YEAR(NOW()) - YEAR(tanggal_lahir)) BETWEEN 49 AND 56 THEN "49-56"
                    WHEN (YEAR(NOW()) - YEAR(tanggal_lahir)) BETWEEN 57 AND 64 THEN "57-64"
                END AS rentang_usia')
            ->selectRaw('COUNT(*) AS jumlah_penduduk')
            ->join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->join('user', 'keluarga.RT', '=', 'user.keterangan')
            ->groupBy('rentang_usia');

        if ($keterangan !== 'ketua') {
            $result = $dataUsia->where('user.keterangan', '=', $keterangan);
        }

        $result = $dataUsia->get();
        $count = $result->sum('jumlah_penduduk');

        foreach ($result as $row) {
            $persentase = ($count != 0) ? ($row->jumlah_penduduk / $count) * 100 : 0;
            $data[] = [
                'rentang_usia' => $row->rentang_usia,
                'jumlah_penduduk' => $row->jumlah_penduduk,
                'persentase' => round($persentase, 1)
            ];
        }

        return $data;
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
