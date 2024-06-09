<?php

namespace App\Http\Controllers;

use App\Models\HaveDemografi;
use App\Models\Keluarga;
use App\Models\KeluargaHistory;
use App\Models\KeluargaModified;
use App\Models\PengajuanData;
use App\Models\Warga;
use App\Models\WargaHistory;
use App\Models\WargaModified;
use App\Rules\PengajuanNotConfirmed;
use Carbon\Carbon;
use Exception;
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

    public function list(Request $request)
    {
        $request->validate([
            'scope_data' => 'max:8',
            'jenis' => 'array|max:3',
            'jenis.*' => 'string|in:Perubahan Warga,Perubahan Keluarga,Pembaruan',
            'status_pengajuan' => 'array|max:3',
            'status_pengajuan.*' => 'string|in:Menunggu,Dikonfirmasi,Ditolak',
        ]);

        $select = [
            'pengajuan.user_id',
            'pengajuan.id',
            'pengajuan.no_kk',
            'pengajuan.tipe',
            'pengajuan.tanggal_request',
            'pengajuan.status_request'
        ];
        $with = [
            'user:user_id,nama',
            'keluarga:no_kk,kepala_keluarga'
        ];

        if (Auth::user()->hasLevel['level_kode'] == 'RW') {
            $query = PengajuanData::select($select)
                            ->with($with)
                            ->join('keluarga', 'keluarga.no_kk', '=', 'pengajuan.no_kk')
                            ->orderBy('id', 'desc');

            if (explode(" ", $request->scope_data)[1] ?? false) {
                $query->where('keluarga.RT', '=', (int)explode(" ", $request->scope_data)[1]);
            }

            if (isset($request->jenis)) {
                $query->whereIn('pengajuan.tipe', $request->jenis);
            }

            if (isset($request->status_pengajuan)) {
                $query->whereIn('pengajuan.status_request', $request->status_pengajuan);
            }

            $pengajuan = $query->get();
        } else if (Auth::user()->hasLevel['level_kode'] == 'RT') {
            $query = PengajuanData::select($select)
                            ->with($with)
                            ->where('user_id', '=', Auth::user()->user_id)
                            ->orderBy('id', 'desc');

            if (isset($request->jenis)) {
                $query->whereIn('pengajuan.tipe', $request->jenis);
            }

            if (isset($request->status_pengajuan)) {
                $query->whereIn('pengajuan.status_request', $request->status_pengajuan);
            }

            $pengajuan = $query->get();
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

        $select = [
            'NIK',
            'nama',
            'status_keluarga'
        ];

        $pengajuan = PengajuanData::find($request->id);
        // Ambil Nomor KK dari pengajuan yang dipilih
        $no_kk = $pengajuan->no_kk;

        if ($pengajuan->status_request == 'Ditolak') {
            // Ambil daftar anggota keluarga asli
            $daftarWarga = Warga::select($select)
                                    ->where('no_kk', '=', $no_kk)
                                    ->whereIn('status_warga',['Tidak Aktif'])
                                    ->where('created_at', '<=', $pengajuan->tanggal_request)
                                    ->get();
            // Ambil daftar anggota keluarga yang ditambahkan dari data baru
            $daftarWargaBaru = Warga::select($select)
                                    ->where('no_kk', '=', $no_kk)
                                    ->where('status_warga', '=', 'Tidak Aktif')
                                    ->where('created_at', '<', $pengajuan->getNext()->tanggal_request)
                                    ->where('created_at', '>', $pengajuan->getPrev()->tanggal_request)
                                    ->get();
            // Ambil daftar anggota keluarga yang berasal dari pindah KK
            $daftarWargaPindahKK = WargaModified::select($select)
                                                ->where('no_kk', '=', $no_kk)
                                                ->where('status_request', '=', 'Ditolak')
                                                ->where('tanggal_request', '<', $pengajuan->getNext()->tanggal_request)
                                                ->where('tanggal_request', '>', $pengajuan->getPrev()->tanggal_request)
                                                ->get();
        } else {
            // Ambil daftar anggota keluarga asli
            $daftarWarga = Warga::select($select)
                                    ->where('no_kk', '=', $no_kk)
                                    ->whereNotIn('status_warga',['Tidak Aktif'])
                                    ->where('created_at', '<=', $pengajuan->tanggal_request)
                                    ->get();
            // Ambil daftar anggota keluarga yang ditambahkan dari data baru
            $daftarWargaBaru = Warga::select($select)
                                    ->where('no_kk', '=', $no_kk)
                                    ->where('status_warga', '=', 'Menunggu')
                                    ->where('created_at', '<', $pengajuan->getNext()->tanggal_request)
                                    ->where('created_at', '>', $pengajuan->getPrev()->tanggal_request)
                                    ->get();
            // Ambil daftar anggota keluarga yang berasal dari pindah KK
            $daftarWargaPindahKK = WargaModified::select($select)
                                                ->where('no_kk', '=', $no_kk)
                                                ->where('status_request', '=', 'Menunggu')
                                                ->where('tanggal_request', '<', $pengajuan->getNext()->tanggal_request)
                                                ->where('tanggal_request', '>', $pengajuan->getPrev()->tanggal_request)
                                                ->get();
        }

        // Ambil data warga dari tabel WargaModified
        if ($daftarWargaPindahKK) {
            $warga = [];
            foreach ($daftarWargaPindahKK as $wargaMod) {
                $tmp = $wargaMod;
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
            // $daftarWarga = $daftarWarga->merge($warga);
            foreach ($warga as $key => $value) {
                $daftarWarga->push($value);
            }
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
    public function detailWarga(Request $request)
    {
        $request->merge(['id' => $request->route('id')]);
        $request->merge(['nik' => $request->route('nik')]);

        $request->validate([
            'id' => 'required|exists:pengajuan,id',
            'nik' => 'required|exists:warga,NIK'
        ]);

        $id = $request->id;

        $pengajuan = PengajuanData::find($request->id);
        // Ambil Nomor KK dari pengajuan yang dipilih
        $no_kk = $pengajuan->no_kk;
        // Ambil daftar anggota keluarga asli / baru
        $wargaNew = Warga::where('NIK', '=', $request->nik)
                                ->where('created_at', '<=', $pengajuan->tanggal_request)
                                ->first();

        // Ambil daftar anggota keluarga yang berasal dari pindah KK
        $wargaPindahKK = WargaModified::where('no_kk', '=', $no_kk)->where('status_request', '=', 'Menunggu')->first();
        $warga = $wargaNew ?? $wargaPindahKK;

        $haveDemografi = HaveDemografi::with('demografi')->where('NIK', '=', $warga->NIK)
                                ->where('tanggal_request', '<=', $pengajuan->tanggal_request)
                                ->orderByDesc('tanggal_request')
                                ->first();

        return view('pengajuan.pembaharuan.detailwarga', compact(['warga', 'haveDemografi', 'id']));
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
                ->where('created_at', '<', $pengajuan->getNext()->tanggal_request)
                ->where('created_at', '>', $pengajuan->getPrev()->tanggal_request)
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
            return redirect()->back()->with('flash', (object) ['type'=>'success', 'message'=>'Berhasil Dikonfirmasi']);
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            return redirect()->back()->with('flash', (object) ['type'=>'error', 'message'=>'Gagal Melakukan Konfirmasi']);
        }
    }

    public function rejectPembaharuan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:pengajuan,id', new PengajuanNotConfirmed],
            'catatan' => 'required|string'
        ], [
            'catatan.required' => 'Masukkan Catatan',
        ]);

        if ($validator->fails()) {
            session()->flash('flash', (object) ['type'=>'error', 'message'=>$validator->errors()->first()]);
            return redirect()->back();
        }
        try {
            DB::beginTransaction();

            $pengajuan = PengajuanData::find($request->id);
            $keluarga = Keluarga::find($pengajuan->no_kk);

            $wargaModfied = WargaModified::where('no_kk', '=', $keluarga->no_kk)
                ->where('status_request', '=', 'Menunggu')
                ->get();

            if (count($wargaModfied) > 0) {
                foreach ($wargaModfied as $wargaMod) {
                    $wargaMod->status_request = 'Ditolak';
                    $wargaMod->save();
                }
            }

            $wargaNew = Warga::where('no_kk', '=', $keluarga->no_kk)
                ->where('status_warga', '=', 'Menunggu')
                ->get();

            if (count($wargaNew) > 0) {
                foreach ($wargaNew as $wargaN) {
                    $wargaN->status_warga = 'Tidak Aktif';
                    $demografiWarga = HaveDemografi::where('NIK', '=', $wargaN->NIK)
                        ->where('status_request', '=', 'Menunggu')
                        ->first();
                    $demografiWarga->status_request = 'Ditolak';
                    $wargaN->save();
                    $demografiWarga->save();
                }
            }

            $pengajuan->status_request = 'Ditolak';
            $pengajuan->catatan = $request->catatan;
            if ($keluarga->status != 'Aktif') {
                $keluarga->status = 'Tidak Aktif';
            }

            $keluarga->save();
            $pengajuan->save();

            DB::commit();
            return redirect()->back()->with('flash', (object) ['type'=>'success', 'message'=>'Berhasil ditolak.']);
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('flash', (object) ['type'=>'error', 'message'=>'Pengajuan gagal ditolak.']);
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
        } else if ($pengajuan->status_request == 'Ditolak')
        {
            $currentKeluarga = KeluargaHistory::where('no_kk', '=', $pengajuan->no_kk)
                                    ->where('valid_to', '>=', $pengajuan->tanggal_request)
                                    ->orderBy('valid_to', 'desc')
                                    ->first();
            if(!$currentKeluarga){
                $currentKeluarga = $pengajuan->keluarga;
            }

            $modifiedKeluarga = KeluargaModified::where('no_kk', '=', $pengajuan->no_kk)
                                    ->where('status_request', '=', 'Ditolak')
                                    ->where('tanggal_request', '>=', Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'))
                                    ->orderBy('id_modify_keluarga', 'asc')
                                    ->first();
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

            // Check if kepala keluarga changed
            $keluarga = Keluarga::find($pengajuan->no_kk);
            $old_kepala_keluarga_nik = Warga::select('*')
                                        ->where('no_kk', '=', $keluarga->no_kk)
                                        ->where('nama', '=', $keluarga->kepala_keluarga)
                                        ->get()
                                        ->first();
            $old_kepala_keluarga = Warga::find($old_kepala_keluarga_nik->NIK);
            $new_kepala_keluarga = Warga::select('*')->where('nama', '=' ,$modifiedKeluarga->kepala_keluarga)->get()->first();
            if ($old_kepala_keluarga->nama != $new_kepala_keluarga->nama) {
                // Change status keluarga on old kepala keluarga to 'Lainnya'
                $old_kepala_keluarga->status_keluarga = 'Lainnya';
                WargaModified::updateWarga($old_kepala_keluarga);
                Warga::applyModifications(WargaModified::getMenunggu($old_kepala_keluarga->no_kk));

                // Change status keluarga on new kepala keluarga to 'Kepala Keluarga'
                $new_kepala_keluarga->status_keluarga = 'Kepala Keluarga';
                WargaModified::updateWarga($new_kepala_keluarga);
                Warga::applyModifications(WargaModified::getMenunggu($new_kepala_keluarga->no_kk));
            }

            if (!Keluarga::applyModifications($modifiedKeluarga)){
                throw new Exception('Gagal menyimpan perubahan kedalam table Keluarga.');
            }

            if ($pengajuan->keluarga->image_kk != $modifiedKeluarga->image_kk) {
                $res = Storage::disk('local')->put(
                    'public/KK/' . $modifiedKeluarga->image_kk,
                    Storage::disk('temp')->get($modifiedKeluarga->image_kk),
                );
                if (!$res) {
                    throw new Exception('Failed to move file from temporary');
                }
                Storage::disk('temp')->delete($modifiedKeluarga->image_kk);
            }

            $pengajuan->status_request = 'Dikonfirmasi';
            $pengajuan->save();

            DB::commit();
            return redirect()->back()->with('flash', (object) ['type'=>'success', 'message'=>'Berhasil dikonfirmasi.']);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('flash', (object) ['type'=>'error', 'message'=>'Pengajuan gagal dikonfirmasi.']);
        }
    }

    public function rejectPerubahanKeluarga(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:pengajuan,id', new PengajuanNotConfirmed],
            'catatan' => 'required|string'
        ], [
            'catatan.required' => 'Masukkan Catatan',
        ]);

        if ($validator->fails()) {
            session()->flash('flash', (object) ['type'=>'error', 'message'=>$validator->errors()->first()]);
            return redirect()->back();
        }

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanData::with('keluarga')->find($request->id);
            $modifiedKeluarga = KeluargaModified::getByDate($pengajuan->no_kk, $pengajuan->tanggal_request);

            $modifiedKeluarga->status_request = 'Ditolak';
            $modifiedKeluarga->save();

            $pengajuan->status_request = 'Ditolak';
            $pengajuan->catatan = $request->catatan;
            $pengajuan->save();

            DB::commit();
            return redirect()->back()->with('flash', (object) ['type'=>'success', 'message'=>'Berhasil ditolak.']);
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->back()->with('flash', (object) ['type'=>'error', 'message'=>'Pengajuan gagal ditolak.']);
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

        } else if ($pengajuan->status_request == 'Ditolak') {
            $warga = WargaModified::where('no_kk', '=', $pengajuan->no_kk)
                        ->where('tanggal_request', '>=', Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'))
                        ->orderBy('id_modify_warga', 'asc')
                        ->first();

            $currentWarga = WargaHistory::where('NIK', '=', $warga->NIK)
                                    ->where('valid_to', '>=', $pengajuan->tanggal_request)
                                    ->orderBy('valid_to', 'desc')
                                    ->first();
            if (!$currentWarga) {
                $currentWarga = Warga::find($warga->NIK);
            }
            $modifiedWarga = WargaModified::where('NIK', '=', $warga->NIK)
                                ->where('status_request', '=', 'Ditolak')
                                ->where('tanggal_request', '>=', Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'))
                                ->orderBy('id_modify_warga', 'asc')
                                ->first();

            $demografiKeluarNew = HaveDemografi::getDemografiKeluar($warga->NIK, 'Ditolak', tanggal_request:Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'));
            $demografiMasukNew = HaveDemografi::getDemografiMasuk($warga->NIK, 'Ditolak', tanggal_request:Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'));
            $demografiKeluarOld = HaveDemografi::getDemografiKeluar($warga->NIK, 'Dikonfirmasi', valid_before:Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'));
            $demografiMasukOld = HaveDemografi::getDemografiMasuk($warga->NIK, 'Dikonfirmasi', valid_before:Carbon::parse($pengajuan->tanggal_request)->format('Y-m-d H:i'));
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
            return redirect()->route('pengajuan')->with('flash', (object) ['type'=>'success', 'message'=>'Berhasil dikonfirmasi.']);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('flash', (object) ['type'=>'error', 'message'=>'Pengajuan gagal dikonfirmasi.']);
        }
    }

    public function rejectPerubahanWarga(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:pengajuan,id', new PengajuanNotConfirmed],
            'catatan' => 'required|string'
        ], [
            'catatan.required' => 'Masukkan Catatan',
        ]);

        if ($validator->fails()) {
            session()->flash('flash', (object) ['type'=>'error', 'message'=>$validator->errors()->first()]);
            return redirect()->back();
        }

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanData::getById($request->id);

            $modifiedWarga = WargaModified::getMenunggu($pengajuan->no_kk);

            $currentWarga = Warga::find($modifiedWarga->NIK);

            if ($modifiedWarga->status_warga != $currentWarga->status_warga) {
                $have_demografi = HaveDemografi::getMenunggu($modifiedWarga->NIK);

                $have_demografi->status_request = 'Ditolak';

                $have_demografi->save();
            }

            $modifiedWarga->status_request = 'Ditolak';
            $modifiedWarga->save();

            $pengajuan->status_request = 'Ditolak';
            $pengajuan->catatan = $request->catatan;
            $pengajuan->save();

            DB::commit();
            return redirect()->back()->with('flash', (object) ['type'=>'success', 'message'=>'Berhasil ditolak.']);
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            return redirect()->back()->with('flash', (object) ['type'=>'error', 'message'=>'Pengajuan gagal ditolak.']);
        }
    }
}
