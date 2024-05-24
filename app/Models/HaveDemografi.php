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
            ->where('demografi_id', '=', $this->demografi_id)
            ->where('tanggal_request', '=', $this->tanggal_request);

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

    public static function getMenunggu(string $NIK): HaveDemografi|null
    {
        return HaveDemografi::where('NIK', '=', $NIK)
                ->where('status_request', '=', 'Menunggu')
                ->first();
    }
    /**
     * @param string $nik
     * @param string $status in ['Menunggu', 'Dikonfirmasi]
     */
    public static function getDemografiKeluar(string $nik, string $status, string $tanggal_request = null, string $valid_before = null) : HaveDemografi|null
    {
        $query = HaveDemografi::with('demografi')->join('demografi', 'demografi.demografi_id', '=', 'have_demografi.demografi_id')
                    ->where('NIK', '=', $nik)
                    ->whereIn('demografi.jenis', ['Meninggal', 'Migrasi Keluar']);

        if ($tanggal_request) {
            $query->whereRaw("DATE_FORMAT(`tanggal_request`, '%Y-%m-%d %H:%i') = '" . $tanggal_request . "'");
        }
        if ($valid_before) {
            $query->whereRaw("DATE_FORMAT(`tanggal_request`, '%Y-%m-%d %H:%i') < '" . $valid_before . "'");
        }

        $query->where('status_request','=', $status)->orderBy('tanggal_request', 'DESC');
        return $query->first();
    }
    /**
     * @param string $nik
     * @param string $status in ['Menunggu', 'Dikonfirmasi]
     * @param string|null $tanggal_reqeust (Optional)
     */
    public static function getDemografiMasuk(string $nik, string $status, string $tanggal_request = null, string $valid_before = null) : HaveDemografi|null
    {
        $query = HaveDemografi::with('demografi')->join('demografi', 'demografi.demografi_id', '=', 'have_demografi.demografi_id')
                    ->where('NIK', '=', $nik)
                    ->whereIn('demografi.jenis', ['Lahir', 'Migrasi Masuk']);

        if ($tanggal_request) {
            $query->whereRaw("DATE_FORMAT(`tanggal_request`, '%Y-%m-%d %H:%i') = '" . $tanggal_request . "'");
        }
        if ($valid_before) {
            $query->whereRaw("DATE_FORMAT(`tanggal_request`, '%Y-%m-%d %H:%i') < '" . $valid_before . "'");
        }

        $query->where('status_request','=', $status)->orderBy('tanggal_request', 'DESC');
        return $query->first();
    }
}
