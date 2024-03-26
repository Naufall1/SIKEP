<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeluargaHistory extends Model
{
    use HasFactory;
    protected $table = 'keluargahistory';
    protected $primaryKey = 'id_history_keluarga';
    public $incrementing = true;
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
        'luas_bangunan',
        'valid_from',
        'valid_to',
    ];

    public function keluarga():BelongsTo
    {
        return $this->belongsTo(KeluargaModel::class, 'no_kk', 'no_kk');
    }
}
