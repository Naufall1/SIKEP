<?php

namespace App\Http\Controllers;

use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Warga;
use App\Models\WargaModified;
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
        $countPenduduk = Warga::count();
        $countKeluarga = Keluarga::count();
        $countPengajuan = HaveDemografi::count() + KeluargaModified::count() + WargaModified::count();
        // dd($countPengajuan);
        return view('dashboard.index', ['title' => 'RW','text' => 'Ketua RW']);
    }
    private function dashboardRT(int $rt) {
        $countPenduduk = Warga::with('keluarga')->where('RT', $rt)->count();
        $countKeluarga = Keluarga::where('RT', $rt)->count();
        $countPengajuan = HaveDemografi::count() + KeluargaModified::count() + WargaModified::count();
        return view('dashboard.index', ['title' => 'RT','text' => 'Ketua RT']);
    }
    private function dashboardADM() {
        return view('dashboard.index', ['title' => 'Admin','text' => 'Admin']);
    }
    private function dashboardGuest() {
        return view('dashboard.index', ['title' => 'Umum','text' => 'Warga']);
    }
}
