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
}
