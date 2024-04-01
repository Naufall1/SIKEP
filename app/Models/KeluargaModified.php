<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeluargaModified extends Model
{
    use HasFactory;
    protected $table = 'keluargaModified';
    protected $primaryKey = 'id_modify_keluarga';
    public $timestamps = false;

    protected $fillable = [
        'no_kk',
        'user_id',
        'kepala_keluarga',
        'image_kk',
        'tagihan_listrik',
        'tanggal_request',
        'status_request',
    ];

    public function keluarga():BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
