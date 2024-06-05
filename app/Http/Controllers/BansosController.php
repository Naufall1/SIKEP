<?php

namespace App\Http\Controllers;

use App\Models\ARAS;
use App\Models\Bansos;
use Exception;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\KeluargaHistory;
use App\Models\KriteriaModel;
use App\Models\MEREC;
use App\Models\MightGet;
use App\Models\Warga;
use App\Models\WargaHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                            <a href="' . route('bansos.kriteria.detail', $bansos->no_kk) . '"
                                class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                Lihat
                            </a>
                        </td>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($id)
    {
        $dataKeluarga = Keluarga::findOrFail($id);

        $dataWarga = Warga::select(
            'warga.*',
            'warga.nik',
            'keluarga.no_kk',
            'keluarga.kepala_keluarga',
            'keluarga.tagihan_listrik',
            'keluarga.luas_bangunan'
        )
            ->join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->where('warga.no_kk', $dataKeluarga->no_kk)
            ->get();

        return view('bansos.kriteria.edit', compact('dataKeluarga', 'dataWarga'));
    }


    public function update(Request $request, $no_kk)
    {
        $request->merge(['no_kk' => $no_kk]);
        $request->validate([
            'no_kk' => 'required|size:16|exists:keluarga,no_kk',
            'tagihan_listrik' => 'required',
            'luas_bangunan' => 'required',
            'penghasilan' => 'required|array',
            'penghasilan.*' => 'integer'
        ]);

        try {
            DB::beginTransaction();

            $keluargaModified = false;
            $wargaModified = false;

            $dataKeluarga = Keluarga::findOrFail($no_kk);
            $dataKeluarga->fill($request->all());

            if (!empty($dataKeluarga->getDirty())) {
                KeluargaHistory::track($dataKeluarga);
                $dataKeluarga->save();
                $keluargaModified = true;
            }

            foreach ($request->penghasilan as $nik => $data) {
                $dataWarga = Warga::findOrFail($nik);
                $dataWarga->penghasilan = $data;
                if (!empty($dataWarga->getDirty())) {
                    WargaHistory::track($dataWarga);
                    $dataWarga->save();
                    $wargaModified = true;
                }
            }

            DB::commit();

            if (!$wargaModified && !$keluargaModified) {
                return redirect()->route('bansos.kriteria')
                    ->with('flash', (object)[
                        'type' => 'success',
                        'message' => 'Tidak ada data yang diubah.'
                    ]);
            }

            return redirect()->route('bansos.kriteria')
                ->with('flash', (object)[
                    'type' => 'success',
                    'message' => 'Data berhasil dikirimkan.'
                ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('bansos.kriteria')
                ->with('flash', (object)[
                    'type' => 'fail',
                    'message' => 'Data gagal dikirimkan.'
                ]);
        }
    }

    public function detail($id)
    {
        $dataKeluarga = Keluarga::findOrFail($id);

        $dataWarga = Warga::select(
            'warga.*',
            'warga.nik',
            'keluarga.no_kk',
            'keluarga.kepala_keluarga',
            'keluarga.tagihan_listrik',
            'keluarga.luas_bangunan'
        )
            ->join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->where('warga.no_kk', $dataKeluarga->no_kk)
            ->get();

        return view('bansos.kriteria.detail', compact('dataKeluarga', 'dataWarga'));
    }

    public function gdss()
    {
        $user = Auth::user();
        $dataKeluarga = null;
        $dataKeluargaWithRank = null;

        $kriteria = new KriteriaModel();

        $MEREC = new MEREC($kriteria);
        $MEREC->calculate();

        $ARAS = new ARAS($kriteria->kriteria(), $kriteria->namaKriteria(), $MEREC->getBobot());
        $ARAS->calculate();

        $rankOrder = array_keys($ARAS->getPeringkatUtilitas_K());

        if (Auth::user()->keterangan === 'ketua') {
            $dataKeluarga = Keluarga::dataBansos($user->keterangan);
        } else {
            $dataKeluarga = Keluarga::dataBansos($user->keterangan);
        }

        foreach ($dataKeluarga as $keluarga) {
            $keluarga['rank'] = array_search($keluarga->no_kk, $rankOrder) + 1;
        }

        return DataTables::of(collect($dataKeluarga))
            // ->addIndexColumn() // menambahkan kolom index / no urut (default namakolom: DT_RowIndex)
            ->addColumn('action', function ($bansos) {
                return '<td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                            <a href="'. route('bansos.perhitungan.detail', $bansos->no_kk) . '"
                                class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                Lihat
                            </a>
                        </td>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function calc()
    {
        return view('bansos.perhitungan.index');
    }

    public function detailCalc($id)
    {
        $dataKeluarga = Keluarga::findOrFail($id);
        $dataKriteria = $dataKeluarga->getDataKriteria();

        return view('bansos.perhitungan.detail', compact(['dataKeluarga', 'dataKriteria']));
    }

    public function tambah(Request $request, $id) {

        $dataKeluarga = Keluarga::findOrFail($id);

        $mightGet = new MightGet();
        $mightGet->bansos_kode = $request->bansos_kode;
        $mightGet->no_kk = $id;
        $mightGet->tanggal_menerima = $request->tanggal_menerima;
        $mightGet->save();
        // dd($request->bansos_kode);


        return redirect()->route('bansos.perhitungan.detail', ['id' => $dataKeluarga->no_kk])
        ->with('flash', (object)[
            'type' => 'success',
            'message' => 'Berhasil menambahkan Bansos'
        ]);
    }

    public function detailPerhitungan(){
        return view('bansos.perhitungan.perhitungan');
    }
}
