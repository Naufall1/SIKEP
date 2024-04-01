<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WargaModified extends Model
{
    use HasFactory;

    protected $table = 'wargaModified';
    protected $primaryKey = 'id_modify_warga';
    public $timestamps = false;
    protected $fillable = [
        'NIK',
        'user_id',
        'agama',
        'status_perkawinan',
        'status_keluarga',
        'status_warga',
        'jenis_pekerjaan',
        'penghasilan',
        'pendidikan',
        'tanggal_request',
        'status_request',
    ];

    public function warga():BelongsTo
    {
        return $this->belongsTo(Warga::class, 'NIK', 'NIK');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
