<?php

namespace App\Http\Controllers;

use App\Models\FormStateKeluarga;
use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Pengajuan;
use App\Models\Warga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

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
        return Keluarga::select(['no_kk', 'kepala_keluarga'])->where('status', '=', 'Aktif')->get();
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

    public function list(Request $request)
    {
        $user = Auth::user();

        if ($user->keterangan == 'ketua') {
            $daftar_keluarga = Keluarga::where('status', '!=', 'Menunggu')->get();
        } else {
            $daftar_keluarga = Keluarga::select('keluarga.*', 'user.keterangan')
                ->join('user', 'keluarga.rt', '=', 'user.keterangan')
                ->where('user.keterangan', $user->keterangan)
                // ->where('status', '!=', 'Menunggu')
                ->get();
        }

        return DataTables::of($daftar_keluarga)
            ->addIndexColumn() // menambahkan kolom index / no urut (default namakolom: DT_RowIndex)
            ->addColumn('action', function ($keluarga) {
                return '
                <td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                    <a href="'. route('penduduk.keluarga.detail', [$keluarga->no_kk]) .'"
                        class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                        Detail
                    </a>
                </td>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Fungsi untuk menampilkan tampilan data keluarga dalam bentuk tabel, dengan data sesuai Level Usernya.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();

        if ($user->keterangan == 'ketua') {
            $keluarga = Keluarga::where('status', '!=', 'Menunggu')->get();
        } else {
            $keluarga = Keluarga::select('keluarga.*', 'user.keterangan')
                ->join('user', 'keluarga.rt', '=', 'user.keterangan')
                ->where('user.keterangan', $user->keterangan)
                // ->where('status', '!=', 'Menunggu')
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
        $pengajuan = new Pengajuan();
        $formState = FormStateKeluarga::get();
        $default = [
            'kode_pos' => 65115,
            'rt' => Auth::user()->keterangan,
            'rw' => '002',
            'kelurahan' => 'Gadingkasri',
            'kecamatan' => 'Klojen',
            'kota' => 'Malang',
            'provinsi' => 'Jawa Timur',
        ];
        return view('penduduk.keluarga.tambah', compact('formState'))->with('default', $default)->with('daftarWarga', $pengajuan->getDaftarWarga());
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
            'no_kk' => 'required',
            // 'image_kk' => 'required:image',
        ]);

        if ($request->action == 'tambah') {
            FormStateKeluarga::update($request);
            // dd($request->all());
            // dd(FormStateKeluarga::get());
            return redirect()->route('tambah-warga', ['no_kk' => $request->no_kk]);
        }

        if (Keluarga::find($request->no_kk)) {
            $keluarga = Keluarga::find($request->no_kk);
        } else {
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
            // $keluarga->image_kk = $this->storeImageKK($request);
            $keluarga->image_kk = '1';
            $keluarga->tagihan_listrik = $request->tagihan_listrik;
            $keluarga->luas_bangunan = $request->luas_bangunan;
            $keluarga->status = 'Menunggu';
            // $keluarga->save();
        }

        $pengajuan = new Pengajuan();
        $pengajuan->keluarga = $keluarga;
        $pengajuan->store();

        // Warga::saveTemp(Keluarga::find($request->no_kk));

        // session()->forget('formState');
        // session()->save();

        return redirect()->route('keluarga');
    }

    /**
     * Fungsi untuk menampilkan form edit data keluarga.
     *
     * @param string $no_kk
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($no_kk)
    {
        $keluarga = Keluarga::with('warga')->find($no_kk);
        if (!$keluarga) {
            return redirect()->back();
        }
        return view('penduduk.keluarga.edit', compact('keluarga'));
    }

    /**
     * Fungsi untuk menangani perubahan data keluarga,
     * dan disimpan sementara pada model KeluargaModified sampai dikonformasi oleh RW.
     *
     * @param Request $request
     * @param string $no_kk
     * @return RedirectResponse
     */
    public function update(Request $request, $no_kk)
    {
        $keluarga = Keluarga::find($no_kk);

        if (!$keluarga) {
           return redirect()->back();
        }

        $keluarga->fill($request->only(['no_kk', 'tagihan_listrik', 'luas_bangunan']));

        $keluarga->kepala_keluarga = Warga::find($request->kepala_keluarga)->nama;

        if ($request->hasFile('image_kk')) {
            $image_kk = $this->storeImageKK($request);
            $keluarga->image_kk = $image_kk;
        }

        // perubahan warga akan disimpan pada tabel warga Modified, untuk menunggu dikonfirmasi oleh ketua RW.
        KeluargaModified::updateKeluarga($keluarga);

        return redirect()->route('keluargaDetail', ['no_kk'=> $request->no_kk]);
    }

    /**
     * @param Request $request
     * Method ini berfungsi untuk menyimpan semua data warga yang ditambahkan kedalam Keluarga yang sudah ada.
     */
    // public function tambahWarga(Request $request){
    //     // TODO: Add validation
    //     Warga::saveTemp(Keluarga::find($request->no_kk));
    //     return redirect()->route('keluarga');
    // }

    /**
     * @param Request $request
     * Fungsi ini untuk menyimpan kondisi terakhir form penambahan data.
     */
    // public function saveFormState(Request $request){
    //     FormStateKeluarga::update($request);
    //     return true;
    // }

    /**
     * Fungsi untuk menghapus anggota keluarga yang disimpan sementara.
     *
     * @param integer $idx
     * @return \Illuminate\Http\RedirectResponse
     */
    function removeAnggotaKeluarga($idx) {
        // Warga::removeTemp($idx);
        $pengajuan = new Pengajuan();
        $pengajuan->removeWarga($idx);
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

    /**
     * Fungsi untuk menampilkan halaman detail dari sebuah Keluarga.
     *
     * @param string $no_kk
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($no_kk){
        $keluarga = Keluarga::with(['warga', 'bansos', 'detailBansos'])->find($no_kk);
        return view('penduduk.keluarga.detail', compact('keluarga'));
    }
}
