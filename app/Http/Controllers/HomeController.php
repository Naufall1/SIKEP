<?php

namespace App\Http\Controllers;

use App\Charts\JenisKelaminChart;
use App\Charts\PekerjaanChart;
use App\Http\Livewire\GrafikWarga;
use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Warga;
use App\Models\WargaModified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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

        return view('dashboard.index', compact('dataPekerjaan', 'dataJenisKelamin')); // jenis kelamin blom


        $countPenduduk = Warga::count();
        $countKeluarga = Keluarga::count();
        $countPengajuan = HaveDemografi::count() + KeluargaModified::count() + WargaModified::count();

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

        // $countPertumbuhan = $countKelahiran - $countKematian;

        // $countUsiaProduktif = $jumlah = Warga::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 50')
        // ->count();


        // jenis kelamin


        // agama
        $daftarAgama = Warga::distinct()->pluck('agama');

        $countPerAgama = [];

        foreach ($daftarAgama as $agama) {
            $jumlah = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
                ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                ->where('warga.agama', $agama)
                ->count();

            $countPerAgama[$agama] = $jumlah;
        }

        // pendidikan
        $countTingkatPendidikan = [];

        $tingkatPendidikan = Warga::distinct()->pluck('pendidikan');

        foreach ($tingkatPendidikan as $tingkat) {
            $count = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
                ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                ->where('warga.pendidikan', $tingkat)
                ->count();

            $countTingkatPendidikan[$tingkat] = $count;
        }


        // return view('dashboard.index', compact('countPenduduk', 'countKeluarga', 'countPengajuan', 'countKematian',
        // 'countKelahiran', 'countPertumbuhan', 'countUsiaProduktif', 'countJK', 'countPerAgama', 'countTingkatPendidikan' , 'countPekerjaan'),
        // ['title' => 'RW', 'text' => 'Ketua RW']);
    }

    private function dashboardRT(int $rt) {
        // chart test
        $keterangan = Auth::user()->keterangan;
        $dataPekerjaan = Warga::getDataPekerjaan(Auth::user()->keterangan);
        $dataJenisKelamin = Warga::getDataJenisKelamin(Auth::user()->keterangan);

        return view('dashboard.index', compact('dataPekerjaan', 'dataJenisKelamin')); // jenis kelamin blom

        $countPenduduk = Warga::join('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')->where('keluarga.RT', $rt)->count();
        $countKeluarga = Keluarga::where('RT', $rt)->count();
        $countPengajuan = HaveDemografi::count() + KeluargaModified::count() + WargaModified::count();

        $countKematian = HaveDemografi::join('demografi', 'have_demografi.demografi_id', '=', 'demografi.demografi_id')
        ->where('demografi.jenis', 'Kematian')
        ->where('have_demografi.status_request', 'Dikonfirmasi')
        ->count();

        $countKelahiran = Keluarga::join('warga', 'keluarga.no_kk', '=', 'warga.no_kk')
        ->join('have_demografi', 'warga.NIK', '=', 'have_demografi.NIK')
        ->join('demografi', 'have_demografi.demografi_id', '=', 'demografi.demografi_id')
        ->where('demografi.jenis', 'Kelahiran')
        ->where('have_demografi.status_request', 'Dikonfirmasi')
        ->where('keluarga.RT', $rt)
        ->count();

        $countPertumbuhan = $countKelahiran - $countKematian;

        $countUsiaProduktif = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
        ->join('user', 'keluarga.RT', '=', 'user.keterangan')
        ->whereRaw('TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) < 50')
        ->where('keluarga.RT', $rt)->count();

        // agama
        $daftarAgama = Warga::distinct()->pluck('agama');

        $countPerAgama = [];

        foreach ($daftarAgama as $agama) {
            $jumlah = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
                ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                ->where('keluarga.RT', $rt)
                ->where('warga.agama', $agama)
                ->count();

            $countPerAgama[$agama] = $jumlah;
        }

        // pendidikan
        $countTingkatPendidikan = [];

        $tingkatPendidikan = Warga::distinct()->pluck('pendidikan');

        foreach ($tingkatPendidikan as $tingkat) {
            $count = Warga::join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
                ->join('user', 'keluarga.RT', '=', 'user.keterangan')
                ->where('keluarga.RT', $rt)
                ->where('warga.pendidikan', $tingkat)
                ->count();

            $countTingkatPendidikan[$tingkat] = $count;
        }

        // return view('dashboard.index', compact('countPenduduk', 'countKeluarga', 'countPengajuan', 'countKematian',
        // 'countKelahiran' , 'countPertumbuhan' ,'countUsiaProduktif', 'countJK' ,'countPerAgama', 'countTingkatPendidikan' , 'countPekerjaan'),
        // ['title' => 'RT', 'text' => 'Ketua RT']);
    }
    private function dashboardADM() {
        return view('dashboard.index', ['title' => 'Admin', 'text' => 'Admin']);
    }
    private function dashboardGuest() {

        return view('landing.index', ['title' => 'Umum', 'text' => 'Warga']);
    }
}
