<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\PengajuanData;
use App\Models\WargaModified;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
            ->addColumn('status', function () {
                return view('components.form.label', ['content' => 'Menunggu'])->render();
            })
            ->addColumn('aksi', function ($pengajuan) {
                switch ($pengajuan->tipe) {
                    case 'Pembaruan':
                        $btn = '<a href="' . route('pengajuan.pembaharuan', ['id' => '123123']) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                        break;
                    case 'Perubahan Keluarga':
                        $btn = '<a href="' . route('pengajuan.perubahankeluarga', ['no_kk' => '123123']) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"   > Detail </a>';
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
    public function showPembaharuan($id)
    {
        $data = PengajuanData::find($id);
        return view('pengajuan.detail')->with('data', $data);
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
