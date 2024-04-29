<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HaveDemografi extends Model
{
    use HasFactory;

    protected $table = 'have_demografi';
    public $timestamps = false;

    protected $fillable = [
        'NIK',
        'demografi_id',
        'tanggal_kejadian',
        'tanggal_request',
        'catatan',
        'dokumen_pendukung',
        'status_request',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'NIK', 'NIK');
    }

    public function demografi(): BelongsTo
    {
        return $this->belongsTo(Demografi::class, 'demografi_id', 'demografi_id');
    }
}
