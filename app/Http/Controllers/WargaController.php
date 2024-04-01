<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\WargaModified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    public function index(){
        $warga = Warga::all();
        return view('penduduk.warga.index', compact('warga'));
    }
    public function create(){
        return view('penduduk.warga.tambah');
    }
    public function store(Request $request){
        Warga::create($request->only([
            'NIK',
            'no_kk',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'status_perkawinan',
            'status_keluarga',
            'status_warga',
            'jenis_pekerjaan',
            'penghasilan',
            'kewarganegaraan',
            'pendidikan',
            'no_paspor',
            'no_kitas',
            'nama_ayah',
            'nama_ibu',
        ]));
        return redirect()->route('warga');
    }
    public function edit($nik){
        $warga = Warga::find($nik);
        return view('penduduk.warga.edit', compact('warga'));
    }
    public function update(Request $request, $nik){
        WargaModified::create([
            'NIK' => $request->nik,
            'user_id' => Auth::user()->user_id,
            'agama' => $request->agama,
            'status_perkawinan'=> $request->status_perkaeinan,
            'status_keluarga'=> $request->status_keluarga,
            'status_warga'=> $request->status_warga,
            'jenis_pekerjaan'=> $request->jenis_pekerjaan,
            'penghasilan'=> $request->penghasilan,
            'pendidikan'=> $request->pendidikan,
            'tanggal_request' => now(),
            'status_request' => 'menunggu',
        ]);
        return redirect()->route('warga');
    }
}
