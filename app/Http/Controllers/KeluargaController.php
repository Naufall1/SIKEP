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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
    public function getAll()
    {
        return Keluarga::select(['no_kk', 'kepala_keluarga'])->where('status', '=', 'Aktif')->get();
    }

    /**
     * Fungsi untuk mengambol semua data sebuah Keluarga berdasarkan parameter no_kk.
     *
     * @param string $no_kk
     * @return \App\Models\Keluarga
     */
    public function getKeluarga($no_kk)
    {
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
                    <a href="' . route('wargaDetail', [$keluarga->no_kk]) . '"
                        class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                        Detail
                    </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Fungsi untuk menampilkan tampilan data keluarga dalam bentuk tabel, dengan data sesuai Level Usernya.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
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
    public function create()
    {
        $pengajuan = new Pengajuan();
        $formState = FormStateKeluarga::get();
        $daftarKeluarga = Keluarga::select('keluarga.*', 'user.keterangan')
            ->join('user', 'keluarga.rt', '=', 'user.keterangan')
            ->where('user.keterangan', Auth::user()->keterangan)
            ->where('status', '!=', 'Menunggu')
            ->get();
        $default = [
            'kode_pos' => 65115,
            'rt' => Auth::user()->keterangan,
            'rw' => 2,
            'kelurahan' => 'Gadingkasri',
            'kecamatan' => 'Klojen',
            'kota' => 'Malang',
            'provinsi' => 'Jawa Timur',
        ];
        return view('penduduk.keluarga.tambah', compact(['formState', 'daftarKeluarga']))->with('default', $default)->with('daftarWarga', $pengajuan->getDaftarWarga());
    }

    /**
     * Fungsi untuk menangani penambahan data keluarga.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /**
         * Validasi upload file ketika
         * - pada session belum tersedia
         * - update kk (jika pada request terdapat 'image_kk')
         * - penambahan data keluarga Baru
         **/
        $request->merge([
            'tagihan_listrik' => (int)$request->get('tagihan_listrik'),
            'luas_bangunan' => (int)$request->get('luas_bangunan'),
        ]);

        if ($request->jenis_data == 'data_lama') {
            if (!FormStateKeluarga::getKartuKeluarga() || $request->has('kartu_keluarga')) {
                $validator_file = Validator::make($request->only('kartu_keluarga'), [
                    'kartu_keluarga' => 'required|file|image|mimes:jpeg,jpg,png|max:2048'
                ]);
            }

            if (isset($validator_file) && !$validator_file->fails()) {
                $filename = Str::uuid()->getHex()->toString();
                $extension = $request->file('kartu_keluarga')->getClientOriginalExtension();
                $filenameSimpan = $filename . '.' . $extension;
                $request->file('kartu_keluarga')->storeAs('', $filenameSimpan, 'temp');
            }

            $validator = Validator::make($request->only(['no_kk','jenis_data']), [
                'no_kk' => 'required|size:16|exists:keluarga,no_kk'
            ]);

            // Hapus file temporary ketika dilakukan upload file baru
            if ((FormStateKeluarga::getKartuKeluarga() != null) && (isset($validator_file) &&!$validator_file->fails())) {
                Storage::disk('temp')->delete(FormStateKeluarga::getKartuKeluarga()->path);
            }

            // Masukkan detail file temporary pada session
            if (isset($validator_file) && !$validator_file->fails()) {
                FormStateKeluarga::setKK((object) [
                    'path' => $filenameSimpan,
                    'ext' => explode('.', $filenameSimpan)[1],
                    'base64' => base64_encode(Storage::disk('temp')->get($filenameSimpan))
                ]);
            }

            // Manual Redirect
            if ($validator->fails() || (isset($validator_file) && $validator_file->fails())) {
                if (FormStateKeluarga::getKartuKeluarga()) {
                    $kk = FormStateKeluarga::getKartuKeluarga();
                    FormStateKeluarga::update(new Request($validator->valid()));
                    FormStateKeluarga::setKK($kk);
                } else {
                    FormStateKeluarga::update(new Request($validator->valid()));
                }

                return redirect()->back()
                    ->withErrors(isset($validator_file) ? $validator->errors()->merge($validator_file) : $validator->errors())
                    ->withInput();
            }
            $kk = FormStateKeluarga::getKartuKeluarga();
            FormStateKeluarga::update(new Request($validator->valid()));
            FormStateKeluarga::setKK($kk);

            // $keluarga = Keluarga::find($request->no_kk);
        } else if ($request->jenis_data == 'data_baru') {
            if (!FormStateKeluarga::getKartuKeluarga() || $request->has('kartu_keluarga')) {
                $validator_file = Validator::make($request->only('kartu_keluarga'), [
                    'kartu_keluarga' => 'required|file|image|mimes:jpeg,jpg,png|max:2048'
                ]);
            }

            if (isset($validator_file) && !$validator_file->fails()) {
                $filename = Str::uuid()->getHex()->toString();
                $extension = $request->file('kartu_keluarga')->getClientOriginalExtension();
                $filenameSimpan = $filename . '.' . $extension;
                $request->file('kartu_keluarga')->storeAs('', $filenameSimpan, 'temp');
            }

            $validator = Validator::make($request->except('kartu_keluarga'), [
                'no_kk' => 'required|size:16|unique:keluarga,no_kk',
                'kepala_keluarga' => 'required|max:100',
                'alamat' => 'required',
                'RT' => 'required|integer',
                'RW' => 'required|integer',
                'kode_pos' => 'required|size:5',
                'kelurahan' => 'required|max:20',
                'kecamatan' => 'required|max:20',
                'kota' => 'required|max:20',
                'provinsi' => 'required|max:20',
                'tagihan_listrik' => 'required|integer',
                'luas_bangunan' => 'required|integer',
            ]);

            // Hapus file temporary ketika dilakukan upload file baru
            if (FormStateKeluarga::getKartuKeluarga() && (isset($validator_file) &&!$validator_file->fails())) {
                Storage::disk('temp')->delete(session()->get('kartu_keluarga')->path);
            }

            // Masukkan detail file temporary pada session
            if (isset($validator_file) && !$validator_file->fails()) {
                FormStateKeluarga::setKK((object) [
                    'path' => $filenameSimpan,
                    'ext' => explode('.', $filenameSimpan)[1],
                    'base64' => base64_encode(Storage::disk('temp')->get($filenameSimpan))
                ]);
            }

            // Manual Redirect
            if ($validator->fails() || (isset($validator_file) && $validator_file->fails())) {
                if (FormStateKeluarga::getKartuKeluarga()) {
                    $kk = FormStateKeluarga::getKartuKeluarga();
                    FormStateKeluarga::update(new Request($validator->valid()));
                    FormStateKeluarga::setKK($kk);
                } else {
                    FormStateKeluarga::update(new Request($validator->valid()));
                }

                return redirect()->back()
                    ->withErrors(isset($validator_file) ? $validator->errors()->merge($validator_file) : $validator->errors())
                    ->withInput();
            }
            $kk = FormStateKeluarga::getKartuKeluarga();
            FormStateKeluarga::update(new Request($validator->valid()));
            FormStateKeluarga::setKK($kk);
        }

        if ($request->action == 'tambah') {
            return redirect()->route('tambah-warga', ['no_kk' => $request->no_kk]);
        }

        if (Keluarga::find($request->no_kk)) {
            $keluarga = Keluarga::find($request->no_kk);
            $keluarga->image_kk = isset($filenameSimpan) ? $filenameSimpan : (FormStateKeluarga::getKartuKeluarga()->path);
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
            $keluarga->image_kk = isset($filenameSimpan) ? $filenameSimpan : (FormStateKeluarga::getKartuKeluarga()->path);
            $keluarga->tagihan_listrik = $request->tagihan_listrik;
            $keluarga->luas_bangunan = $request->luas_bangunan;
            $keluarga->status = 'Menunggu';
        }

        $pengajuan = new Pengajuan();
        $pengajuan->keluarga = $keluarga;
        $pengajuan->store();

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

        return redirect()->route('keluargaDetail', ['no_kk' => $request->no_kk]);
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
    function removeAnggotaKeluarga($idx)
    {
        // Warga::removeTemp($idx);
        $pengajuan = new Pengajuan();
        $pengajuan->removeWarga($idx);
        return redirect(route('keluarga-tambah') . '#anggota_keluarga');
    }

    /**
     * @param Request $request
     * Fungsi ini menangani upload gambar KK.
     */
    private function storeImageKK(Request $request)
    {
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
    public function detail($no_kk)
    {
        $keluarga = Keluarga::with(['warga', 'bansos', 'detailBansos'])->find($no_kk);
        return view('penduduk.keluarga.detail', compact('keluarga'));
    }
}
