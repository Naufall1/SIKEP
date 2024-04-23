<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bansos;
use App\Models\Keluarga;
use App\Models\MightGet;
use App\Models\Warga;

class BansosController extends Controller
{
    public function index()
    {
        $dataKeluarga = Keluarga::dataBansos();

        return view('bansos.kriteria.index', compact('dataKeluarga'));
    }

    public function edit($id)
    {
        $dataKeluarga = Keluarga::findOrFail($id);

        $dataWarga = Warga::select('warga.*', 'warga.nik', 'keluarga.no_kk', 'keluarga.kepala_keluarga',
            'keluarga.tagihan_listrik', 'keluarga.luas_bangunan')
            ->join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->where('warga.no_kk', $dataKeluarga->no_kk)
            ->get();

        return view('bansos.kriteria.edit', compact('dataKeluarga', 'dataWarga'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        //
    ]);

    $dataKeluarga = Keluarga::findOrFail($id);
    $dataKeluarga->fill($request->all());
    $dataKeluarga->save();

    foreach ($request->nik as $key => $nik) {
        $dataWarga = Warga::where('nik', $nik)->firstOrFail();
        $dataWarga->update([
            'penghasilan' => $request->penghasilan[$key],
            'jenis_pekerjaan' => $request->jenis_pekerjaan[$key],
        ]);
    }

    return redirect()->route('kriteria')
        ->with('success', 'Data berhasil disimpan.');
}


}
