<?php

namespace App\Http\Controllers;

use App\Models\Demografi;
use App\Models\FormStateKeluarga;
use App\Models\HaveDemografi;
use App\Models\Pengajuan;
use App\Models\PengajuanData;
use App\Models\Warga;
use App\Models\WargaModified;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function list(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'scope_data' => 'max:8',
            'agama' => 'array|max:6',
            'agama.*' => 'string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghuchu',
            'status_warga' => 'array|max:3',
            'status_warga.*' => 'string|in:Aktif,Meninggal,Migrasi Keluar',
        ]);

        $select = [
            'warga.NIK',
            'warga.nama',
            'warga.jenis_kelamin',
            'warga.tanggal_lahir',
            'warga.agama',
            'warga.status_warga'
        ];

        if ($user->keterangan == 'ketua') {
            $query = Warga::select($select, 'keluarga.rt')
                ->join('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')
                ->where('status_warga', '!=', 'Menunggu');

            if (explode(" ", $request->scope_data)[1] ?? false) {
                $query->where('keluarga.RT', '=', (int)explode(" ", $request->scope_data)[1]);
            }

            if (isset($request->agama)) {
                $query->whereIn('warga.agama', $request->agama);
            }

            if (isset($request->status_warga)) {
                $query->whereIn('warga.status_warga', $request->status_warga);
            }

            $daftar_warga = $query->get();
        } else {
            $query = Warga::select($select, 'keluarga.rt')
                ->join('keluarga', 'keluarga.no_kk', '=', 'warga.no_kk')
                ->join('user', function ($join) use ($user) {
                    $join->on('keluarga.rt', '=', 'user.keterangan')
                        ->where('keluarga.rt', '=', $user->keterangan);
                })
                ->where('status_warga', '!=', 'Menunggu');

            if (isset($request->agama)) {
                $query->whereIn('warga.agama', $request->agama);
            }

            if (isset($request->status_warga)) {
                $query->whereIn('warga.status_warga', $request->status_warga);
            }

            $daftar_warga = $query->get();
        }

        return DataTables::of($daftar_warga)
            ->addIndexColumn() // menambahkan kolom index / no urut (default namakolom: DT_RowIndex)
            ->addColumn('action', function ($warga) {
                return '
                    <a href="' . route('wargaDetail', [$warga->NIK]) . '"
                        class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                        Detail
                    </a>';
            })
            ->addColumn('status_warga', function ($warga) {
                // return '@include(\'components.label\', [\'content\' => ' . $warga->status_warga .' ])';
                if (strtolower($warga->status_warga) == 'aktif') {
                    return '<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-g50 tw-w-fit tw-h-fit">
                                <p class="tw-font-sans tw-font-bold tw-text-sm tw-text-g500">' . $warga->status_warga . '</p>
                            </div>';
                } elseif (strtolower($warga->status_warga) == 'migrasi keluar') {
                    return '<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-r50 tw-w-fit tw-h-fit">
                                <p class="tw-font-sans tw-font-bold tw-text-sm tw-text-r500">' . $warga->status_warga . '</p>
                            </div>';
                } elseif (strtolower($warga->status_warga) == 'menunggu') {
                    return '<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-y50 tw-w-fit tw-h-fit">
                                <p class="tw-font-sans tw-font-bold tw-text-sm tw-text-y500">' . $warga->status_warga . '</p>
                            </div>';
                } else {
                    return '<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-n300 tw-w-fit tw-h-fit">
                                <p class="tw-font-sans tw-font-bold tw-text-sm tw-text-n700">' . $warga->status_warga . '</p>
                            </div>';
                }
            })
            ->rawColumns(['action', 'status_warga'])
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
            $validator_file = Validator::make($request->only('berkas_demografi'), [
                'berkas_demografi' => 'required|file|image|mimes:jpeg,jpg,png|max:2048'
            ], [
                'berkas_demografi.required' => 'Masukkan Berkas Pendukung',
                'berkas_demografi.mimes' => 'Berkas salah. Masukkan berkas .jpeg, .jpg, atau .png',
                'berkas_demografi.max' => 'Ukuran berkas terlalu besar. Masukkan berkas kurang dari 2MB',
            ]);
        }

        if (isset($validator_file) && !$validator_file->fails()) {
            $filename = Str::uuid()->getHex()->toString();
            $extension = $request->file('berkas_demografi')->getClientOriginalExtension();
            $filenameSimpan = $filename . '.' . $extension;
            $request->file('berkas_demografi')->storeAs('', $filenameSimpan, 'temp');
        }

        $rules = [
            'NIK' => 'required|size:16' . (is_null(Warga::where('NIK', $request->NIK)->where('status_warga', 'Tidak Aktif')->first()) ? '|unique:warga,NIK' :''),
            'no_kk' => 'required',
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pendidikan' => 'required|string|max:50|in:Tidak/Belum Sekolah,Belum Tamat SD/Sederajat,Tamat SD/Sederajat,SLTP/Sederajat,SLTA/Sederajat,Diploma I/II,Akademi/Diploma III/S. Muda,Diploma IV/Strata I,Strata II',
            'agama' => 'required|in:Buddha,Hindu,Islam,Katolik,Kristen,Konghuchu',
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Mati,Cerai Hidup',
            'jenis_pekerjaan' => 'required|string|max:50|in:Belum/Tidak Bekerja,Mengurus Rumah Tangga,Pelajar/Mahasiswa,Pensiunan,Pegawai Negeri Sipil,Tentara Nasional Indonesia,Kepolisian RI,Perdagangan,Petani/Pekebun,Peternak,Nelayan/Perikanan,Industri,Konstruksi,Transportasi,Karyawan Swasta,Karyawan BUMN,Karyawan BUMD,Karyawan Honorer,Buruh Harian Lepas,Buruh Tani/Perkebunan,Buruh Nelayan/Perikanan,Buruh Peternakan,Pembantu Rumah Tangga,Tukang Cukur,Tukang Listrik,Tukang Batu,Tukang Kayu,Tukang Sol Sepatu,Tukang Las/Pandai Besi,Tukang Jahit,Penata Rambut,Penata Rias,Penata Busana,Mekanik,Tukang Gigi,Seniman,Tabib,Paraji,Perancang Busana,Penerjemah,Imam Masjid,Pendeta,Pastur,Wartawan,Ustadz/Mubaligh,Juru Masak,Promotor Acara,Anggota DPR-RI,Anggota DPD,Anggota BPK,Presiden,Wakil Presiden,Anggota Mahkamah Konstitusi,Anggota Kabinet/Kementerian,Duta Besar,Gubernur,Wakil Gubernur,Bupati,Wakil Bupati,Walikota,Wakil Walikota,Anggota DPRD Provinsi,Anggota DPRD Kabupaten,Dosen,Guru,Pilot,Pengacara,Notaris,Arsitek,Akuntan,Konsultan,Dokter,Bidan,Perawat,Apoteker,Psikiater/Psikolog,Penyiar Televisi,Penyiar Radio,Pelaut,Peneliti,Sopir,Pialang,Paranormal,Pedagang,Perangkat Desa,Kepala Desa,Biarawati,Wiraswasta,Anggota Lembaga Tinggi,Artis,Atlit,Chef,Manajer,Tenaga Tata Usaha,Operator,Pekerja Pengolahan,Kerajinan,Teknisi,Asisten Ahli,Lainnya',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'status_keluarga' => 'required|in:Kepala Keluarga,Suami,Istri,Anak,Menantu,Cucu,Orang Tua,Mertua,Famili Lain,Pembantu,Lainnya',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'penghasilan' => 'required|integer',
            'no_paspor' => 'nullable|string|max:10',
            'no_kitas' => 'nullable|string|max:10',
            'jenis_demografi' => 'required|in:Lahir,Meninggal,Migrasi Masuk,Migrasi Keluar',
            'tanggal_kejadian' => 'required|date|after_or_equal:tanggal_lahir',
        ];

        $customMessage = [
            'NIK.required' => 'Masukkan NIK',
            'NIK.size' => 'NIK tidak valid. Periksa kembali',
            'NIK.unique' => 'NIK telah terdaftar. Periksa kembali',
            'nama.required' => 'Masukkan Nama',
            'nama.string' => 'Nama tidak valid. Periksa kembali',
            'nama.max' => 'Nama melebihi 100 karakter. Periksa kembali',
            'tempat_lahir.required' => 'Masukkan Tempat Lahir',
            'tempat_lahir.max' => 'Tempat Lahir melebihi 50 karakter. Periksa kembali',
            'tempat_lahir.string' => 'Tempat Lahir tidak valid. Periksa kembali',
            'tanggal_lahir.required' => 'Masukkan Tanggal Lahir',
            'tanggal_lahir.date' => 'Masukan Tanggal Lahir bukan tanggal. Periksa kembali',
            'tanggal_lahir.before' => 'Tanggal Lahir tidak valid. Periksa kembali',
            'jenis_kelamin.required' => 'Pilih Jenis Kelamin',
            'jenis_kelamin.in' => 'Jenis Kelamin tidak valid. Periksa kembali',
            'pendidikan.required' => 'Pilih Pendidikan',
            'pendidikan.string' => 'Pendidikan tidak valid. Periksa kembali',
            'pendidikan.max' => 'Pendidikan melebihi 50 karakter. Periksa kembali',
            'pendidikan.in' => 'Pilihan Pendidikan salah. Pilih kembali',
            'agama.required' => 'Pilih Agama',
            'agama.in' => 'Pilihan Agama salah. Pilih kembali',
            'status_perkawinan.required' => 'Pilih Status Perkawinan',
            'status_perkawinan.in' => 'Pilihan Status Perkawinan salah. Pilih kembali',
            'jenis_pekerjaan.required' => 'Pilih Jenis Pekerjaan',
            'jenis_pekerjaan.in' => 'Pilihan Jenis Pekerjaan salah. Pilih kembali',
            'jenis_pekerjaan.string' => 'Jenis Pekerjaan tidak valid. Periksa kembali',
            'jenis_pekerjaan.max' => 'Jenis Pekerjaan melebihi 50 karakter. Periksa kembali',
            'kewarganegaraan.required' => 'Pilih Kewarganegaraan',
            'kewarganegaraan.in' => 'Pilihan Kewarganegaraan salah. Pilih kembali',
            'status_keluarga.required' => 'Pilih Status Keluarga',
            'status_keluarga.in' => 'Pilihan Status Keluarga salah. Periksa kembali',
            'nama_ayah.required' => 'Masukkan Nama Ayah',
            'nama_ayah.string' => 'Nama Ayah tidak valid. Periksa kembali',
            'nama_ayah.max' => 'Nama Ayah melebihi 100 karakter. Periksa kembali',
            'nama_ibu.required' => 'Masukkan Nama Ibu',
            'nama_ibu.string' => 'Nama Ibu tidak valid. Periksa kembali',
            'nama_ibu.max' => 'Nama Ibu melebihi 100 karakter. Periksa kembali',
            'penghasilan.required' => 'Masukkan Penghasilan',
            'penghasilan.integer' => 'Penghasilan tidak valid. Periksa kembali',
            'no_paspor.string' => 'Nomor Paspor tidak valid. Periksa kembali',
            'no_paspor.max' => 'Nomor Paspor melebihi 10 karakter. Periksa kembali',
            'no_kitas.string' => 'Nomor Kitas tidak valid. Periksa kembali',
            'no_kitas.max' => 'Nomor Kitas melebihi 10 karakter. Periksa kembali',
            'jenis_demografi.required' => 'Pilih Jenis Demografi',
            'jenis_demografi.in' => 'Pilihan Jenis Demografi salah. Pilih kembali',
            'tanggal_kejadian.required' => 'Masukkan Tanggal Kejadian',
            'tanggal_kejadian.date' => 'Masukan Tanggal Kejadian bukan tanggal. Periksa kembali',
            'tanggal_kejadian.after_or_equal' => 'Tanggal Kejadian tidak valid. Periksa kembali',
        ];


        $pengajuan = new Pengajuan();

        if ($pengajuan->keluarga->kepala_keluarga == null) {
            $rules['status_keluarga'] = 'required|in:Kepala Keluarga';
            $customMessage['status_keluarga.in'] = 'Warga pertama WAJIB Kepala Keluarga';
            // $customMessage = array_merge($customMessage, ['status_keluarga.required' => 'Masukkan Status Keluarga', 'status_keluarga.in' => 'Warga pertama WAJIB Kepala Keluarga']);
            $validator = Validator::make($request->all(), $rules, $customMessage);
        } else {
            $validator = Validator::make($request->all(), $rules, $customMessage);
        }

        if (session()->exists('berkas_demografi') && (isset($validator_file) && !$validator_file->fails())) {
            Storage::disk('temp')->delete(session()->get('berkas_demografi')->path);
        }
        if (isset($validator_file) && !$validator_file->fails() && $validator->fails()) {
            session()->put('berkas_demografi', (object) [
                'path' => $filenameSimpan,
                'ext' => explode('.', $filenameSimpan)[1],
                // 'base64' => base64_encode(Storage::disk('temp')->get($filenameSimpan))
            ]);
        }

        // Manual Redirect
        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors(isset($validator_file) ? $validator->errors()->merge($validator_file) : $validator->errors())
                ->withInput();
        }

        // Mapping data dari request menuju objek
        if (!is_null(Warga::where('NIK', $request->NIK)->where('status_warga', 'Tidak Aktif')->first())) {
            $warga = Warga::find($request->NIK);
        } else {
            $warga = new Warga();
            $warga->NIK = $request->NIK;
        }
        $warga->no_kk = $request->no_kk;
        $warga->nama = $request->nama;
        $warga->tempat_lahir = $request->tempat_lahir;
        $warga->tanggal_lahir = $request->tanggal_lahir;

        $jenisKelaminMap = [
            'Laki-laki' => 'L',
            'Perempuan' => 'P'
        ];
        $warga->jenis_kelamin = $jenisKelaminMap[$request->jenis_kelamin];

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

        if ($warga->status_keluarga != 'Kepala Keluarga' && !$pengajuan->hasKepalaKeluarga($warga)) {
            return redirect()->back()
                ->withErrors(['status_keluarga' => 'Warga pertama WAJIB Kepala Keluarga'])
                ->withInput();
        }

        $demografi = new Demografi();
        $demografi->user_id = Auth::user()->user_id;
        $demografi->jenis = $request->jenis_demografi;

        $haveDemografi = new HaveDemografi();
        $haveDemografi->NIK = $warga->NIK;
        if ($request->jenis_demografi == 'Lahir') {
            $haveDemografi->tanggal_kejadian = $request->tanggal_lahir;
        } else {
            $haveDemografi->tanggal_kejadian = $request->tanggal_kejadian;
        }
        $haveDemografi->tanggal_request = now();
        $haveDemografi->dokumen_pendukung = isset($filenameSimpan) ? $filenameSimpan : session()->get('berkas_demografi')->path;
        $haveDemografi->status_request = 'Menunggu';

        if ($warga->status_keluarga == 'Kepala Keluarga') {
            FormStateKeluarga::setKepalaKeluarga($warga->nama);
            $pengajuan->keluarga->kepala_keluarga = $warga->nama;
        }

        if (!is_null($pengajuan->getWarga($request->NIK))) {
            $pengajuan->updateWarga($warga, $demografi, $haveDemografi);
        } else {
            $pengajuan->tambahWarga($warga, $demografi, $haveDemografi);
        }

        session()->forget('berkas_demografi');

        return redirect()->route('keluarga-tambah');
    }
    public function edit($nik)
    {
        $request = new Request;
        $request->merge(['nik' => $nik]);
        $request->validate([
            'nik' => 'required|numeric|exists:warga,NIK'
        ]);

        // Get Data warga
        $warga = Warga::find($nik);

        // Get data demografi warga terakhir yang terkonfirmasi
        $demografi = HaveDemografi::with('demografi')
            ->where('nik', '=', $warga->NIK)
            ->where('status_request', '=', 'Dikonfirmasi')
            ->orderBy('tanggal_request', 'DESC')
            ->first();

        // dd($demografi);

        return view('penduduk.warga.edit', compact(['warga', 'demografi']));
    }
    public function update(Request $request, $nik)
    {

        // Mengambil data warga
        $warga = Warga::find($nik);

        $request->merge(['nik' => $nik]);
        $request->merge(['tanggal_lahir' => $warga->tanggal_lahir]);
        $request->validate([
            'nik' => 'required|numeric'
        ]);

        // Jika data tidak ditemukan, maka akan dikembalikan ke halaman warga
        if (!Warga::find($nik)) {
            return redirect()->route('warga')->with('flash', (object) ['type' => 'error', 'message' => 'Data tidak ditemukan!']);
        }

        // Ambil data warga
        $warga = Warga::find($nik);
        // Ambil data demografi warga (diambil data terakhir dan sudah dikonformasi)
        $demografi = HaveDemografi::with('demografi')
            ->where('nik', '=', $warga->NIK)
            ->where('status_request', '=', 'Dikonfirmasi')
            ->orderBy('tanggal_request', 'DESC')
            ->first();


        // Validasi dasar
        $rules = [
            'pendidikan' => 'required|string|max:50',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'jenis_pekerjaan' => 'required|string|max:50|in:Belum/Tidak Bekerja,Mengurus Rumah Tangga,Pelajar/Mahasiswa,Pensiunan,Pegawai Negeri Sipil,Tentara Nasional Indonesia,Kepolisian RI,Perdagangan,Petani/Pekebun,Peternak,Nelayan/Perikanan,Industri,Konstruksi,Transportasi,Karyawan Swasta,Karyawan BUMN,Karyawan BUMD,Karyawan Honorer,Buruh Harian Lepas,Buruh Tani/Perkebunan,Buruh Nelayan/Perikanan,Buruh Peternakan,Pembantu Rumah Tangga,Tukang Cukur,Tukang Listrik,Tukang Batu,Tukang Kayu,Tukang Sol Sepatu,Tukang Las/Pandai Besi,Tukang Jahit,Penata Rambut,Penata Rias,Penata Busana,Mekanik,Tukang Gigi,Seniman,Tabib,Paraji,Perancang Busana,Penerjemah,Imam Masjid,Pendeta,Pastur,Wartawan,Ustadz/Mubaligh,Juru Masak,Promotor Acara,Anggota DPR-RI,Anggota DPD,Anggota BPK,Presiden,Wakil Presiden,Anggota Mahkamah Konstitusi,Anggota Kabinet/Kementerian,Duta Besar,Gubernur,Wakil Gubernur,Bupati,Wakil Bupati,Walikota,Wakil Walikota,Anggota DPRD Provinsi,Anggota DPRD Kabupaten,Dosen,Guru,Pilot,Pengacara,Notaris,Arsitek,Akuntan,Konsultan,Dokter,Bidan,Perawat,Apoteker,Psikiater/Psikolog,Penyiar Televisi,Penyiar Radio,Pelaut,Peneliti,Sopir,Pialang,Paranormal,Pedagang,Perangkat Desa,Kepala Desa,Biarawati,Wiraswasta,Anggota Lembaga Tinggi,Artis,Atlit,Chef,Manajer,Tenaga Tata Usaha,Operator,Pekerja Pengolahan,Kerajinan,Teknisi,Asisten Ahli,Lainnya',
            'status_keluarga' => 'required|in:Kepala Keluarga,Suami,Istri,Anak,Menantu,Cucu,Orang Tua,Mertua,Famili Lain,Pembantu,Lainnya',
            'penghasilan' => 'required|integer',
            'no_paspor' => 'nullable|string|max:10',
            'no_kitas' => 'nullable|string|max:10',
        ];

        // Custom message error
        $customMessage = [
            'pendidikan.required' => 'Pilih Pendidikan',
            'pendidikan.string' => 'Pendidikan tidak valid. Periksa kembali',
            'pendidikan.max' => 'Pendidikan melebihi 50 karakter. Periksa kembali',
            'pendidikan.in' => 'Pilihan Pendidikan salah. Pilih kembali',
            'agama.required' => 'Pilih Agama',
            'agama.in' => 'Pilihan Agama salah. Pilih kembali',
            'status_perkawinan.required' => 'Pilih Status Perkawinan',
            'status_perkawinan.in' => 'Pilihan Status Perkawinan salah. Pilih kembali',
            'jenis_pekerjaan.required' => 'Pilih Jenis Pekerjaan',
            'jenis_pekerjaan.in' => 'Pilihan Jenis Pekerjaan salah. Pilih kembali',
            'jenis_pekerjaan.string' => 'Jenis Pekerjaan tidak valid. Periksa kembali',
            'jenis_pekerjaan.max' => 'Jenis Pekerjaan melebihi 50 karakter. Periksa kembali',
            'penghasilan.required' => 'Masukkan Penghasilan',
            'penghasilan.integer' => 'Penghasilan tidak valid. Periksa kembali',
            'no_paspor.string' => 'Nomor Paspor tidak valid. Periksa kembali',
            'no_paspor.max' => 'Nomor Paspor melebihi 10 karakter. Periksa kembali',
            'no_kitas.string' => 'Nomor Kitas tidak valid. Periksa kembali',
            'no_kitas.max' => 'Nomor Kitas melebihi 10 karakter. Periksa kembali',
        ];


        // Ketika seorang warga merubah data demografi
        // dd($request->jenis_demografi_keluar);
        if (
            ($demografi && ($demografi->demografi->jenis != $request->jenis_demografi_keluar))  || (!$demografi && $request->jenis_demografi_keluar != 'Aktif')
        ) {
            // dd($request->hasFile('berkas_demografi_keluar'));
            if (!session()->exists('berkas_demografi_keluar') || $request->hasFile('berkas_demografi_keluar')) {
                $validator_file = Validator::make($request->only('berkas_demografi_keluar'), [
                    'berkas_demografi_keluar' => 'required|file|image|mimes:jpeg,jpg,png|max:2048'
                ], [
                    'berkas_demografi_keluar.required' => 'Masukkan Berkas Pendukung',
                    'berkas_demografi_keluar.mimes' => 'Berkas salah. Masukkan berkas .jpeg, .jpg, atau .png',
                    'berkas_demografi_keluar.max' => 'Ukuran berkas terlalu besar. Masukkan berkas kurang dari 2MB',
                ]);
            }

            if (isset($validator_file) && !$validator_file->fails()) {
                $filename = Str::uuid()->getHex()->toString();
                $extension = $request->file('berkas_demografi_keluar')->getClientOriginalExtension();
                $filenameSimpan = $filename . '.' . $extension;
                $request->file('berkas_demografi_keluar')->storeAs('', $filenameSimpan, 'temp');
            }

            if (session()->exists('berkas_demografi_keluar') && (isset($validator_file) && !$validator_file->fails())) {
                Storage::disk('temp')->delete(session()->get('berkas_demografi_keluar')->path);
            }

            $rules = array_merge($rules, [
                'tanggal_kejadian_demografi_keluar' => 'required|date|after_or_equal:tanggal_lahir'
            ]);

            $customMessage = array_merge($customMessage, [
                'tanggal_kejadian_demografi_keluar.required' => 'Masukkan Tanggal Kejadian',
                'tanggal_kejadian_demografi_keluar.date' => 'Masukan Tanggal Kejadian bukan tanggal. Periksa kembali',
                'tanggal_kejadian_demografi_keluar.after_or_equal' => 'Tanggal Kejadian tidak valid. Periksa kembali',
            ]);
        }

        // Jika data demografi sebelumnya ada, maka tambahkan validasi berikut
        else if ($demografi) {
            $rules = array_merge($rules, [
                'tanggal_kejadian' => 'required|date|after_or_equal:tanggal_lahir',
            ]);

            $customMessage = array_merge($customMessage, [
                'tanggal_kejadian.required' => 'Masukkan Tanggal Kejadian',
                'tanggal_kejadian.date' => 'Masukan Tanggal Kejadian bukan tanggal. Periksa kembali',
                'tanggal_kejadian.after_or_equal' => 'Tanggal Kejadian tidak valid. Periksa kembali',
            ]);

            if ($request->hasFile('berkas_demografi')) {
                $validator_file_2 = Validator::make($request->only('berkas_demografi'), [
                    'berkas_demografi' => 'required|file|image|mimes:jpeg,jpg,png|max:2048'
                ], [
                    'berkas_demografi.required' => 'Masukkan Berkas Pendukung',
                    'berkas_demografi.mimes' => 'Berkas salah. Masukkan berkas .jpeg, .jpg, atau .png',
                    'berkas_demografi.max' => 'Ukuran berkas terlalu besar. Masukkan berkas kurang dari 2MB',
                ]);
            }

            if (isset($validator_file_2) && !$validator_file_2->fails()) {
                $filename = Str::uuid()->getHex()->toString();
                $extension = $request->file('berkas_demografi')->getClientOriginalExtension();
                $filenameSimpan_2 = $filename . '.' . $extension;
                $request->file('berkas_demografi')->storeAs('', $filenameSimpan_2, 'temp');
            }

            if (session()->exists('berkas_demografi') && (isset($validator_file_2) && !$validator_file_2->fails())) {
                Storage::disk('temp')->delete(session()->get('berkas_demografi')->path);
            }
        }

        // Dilakukan validasi terhadap semua rule yang telah ditambahkan kedalam $rules
        $validator = Validator::make($request->all(), $rules, $customMessage);

        // Jika terdapat file yang diupload, maka akan disimpan informasinya pada session
        if (isset($validator_file) && !$validator_file->fails() && $validator->fails()) {
            session()->put('berkas_demografi_keluar', (object) [
                'path' => $filenameSimpan,
                'ext' => explode('.', $filenameSimpan)[1],
            ]);
        }
        if (isset($validator_file_2) && !$validator_file_2->fails() && $validator->fails()) {
            session()->put('berkas_demografi_keluar', (object) [
                'path' => $filenameSimpan_2,
                'ext' => explode('.', $filenameSimpan_2)[1],
            ]);
        }


        // Jika terdapat validasi yang gagal maka akan dikembalikan menuju form sebelumnya untuk diisi dengan benar.
        if ($validator->fails() || (isset($validator_file) && $validator_file->fails()) || (isset($validator_file_2) && $validator_file_2->fails())) {
            if (isset($validator_file)) {
                $errors = $validator->errors()->merge($validator_file);
            } else if (isset($validator_file_2)) {
                $errors = $validator->errors()->merge($validator_file_2);
            }

            return redirect()->back()
                ->withErrors(isset($errors) ? $errors : $validator->errors())
                ->withInput();
        }

        try {
            $message = [];
            $message['message'] = 'Tidak ada data yang diubah';
            $messageType = 'information';
            DB::beginTransaction();
            // passing data dari request kedalam object warga
            $warga->agama = $request->agama;
            $warga->status_perkawinan = $request->status_perkawinan;
            $warga->status_keluarga = $request->status_keluarga;
            // $warga->status_warga = $request->status_warga;
            $warga->jenis_pekerjaan = $request->jenis_pekerjaan;
            $warga->penghasilan = $request->penghasilan;
            $warga->pendidikan = $request->pendidikan;
            if (isset($demografi)) {
                $demografi->tanggal_kejadian = $request->tanggal_kejadian;
            }

            // Ketika seorang warga merubah data demografi
            if (
                ($demografi && ($demografi->demografi->jenis != $request->jenis_demografi_keluar)) ||
                (!$demografi && $request->jenis_demografi_keluar != 'Aktif')
            ) {
                $warga->status_warga = $request->jenis_demografi_keluar;
                WargaModified::updateWarga($warga);

                $dm = Demografi::create([
                    'user_id' => Auth::user()->user_id,
                    'jenis' => $request->jenis_demografi_keluar
                ]);
                HaveDemografi::create([
                    'NIK' => $warga->NIK,
                    'demografi_id' => $dm->demografi_id,
                    'tanggal_kejadian' => $request->tanggal_kejadian_demografi_keluar,
                    'tanggal_request' => now(),
                    'dokumen_pendukung' => $filenameSimpan ?? session()->get('berkas_demografi_keluar')->path,
                    'status_request' => 'Menunggu',
                ]);

                PengajuanData::create([
                    'user_id' => Auth::user()->user_id,
                    'no_kk' => $warga->no_kk,
                    'tanggal_request' => now(),
                    'status_request' => 'Menunggu',
                    'tipe' => 'Perubahan Warga'
                ]);
                $message['message'] = 'Edit Warga Berhasil!';
                $messageType = 'success';
                $warga = null;
            }

            // Hapus session berkas demografi.
            if (session()->has('berkas_demografi_keluar')) {
                session()->forget('berkas_demografi_keluar');
            }

            // Jika data warga ada yang berubah maka akan ditambahkan kedalam tabel wargaModified
            if (($warga && !empty($warga->getDirty())) || ($demografi && $demografi->isDirty('tanggal_kejadian')) || isset($filenameSimpan_2)) {
                // perubahan warga akan disimpan pada tabel warga Modified, untuk menunggu dikonfirmasi oleh ketua RW.
                WargaModified::updateWarga($warga);

                if ($request->has('tanggal_kejadian')) {
                    $demografi->fill($request->only('tanggal_kejadian'));
                }

                if (($demografi && $demografi->isDirty('tanggal_kejadian')) || isset($filenameSimpan)) {
                    HaveDemografi::create([
                        'demografi_id' => $demografi->demografi_id,
                        'NIK' => $warga->NIK,
                        'tanggal_kejadian' => $demografi->tanggal_kejadian,
                        'tanggal_request' => now(),
                        'dokumen_pendukung' => isset($filenameSimpan) ? $filenameSimpan : $demografi->dokumen_pendukung,
                        'status_request' => 'Menunggu',
                    ]);
                }

                // Membuat data request
                PengajuanData::create([
                    'user_id' => Auth::user()->user_id,
                    'no_kk' => $warga->no_kk,
                    'tanggal_request' => now(),
                    'status_request' => 'Menunggu',
                    'tipe' => 'Perubahan Warga'
                ]);
                $message['message'] = 'Edit Warga Berhasil!';
                $messageType = 'success';
            }

            DB::commit();
            return redirect()->route('wargaDetail', ['nik' => $request->nik])->with('flash', (object) ['type' => $messageType, 'message' => $message['message']]);
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            return redirect()->route('wargaDetail', ['nik' => $request->nik])->with('flash', (object) ['type' => 'error', 'message' => 'Gagal ubah data warga!']);
        }
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
            'status_keluarga' => 'required|in:Kepala Keluarga,Suami,Istri,Anak,Menantu,Cucu,Orang Tua,Mertua,Famili Lain,Pembantu,Lainnya'
        ], [
            'NIK.required' => 'Masukkan NIK',
            'NIK.size' => 'NIK tidak valid. Periksa kembali',
            'status_keluarga.required' => 'Masukkan Status Keluarga',
            'status_keluarga.in' => 'Pilihan Status Keluarga salah. Periksa kembali',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('data_lama', true)
                ->withErrors($validator->errors())
                ->withInput();
        }

        $pengajuan = new Pengajuan();
        $warga = Warga::find($request->NIK);
        $warga->status_keluarga = $request->status_keluarga;
        $pengajuan->pindahKK($warga);
        return redirect()->route('keluarga-tambah');
    }

    public function detail($nik)
    {
        $warga = Warga::with(['keluarga', 'haveDemografi', 'haveDemografi.demografi'])->find($nik);
        $demografiMasuk = HaveDemografi::getDemografiMasuk($warga->NIK, 'Dikonfirmasi');
        $demografiKeluar = HaveDemografi::join('demografi', 'demografi.demografi_id', '=', 'have_demografi.demografi_id')
            ->where('NIK', '=', $warga->NIK)
            ->whereIn('demografi.jenis', ['Meninggal', 'Migrasi Keluar'])
            ->where('status_request', '=', 'Dikonfirmasi')
            ->orderBy('tanggal_request', 'DESC')
            ->first();
        $pengajuanInProgres = PengajuanData::where('no_kk', '=', $warga->no_kk)
            ->where('status_request', '=', 'Menunggu')
            ->orderBy('tanggal_request', 'DESC')
            ->first();

        if (!$warga) {
            return redirect()->back();
        }
        return view('penduduk.warga.detail', compact(['warga', 'pengajuanInProgres', 'demografiMasuk', 'demografiKeluar']));
    }
}
