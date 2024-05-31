<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ARASController;
use App\Http\Controllers\ArticleAnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\MERECController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SPKController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/testchart', [HomeController::class, 'chart']);

Route::prefix('spk')->middleware(['auth', 'role:rw,rt'])->group(function () {
    Route::prefix('merec')->group(function () {
        Route::post('/keputusan', [SPKController::class, 'getMatriksKeputusan'])->name('spk.merec.keputusan');
        Route::post('/normalisasi', [SPKController::class, 'getMERECMatriksTernormalisasi'])->name('spk.merec.normalisasi');
        Route::post('/nilaiSi', [SPKController::class, 'getMERECNilaiSi'])->name('spk.merec.nilaiSi');
        Route::post('/nilaiSij', [SPKController::class, 'getMERECSij'])->name('spk.merec.nilaiSij');
        Route::post('/nilaiEi', [SPKController::class, 'getMERECEi'])->name('spk.merec.nilaiEi');
        Route::post('/bobot', [SPKController::class, 'getMERECBobot'])->name('spk.merec.bobot');
    });

    Route::prefix('aras')->group(function () {
        Route::post('/keputusan', [SPKController::class, 'getARASMatriksKeputusan'])->name('spk.aras.matriksKeputusan');
        Route::post('/normalisasi_1', [SPKController::class, 'getARASNormalisasi_1'])->name('spk.aras.matriksTrnormalisasi_1');
        Route::post('/normalisasi_2', [SPKController::class, 'getARASMatriksTernormalisasi'])->name('spk.aras.matriksTrnormalisasi_2');
        Route::post('/terbobot', [SPKController::class, 'getARASMatriksTerbobot'])->name('spk.aras.matriksTerbobot');
        Route::post('/nilaiFungsiOptimal', [SPKController::class, 'getARASNilaiFungsiOptimal'])->name('spk.aras.nilaiFungsiOptimal');
        Route::post('/peringkatUtilitas', [SPKController::class, 'getARASPeringkatUtilitas'])->name('spk.aras.peringkatUtilitas');
    });

    Route::get('/', [SPKController::class, 'index'])->name('spk.merec');
    Route::get('/merec', [MERECController::class, 'MEREC'])->name('spk.merec');
    Route::get('/aras', [ARASController::class, 'rankingBansos'])->name('spk.aras');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/filter-data', [ChartController::class, 'filterData'])->name('filter-data');

Route::get('/test/{id}', [AuthController::class, 'test'])->name('test');

Route::prefix('auth')->group(function (){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('loginAction');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('penduduk')->group(function () {
    Route::get('/', function () {
        return redirect()->route('warga');
    });

    /**
     * Route untuk manage Warga
     */
    Route::get('/warga', [WargaController::class, 'index'])->name('penduduk.warga')->middleware('role:rw,rt'); // untuk menampilkan tabel warga
    Route::post('/warga/list', [WargaController::class, 'list'])->name('warga.list')->middleware('role:rw,rt'); // untuk menampilkan tabel warga

    // FIX THIS DETAIL WARGA ROUTE
    Route::get('/warga/detail/{nik}', [WargaController::class, 'detail'])->name('wargaDetail')->middleware('role:rw,rt'); // untuk menampilkan detail warga

    Route::middleware(['role:rt', 'auth'])->group(function () {
        Route::get('/warga/ubah/{nik}', [WargaController::class, 'edit'])->name('warga-edit'); // untuk menampilkan form edit data Warga
        Route::put('/warga/ubah/{nik}', [WargaController::class, 'update'])->name('warga-edit'); // untuk menangani update data Warga dan menyimpan pada database
        Route::get('/warga/tambah/{no_kk}', [WargaController::class, 'create'])->name('tambah-warga'); // untuk menampilkan form penambahan data warga
        Route::post('/warga/tambah/', [WargaController::class, 'store'])->name('tambah-warga-post');  // untuk menangani penambahan data Warga
        Route::post('/warga/pindahKK/', [WargaController::class, 'pindahKK'])->name('pindahKK'); // tambah warga dengan data lama akan ditangani oleh route ini
    });

    /**
     * Route untuk manage Keluarga
     */

    Route::middleware(['auth','role:rt'])->group(function () {
        Route::get('/keluarga/{no_kk}/ubah', [KeluargaController::class, 'edit'])->name('keluarga-edit'); // untuk menampilkan form edit data keluarga
        Route::put('/keluarga/{no_kk}', [KeluargaController::class, 'update'])->name('penduduk.keluarga.update'); // untuk menangani update data Keluarga dan menyimpan pada database
        Route::get('/keluarga/tambah/', [KeluargaController::class, 'create'])->name('keluarga-tambah'); // menampilkan halaman form penambahan data keluarga
        Route::get('/keluarga/tambah/back', [KeluargaController::class, 'back'])->name('penduduk.keluarga.tambah.back'); // menampilkan halaman form penambahan data keluarga
        Route::post('/keluarga/tambah/', [KeluargaController::class, 'store']); // untuk menangani penambahan data keluarga/KK
        Route::get('/keluarga/tambah/removeWarga/{nik}', [KeluargaController::class, 'removeAnggotaKeluarga'])->name('removeAnggotaKeluarga'); // menghapus warga pada anggota keluarga
        Route::post('/keluarga/listWarga', [KeluargaController::class, 'listWargaCreate'])->name('penduduk.keluarga.tambah.listwarga'); // menghapus warga pada anggota keluarga
    });

    Route::middleware(['auth','role:rw,rt'])->group(function () {
        Route::get('/keluarga', [KeluargaController::class, 'index'])->name('keluarga')->middleware('role:rw,rt'); // untuk menampilkan tabel keluarga
        Route::post('/keluarga/list', [KeluargaController::class, 'list'])->name('keluarga.list')->middleware('role:rw,rt'); // untuk menampilkan tabel keluarga
        Route::get('/keluarga/{no_kk}', [KeluargaController::class, 'detail'])->name('penduduk.keluarga.detail')->middleware('role:rw,rt'); // untuk menampilkan detail warga
        Route::post('/keluarga/{no_kk}/listWarga', [KeluargaController::class, 'listWarga'])->name('penduduk.keluarga.detail.listWarga')->middleware('role:rw,rt'); // untuk menampilkan detail warga
        Route::post('/keluarga/{no_kk}/listBansos', [KeluargaController::class, 'listBansos'])->name('penduduk.keluarga.detail.listBansos')->middleware('role:rw,rt'); // untuk menampilkan detail warga
    });
})->name('penduduk');

Route::prefix('pengajuan')->group(function () {
    /**
     * Route untuk menampilkan tabel-tabel data pengajuan
     */
    Route::get('/', [PengajuanController::class, 'index'])
        ->name('pengajuan')
        ->middleware('role:rw,rt'); // menampilkan tabel pengajuan
    Route::post('/list', [PengajuanController::class, 'list'])
        ->name('pengajuan.list')
        ->middleware('role:rw,rt'); // memberikan daftar data pengajuan untuk DataTables

    /**
     * Route untuk menampilkan detail sebuah data pengajuan
     */
    Route::middleware(['role:rt,rw', 'auth'])->group(function() {
        Route::get('/pembaharuan/{id}', [PengajuanController::class, 'showPembaharuan'])->name('pengajuan.pembaharuan'); // memberikan halaman detail sebuah pengajuan data pembaharuan
        Route::post('/pembaharuan/{id}/listWarga', [PengajuanController::class, 'listWarga'])->name('pengajuan.pembaharuan.listWarga'); //

        Route::get('/pembaharuan/{id}/warga/{nik}', [PengajuanController::class, 'detailWarga'])->name('pengajuan.pembaharuan.detailwarga'); // memberikan halaman detail warga sebuah pengajuan data pembaharuan

        Route::get('/perubahan-keluarga/{id}', [PengajuanController::class, 'showPerubahanKeluarga'])->name('pengajuan.perubahankeluarga'); // memberikan halaman detail warga pengajuan perubahan warga
        Route::get('/perubahan-warga/{id}', [PengajuanController::class, 'showPerubahanWarga'])->name('pengajuan.perubahanwarga'); // memberikan halaman detail warga dari sebuah data pengajuan
    });

    /**
     * Route untuk menangani konfirmasi sebuah pengajuan
     */
    Route::middleware('role:rw')->group(function() {
        Route::put('/confirm/pembaharuan', [PengajuanController::class, 'confirmPembaharuan'])->name('pengajuan.confirm.pembaharuan');
        Route::put('/confirm/perubahanKeluarga', [PengajuanController::class, 'confirmPerubahanKeluarga'])->name('pengajuan.confirm.perubahan.keluarga');
        Route::put('/confirm/perubahanWarga', [PengajuanController::class, 'confirmPerubahanWarga'])->name('pengajuan.confirm.perubahan.warga');

        Route::put('/reject/pembaharuan', [PengajuanController::class, 'rejectPembaharuan'])->name('pengajuan.reject.pembaharuan');
        Route::put('/reject/perubahanKeluarga', [PengajuanController::class, 'rejectPerubahanKeluarga'])->name('pengajuan.reject.perubahan.keluarga');
        Route::put('/reject/perubahanWarga', [PengajuanController::class, 'rejectPerubahanWarga'])->name('pengajuan.reject.perubahan.warga');
    });
})->name('pengajuan');

Route::prefix('bansos')->middleware('role:rw,rt')->group(function () {
    route::post('/list', [BansosController::class, 'list'])->name('bansos.list');
    Route::get('/kriteria', [BansosController::class, 'index'])->name('bansos.kriteria');// menampilkan tabel yang berisi semua data kriteria yang digunakan untuk SPK (Sistem Pendukung Keputusan)
    Route::get('/kriteria/{id}/ubah', [BansosController::class, 'edit'])->name('bansos.kriteria.form'); // menampilkan form yang digunakan untuk merubah data kriteria
    Route::get('/kriteria/{id}/detail', [BansosController::class, 'detail'])->name('bansos.kriteria.detail'); // menampilkan form yang digunakan untuk merubah data kriteria
    Route::put('/kriteria/{id}/ubah', [BansosController::class, 'update'])->name('bansos.kriteria.update'); // menerima data dari form edit dan menyimpannya pada database

    route::post('/gdss', [BansosController::class, 'gdss'])->name('perhitungan.gdss');
    Route::get('/perhitungan', [BansosController::class, 'calc'])->name('bansos.perhitungan'); // menampilkan tabel perankingan dari hasil perhitungan SPK (Sistem Pendukung Keputusan)
    Route::get('/perhitungan/detail', [BansosController::class, 'detailPerhitungan'])->name('bansos.perhitungan.detailPerhitungan'); // menampilkan langkah perhitungan SPK (Sistem Pendukung Keputusan)
    Route::get('/perhitungan/{id}/detail', [BansosController::class, 'detailCalc'])->name('bansos.perhitungan.detail'); // menampilkan detail dari keluarga
    Route::post('/tambah', [BansosController::class, 'tambah'])->name('tambahPenerimaBansos'); // menangani penerimaan data dari form penambahan penerima bansos dan menyimpan pada database
});

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfilController::class, 'index'])->name('profil');// menampilkan halaman profile user
    Route::get('/ubah/{user_id}', [ProfilController::class, 'edit'])->name('profilFormEdit'); // untuk menampilkan form edit data user
    Route::put('/ubah/{user_id}', [ProfilController::class, 'update'])->name('profilUpdate'); // menangani penerimaan data dari form edit user dan menyimpan pada database
})->middleware('role:rt,rw,adm');

