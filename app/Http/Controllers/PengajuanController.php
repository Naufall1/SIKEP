<?php

namespace App\Http\Controllers;

use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaHistory;
use App\Models\KeluargaModified;
use App\Models\Pengajuan;
use App\Models\PengajuanData;
use App\Models\Warga;
use App\Models\WargaHistory;
use App\Models\WargaModified;
use App\Rules\PengajuanNotConfirmed;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PengajuanController extends Controller
{
    public function index()
    {
        Storage::disk('public');
        return view('pengajuan.index');
    }

    public function list()
    {
        if (Auth::user()->hasLevel['level_kode'] == 'RW') {
            $pengajuan =  PengajuanData::with(['user', 'keluarga'])
                            ->orderBy('id', 'desc')
                            ->get();
        } else if (Auth::user()->hasLevel['level_kode'] == 'RT') {
            $pengajuan =  PengajuanData::with(['user', 'keluarga'])
                            ->where('user_id', '=', Auth::user()->user_id)
                            ->orderBy('id', 'desc')
                            ->get();
        }

        return DataTables::of($pengajuan)
            ->addIndexColumn()
            ->addColumn('status', function ($pengajuan) {
                return view('components.form.label', ['content' => $pengajuan->status_request])->render();
            })
            ->addColumn('aksi', function ($pengajuan) {
                switch ($pengajuan->tipe) {
                    case 'Pembaruan':
                        $btn = '<a href="' . route('pengajuan.pembaharuan', ['id' => $pengajuan->id]) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                        break;
                    case 'Perubahan Keluarga':
                        $btn = '<a href="' . route('pengajuan.perubahankeluarga', ['id' => $pengajuan->id]) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                        break;
                    case 'Perubahan Warga':
                        $btn = '<a href="' . route('pengajuan.perubahanwarga', ['id' => $pengajuan->id]) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                        break;
                }
                return $btn;
            })
            ->rawColumns(['status', 'aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    /**
     * Fungsi-fungsi untuk jenis pengajuan Pembaharuan
     */
    public function showPembaharuan($id)
    {
        $user = Auth::user()->level_id;
        $pengajuan = PengajuanData::with('keluarga')->find($id);

        return view('pengajuan.pembaharuan.detail', compact(['user', 'pengajuan']));
    }
    public function listWarga(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);
        $request->validate([
            'id' => 'required|exists:pengajuan,id'
        ]);

        $pengajuan = PengajuanData::find($request->id);
        // Ambil Nomor KK dari pengajuan yang dipilih
        $no_kk = $pengajuan->no_kk;
        // Ambil daftar anggota keluarga asli
        $daftarWarga = Warga::where('no_kk', '=', $no_kk)
                                ->where('status_warga', '!=', 'Menunggu')
                                ->where('created_at', '<=', $pengajuan->tanggal_request)
                                ->get();
        // Ambil daftar anggota keluarga yang ditambahkan dari data baru
        $daftarWargaBaru = Warga::where('no_kk', '=', $no_kk)
                                ->where('status_warga', '=', 'Menunggu')
                                ->where('created_at', '<=', $pengajuan->tanggal_request)
                                ->get();
        // Ambil daftar anggota keluarga yang berasal dari pindah KK
        $daftarWargaPindahKK = WargaModified::where('no_kk', '=', $no_kk)->where('status_request', '=', 'Menunggu')->get();

        // Ambil data warga dari tabel WargaModified
        if ($daftarWargaPindahKK) {
            $warga = [];
            foreach ($daftarWargaPindahKK as $wargaMod) {
                $tmp = Warga::find($wargaMod->NIK);
                $tmp->status_warga = 'Menunggu';
                // Tambahkan keterangan `(Baru)` pada nama anggota keluarga
                $tmp->nama = $tmp->nama . ' (Baru)';
                $warga[] = $tmp;
            }
        }
        if ($daftarWargaBaru) {
            // Tambahkan keterangan `(Baru)` pada setiap nama anggota keluarga
            foreach ($daftarWargaBaru as $tmp) {
                $tmp->nama = $tmp->nama . ' (Baru)';
            }
            // Gabungkan data anggota keluarga asli dengan anggota keluarga baru
            $daftarWarga = $daftarWarga->merge($daftarWargaBaru);
        }
        if ($daftarWargaPindahKK) {
            // Gabungkan data anggota keluarga asli dengan anggota keluarga pindah KK
            $daftarWarga = $daftarWarga->merge($warga);
        }

        return DataTables::of($daftarWarga)
            ->addIndexColumn()
            ->addColumn('aksi', function ($warga) use ($request) {
                $btn = '<a href="' . route('pengajuan.pembaharuan.detailwarga', ['id' => $request->id, 'nik' => $warga->NIK]) . '" class="tw-btn tw-btn-primary tw-btn-round-md tw-btn-md"> Detail </a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function confirmPembaharuan(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:pengajuan,id', new PengajuanNotConfirmed]
        ]);

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanData::find($request->id);
            $keluarga = Keluarga::find($pengajuan->no_kk);

            if ($keluarga->status == 'Menunggu') {
                $keluarga->status = 'Aktif';
            }

            $wargaModfied = WargaModified::where('no_kk', '=', $keluarga->no_kk)
                ->where('status_request', '=', 'Menunggu')
                ->get();

            if (count($wargaModfied) > 0) {
                foreach ($wargaModfied as $wargaMod) {
                    Warga::applyModifications($wargaMod);
                    WargaHistory::track(Warga::find($wargaMod->NIK));
                    $wargaMod->save();
                }
            }

            $wargaNew = Warga::where('no_kk', '=', $keluarga->no_kk)
                ->where('status_warga', '=', 'Menunggu')
                ->get();

            if (count($wargaNew) > 0) {
                foreach ($wargaNew as $wargaN) {
                    $wargaN->status_warga = 'Aktif';
                    $demografiWarga = HaveDemografi::where('NIK', '=', $wargaN->NIK)
                        ->where('status_request', '=', 'Menunggu')
                        ->first();
                    $demografiWarga->status_request = 'Dikonfirmasi';
                    $wargaN->save();
                    $demografiWarga->save();
                }
            }

            $pengajuan->status_request = 'Dikonfirmasi';

            $keluarga->save();
            $pengajuan->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil Dikonfirmasi');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Melakukan Konfirmasi');
        }
    }

    /**
     * Fungsi-fungsi untuk jenis pengajuan Perubahan Keluarga
     */
    public function showPerubahanKeluarga(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);
        $request->validate([
            'id' => 'required|exists:pengajuan,id'
        ]);

        $user = Auth::user()->level_id;
        $pengajuan = PengajuanData::with('keluarga')->find($request->id);

        if ($pengajuan->status_request == 'Menunggu') {
            $currentKeluarga = Keluarga::find($pengajuan->no_kk);
            $modifiedKeluarga = KeluargaModified::where('no_kk', '=', $pengajuan->no_kk)
                                    ->where('tanggal_request', '=', $pengajuan->tanggal_request)
                                    ->where('status_request', '=', 'Menunggu')
                                    ->first();
        } else if ($pengajuan->status_request == 'Dikonfirmasi') {
            $currentKeluarga = KeluargaHistory::where('no_kk', '=', $pengajuan->no_kk)
                                    ->where('valid_from', '<=', $pengajuan->tanggal_request)
                                    ->orderBy('valid_to', 'desc')
                                    ->first();
            $modifiedKeluarga = KeluargaHistory::where('no_kk', '=', $pengajuan->no_kk)
                                    ->where('valid_from', '>=', $pengajuan->tanggal_request)
                                    ->orderBy('valid_from', 'asc')
                                    ->first();
            if (!$modifiedKeluarga) {
                $modifiedKeluarga = KeluargaModified::where('tanggal_request', '=', $pengajuan->tanggal_request)->first();
            }
        }

        return view('pengajuan.perubahankeluarga.detail', compact(['user', 'pengajuan', 'currentKeluarga', 'modifiedKeluarga']));
    }
    public function confirmPerubahanKeluarga(Request $request)
    {
        // $request->merge(['id' => $request->route('id')]);
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:pengajuan,id', new PengajuanNotConfirmed]
        ]);

        // dd($validator->fails());

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanData::with('keluarga')->find($request->id);
            $modifiedKeluarga = KeluargaModified::where('no_kk', '=', $pengajuan->no_kk)
                ->where('tanggal_request', '=', $pengajuan->tanggal_request)
                ->where('status_request', '=', 'Menunggu')
                ->first();

            if (!Keluarga::applyModifications($modifiedKeluarga)){
                throw new Exception('Gagal menyimpan perubahan kedalam table Keluarga.');
            }

            $pengajuan->status_request = 'Dikonfirmasi';
            $pengajuan->save();

            DB::commit();
            return redirect()->route('pengajuan')->with('flash', (object) ['status'=>'success', 'message'=>'Berhasil dikonfirmasi.']);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('flash', (object) ['status'=>'error', 'message'=>'Pengajuan gagal dikonfirmasi.']);
        }
    }

    /**
     * Fungsi-fungsi untuk jenis pengajuan Perubahan Keluarga
     */
    public function showPerubahanWarga(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);

        $request->validate([
            'id' => 'required|exists:pengajuan,id'
        ]);

        $user = Auth::user()->level_id;
        $pengajuan = PengajuanData::with('keluarga')->find($request->id);

        if ($pengajuan->status_request == 'Menunggu') {
            $modifiedWarga = WargaModified::where('no_kk', '=', $pengajuan->no_kk)
                                    // ->where('tanggal_request', '=', $pengajuan->tanggal_request)
                                    ->where('status_request', '=', 'Menunggu')
                                    ->first();

            $currentWarga = Warga::find($modifiedWarga->NIK);
            $demografiKeluarNew = HaveDemografi::getDemografiKeluar($modifiedWarga->NIK, 'Menunggu');
            $demografiMasukNew = HaveDemografi::getDemografiMasuk($modifiedWarga->NIK, 'Menunggu');
            $demografiKeluarOld = HaveDemografi::getDemografiKeluar($modifiedWarga->NIK, 'Dikonfirmasi', valid_before:$pengajuan->tanggal_request);
            $demografiMasukOld = HaveDemografi::getDemografiMasuk($modifiedWarga->NIK, 'Dikonfirmasi', valid_before:$pengajuan->tanggal_request);

        } else if ($pengajuan->status_request == 'Dikonfirmasi') {
            $warga = WargaModified::where('no_kk', '=', $pengajuan->no_kk)
                        ->where('tanggal_request', '>=', Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'))
                        ->orderBy('id_modify_warga', 'asc')
                        ->first();
// dd($warga);
            $currentWarga = WargaHistory::where('NIK', '=', $warga->NIK)
                                    ->where('valid_from', '<=', $pengajuan->tanggal_request)
                                    ->orderBy('valid_to', 'desc')
                                    ->first();
            $modifiedWarga = WargaHistory::where('NIK', '=', $warga->NIK)
                                    ->where('valid_from', '>=', $pengajuan->tanggal_request)
                                    ->orderBy('valid_from', 'asc')
                                    ->first();
            if (!$modifiedWarga) {
                $modifiedWarga = WargaModified::where('NIK', '=', $warga->NIK)->where('status_request', '=', 'Dikonfirmasi')->orderBy('id_modify_warga', 'desc')->first();
            }

            $demografiKeluarNew = HaveDemografi::getDemografiKeluar($warga->NIK, 'Dikonfirmasi', tanggal_request:Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'));
            $demografiMasukNew = HaveDemografi::getDemografiMasuk($warga->NIK, 'Dikonfirmasi', tanggal_request:Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'));
            $demografiKeluarOld = HaveDemografi::getDemografiKeluar($warga->NIK, 'Dikonfirmasi', valid_before:Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'));
            $demografiMasukOld = HaveDemografi::getDemografiMasuk($warga->NIK, 'Dikonfirmasi', valid_before:Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'));
            // dd($demografiKeluarOld,$demografiMasukOld, $pengajuan->tanggal_request);
        }

        return view('pengajuan.perubahanwarga.detail', compact(['user', 'pengajuan', 'currentWarga', 'modifiedWarga', 'demografiKeluarNew', 'demografiMasukNew', 'demografiKeluarOld', 'demografiMasukOld']));
    }
    public function confirmPerubahanWarga(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:pengajuan,id', new PengajuanNotConfirmed]
        ]);

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanData::with('keluarga')->find($request->id);
            $modifiedWarga = WargaModified::where('no_kk', '=', $pengajuan->no_kk)
                                    // ->where('tanggal_request', '=', $pengajuan->tanggal_request)
                                    ->where('status_request', '=', 'Menunggu')
                                    ->first();
            $currentWarga = Warga::find($modifiedWarga->NIK);

            if ($modifiedWarga->status_warga != $currentWarga->status_warga) {
                $have_demografi = HaveDemografi::where('NIK', '=', $modifiedWarga->NIK)
                                    // ->where('tanggal_request', '=', $pengajuan->tanggal_request)
                                    ->where('status_request', '=', 'Menunggu')
                                    ->first();
                $have_demografi->status_request = 'Dikonfirmasi';
                $res = Storage::disk('local')->put(
                    'public/Dokumen-Pendukung/' . $have_demografi->dokumen_pendukung,
                    Storage::disk('temp')->get($have_demografi->dokumen_pendukung),
                );
                if (!$res) {
                    throw new Exception('Failed to move file from temporary');
                }
                $have_demografi->save();
            }

            if (in_array($modifiedWarga->status_warga, ['Lahir', 'Migrasi Masuk'])) {
                $modifiedWarga->status_warga = 'Aktif';
            }

            WargaHistory::track(Warga::find($modifiedWarga->NIK));

            if (!Warga::applyModifications($modifiedWarga)){
                throw new Exception('Gagal menyimpan perubahan kedalam table Keluarga.');
            }

            $pengajuan->status_request = 'Dikonfirmasi';
            $pengajuan->save();

            DB::commit();
            return redirect()->route('pengajuan')->with('flash', (object) ['status'=>'success', 'message'=>'Berhasil dikonfirmasi.']);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('flash', (object) ['status'=>'error', 'message'=>'Pengajuan gagal dikonfirmasi.']);
        }
    }

    public function confirm($id)
    {
        $data = Keluarga::find($id);
        $data->status = 'confirm';
        $data->save();
        return redirect()->route('pengajuan.index')->with('flash', 'success');
    }
    public function reject($id)
    {
        $data = Keluarga::find($id);
        $data->status = 'reject';
        $data->save();
        return redirect()->route('pengajuan.index')->with('flash', 'danger');
    }
}
