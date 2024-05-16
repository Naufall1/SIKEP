<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bansos;
use App\Models\Keluarga;
use App\Models\MightGet;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BansosController extends Controller
{
    public function index()
    {
        return view('bansos.kriteria.index');
    }
    public function list()
    {
        $user = Auth::user();
        $dataKeluarga = null;

        if (Auth::user()->keterangan === 'ketua') {
            $dataKeluarga = Keluarga::dataBansos($user->keterangan);
        } else {
            $dataKeluarga = Keluarga::dataBansos($user->keterangan);
        }
        return DataTables::of($dataKeluarga)
            ->addIndexColumn() // menambahkan kolom index / no urut (default namakolom: DT_RowIndex)
            ->addColumn('action', function ($bansos) {
                return '<td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                            <a href="'. route('bansos.kriteria.form', $bansos->no_kk) . '"
                                class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                Ubah
                            </a>
                        </td>';
            })
            ->rawColumns(['action'])
            ->make(true);
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
