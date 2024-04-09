<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Warga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KeluargaController extends Controller
{
    public function index(){
        $keluarga = Keluarga::all();
        return view('penduduk.keluarga.index', compact('keluarga'));
    }
    public function create(){
        $default = [
            'kode_pos' => 65115,
            'rt' => Auth::user()->keterangan,
            'rw' => '002',
            'kelurahan' => 'Gadingkasri',
            'kecamatan' => 'Klojen',
            'kota' => 'Malang',
            'provinsi' => 'Jawa Timur',
        ];
        return view('penduduk.keluarga.tambah')->with('default', $default)->with('daftarWarga', Warga::getTempWarga());
    }
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'image_kk' => 'required:image',
        ]);

        $keluarga = new Keluarga;
        $keluarga->no_kk = $request->no_kk;
        $keluarga->kepala_keluarga = $request->kepala_keluarga;
        $keluarga->alamat = $request->alamat;
        $keluarga->RT = $request->RT;
        $keluarga->RW = $request->RW;
        $keluarga->kode_pos = $request->kode_pos;
        $keluarga->kelurahan = $request->kelurahan;
        $keluarga->kecamatan = $request->kecamatan;
        $keluarga->kota = $request->kota;
        $keluarga->provinsi = $request->provinsi;
        $keluarga->image_kk = $this->storeImageKK($request);
        $keluarga->tagihan_listrik = $request->tagihan_listrik;
        $keluarga->luas_bangunan = $request->luas_bangunan;
        $keluarga->status = 'Menunggu';
        $keluarga->save();

        Warga::saveTemp(Keluarga::find($request->no_kk));

        return redirect()->route('keluarga');
    }
    public function edit($no_kk){
        $keluarga = Keluarga::find($no_kk);
        return view('penduduk.keluarga.edit', compact('keluarga'));
    }
    public function update(Request $request, $no_kk)
    {
        if (!Keluarga::where('no_kk', $no_kk)->exists()) {
           return redirect()->route('keluarga.index');
        }
        if ($request->hasFile('image_kk')) {
            $image_kk = $this->storeImageKK($request);
        } else {
            $image_kk = Keluarga::where('no_kk', $no_kk)->first()->image_kk;
        }

        KeluargaModified::create([
            'no_kk' => $request->no_kk,
            'user_id' => Auth::user()->user_id,
            'kepala_keluarga' => $request->kepala_keluarga,
            'image_kk' => $image_kk,
            'tagihan_listrik' => $request->tagihan_listrik,
            'tanggal_request' => now(),
            'status_request' => 'Menunggu',
        ]);
    }
    public function saveFormState(Request $request){
        session()->put('formState', $request->json()->all());
        return true;
    }
    private function storeImageKK(Request $request){
        $filename = Str::uuid()->toString();
        $extension = $request->file('image_kk')->getClientOriginalExtension();
        $filenameSimpan = $filename . '.' . $extension;
        // TODO: fix this error upload image file
        // $request->file('image_kk')->storeAs('public/images-kk', $filenameSimpan);
        return $filenameSimpan;
    }
}
