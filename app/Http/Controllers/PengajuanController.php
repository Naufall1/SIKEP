<?php

namespace App\Http\Controllers;

use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\PengajuanData;
use App\Models\Warga;
use App\Models\WargaHistory;
use App\Models\WargaModified;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PengajuanController extends Controller
{
    public function index()
    {
        Storage::disk('public');
        return view('pengajuan.index');
    }

    public function list()
    {
        $pengajuan =  PengajuanData::with(['user', 'keluarga'])->get();
        return DataTables::of($pengajuan)
            ->addIndexColumn()
            ->addColumn('status', function ($pengajuan) {
                return view('components.form.label', ['content' => $pengajuan->status_request])->render();
            })
            ->addColumn('aksi', function ($pengajuan) {
                switch ($pengajuan->tipe) {
                    case 'Pembaruan':
                        $btn = '<a href="' . route('pengajuan.pembaharuan', ['id' => $pengajuan->id]) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                        break;
                    case 'Perubahan Keluarga':
                        $btn = '<a href="' . route('pengajuan.perubahankeluarga', ['no_kk' => '123123']) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                        break;
                    case 'Perubahan Warga':
                        $btn = '<a href="' . route('pengajuan.perubahanwarga', ['nik' => '123123']) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                        break;
                }
                return $btn;
            })
            ->rawColumns(['status', 'aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    /**
     * Fungsi-fungsi untuk jenis pengajuan Pembaharuan
     */
    public function showPembaharuan($id)
    {
        $pengajuan = PengajuanData::with('keluarga')->find($id);

        return view('pengajuan.pembaharuan.detail', compact('pengajuan'));
    }
    public function listWarga(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);
        $request->validate([
            'id' => 'required|exists:pengajuan,id'
        ]);

        $daftarWarga = Warga::where('no_kk', '=', PengajuanData::find($request->id)->no_kk)->get();
        return DataTables::of($daftarWarga)
            ->addIndexColumn()
            ->addColumn('aksi', function () {
                $btn = '<a href="#" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function confirmPembaharuan(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pengajuan,id'
        ]);

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanData::find($request->id);
            $keluarga = Keluarga::find($pengajuan->no_kk);

            if ($keluarga->status == 'Menunggu') {
                $keluarga->status = 'Aktif';
            }

            $wargaModfied = WargaModified::where('no_kk', '=', $keluarga->no_kk)
                ->where('status_request', '=', 'Menunggu')
                ->get();

            if (count($wargaModfied) > 0) {
                foreach ($wargaModfied as $wargaMod) {
                    Warga::applyModifications($wargaMod);
                    WargaHistory::track(Warga::find($wargaMod->NIK));
                    $wargaMod->save();
                }
            }

            $wargaNew = Warga::where('no_kk', '=', $keluarga->no_kk)
                ->where('status_warga', '=', 'Menunggu')
                ->get();

            if (count($wargaNew) > 0) {
                foreach ($wargaNew as $wargaN) {
                    $wargaN->status_warga = 'Aktif';
                    $demografiWarga = HaveDemografi::where('NIK', '=', $wargaN->NIK)
                        ->where('status_request', '=', 'Menunggu')
                        ->first();
                    $demografiWarga->status_request = 'Dikonfirmasi';
                    $wargaN->save();
                    $demografiWarga->save();
                }
            }

            $pengajuan->status_request = 'Dikonfirmasi';

            $keluarga->save();
            $pengajuan->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil Dikonfirmasi');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Melakukan Konfirmasi');
        }
    }

    public function confirm($id)
    {
        $data = Keluarga::find($id);
        $data->status = 'confirm';
        $data->save();
        return redirect()->route('pengajuan.index')->with('flash', 'success');
    }
    public function reject($id)
    {
        $data = Keluarga::find($id);
        $data->status = 'reject';
        $data->save();
        return redirect()->route('pengajuan.index')->with('flash', 'danger');
    }
}
