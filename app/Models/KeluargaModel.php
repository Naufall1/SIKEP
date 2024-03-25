<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
