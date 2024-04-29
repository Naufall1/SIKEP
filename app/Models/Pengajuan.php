<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @var Keluarga $keluaga
 * @var array(
 *      ['warga' => Warga,
 *       'demografi' => Demografi,
 *       'haveDemografi' => HaveDemografi
 *      ],
 *      ...) $daftarKeluarga
 */
class Pengajuan
{
    use HasFactory;
    public ?Keluarga $keluarga;
    protected array $daftarWarga = [];

    function __construct()
    {
        if (session()->has('pengajuan')) {
            $this->keluarga = session()->get('pengajuan')['keluarga'];
            $this->daftarWarga = session()->get('pengajuan')['daftarWarga'];
        } else {
            $this->keluarga = FormStateKeluarga::getKeluarga();
            session()->put('pengajuan', ['keluarga' => $this->keluarga, 'daftarWarga' => $this->daftarWarga]);
            session()->save();
        }
    }
    public function store():bool
    {
        try {
            DB::beginTransaction();
            $no_kk = $this->keluarga->no_kk;
            $this->keluarga->save();
            foreach ($this->daftarWarga as $warga) {
                $warga['warga']->no_kk = $no_kk;
                if (!empty(Warga::find($warga['warga']->NIK))) {
                    WargaModified::updateWarga($warga['warga']);
                } else {
                    $warga['warga']->save();
                    $warga['demografi']->save();
                    $warga['haveDemografi']->demografi_id = $warga['demografi']->demografi_id;
                    $warga['haveDemografi']->save();
                }
            }
            PengajuanData::create(
                [
                    'no_kk' => $no_kk,
                    'user_id' => Auth::user()->user_id,
                    'tanggal_request' => now(),
                    'status_request' => 'Menunggu'
                ]
            );
            $this->clear();
            FormStateKeluarga::clear();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return false;
        }
    }
    public function tambahWarga(Warga $warga, Demografi $demografi, HaveDemografi $haveDemografi)
    {
        $this->daftarWarga[] = [
            'warga' => $warga,
            'demografi' => $demografi,
            'haveDemografi' => $haveDemografi
        ];
        // dd($this->daftarWarga);
        $this->save();
    }
    public function pindahKK(Warga $warga)
    {
        $warga->no_kk = $this->keluarga->no_kk;
        $this->daftarWarga[] = [
            'warga' => $warga,
            'demografi' => null,
            'haveDemografi' => null
        ];
        $this->save();
    }
    public function removeWarga(int $idx)
    {
        if (!count($this->daftarWarga) == 0) {
            array_splice($this->daftarWarga, $idx, 1);
            $this->save();
        }
    }
    public function getDaftarWarga()
    {
        return $this->daftarWarga;
    }
    private function save()
    {
        session()->put('pengajuan', ['keluarga' => $this->keluarga, 'daftarWarga' => $this->daftarWarga]);
        session()->save();
    }
    private function clear()
    {
        $this->keluarga = null;
        $this->daftarWarga = [];
        session()->forget('pengajuan');
        session()->save();
    }

}
