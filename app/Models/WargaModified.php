<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class WargaModified extends Model
{
    use HasFactory;

    protected $table = 'wargaModified';
    protected $primaryKey = 'id_modify_warga';
    public $timestamps = false;
    protected $fillable = [
        'NIK',
        'no_kk',
        'user_id',
        'nama',
        'agama',
        'status_perkawinan',
        'status_keluarga',
        'status_warga',
        'jenis_pekerjaan',
        'penghasilan',
        'pendidikan',
        'no_kitas',
        'no_paspor',
        'tanggal_request',
        'status_request',
    ];

    public static function updateWarga(Warga $warga,$date = null){
        $modif = WargaModified::where('NIK', $warga->NIK)->where('status_request', 'Menunggu')->first();
        if ($modif) {
            $modif->fill($warga->toArray());
            $modif->tanggal_request = $date;
            return $modif->save();
        }
        $modif = new WargaModified();
        $modif->user_id = Auth::user()->user_id;
        $modif->NIK = $warga->NIK;

        $modif->fill($warga->toArray());

        $modif->tanggal_request = $date ?? now();
        $modif->status_request = 'Menunggu';

        $modif->save();
    }

    public static function getMenunggu(string $no_kk, string $tanggal_request): WargaModified|null
    {
        return WargaModified::where('no_kk', '=', $no_kk)
                ->where('tanggal_request', $tanggal_request)
                ->where('status_request', '=', 'Menunggu')
                ->first();
    }

    public function warga():BelongsTo
    {
        return $this->belongsTo(Warga::class, 'NIK', 'NIK');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
