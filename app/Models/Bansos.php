<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Bansos extends Model
{
    use HasFactory;
    protected $table = 'bansos';
    public $timestamps = false;
    protected $primaryKey = 'bansos_kode';

    protected $fillable = [
        'bansos_kode',
        'bansos_nama',
        'keterangan',
    ];
    public static function getFromKK(string $no_kk)
    {
        $bansos = DB::table('bansos')->join('might_get as mg', 'mg.bansos_kode', '=', 'bansos.bansos_kode')->where('mg.no_kk', '=', $no_kk);
        return $bansos->get();
    }
    public function detail():HasMany
    {
        return $this->hasMany(MightGet::class, 'bansos_kode', 'bansos_kode');
    }
    public function keluarga()
    {
        return $this->belongsToMany(Keluarga::class, 'might_gets', 'bansos_kode', 'no_kk');
    }
}
