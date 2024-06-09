<?php

namespace App\Http\Controllers;

use App\Models\ArticleAnnouncement;
use App\Models\Bansos;
use App\Models\Demografi;
use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Pengajuan;
use App\Models\PengajuanData;
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
        return redirect()->route('publikasi');
    }

    private function dashboardGuest() {

        $select = [
            'kode',
            'judul',
            'penulis',
            'kategori',
            'status',
            'tanggal_dibuat',
            'image_url',
        ];

        $announcements = ArticleAnnouncement::select($select)->where('status', '=', 'ditampilkan')->orderBy('tanggal_dibuat', 'desc')->get();

        // dd(Auth::user());
        $data = $this->getData(Auth::user());

        return view('landing.index', $data, ['title' => 'Umum', 'text' => 'Warga', 'announcements' => $announcements]);
    }

    public function getBacaan($id){

        $announcement = ArticleAnnouncement::find($id);
        // dd($announcement);
        return view('landing.bacaan', compact('announcement'));

    }

    private function getData($keterangan) {
        $dataPekerjaan = Warga::getDataPekerjaan($keterangan);
        $dataJenisKelamin = Warga::getDataJenisKelamin($keterangan);
        $dataAgama = Warga::getDataAgama($keterangan);
        $dataTingkatPendidikan = Warga::getDataTingkatPendidikan($keterangan);
        $dataBansos = Bansos::getDataBansos($keterangan);
        $dataBansosByMonth = Bansos::getDataBansosByMonth($keterangan);
        $dataUsia = Demografi::getDataUsia($keterangan);
        $dataMeninggal = Demografi::getDataMeninggal($keterangan);
        // dd($dataMeninggal);
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

            // dd($pengajuanTable);


        if ($keterangan !== 'ketua' && $keterangan !== 'Admin') {
            $countPenduduk = Keluarga::join('user as u', 'keluarga.RT', '=', 'u.keterangan')
                            ->join('warga as w', 'keluarga.no_kk', '=', 'w.no_kk')
                            ->where('keluarga.RT', $keterangan)
                            ->count('w.no_kk');
            $countKeluarga = Keluarga::join('user as u', 'keluarga.RT', '=', 'u.keterangan')
                            ->where('keluarga.RT', $keterangan)
                            ->count();
            $pengajuanTable = PengajuanData::with('user')->limit(5)
                            ->join('user', 'pengajuan.user_id', '=', 'user.user_id')
                            ->where('status_request', '=' ,'Menunggu')
                            ->where('user.keterangan',  '=' ,$keterangan)
                            ->orderByDesc('tanggal_request')
                            ->get();

            if (isset(Auth::user()->user_id)) {
                $countPengajuan = PengajuanData::where('user_id', Auth::user()->user_id)->count();
            }
            else {
                $countPengajuan = PengajuanData::count();
            }

        } else {
            $countPenduduk = Warga::where('status_warga', '!=', 'Menunggu')->count();
            $countKeluarga = Keluarga::where('status', '=', 'Aktif')->count();
            $countPengajuan = PengajuanData::count();
            $pengajuanTable = PengajuanData::with('user')->limit(5)
                            ->where('status_request', '=' ,'Menunggu')
                            ->orderByDesc('tanggal_request')
                            ->get();
        }

        return compact('dataMeninggal','dataPekerjaan', 'dataJenisKelamin', 'dataAgama', 'dataTingkatPendidikan', 'dataBansos', 'dataBansosByMonth', 'dataUsia', 'semuaRT',
            'countPengajuan', 'countKeluarga', 'countPenduduk', 'pengajuanTable');
    }

}
