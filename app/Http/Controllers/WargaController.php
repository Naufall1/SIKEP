<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use App\Models\WargaModified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    public function getAll(){
        return Warga::select(['nik', 'nama'])->get();
    }
    public function getWarga($nik){
        return Warga::find($nik);
    }
    public function index()
    {
        $user = Auth::user();

        if ($user->keterangan == 'ketua') {
            $warga = Warga::select('warga.*')
                ->join('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')
                ->get();
        } else {
            $warga = Warga::select('warga.*', 'keluarga.rt')
                ->join('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')
                ->join('user', function ($join) use ($user) {
                    $join->on('keluarga.rt', '=', 'user.keterangan')
                        ->where('keluarga.rt', '=', $user->keterangan);
                })
                ->get();
        }
        return view('penduduk.warga.index', compact('warga'));
    }
    public function create($no_kk){
        return view('penduduk.warga.tambah')->with('no_kk', $no_kk);
    }
    public function store(Request $request){
        // Validasi data yang masuk
        $request->validate([
            'NIK' => 'required|size:16',
            'no_kk' => 'required|size:16',
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'status_keluarga' => 'required|string|max:15',
            'status_warga' => 'required|in:Aktif,Meninggal,Migrasi,Menunggu',
            'jenis_pekerjaan' => 'required|string|max:50',
            'penghasilan' => 'required|integer',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'pendidikan' => 'required|string|max:50',
            'no_paspor' => 'nullable|string|max:10',
            'no_kitas' => 'nullable|string|max:10',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
        ]);
        // Mapping data dari request menuju objek
        $warga = new Warga();
        $warga->NIK = $request->nik;
        $warga->no_kk = $request->no_kk;
        $warga->nama = $request->nama;
        $warga->tempat_lahir = $request->tempat_lahir;
        $warga->tanggal_lahir = $request->tanggal_lahir;
        $warga->jenis_kelamin = $request->jenis_kelamin;
        $warga->agama = $request->agama;
        $warga->status_perkawinan = $request->status_perkawinan;
        $warga->status_keluarga = $request->status_keluarga;
        $warga->status_warga = 'Menunggu';
        $warga->jenis_pekerjaan = $request->jenis_pekerjaan;
        $warga->penghasilan = $request->penghasilan;
        $warga->kewarganegaraan = $request->kewarganegaraan;
        $warga->pendidikan = $request->pendidikan;
        $warga->no_paspor = $request->no_paspor;
        $warga->no_kitas = $request->no_kitas;
        $warga->nama_ayah = $request->nama_ayah;
        $warga->nama_ibu = $request->nama_ibu;

        $warga->storeTemp();
        return redirect()->route('keluarga-tambah');
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
            'status_request' => 'Menunggu',
        ]);
        return redirect()->route('warga');
    }
    /**
     * fungsi untuk merubah no_kk dari sebuah warga,
     * kemudian disimpan sementara pada session daftarWarga sampai dilakukan simpan permanen.
     */
    public function pindahKK(Request $request){
        $warga = Warga::find($request->nik);
        $warga->no_kk = $request->no_kk;
        $warga->storeTemp();
        return redirect()->route('keluarga-tambah');
    }

    public function detail(){
        return view('penduduk.warga.detail');
    }
}
