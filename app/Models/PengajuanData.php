<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanData extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'no_kk',
        'user_id',
        'tanggal_request',
        'tipe',
        'status_request',
        'catatan'
    ];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public static function getById(int $id)
    {
        return PengajuanData::with('keluarga')->find($id);
    }
}
