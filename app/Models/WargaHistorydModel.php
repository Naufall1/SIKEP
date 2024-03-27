<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WargaHistory extends Model
{
    use HasFactory;

    protected $table = 'wargaHistory';
    protected $primaryKey = 'id_history_warga';
    public $timestamps = false;

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
        'valid_from',
        'valid_to',
    ];


    public function warga():BelongsTo
    {
        return $this->belongsTo(Warga::class, 'NIK', 'NIK');
    }
}
