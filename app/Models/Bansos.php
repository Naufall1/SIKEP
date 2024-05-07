<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Bansos extends Model
{
    use HasFactory;
    protected $table = 'bansos';
    public $timestamps = false;
    protected $primaryKey = 'bansos_kode';

    protected $fillable = [
        'bansos_kode',
        'bansos_nama',
        'keterangan',
    ];

    public static function getDataBansos($keterangan) {
        $data = [];

        $dataBansos = MightGet::selectRaw('bansos_nama,
                                           COUNT(*) AS jumlah_penerima')
                        ->join('keluarga', 'might_get.no_kk', '=', 'keluarga.no_kk')
                        ->join('bansos', 'might_get.bansos_kode', '=', 'bansos.bansos_kode')
                        ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                        ->groupByRaw('bansos_nama');

        if ($keterangan !== 'ketua') {
            $result = $dataBansos->where('keluarga.RT', '=', $keterangan)->get();
        } else {
            $result = $dataBansos->get();
        }

        $count = $result->sum('jumlah_penerima');

        foreach ($result as $row) {
            $bulan = strftime('%B', mktime(0, 0, 0, $row->bulan, 1));
            $persentase = ($count != 0) ? ($row->jumlah_penerima / $count) * 100 : 0;
            $data[] = [
                // 'tahun' => $row->tahun,
                // 'bulan' => $bulan,
                'bansos' => $row->bansos_nama,
                'jumlah' => $row->jumlah_penerima,
                'persentase' => round($persentase, 1)
            ];
        }

        return $data;
    }

    public static function getDataBansosByMonth($keterangan) {
        $data = [];

        $dataBansos = MightGet::selectRaw('YEAR(tanggal_menerima) AS tahun,
                                           MONTH(tanggal_menerima) AS bulan,
                                           COUNT(*) AS jumlah_penerima')
                        ->join('keluarga', 'might_get.no_kk', '=', 'keluarga.no_kk')
                        ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                        ->orderByDesc('tahun')
                        ->orderBy('bulan')
                        ->groupByRaw('YEAR(tanggal_menerima), MONTH(tanggal_menerima)');

        if ($keterangan !== 'ketua') {
            $result = $dataBansos->where('keluarga.RT', '=', $keterangan)->get();
        } else {
            $result = $dataBansos->limit(6)->get();
        }

        $count = $result->sum('jumlah_penerima');

        foreach ($result as $row) {
            $bulan = strftime('%B', mktime(0, 0, 0, $row->bulan, 1));
            $persentase = ($count != 0) ? ($row->jumlah_penerima / $count) * 100 : 0;
            $data[] = [
                'tahun' => $row->tahun,
                'bulan' => $bulan,
                'jumlah' => $row->jumlah_penerima,
                'persentase' => round($persentase, 1)
            ];
        }

        return $data;
    }


    public function mightGets():HasMany
    {
        return $this->hasMany(MightGet::class, 'bansos_kode', 'bansos_kode');
    }
    public function keluarga()
    {
        return $this->belongsToMany(Keluarga::class, 'might_gets', 'bansos_kode', 'no_kk');
    }
}
