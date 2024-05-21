<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\Demografi;
use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Warga;
use App\Models\WargaModified;
use Illuminate\Console\View\Components\Warn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index(){
        if (!Auth::check()) {
            return $this->dashboardGuest();
        }
        switch (Auth::user()->hasLevel['level_kode']) {
            case 'RW':
                return $this->dashboardRW();
            case 'RT':
                return $this->dashboardRT((int)Auth::user()->keterangan);
            case 'ADM':
                return $this->dashboardADM();
            default:
                break;
        }
    }

    private function dashboardRW() {
        $data = $this->getData(Auth::user()->keterangan);
        return view('dashboard.index', $data, ['title' => 'RW', 'text' => 'Ketua RW']);
    }

    private function dashboardRT(int $rt) {
        $data = $this->getData($rt);
        return view('dashboard.index', $data, ['title' => 'RT', 'text' => 'Ketua RT']);
    }

    private function dashboardADM() {
        return view('dashboard.index', ['title' => 'Admin', 'text' => 'Admin']);
    }

    private function dashboardGuest() {
        return view('landing.index', ['title' => 'Umum', 'text' => 'Warga']);
    }

    private function getData($keterangan) {
        $dataPekerjaan = Warga::getDataPekerjaan($keterangan);
        $dataJenisKelamin = Warga::getDataJenisKelamin($keterangan);
        $dataAgama = Warga::getDataAgama($keterangan);
        $dataTingkatPendidikan = Warga::getDataTingkatPendidikan($keterangan);
        $dataBansos = Bansos::getDataBansos($keterangan);
        $dataBansosByMonth = Bansos::getDataBansosByMonth($keterangan);
        $dataUsia = Demografi::getDataUsia($keterangan);
        $semuaRT = Warga::rightJoin('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->rightJoin('user', 'keluarga.RT', '=', 'user.keterangan')
            ->select('user.keterangan')
            ->distinct()
            ->whereNotIn('keterangan', function($query) {
                $query->select('keterangan')
                    ->from('user')
                    ->where('keterangan', 'like', 'admin%')
                    ->orWhere('keterangan', 'ketua');
            })
            ->get();

        if ($keterangan !== 'ketua') {
            $countPenduduk = Keluarga::join('user as u', 'keluarga.RT', '=', 'u.keterangan')
                            ->join('warga as w', 'keluarga.no_kk', '=', 'w.no_kk')
                            ->where('keluarga.RT', $keterangan)
                            ->count('w.no_kk');
            $countKeluarga = Keluarga::join('user as u', 'keluarga.RT', '=', 'u.keterangan')
                            ->where('keluarga.RT', $keterangan)
                            ->count();
            $countPengajuan = HaveDemografi::count() + KeluargaModified::count() + WargaModified::count();

        } else {
            $countPenduduk = Warga::where('status_warga', '!=', 'Menunggu')->count();
            $countKeluarga = Keluarga::where('status', '=', 'Aktif')->count();
            $countPengajuan = HaveDemografi::count() + KeluargaModified::count() + WargaModified::count();
        }

        return compact('dataPekerjaan', 'dataJenisKelamin', 'dataAgama', 'dataTingkatPendidikan', 'dataBansos', 'dataBansosByMonth', 'dataUsia', 'semuaRT',
            'countPengajuan', 'countKeluarga', 'countPenduduk');
    }

}
