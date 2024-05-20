<?php

namespace App\Models;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $res = Storage::disk('local')->put(
                'public/KK/' . $this->keluarga->image_kk,
                Storage::disk('temp')->get($this->keluarga->image_kk),
            );
            if (!$res) {
                throw new \Exception('Failed to move file from temporary');
            }
            Storage::disk('temp')->delete($this->keluarga->image_kk);
            foreach ($this->daftarWarga as $warga) {
                $warga['warga']->no_kk = $no_kk;
                if (!empty(Warga::find($warga['warga']->NIK))) {
                    WargaModified::updateWarga($warga['warga']);
                } else {
                    $warga['warga']->save();
                    $warga['demografi']->save();
                    $warga['haveDemografi']->demografi_id = $warga['demografi']->demografi_id;
                    $warga['haveDemografi']->save();

                    // Pindahkan file yang berada pada penyimpanan sementara
                    $res = Storage::disk('local')->put(
                        'public/Dokumen-Pendukung/' . $warga['haveDemografi']->dokumen_pendukung,
                        Storage::disk('temp')->get($warga['haveDemografi']->dokumen_pendukung),
                    );
                    if (!$res) {
                        throw new \Exception('Failed to move file from temporary');
                    }
                    Storage::disk('temp')->delete($warga['haveDemografi']->dokumen_pendukung);
                    session()->forget('berkas_demografi');
                }
            }
            PengajuanData::create(
                [
                    'no_kk' => $no_kk,
                    'user_id' => Auth::user()->user_id,
                    'tipe' => 'Pembaruan',
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
            dd($e);         // DELETE THIS ON PROD //
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
    public function removeWarga(string $nik)
    {
        $idx = -1;
        foreach ($this->daftarWarga as $key => $value) {
            if ($value['warga']->NIK == $nik) {
                $idx = $key;
            }
        }
        if (!count($this->daftarWarga) == 0 && $idx != -1) {
            array_splice($this->daftarWarga, $idx, 1);
            $this->save();
        }
    }
    public function getDaftarWarga()
    {
        return $this->daftarWarga;
    }
    public function getDaftarWargaOnly(): Collection|Warga
    {
        $temp = new Collection;
        if ($this->keluarga && Keluarga::find($this->keluarga->no_kk)) {
            foreach (Warga::where('no_kk', '=', $this->keluarga->no_kk)->where('status_warga', '!=', 'Menunggu')->get() as $tempWarga) {
               $temp->push($tempWarga);
            }
        }
        foreach ($this->daftarWarga as $value) {
            $warga = clone $value['warga'];
            $warga->nama .= ' (Baru)';
            $temp->push($warga);
        }
        return $temp;
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
