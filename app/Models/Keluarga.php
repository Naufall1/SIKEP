<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = 'keluarga';
    protected $primaryKey = 'no_kk';
    public $timestamps = false;

    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'RT',
        'RW',
        'kode_pos',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'image_kk',
        'tagihan_listrik',
        'luas_bangunan'
    ];

    public function keluargaHistory(): HasMany
    {
        return $this->hasMany(KeluargaHistory::class, 'no_kk', 'no_kk');
    }

    public function keluargaModified(): HasOne
    {
        return $this->hasOne(KeluargaModified::class, 'no_kk', 'no_kk');
    }

    public function detailBansos(): HasMany
    {
        return $this->hasMany(MightGet::class, 'no_kk', 'no_kk');
    }

    public function bansos()
    {
        return $this->belongsToMany(Bansos::class, 'might_gets', 'no_kk', 'bansos_kode');
    }

    public function warga(): HasMany
    {
        return $this->hasMany(Warga::class, 'no_kk', 'no_kk');
    }

    public static function dataBansos()
    {
        return Keluarga::select('keluarga.no_kk', 'keluarga.kepala_keluarga', 'keluarga.tagihan_listrik',
        'keluarga.luas_bangunan')
        ->selectRaw('SUM(warga.penghasilan) as total_penghasilan')
        ->selectRaw('COUNT(DISTINCT warga.NIK) AS jumlah_warga')
        ->selectRaw('COUNT(DISTINCT CASE WHEN warga.penghasilan > 0 THEN warga.NIK END) AS jumlah_warga_berpenghasilan')
        ->selectRaw('SUM(CASE WHEN warga.jenis_pekerjaan = "Pelajar/Mahasiswa" THEN 1 ELSE 0 END) AS jumlah_warga_bersekolah')
        ->selectRaw('COUNT(CASE WHEN warga.jenis_pekerjaan = "Tidak Bekerja" THEN warga.NIK ELSE NULL END) AS tanggungan')
        ->join('warga', 'warga.no_kk', '=', 'keluarga.no_kk')
        ->groupBy('keluarga.no_kk', 'keluarga.kepala_keluarga', 'keluarga.tagihan_listrik', 'keluarga.luas_bangunan')
        ->orderBy('total_penghasilan')
        ->get();
    }
}
