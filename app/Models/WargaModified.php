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

    public static function updateWarga(Warga $warga){
        $modif = new WargaModified();
        $modif->user_id = Auth::user()->user_id;
        $modif->NIK = $warga->isDirty('NIK') ? $warga->NIK : "";
        $modif->no_kk = $warga->isDirty('no_kk') ? $warga->no_kk : "";
        $modif->agama = $warga->isDirty('agama') ? $warga->agama : "";
        $modif->status_perkawinan = $warga->isDirty("status_perkawinan") ? $warga->status_perkawinan : "";
        $modif->status_keluarga = $warga->isDirty('status_keluarga') ? $warga->status_keluarga : "";
        $modif->status_warga = $warga->isDirty('status_warga') ? $warga->status_warga : "";
        $modif->jenis_pekerjaan = $warga->isDirty('jenis_pekerjaan') ? $warga->jenis_pekerjaan : "";
        $modif->penghasilan = $warga->isDirty('penghasilan') ? $warga->penghasilan : "";
        $modif->pendidikan = $warga->isDirty('pendidikan') ? $warga->pendidikan : "";
        $modif->tanggal_request = now();
        $modif->status_request = 'Menunggu';
        $modif->save();
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
