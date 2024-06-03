<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\FormStateKeluarga;
use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaModified;
use App\Models\Pengajuan;
use App\Models\PengajuanData;
use App\Models\Warga;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    /**
     * [START] Fungsi Untuk menangani DataTables
     */

    /**
     * Fungsi untuk menampilkan daftar semua Keluarga
     */
    public function list(Request $request)
    {
        $user = Auth::user();
        $select = [
            'keluarga.no_kk',
            'keluarga.kepala_keluarga',
            'keluarga.alamat',
            'keluarga.RT'
        ];

        if ($user->keterangan == 'ketua') {
            $query = Keluarga::select($select)
                                ->where('status', '!=', 'Menunggu');

            if (explode(" ", $request->scope_data)[1] ?? false) {
                $query->where('RT', '=', (int)explode(" ", $request->scope_data)[1]);
            }

            $daftar_keluarga = $query->get();
        } else {
            $daftar_keluarga = Keluarga::select($select, 'user.keterangan')
                ->join('user', 'keluarga.rt', '=', 'user.keterangan')
                ->where('user.keterangan', $user->keterangan)
                ->where('status', '!=', 'Menunggu')
                ->get();
        }

        return DataTables::of($daftar_keluarga)
            ->addIndexColumn() // menambahkan kolom index / no urut (default namakolom: DT_RowIndex)
            ->addColumn('action', function ($keluarga) {
                return '
                    <a href="' . route('penduduk.keluarga.detail', [$keluarga->no_kk]) . '"
                        class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                        Detail
                    </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Mengembalikan daftar warga yang terdaftar pada Keluarga
     */
    public function listWarga(Request $request, $no_kk)
    {
        $keluarga = Keluarga::with('warga')->find($no_kk);
        return DataTables::of($keluarga->warga)
            ->addIndexColumn() // menambahkan kolom index / no urut (default namakolom: DT_RowIndex)
            ->addColumn('action', function (Warga $warga) {
                return '
                <a href="' . route('wargaDetail', [$warga->NIK]) . '"
                    class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                    Detail
                </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Mengembalikan daftar bansos yang ada pada Keluarga
     */
    public function listBansos(Request $request, $no_kk)
    {
        $bansos = Bansos::getFromKK($no_kk);
        return DataTables::of($bansos)
            ->addIndexColumn()
            ->make(true);
    }
    /**
     * [END] Fungsi Untuk menangani DataTables
     */

    /**
     * Fungsi untuk menampilkan tampilan data keluarga dalam bentuk tabel, dengan data sesuai Level Usernya.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('penduduk.keluarga.index');
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
        // return view('penduduk.keluarga.tambah', compact(['formState', 'daftarKeluarga']))->with('default', $default)->with('daftarWarga', $pengajuan->getDaftarWarga());
        return view('penduduk.keluarga.tambah', compact(['formState', 'daftarKeluarga']))->with('default', $default);
    }

    public function listWargaCreate(Request $request)
    {
        // dd($request);
        $request->validate([
            'no_kk' => 'numeric|nullable'
        ]);
        $pengajuan = new Pengajuan();
        $pengajuan->keluarga = new Keluarga;
        $pengajuan->keluarga->no_kk = $request->no_kk;
        $daftarWarga = $pengajuan->getDaftarWargaOnly();
        return DataTables::of($daftarWarga)
            ->addIndexColumn()
            ->addColumn('action', function (Warga $warga) {
                $trash = '
                    <a href="'. route('removeAnggotaKeluarga', $warga->NIK) .'"
                        class="tw-btn tw-btn-danger tw-btn-md tw-btn-round-md tw-px-2">
                        <span class="tw-stroke-n100">
    <svg width="20" height="20" viewBox="0 0 25 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M21.647 5.98C18.317 5.65 14.967 5.48 11.627 5.48C9.64703 5.48 7.66703 5.58 5.68703 5.78L3.64703 5.98"
            stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M9.14703 4.97L9.36703 3.66C9.52703 2.71 9.64703 2 11.337 2H13.957C15.647 2 15.777 2.75 15.927 3.67L16.147 4.97"
            stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M19.497 9.14L18.847 19.21C18.737 20.78 18.647 22 15.857 22H9.43703C6.64703 22 6.55703 20.78 6.44703 19.21L5.79703 9.14"
            stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10.977 16.5H14.307"
            stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path dd="M10.147 12.5H15.147"
            stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</span>
                    </a>';
                $show = '
                    <a href="'. route('detailAnggotaKeluarga', ['nik' => $warga->NIK]) .'"
                        class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                        Lihat
                    </a>';
                $disabledShow = '
                    <button disabled href="'. route('detailAnggotaKeluarga', ['nik' => $warga->NIK]) .'"
                        class="tw-btn tw-btn-disabled tw-btn-md tw-btn-round-md">
                        Lihat
                    </button>';

                $disabledTrash = '<button disabled href="'. route('removeAnggotaKeluarga', $warga->NIK) .'"
                                                    class="tw-btn tw-btn-disabled tw-btn-md tw-btn-round-md tw-px-2">
                                                    <span class="tw-stroke-n100">
                                    <svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.647 5.98C18.317 5.65 14.967 5.48 11.627 5.48C9.64703 5.48 7.66703 5.58 5.68703 5.78L3.64703 5.98"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.14703 4.97L9.36703 3.66C9.52703 2.71 9.64703 2 11.337 2H13.957C15.647 2 15.777 2.75 15.927 3.67L16.147 4.97"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M19.497 9.14L18.847 19.21C18.737 20.78 18.647 22 15.857 22H9.43703C6.64703 22 6.55703 20.78 6.44703 19.21L5.79703 9.14"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.977 16.5H14.307"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path dd="M10.147 12.5H15.147"
                                        stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    </span>
                                </button>';
                if (str_contains($warga->nama, '(Baru)')) {
                    return $trash . $show;
                }
                return $disabledTrash . $disabledShow;
            })
            ->rawColumns(['action'])
            ->make(true);
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

        if ($request->jenis_data == 'Data Lama') {
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

            $validator = Validator::make($request->only(['no_kk', 'jenis_data']), [
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
        } else if ($request->jenis_data == 'Data Baru') {
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
            if (FormStateKeluarga::getKartuKeluarga() && (isset($validator_file) && !$validator_file->fails())) {
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
            $pengajuan = new Pengajuan();
            $pengajuan->keluarga->kepala_keluarga = $request->kepala_keluarga ?? null;
            return redirect()->route('tambah-warga', ['no_kk' => $request->no_kk]);
        }
        $pengajuan = new Pengajuan();

        if (!$pengajuan->haveWarga()) {
            return redirect()->back()->with('flash', (object) [
                'type' => 'error',
                'message' => 'Gagal! Tidak ada data warga yang ditambahkan.'
            ])->withInput();
        }

        $request->validate([
            'kepala_keluarga' => 'required|max:100'
        ], [
            'kepala_keluarga.required' => 'Tambahkan minimal 1 warga sebagai kepala keluarga.'
        ]);

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

        $pengajuan->keluarga = $keluarga;
        $pengajuan->store();

        return redirect()->route('keluarga')->with('flash', (object) [
            'type' => 'success',
            'message' => 'Data yang ditambahkan berhasil dikirim.'
        ]);
        // return redirect()->route('keluarga');
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

        $rules = [
            'kepala_keluarga' => 'required',
            'tagihan_listrik' => 'required',
            'luas_bangunan' => 'required',
        ];

        try {
            DB::beginTransaction();
            if ($request->hasFile('kartu_keluarga')) {
                $validator_file = Validator::make($request->only('kartu_keluarga'),[
                    'kartu_keluarga' => 'required|file|image|mimes:jpeg,jpg,png|max:2048'
                ]);
            }

            if (isset($validator_file) && !$validator_file->fails()) {
                $filename = Str::uuid()->getHex()->toString();
                $extension = $request->file('kartu_keluarga')->getClientOriginalExtension();
                $filenameSimpan = $filename . '.' . $extension;
                $request->file('kartu_keluarga')->storeAs('', $filenameSimpan, 'temp');
            }

            if (session()->exists('kartu_keluarga') && (isset($validator_file) && !$validator_file->fails() )) {
                Storage::disk('temp')->delete(session()->get('kartu_keluarga')->path);
            }

            $validator = Validator::make($request->only(['no_kk', 'tagihan_listrik', 'luas_bangunan', 'kepala_keluarga']), $rules);

            if ( isset($validator_file) && !$validator_file->fails() && $validator->fails()) {
                session()->put('kartu_keluarga', (object) [
                    'path' => $filenameSimpan,
                    'ext' => explode('.', $filenameSimpan)[1],
                ]);
            }

            // dd($validator->errors());
            if ($validator->fails()  || (isset($validator_file) && $validator_file->fails())) {
                if (isset($validator_file)) {
                    $errors = $validator->errors()->merge($validator_file);
                }

                return redirect()->back()
                    ->withErrors(isset($errors) ? $errors : $validator->errors())
                    ->withInput();
            }

            $keluarga->fill($request->only(['no_kk', 'tagihan_listrik', 'luas_bangunan']));
            $keluarga->kepala_keluarga = Warga::find($request->kepala_keluarga)->nama;

            if (isset($filenameSimpan)) {
                $keluarga->image_kk = $filenameSimpan;
            }

            if (empty($keluarga->getDirty())) {
                return redirect()->route('penduduk.keluarga.detail', ['no_kk' => $request->no_kk])->with('flash',(object) ['type'=>'information','message'=> 'Tidak ada data yang diubah.']);
            }

            // perubahan warga akan disimpan pada tabel warga Modified, untuk menunggu dikonfirmasi oleh ketua RW.
            KeluargaModified::updateKeluarga($keluarga);

            PengajuanData::create([
                'user_id' => Auth::user()->user_id,
                'no_kk' => $keluarga->no_kk,
                'tanggal_request' => now(),
                'status_request' => 'Menunggu',
                'tipe' => 'Perubahan Keluarga'
            ]);

            if (session()->has('kartu_keluarga')) {
                session()->forget('kartu_keluarga');
            }
            DB::commit();
            return redirect()->route('penduduk.keluarga.detail', ['no_kk' => $request->no_kk])->with('flash',(object) ['type' => 'success', 'message' => 'Permintaan perubahan data Terkirim!']);

        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('penduduk.keluarga.detail', ['no_kk' => $request->no_kk])->with('flash', (object) ['type'=>'danger', 'message'=>'Perubahan data gagal!']);
        }

    }


    /**
     * Fungsi untuk menghapus anggota keluarga yang disimpan sementara.
     *
     * @param integer $idx
     * @return \Illuminate\Http\RedirectResponse
     */
    function removeAnggotaKeluarga($nik)
    {
        // Warga::removeTemp($idx);
        $pengajuan = new Pengajuan();
        $pengajuan->removeWarga($nik);
        return redirect(route('keluarga-tambah') . '#anggota_keluarga');
    }

    function detailAnggotaKeluarga_temp($nik)
    {
        $pengajuan = new Pengajuan();
        $data_warga = $pengajuan->getWarga($nik);

        if (!$data_warga) {
            return redirect()->back()->with('flash', (object) ['type' => 'error', 'message'=> 'Data tidak tersedia.']);
        }

        $warga = $data_warga['warga'];
        $haveDemografi = $data_warga['haveDemografi'];
        $demografi = $data_warga['demografi'];
        return view('pengajuan.pembaharuan.detailwarga', compact(['warga', 'haveDemografi', 'demografi']));
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

        $pengajuanInProgres = PengajuanData::where('no_kk', '=', $keluarga->no_kk)
            ->where('status_request','=', 'Menunggu')
            ->orderBy('tanggal_request', 'DESC')
            ->first();

        return view('penduduk.keluarga.detail', compact(['keluarga', 'pengajuanInProgres']));
    }

    public function back()
    {
        FormStateKeluarga::clear();

        session()->forget('berkas_demografi');
        session()->save();

        $pengajuan = new Pengajuan();
        $pengajuan->clear();

        return redirect()->route('penduduk.warga');
    }
}