Route::prefix('publikasi')->middleware(['auth','role:adm'])->group(function () {
    Route::get('/', [ArticleAnnouncementController::class, 'index_publikasi'])->name('publikasi'); // menampilkan halaman yang berisi tabel daftar publikasi
    Route::post('/list', [ArticleAnnouncementController::class, 'list_publikasi'])->name('publikasi.list'); // menampilkan halaman yang berisi tabel daftar publikasi
    Route::get('/{id}/detail', [ArticleAnnouncementController::class, 'show'])->name('publikasi.detail'); // menampilkan detail dari sebuah publikasi
    Route::get('/{id}/ubah', [ArticleAnnouncementController::class, 'edit_publikasi'])->name('publikasi.ubah'); // menampilkan detail dari sebuah publikasi
    Route::put('/{id}/ubah', [ArticleAnnouncementController::class, 'update_publikasi'])->name('publikasi.update');// menyimpan data

    Route::get('/tambah', [ArticleAnnouncementController::class, 'create'])->name('publikasi.tambah'); // menampilkan form untuk menambahkan sebuah article atau pengumuman
    Route::post('/tambah', [ArticleAnnouncementController::class, 'store'])->name('publikasi.store'); // mmelakukan proses menerima data dari form penambahan data dan mrnyimpannya pada databse


    Route::get('/draf', [ArticleAnnouncementController::class, 'index_draf'])->name('publikasi.draf'); // menampilkan halaman yang berisi tabel daftar draf publikasi
    Route::post('/draf/list', [ArticleAnnouncementController::class, 'list_draf'])->name('publikasi.draf.list'); // menampilkan halaman yang berisi tabel daftar draf publikasi
    Route::get('/draf/{id}/detail', [ArticleAnnouncementController::class, 'show_draf'])->name('publikasi.draf.detail'); // menampilkan detail dari sebuah draf publikasi
    Route::get('/draf/{id}/ubah', [ArticleAnnouncementController::class, 'edit_draf'])->name('publikasi.draf.ubah'); // menampilkan detail dari sebuah draf publikasi
    Route::put('/draf/{id}/ubah', [ArticleAnnouncementController::class, 'update_draf'])->name('publikasi.draf.update'); // menyimpan data

});

