<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\WargaModified;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengajuanController extends Controller
{
    public function indexNew() {
        $dataBaru =  Keluarga::where('status', '=', 'Menunggu')->get();
        return view('pengajuan.index', compact('dataBaru'));
    }
    public function indexModifWarga() {
        $wargaModified =  WargaModified::all();
        return view('pengajuan.perubahanwarga.index', compact('wargaModified'));
    }
    public function indexModifKeluarga() {
        $keluargaModified =  KeluargaModified::all();
        return view('pengajuan.perubahankeluarga.index', compact('keluargaModified'));
    }
    public function listModifKeluarga() {
        $keluargaModified =  KeluargaModified::with(['user', 'keluarga'])->select();
        return DataTables::of($keluargaModified)
            ->addIndexColumn()
            ->addColumn('status', function (KeluargaModified $keluarga){
                return view('components.form.label', ['content' => $keluarga->status_request])->render();
            })
            ->addColumn('aksi', function (KeluargaModified $keluarga) {
                $btn = '<a href="'. route('pengajuan.perubahan.keluarga', ['no_kk'=>$keluarga->no_kk]) .'" class="tw-h-10 tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center"> Detail </a>';
                return $btn;
            })
            ->rawColumns(['status', 'aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
    public function detail($id) {
        $data = Keluarga::find($id);
        return view('pengajuan.detail')->with('data', $data);
    }
    public function confirm($id) {
        $data = Keluarga::find($id);
        $data->status = 'confirm';
        $data->save();
        return redirect()->route('pengajuan.index')->with('flash', 'success');
    }
    public function reject($id) {
        $data = Keluarga::find($id);
        $data->status ='reject';
        $data->save();
        return redirect()->route('pengajuan.index')->with('flash', 'danger');
    }
}
