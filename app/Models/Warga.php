<?php

namespace App\Models;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warga extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'warga';
    protected $primaryKey = 'NIK';

    protected $fillable = [
        'NIK',
        'no_kk',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'status_keluarga',
        'status_warga',
        'jenis_pekerjaan',
        'penghasilan',
        'kewarganegaraan',
        'pendidikan',
        'no_paspor',
        'no_kitas',
        'nama_ayah',
        'nama_ibu',
    ];

    public function storeTemp() {
        if (session()->has('daftar_warga')) {
            $daftarWarga = session()->get('daftar_warga');
        } else {
            $daftarWarga = [];
        }

        $daftarWarga[] = $this;
        // dd($daftarWarga);

        session()->put('daftar_warga', $daftarWarga);
        session()->save();
        return ;
    }
    public static function getTempWarga(): array | Warga | null {
        if (empty(session()->get('daftar_warga'))) {
            return [];
        }
        return session()->get('daftar_warga');
    }
    public static function saveTemp(Keluarga $keluarga){
        // dd($keluarga);
        $daftarWarga = session()->get('daftar_warga');
        foreach ($daftarWarga as $warga) {
            $warga->no_kk = $keluarga->no_kk;
            if (!empty(Warga::find($warga->nik))) {
                WargaModified::updateWarga($warga);
            } else {
                $warga->save();
            }
        }
        session()->forget('daftar_warga');
        session()->save();
    }
    public function keluarga():BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }
    public function haveDemografi():HasMany
    {
        return $this->hasMany(HaveDemografi::class, 'NIK', 'NIK');
    }
}