Route::get('/baca', function(){
    return view('landing.bacaan');
})->name('publikasi.baca'); // menampilkan halaman bacaan publikasi

Route::prefix('api')->group(function () {
    Route::get('/warga', [WargaController::class, 'getAll'])->middleware('role:rt'); // route ini akan mengembalikan json yang berisi semua data warga (TODO data warga berdasarkan RT)
    Route::get('/warga/{nik}', [WargaController::class, 'getWarga'])->middleware('role:rt'); // route ini akan mengembalikan json yang berisi informasi detail dari sebuah data warga
    Route::get('/keluarga', [KeluargaController::class, 'getAll'])->middleware('role:rt'); // route ini akan mengembalikan json yang berisi semua data keluarga (TODO data keluarga berdasarkan RT)
    Route::get('/keluarga/{no_kk}', [KeluargaController::class, 'getKeluarga'])->middleware('role:rt'); // route ini akan mengembalikan json yang berisi informasi detail dari sebuah data keluarga
});

// artikel publikasi
// Route::prefix('article_announcements')->middleware('auth')->group(function () {
//     Route::get('/', [ArticleAnnouncementController::class, 'index'])->name('article_announcements.index');
//     Route::get('/create', [ArticleAnnouncementController::class, 'create'])->name('article_announcements.create');
//     Route::post('/', [ArticleAnnouncementController::class, 'store'])->name('article_announcements.store');
//     Route::get('/{kode}', [ArticleAnnouncementController::class, 'show'])->name('article_announcements.show');
//     Route::get('/{kode}/edit', [ArticleAnnouncementController::class, 'edit'])->name('article_announcements.edit');
//     Route::put('/{kode}', [ArticleAnnouncementController::class, 'update'])->name('article_announcements.update');
//     Route::delete('/{kode}', [ArticleAnnouncementController::class, 'destroy'])->name('article_announcements.destroy');
// });


Route::prefix('admin')->middleware('role:rw')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::post('/list', [AdminController::class, 'list'])->name('admin.list');
    Route::post('/list/publikasi', [AdminController::class, 'listPublikasi'])->name('admin.publikasi.list');
    Route::get('/tambah', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/{username}', [AdminController::class, 'show'])->name('admin.detail');
    Route::post('/tambah', [AdminController::class, 'store'])->name('admin.store');
});
