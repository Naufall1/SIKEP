<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

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
        'luas_bangunan',
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

    /**
     * @param Keluarga $keluarga
     * @return bool
     */
    public static function updateKeluarga(Keluarga $keluarga)
    {
        $modif = new KeluargaModified();
        $modif->fill($keluarga->toArray());
        // $modif->no_kk = $keluarga->no_kk;
        $modif->user_id = Auth::user()->user_id;

        $modif->tanggal_request = now();
        $modif->status_request = 'Menunggu';
        return $modif->save();
    }

    public static function getByDate(string $no_kk, string $tanggal_request): KeluargaModified|null
    {
        return KeluargaModified::where('no_kk', '=', $no_kk)
                    ->where('tanggal_request', '=', $tanggal_request)
                    ->where('status_request', '=', 'Menunggu')
                    ->first();
    }
}
