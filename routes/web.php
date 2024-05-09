<?php

use App\Http\Controllers\PendudukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\WargaController;
use App\Models\Bansos;
use Illuminate\Routing\Route as RoutingRoute;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

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
    Route::get('/warga', [WargaController::class, 'index'])->name('warga')->middleware('role:rw,rt'); // untuk menampilkan tabel warga
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
    Route::get('/keluarga', [KeluargaController::class, 'index'])->name('keluarga')->middleware('role:rw,rt'); // untuk menampilkan tabel keluarga
    Route::post('/keluarga/list', [KeluargaController::class, 'list'])->name('keluarga.list')->middleware('role:rw,rt'); // untuk menampilkan tabel keluarga


    Route::middleware('role:rt')->group(function () {
        Route::get('/keluarga/{no_kk}/ubah', [KeluargaController::class, 'edit'])->name('keluarga-edit'); // untuk menampilkan form edit data keluarga
        Route::put('/keluarga/{no_kk}', [KeluargaController::class, 'update'])->name('keluarga-editP'); // untuk menangani update data Keluarga dan menyimpan pada database
        Route::get('/keluarga/tambah/', [KeluargaController::class, 'create'])->name('keluarga-tambah'); // menampilkan halaman form penambahan data keluarga
        Route::post('/keluarga/tambah/', [KeluargaController::class, 'store']); // untuk menangani penambahan data keluarga/KK
        // Route::post('/keluarga/tambah/save-state', [KeluargaController::class, 'saveFormState']); // untuk menyimpan data form sementara pada session
        Route::get('/keluarga/tambah/removeWarga/{idx}', [KeluargaController::class, 'removeAnggotaKeluarga'])->name('removeAnggotaKeluarga'); // menghapus warga pada anggota keluarga
    });
    Route::get('/keluarga/{no_kk}', [KeluargaController::class, 'detail'])->name('penduduk.keluarga.detail')->middleware('role:rw,rt'); // untuk menampilkan detail warga
    Route::post('/keluarga/{no_kk}/listWarga', [KeluargaController::class, 'listWarga'])->name('penduduk.keluarga.detail.listWarga')->middleware('role:rw,rt'); // untuk menampilkan detail warga
    Route::post('/keluarga/{no_kk}/listBansos', [KeluargaController::class, 'listBansos'])->name('penduduk.keluarga.detail.listBansos')->middleware('role:rw,rt'); // untuk menampilkan detail warga
})->name('penduduk');

Route::prefix('pengajuan')->group(function () {
    /**
     * Route untuk menampilkan tabel-tabel data pengajuan
     */
    Route::get('/', [PengajuanController::class, 'index'])
        ->name('dataBaru')
        ->middleware('role:rw,rt'); // menampilkan tabel pengajuan
    Route::post('/list', [PengajuanController::class, 'list'])
        ->name('pengajuan.list')
        ->middleware('role:rw,rt'); // memberikan daftar data pengajuan untuk DataTables

    /**
     * Route untuk menampilkan detail sebuah data pengajuan
     */
    Route::get('/pembaharuan/{id}', [PengajuanController::class, 'showPembaharuan'])->name('pengajuan.pembaharuan'); // memberikan halaman detail sebuah pengajuan data pembaharuan
    Route::post('/pembaharuan/{id}/listWarga', [PengajuanController::class, 'listWarga'])->name('pengajuan.pembaharuan.listWarga'); //

    Route::get('/pembaharuan/{id}/warga/{nik}', [function(){
        return view('pengajuan.pembaharuan.detailwarga');
    }])->name('pengajuan.pembaharuan.detailwarga'); // memberikan halaman detail warga sebuah pengajuan data pembaharuan

    Route::get('/perubahan-keluarga/{id}', [PengajuanController::class, 'showPerubahanKeluarga'])->name('pengajuan.perubahankeluarga'); // memberikan halaman detail warga pengajuan perubahan warga
    Route::get('/perubahan-warga/{id}', [PengajuanController::class, 'showPerubahanWarga'])->name('pengajuan.perubahanwarga'); // memberikan halaman detail warga dari sebuah data pengajuan

    /**
     * Route untuk menangani konfirmasi sebuah pengajuan
     */
    Route::middleware('role:rw')->group(function() {
        Route::put('/confirm/pembaharuan', [PengajuanController::class, 'confirmPembaharuan'])->name('pengajuan.confirm.pembaharuan');
        Route::put('/confirm/perubahanKeluarga', [PengajuanController::class, 'confirmPerubahanKeluarga'])->name('pengajuan.confirm.perubahan.keluarga');
        Route::put('/confirm/perubahanWarga', [PengajuanController::class, 'confirmPerubahanWarga'])->name('pengajuan.confirm.perubahan.warga');

        Route::get('/konfirmasi/{id}', [ 'konfirmasi'])->name('confirmPengajuan'); // melakukan proses konfirmasi/terima sebuah data pengajuan
        Route::post('/tolak/{id}', [ 'tolak'])->name('rejectPengajuan'); // melakukan proses tolak sebuah data pengajuan
    });
})->name('pengajuan');

