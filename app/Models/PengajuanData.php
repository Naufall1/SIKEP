<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getNext() : PengajuanData|null
    {
        $next = $this->where('tanggal_request', '>', $this->tanggal_request)
                ->orderBy('tanggal_request')
                ->limit(1)
                ->get()[0] ?? null;
        $date= Carbon::parse($this->tanggal_request);
        $date->addDay();

        $temp = clone $this;

        $temp->tanggal_request = $date->toDateTimeString();
        if (!empty($next)) {
            return $next;
        }
        return $temp;
    }
    public function getPrev() : PengajuanData|null
    {
        $prev = $this->where('tanggal_request', '<', $this->tanggal_request)
                ->orderByDesc('tanggal_request')
                ->limit(1)
                ->get()[0] ?? null;

        $date= Carbon::parse($this->tanggal_request);
        $date->subDay();

        $temp = clone $this;

        $temp->tanggal_request = $date->toDateTimeString();
        if (!empty($prev)) {
            return $prev;
        }
        return $temp;
    }

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
