<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeluargaHistory extends Model
{
    use HasFactory;
    protected $table = 'keluargahistory';
    protected $primaryKey = 'id_history_keluarga';
    public $timestamps = false;

    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'RT',
        'RW',
        'kode_pos',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'image_kk',
        'tagihan_listrik',
        'luas_bangunan',
        'valid_from',
        'valid_to',
    ];

    public function keluarga():BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }
    public static function track(Keluarga $keluarga): void
    {
        // cari tanggal terakhir data warga tertentu dirubah
        $valid_from = KeluargaHistory::where('no_kk', '=', $keluarga)
            ->orderBy('id_history_keluarga', 'desc')
            ->first();

        if ($valid_from) {
            $valid_from = $valid_from->value('valid_to');
        }

        // jika tidak ada data, maka valid_from adalah tanggal dibuat
        if (is_null($valid_from)) {
            $valid_from = $keluarga->created_at;
            // $valid_from = null;
        }

        KeluargaHistory::create([
            'no_kk' => $keluarga->no_kk,
            'kepala_keluarga' => $keluarga->kepala_keluarga,
            'alamat' => $keluarga->alamat,
            'RT' => $keluarga->RT,
            'RW' => $keluarga->RW,
            'kode_pos' => $keluarga->kode_pos,
            'kelurahan' => $keluarga->kelurahan,
            'kecamatan' => $keluarga->kecamatan,
            'kota' => $keluarga->kota,
            'provinsi' => $keluarga->provinsi,
            'image_kk' => $keluarga->image_kk,
            'tagihan_listrik' => $keluarga->tagihan_listrik,
            'luas_bangunan' => $keluarga->luas_bangunan,
            'valid_from' => $valid_from,
            'valid_to' => now()
        ]);
    }
}
