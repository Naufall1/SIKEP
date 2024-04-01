<?php

namespace App\Http\Controllers;

use App\Models\HaveDemografiModel;
use App\Models\KeluargaModel;
use App\Models\KeluargaModifiedModel;
use App\Models\WargaModel;
use App\Models\WargaModifiedModel;
use Illuminate\Http\Request;
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
                return $this->dashboardRT(Auth::user()->keterangan);
            case 'ADM':
                return $this->dashboardADM();
            default:
                break;
        }
    }
    public function test() {
        // dd(WargaModel::with('keluarga')->where('RT', $rt));
    }
    private function dashboardRW() {
        $countPenduduk = WargaModel::count();
        $countKeluarga = KeluargaModel::count();
        $countPengajuan = HaveDemografiModel::count() + KeluargaModifiedModel::count() + WargaModifiedModel::count();
        // dd($countPengajuan);
        return view('dashboard.index', ['title' => 'RW','text' => 'Ketua RW']);
    }
    private function dashboardRT(int $rt) {
        $countPenduduk = WargaModel::with('keluarga')->where('RT', $rt)->count();
        $countKeluarga = KeluargaModel::where('RT', $rt)->count();
        $countPengajuan = HaveDemografiModel::count() + KeluargaModifiedModel::count() + WargaModifiedModel::count();
        return view('dashboard.index', ['title' => 'RT','text' => 'Ketua RT']);
    }
    private function dashboardADM() {
        return view('dashboard.index', ['title' => 'Admin','text' => 'Admin']);
    }
    private function dashboardGuest() {
        return view('dashboard.index', ['title' => 'Umum','text' => 'Warga']);
    }
}
