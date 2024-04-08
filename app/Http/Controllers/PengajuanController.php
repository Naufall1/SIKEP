<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\WargaModified;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function indexNew() {
        $dataBaru =  Keluarga::all();
        return view('pengajuan.index')->with('dataBaru', $dataBaru);
    }
    public function indexModifWarga() {
        $dataBaru =  WargaModified::all();
        return view('pengajuan.index')->with('dataBaru', $dataBaru);
    }
    public function indexModifKeluarga() {
        $dataBaru =  KeluargaModified::all();
        return view('pengajuan.index')->with('dataBaru', $dataBaru);
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
