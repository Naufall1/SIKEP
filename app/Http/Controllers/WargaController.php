<?php

namespace App\Http\Controllers;

use App\Models\Demografi;
use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\Pengajuan;
use App\Models\Warga;
use App\Models\WargaModified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class WargaController extends Controller
{
    public function getAll()
    {
        return Warga::select(['nik', 'nama'])->get();
    }
    public function getWarga($nik)
    {
        return Warga::find($nik);
    }
    public function list()
    {
        $user = Auth::user();

        if ($user->keterangan == 'ketua') {
            $daftar_warga = Warga::select('warga.*')
                ->join('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')
                ->get();
        } else {
            $daftar_warga = Warga::select('warga.*', 'keluarga.rt')
                ->join('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')
                ->join('user', function ($join) use ($user) {
                    $join->on('keluarga.rt', '=', 'user.keterangan')
                        ->where('keluarga.rt', '=', $user->keterangan);
                })
                ->get();
        }

        return DataTables::of($daftar_warga)
            ->addIndexColumn() // menambahkan kolom index / no urut (default namakolom: DT_RowIndex)
            ->addColumn('action', function ($warga) {
                return '
                <td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                    <a href="'. route('wargaDetail', [$warga->NIK]) .'"
                        class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                        Detail
                    </a>
                </td>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function index()
    {
        return view('penduduk.warga.index');
    }
    public function create($no_kk)
    {
        $user = Auth::user();

        $daftarWarga = Warga::select('warga.*', 'keluarga.rt')
        ->join('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')
        ->join('user', function ($join) use ($user) {
            $join->on('keluarga.rt', '=', 'user.keterangan')
                ->where('keluarga.rt', '=', $user->keterangan);
        })
        ->where('status_warga', '!=', 'Menunggu')
        ->where('warga.no_kk', '!=', $no_kk)
        ->get();
        return view('penduduk.warga.tambah', compact('daftarWarga'))->with('no_kk', $no_kk);
    }
    public function store(Request $request)
    {
        // Validasi data yang masuk
        if (!session()->exists('berkas_demografi') || $request->has('berkas_demografi')) {
            $validator_file = Validator::make($request->only('berkas_demografi'),[
                'berkas_demografi' => 'required|file|image|mimes:jpeg,jpg,png|max:2048'
            ]);
        }

        if (isset($validator_file) && !$validator_file->fails()) {
            $filename = Str::uuid()->getHex()->toString();
            $extension = $request->file('berkas_demografi')->getClientOriginalExtension();
            $filenameSimpan = $filename . '.' . $extension;
            $request->file('berkas_demografi')->storeAs('', $filenameSimpan, 'temp');
        }

        $validator = Validator::make($request->all(), [
            'NIK' => 'required|size:16|unique:warga,NIK',
            'no_kk' => 'required',
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:50',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'jenis_pekerjaan' => 'required|string|max:50',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'status_keluarga' => 'required|in:Kepala Keluarga,Istri,Anak',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            // 'status_warga' => 'required|in:Aktif,Meninggal,Migrasi,Menunggu',
            'penghasilan' => 'required|integer',
            'no_paspor' => 'nullable|string|max:10',
            'no_kitas' => 'nullable|string|max:10',
            'jenis_demografi' => 'required|in:Lahir,Meninggal,Migrasi Masuk,Migrasi Keluar',
            'tanggal_kejadian' => 'required|date',
        ]);

        if (session()->exists('berkas_demografi') && (isset($validator_file) && !$validator_file->fails() )) {
            Storage::disk('temp')->delete(session()->get('berkas_demografi')->path);
        }
        if ( isset($validator_file) && !$validator_file->fails() && $validator->fails()) {
            session()->put('berkas_demografi', (object) [
                'path' => $filenameSimpan,
                'ext' => explode('.', $filenameSimpan)[1],
                'base64' => base64_encode(Storage::disk('temp')->get($filenameSimpan))
            ]);
        }

        // Manual Redirect
        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors(isset($validator_file) ? $validator->errors()->merge($validator_file) : $validator->errors())
                ->withInput();
        }
        // Mapping data dari request menuju objek
        $warga = new Warga();
        $warga->NIK = $request->NIK;
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

        $demografi = new Demografi();
        $demografi->user_id = Auth::user()->user_id;
        $demografi->jenis = $request->jenis_demografi;

        $haveDemografi = new HaveDemografi();
        $haveDemografi->NIK = $warga->NIK;
        $haveDemografi->tanggal_kejadian = $request->tanggal_kejadian;
        $haveDemografi->tanggal_request = now();
        $haveDemografi->dokumen_pendukung = isset($filenameSimpan) ? $filenameSimpan : session()->get('berkas_demografi')->path;
        $haveDemografi->status_request = 'Menunggu';

        $pengajuan = new Pengajuan();
        $pengajuan->tambahWarga($warga, $demografi, $haveDemografi);
        session()->forget('berkas_demografi');

        // $warga->storeTemp();
        return redirect()->route('keluarga-tambah');
    }
    public function edit($nik)
    {
        $warga = Warga::find($nik);
        if (!$warga) {
            return redirect()->back();
        }
        return view('penduduk.warga.edit', compact('warga'));
    }
    public function update(Request $request, $nik)
    {
        // TODO: add validation

        if (!Warga::find($nik)) {
            return redirect()->route('warga')->with('danger', 'Data tidak ditemukan');
        }
        $warga = Warga::find($nik);
        $warga->agama = $request->agama;
        $warga->status_perkawinan = $request->status_perkawinan;
        $warga->status_keluarga = $request->status_keluarga;
        $warga->status_warga = $request->status_warga;
        $warga->jenis_pekerjaan = $request->jenis_pekerjaan;
        $warga->penghasilan = $request->penghasilan;
        $warga->pendidikan = $request->pendidikan;

        // perubahan warga akan disimpan pada tabel warga Modified, untuk menunggu dikonfirmasi oleh ketua RW.
        WargaModified::updateWarga($warga);

        return redirect()->route('wargaDetail', ['nik' => $request->nik]);
    }
    /**
     * fungsi untuk merubah no_kk dari sebuah warga,
     * kemudian disimpan sementara pada session daftarWarga sampai dilakukan simpan permanen.
     */
    public function pindahKK(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NIK' => 'required|size:16|exists:warga,NIK',
            'no_kk' => 'required',
            'status_keluarga' => 'required|in:Kepala Keluarga,Istri,Anak'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->with('data_lama', true)
            ->withErrors($validator->errors())
            ->withInput();
        }
        // dd($request->all());
        // $warga = Warga::find($request->NIK);
        // $warga->no_kk = $request->no_kk;
        // $warga->storeTemp();
        $pengajuan = new Pengajuan();
        $pengajuan->pindahKK(Warga::find($request->NIK));
        return redirect()->route('keluarga-tambah');
    }

    public function detail($nik)
    {
        $warga = Warga::with(['keluarga', 'haveDemografi', 'haveDemografi.demografi'])->find($nik);
        if (!$warga) {
            return redirect()->back();
        }
        return view('penduduk.warga.detail', compact('warga'));
    }
}
