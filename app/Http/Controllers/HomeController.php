<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\Demografi;
use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Warga;
use App\Models\WargaModified;
use Illuminate\Support\Facades\Auth;


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

        // chart test
        $dataPekerjaan = Warga::getDataPekerjaan(Auth::user()->keterangan);
        $dataJenisKelamin = Warga::getDataJenisKelamin(Auth::user()->keterangan);
        $dataAgama = Warga::getDataAgama(Auth::user()->keterangan);
        $dataTingkatPendidikan = Warga::getDataTingkatPendidikan(Auth::user()->keterangan);
        $dataBansos = Bansos::getDataBansos(Auth::user()->keterangan);
        $dataUsia = Demografi::getDataUsia(Auth::user()->keterangan);

        //end chart

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

        $countPenduduk = Warga::count();
        $countKeluarga = Keluarga::count();
        $countPengajuan = HaveDemografi::count() + KeluargaModified::count() + WargaModified::count();

        return view('dashboard.index', compact('dataPekerjaan', 'dataJenisKelamin', 'dataAgama', 'dataTingkatPendidikan', 'dataBansos', 'dataUsia', 'semuaRT',
         'countPengajuan', 'countKeluarga', 'countPenduduk'), ['title' => 'RT', 'text' => 'Ketua RT']); // jenis kelamin blom


        // $countKematian = HaveDemografi::join('demografi', 'have_demografi.demografi_id', '=', 'demografi.demografi_id')
        // ->where('demografi.jenis', 'Kematian')
        // ->where('have_demografi.status_request', 'Dikonfirmasi')
        // ->count();

        // $countKelahiran = Keluarga::join('warga', 'keluarga.no_kk', '=', 'warga.no_kk')
        // ->join('have_demografi', 'warga.NIK', '=', 'have_demografi.NIK')
        // ->join('demografi', 'have_demografi.demografi_id', '=', 'demografi.demografi_id')
        // ->where('demografi.jenis', 'Kelahiran')
        // ->where('have_demografi.status_request', 'Dikonfirmasi')
        // ->count();

        // $countUsia = $countKelahiran - $countKematian;

        // $countUsiaProduktif = $jumlah = Warga::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 50')
        // ->count();


    }

    private function dashboardRT(int $rt) {
         // chart test
         $dataPekerjaan = Warga::getDataPekerjaan(Auth::user()->keterangan);
         $dataJenisKelamin = Warga::getDataJenisKelamin(Auth::user()->keterangan);
         $dataAgama = Warga::getDataAgama(Auth::user()->keterangan);
         $dataTingkatPendidikan = Warga::getDataTingkatPendidikan(Auth::user()->keterangan);
         $dataBansos = Bansos::getDataBansos(Auth::user()->keterangan);
         $dataUsia = Demografi::getDataUsia(Auth::user()->keterangan);
         //end chart


        $countPenduduk = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
                        ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                        ->where('keluarga.RT', $rt)
                        ->count();

        $countKeluarga = Keluarga::where('keluarga.RT', $rt)->count();;

        $countPengajuan =KeluargaModified::where('user_id', '=', Auth::user()->user_id)->count() +
        WargaModified::where('user_id', '=', Auth::user()->user_id)->count();
        // Pengajuan::where('user_id', '=', Auth::user()->user_id)->count();

         return view('dashboard.index',
         compact('dataPekerjaan',
            'dataJenisKelamin',
            'dataAgama',
            'dataTingkatPendidikan',
            'dataBansos',
            'dataUsia',
            'countPengajuan',
            'countKeluarga',
            'countPenduduk'),
            ['title' => 'RT', 'text' => 'Ketua RT']); // jenis kelamin blom

        // $countKematian = HaveDemografi::join('demografi', 'have_demografi.demografi_id', '=', 'demografi.demografi_id')
        // ->where('demografi.jenis', 'Kematian')
        // ->where('have_demografi.status_request', 'Dikonfirmasi')
        // ->count();

        // $countKelahiran = Keluarga::join('warga', 'keluarga.no_kk', '=', 'warga.no_kk')
        // ->join('have_demografi', 'warga.NIK', '=', 'have_demografi.NIK')
        // ->join('demografi', 'have_demografi.demografi_id', '=', 'demografi.demografi_id')
        // ->where('demografi.jenis', 'Kelahiran')
        // ->where('have_demografi.status_request', 'Dikonfirmasi')
        // ->where('keluarga.RT', $rt)
        // ->count();

        // $countUsia = $countKelahiran - $countKematian;

        // $countUsiaProduktif = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
        // ->join('user', 'keluarga.RT', '=', 'user.keterangan')
        // ->whereRaw('TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) < 50')
        // ->where('keluarga.RT', $rt)->count();


        // return view('dashboard.index', compact('countPenduduk', 'countKeluarga', 'countPengajuan', 'countKematian',
        // 'countKelahiran' , 'countUsia' ,'countUsiaProduktif', 'countJK' ,'countPerAgama', 'countTingkatPendidikan' , 'countPekerjaan'),
        // ['title' => 'RT', 'text' => 'Ketua RT']);
    }
    private function dashboardADM() {
        return view('dashboard.index', ['title' => 'Admin', 'text' => 'Admin']);
    }
    private function dashboardGuest() {

        return view('landing.index', ['title' => 'Umum', 'text' => 'Warga']);
    }
}
