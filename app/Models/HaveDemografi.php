<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class HaveDemografi extends Model
{
    use HasFactory;

    // protected $primaryKey = ['NIK', 'demografi_id'];
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

    /**
     * Ditambahkan untuk mensuport composite primary key ['NIK', 'demografi_id']
     *
     * @param Builder $query
     * @return Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $query->where('NIK', '=', $this->NIK)
            ->where('demografi_id', '=', $this->demografi_id);

        return $query;
    }

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'NIK', 'NIK');
    }

    public function demografi(): BelongsTo
    {
        return $this->belongsTo(Demografi::class, 'demografi_id', 'demografi_id');
    }
}