Route::prefix('bansos')->group(function () {
    Route::get('/kriteria', [BansosController::class, 'index'])->name('kriteria');// menampilkan tabel yang berisi semua data kriteria yang digunakan untuk SPK (Sistem Pendukung Keputusan)
    Route::get('/kriteria/ubah/{id}', [BansosController::class, 'edit'])->name('kriteriaForm'); // menampilkan form yang digunakan untuk merubah data kriteria
    Route::put('/kriteria/ubah/{id}', [BansosController::class, 'update'])->name('kriteriaUpdate'); // menerima data dari form edit dan menyimpannya pada database

    Route::get('/perhitungan', [])->name('perhitungan'); // menampilkan tabel perankingan dari hasil perhitungan SPK (Sistem Pendukung Keputusan)
    Route::get('/perhitungan/detail/{}', []); // menampilkan detail dari keluarga
    Route::post('/tambah', [])->name('tambahPenerimaBansos'); // menangani penerimaan data dari form penambahan penerima bansos dan menyimpan pada database
})->middleware('role:rw,rt');

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfilController::class, 'index'])->name('profil');// menampilkan halaman profile user
    Route::get('/ubah/{user_id}', [ProfilController::class, 'edit'])->name('profilFormEdit'); // untuk menampilkan form edit data user
    Route::put('/ubah/{user_id}', [ProfilController::class, 'update'])->name('profilUpdate'); // menangani penerimaan data dari form edit user dan menyimpan pada database
})->middleware('role:rt,rw,adm');

Route::prefix('publikasi')->group(function () {
    Route::get('/', []); // menampilkan halaman yang berisi tabel daftar publikasi
    Route::get('/detail/{id}', []); // menampilkan detail dari sebuah publikasi
    Route::get('/tambah', []); // menampilkan form untuk menambahkan sebuah article atau pengumuman
    Route::post('/tambah', []); // mmelakukan proses menerima data dari form penambahan data dan mrnyimpannya pada databse
})->middleware('role:adm');

Route::prefix('api')->group(function () {
    Route::get('/warga', [WargaController::class, 'getAll'])->middleware('role:rt'); // route ini akan mengembalikan json yang berisi semua data warga (TODO data warga berdasarkan RT)
    Route::get('/warga/{nik}', [WargaController::class, 'getWarga'])->middleware('role:rt'); // route ini akan mengembalikan json yang berisi informasi detail dari sebuah data warga
    Route::get('/keluarga', [KeluargaController::class, 'getAll'])->middleware('role:rt'); // route ini akan mengembalikan json yang berisi semua data keluarga (TODO data keluarga berdasarkan RT)
    Route::get('/keluarga/{no_kk}', [KeluargaController::class, 'getKeluarga'])->middleware('role:rt'); // route ini akan mengembalikan json yang berisi informasi detail dari sebuah data keluarga
});
