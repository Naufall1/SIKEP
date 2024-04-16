<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KeluargaController extends Controller
{
    /**
     * Fungsi untuk mengambil data no_kk dan nama kepala_keluarga semua Keluarga pada database.
     *
     * @return array([
     *      'no_kk' => 'no_kk',
     *      'kepala_keluarga' => 'Kepala keluarga'], ...)
     */
    public function getAll(){
        return Keluarga::select(['no_kk', 'kepala_keluarga'])->get();
    }

    /**
     * Fungsi untuk mengambol semua data sebuah Keluarga berdasarkan parameter no_kk.
     *
     * @param string $no_kk
     * @return \App\Models\Keluarga
     */
    public function getKeluarga($no_kk){
        return Keluarga::find($no_kk);
    }

    /**
     * Fungsi untuk menampilkan tampilan data keluarga dalam bentuk tabel, dengan data sesuai Level Usernya.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();

        if ($user->keterangan == 'ketua') {
            $keluarga = Keluarga::all();
        } else {
            $keluarga = Keluarga::select('keluarga.*', 'user.keterangan')
                ->join('user', 'keluarga.rt', '=', 'user.keterangan')
                ->where('user.keterangan', $user->keterangan)
                ->get();
        }
        return view('penduduk.keluarga.index', compact('keluarga'));
    }

    /**
     * Fungsi untuk menampilkan form penambahan data keluarga, dengan memberi beberapa nilai default.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Fungsi untuk menangani penambahan data keluarga.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            // 'image_kk' => 'required:image',
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

        session()->forget('formState');
        session()->save();

        return redirect()->route('keluarga');
    }

    /**
     * Fungsi untuk menampilkan form edit data keluarga.
     *
     * @param string $no_kk
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($no_kk){
        $keluarga = Keluarga::find($no_kk);
        return view('penduduk.keluarga.edit', compact('keluarga'));
    }

    /**
     * Fungsi untuk menangani perubahan data keluarga,
     * dan disimpan sementara pada model KeluargaModified sampai dikonformasi oleh RW.
     *
     * @param Request $request
     * @param string $no_kk
     * @return void
     */
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

    /**
     * @param Request $request
     * Method ini berfungsi untuk menyimpan semua data warga yang ditambahkan kedalam Keluarga yang sudah ada.
     */
    public function tambahWarga(Request $request){
        // TODO: Add validation
        Warga::saveTemp(Keluarga::find($request->no_kk));
        return redirect()->route('keluarga');
    }

    /**
     * @param Request $request
     * Fungsi ini untuk menyimpan kondisi terakhir form penambahan data.
     */
    public function saveFormState(Request $request){
        session()->put('formState', $request->json()->all());
        return true;
    }

    /**
     * Fungsi untuk menghapus anggota keluarga yang disimpan sementara.
     *
     * @param integer $idx
     * @return \Illuminate\Http\RedirectResponse
     */
    function removeAnggotaKeluarga($idx) {
        Warga::removeTemp($idx);
        return redirect(route('keluarga-tambah') . '#anggota_keluarga');
    }

    /**
     * @param Request $request
     * Fungsi ini menangani upload gambar KK.
     */
    private function storeImageKK(Request $request){
        $filename = Str::uuid()->getHex()->toString();
        $extension = $request->file('kartu_keluarga')->getClientOriginalExtension();
        $filenameSimpan = $filename . '.' . $extension;
        $request->file('kartu_keluarga')->storeAs('public/KK', $filenameSimpan, 'local');
        return $filenameSimpan;
    }

    public function detail(){
        return view('penduduk.keluarga.detail');
    }
}
