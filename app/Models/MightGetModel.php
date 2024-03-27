<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MightGet extends Model
{
    use HasFactory;
    protected $table = 'might_get';
    public $timestamps = false;

    protected $fillable = [
        'no_kk',
        'bansos_kode',
        'tanggal_menerima',
    ];


    public function keluarga():BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }

    public function bansos():BelongsTo
    {
        return $this->belongsTo(BansosModel::class, 'bansos_kode', 'bansos_kode');
    }
}
