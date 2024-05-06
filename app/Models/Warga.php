<?php

namespace App\Models;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warga extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'warga';
    protected $primaryKey = 'NIK';

    protected $fillable = [
        'NIK',
        'no_kk',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'status_keluarga',
        'status_warga',
        'jenis_pekerjaan',
        'penghasilan',
        'kewarganegaraan',
        'pendidikan',
        'no_paspor',
        'no_kitas',
        'nama_ayah',
        'nama_ibu',
    ];
    protected $casts = [
        'NIK' => 'string'
    ];

    public static function applyModifications(WargaModified $wargaModified)
    {
        $warga = Warga::find($wargaModified->NIK);
        $warga->fill($wargaModified->toArray());
        $warga->save();
        $wargaModified->status_request = 'Dikonfirmasi';
    }

    // buat chart
    public static function getDataAgama($keterangan): array
    {
        $data = [];
        $daftarAgama = ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Khonghucu'];

        foreach ($daftarAgama as $agama) {
            $query = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
                ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                ->where('warga.agama', $agama);

            if ($keterangan !== 'ketua') {
                $count = $query->where('keluarga.RT', $keterangan)->count();
                $total = keluarga::join('warga', 'keluarga.no_kk', '=', 'warga.no_kk')
                ->where('keluarga.RT', '=' , $keterangan)->count();

            } else{
                $count = $query->count();
                $total= Warga::count();
            }

            $persentase = ($total > 0) ? ($count / $total) * 100 : 0;

            $data[] = [
                'agama' => $agama,
                'jumlah' => $count,
                'persentase' => round($persentase, 1)

            ];
        }

        return $data;
    }
    public static function getDataTingkatPendidikan($keterangan): array
{
    $data = [];
    $tingkatPendidikan = Warga::distinct()->pluck('pendidikan');

    foreach ($tingkatPendidikan as $tingkat) {
        $query = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->join('user', 'keluarga.RT', '=', 'user.keterangan')
            ->where('warga.pendidikan', $tingkat);

        if ($keterangan !== 'ketua') {
            $count = $query->where('keluarga.RT', $keterangan)->count();
            $total = keluarga::join('warga', 'keluarga.no_kk', '=', 'warga.no_kk')
            ->where('keluarga.RT', '=' , $keterangan)->count();

        } else{
            $count = $query->count();
            $total= Warga::count();
        }

        $count = $query->count();
        $persentase = ($total > 0) ? ($count / $total) * 100 : 0;

        $data[] = [
            'pendidikan' => $tingkat,
            'jumlah' => $count, // barchart
            'persentase' => round($persentase, 1)
        ];
    }

    return $data;
}

    public static function getDataPekerjaan($keterangan): array
{
    $data = [];
    $jenisPekerjaan = Warga::distinct()->pluck('jenis_pekerjaan');

    foreach ($jenisPekerjaan as $jenis) {
        $query = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
                            ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                            ->where('warga.jenis_pekerjaan',$jenis);

        if ($keterangan !== 'ketua') {
            $count = $query->where('keluarga.RT', $keterangan)->count();
            $total = keluarga::join('warga', 'keluarga.no_kk', '=', 'warga.no_kk')
            ->where('keluarga.RT', '=' , $keterangan)->count();

        } else{
            $count = $query->count();
            $total= Warga::count();
        }

        $count = $query->count();
        $persentase = ($total > 0) ? ($count / $total) * 100 : 0;
        $data[] = [
            'jenis_pekerjaan' => $jenis,
            'total' => $count, // barchart
            'persentase' => round($persentase, 1)
        ];
    }

    return $data;
}


    public static function getDataJenisKelamin($keterangan): array
    {
        $data = [];

        $dataJenisKelamin = Warga::distinct()->pluck('jenis_kelamin');

        foreach ($dataJenisKelamin as $jenis) {
            $query = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
                        ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                        ->where('warga.jenis_kelamin', $jenis);

            if ($keterangan !== 'ketua') {
                $count = $query->where('keluarga.RT', $keterangan)->count();
                $total = keluarga::join('warga', 'keluarga.no_kk', '=', 'warga.no_kk')
                ->where('keluarga.RT', '=' , $keterangan)->count();

            } else{
                $count = $query->count();
                $total= Warga::count();
            }

            $count = $query->count();
            $persentase = ($total > 0) ? ($count / $total) * 100 : 0;

            $data[] = [
                'jenis_kelamin' => $jenis,
                'jumlah' => $count,
                'persentase' => round($persentase, 1)
            ];
        }

        return $data;
    }


        // end of buat chart

    public function keluarga():BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }
    public function haveDemografi():HasMany
    {
        return $this->hasMany(HaveDemografi::class, 'NIK', 'NIK');
    }
}
