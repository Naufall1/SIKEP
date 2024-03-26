<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KeluargaModel extends Model
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
    public function keluargaHistory():HasMany // isok akeh soale iso due histori lg dan lg anjayyy
    {
        return $this->hasMany(KeluargaHistory::class, 'no_kk', 'no_kk');
    }

    public function keluargaModified():HasOne // mek siji soale keluarga sg isok d edit iku mek siji slebew
    {
        return $this->hasOne(KeluargaModifiedModel::class, 'no_kk', 'no_kk');
    }
}
