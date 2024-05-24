<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WargaHistory extends Model
{
    use HasFactory;

    protected $table = 'wargaHistory';
    protected $primaryKey = 'id_history_warga';
    public $timestamps = false;

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
        'valid_from',
        'valid_to',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'NIK', 'NIK');
    }

    public static function track(Warga $warga): void
    {
        // cari tanggal terakhir data warga tertentu dirubah
        $last_data = WargaHistory::where('NIK', '=', $warga->NIK)
            ->orderBy('id_history_warga', 'desc')
            ->first();

        if ($last_data) {
            $valid_from = $last_data->valid_to;
        }

        // jika tidak ada data, maka valid_from adalah tanggal dibuat
        if (is_null($last_data)) {
            $valid_from = $warga->created_at;
        }

        WargaHistory::create([
            'NIK' => $warga->NIK,
            'no_kk' => $warga->no_kk,
            'nama' => $warga->nama,
            'tempat_lahir' => $warga->tempat_lahir,
            'tanggal_lahir' => $warga->tanggal_lahir,
            'jenis_kelamin' => $warga->jenis_kelamin,
            'agama' => $warga->agama,
            'status_perkawinan' => $warga->status_perkawinan,
            'status_keluarga' => $warga->status_keluarga,
            'status_warga' => $warga->status_warga,
            'jenis_pekerjaan' => $warga->jenis_pekerjaan,
            'penghasilan' => $warga->penghasilan,
            'kewarganegaraan' => $warga->kewarganegaraan,
            'pendidikan' => $warga->pendidikan,
            'no_paspor' => $warga->no_paspor,
            'no_kitas' => $warga->no_kitas,
            'nama_ayah' => $warga->nama_ayah,
            'nama_ibu' => $warga->nama_ibu,
            'valid_from' => $valid_from,
            'valid_to' => now()
        ]);
    }
}
