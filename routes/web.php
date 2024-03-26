<?php

use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('penduduk')->group(function () {
    Route::get('/', function () {
        return redirect()->route('warga');
    });
    // Route::get('/loadK', [PendudukController::class, 'loadDummyKeluarga']);

    /**
     * Route untuk manage Warga
     */
    Route::get('/warga', [PendudukController::class, 'warga'])->name('warga'); // untuk menampilkan tabel warga
    Route::get('/warga/ubah/{nik}', [PendudukController::class, 'wargaEdit']); // untuk menampilkan form edit data Warga
    Route::put('/warga/ubah/{nik}', [PendudukController::class, 'wargaUpdate']); // untuk menangani update data Warga dan menyimpan pada database
    Route::get('/warga/tambah/', [PendudukController::class, 'wargaCreate']); // untuk menampilkan form penambahan data warga
    Route::post('/warga/tambah/', [PendudukController::class, 'wargaStore']); // untuk menangani penambahan data Warga

    /**
     * Route untuk manage Keluarga
     */
    Route::get('/keluarga', [PendudukController::class, 'keluarga']); // untuk menampilkan tabel keluarga
    Route::get('/keluarga/ubah/{no_kk}', [PendudukController::class, 'keluargaEdit']); // untuk menampilkan form edit data keluarga
    Route::put('/keluarga/ubah/{no_kk}', [PendudukController::class, 'keluargaUpdate']); // untuk menangani update data Keluarga dan menyimpan pada database
});

Route::prefix('pengajuan')->group(function () {
    Route::get('/', [ 'index']); // Menampilkan halaman utama menu Pengajuan
    

    /**
     * Route untuk menampilkan tabel-tabel data pengajuan
     */
    Route::get('/data-baru', [ 'dataBaru'])->name('dataBaru'); // memberikan data request penambahan data baru
    Route::get('/perubahan-warga', [ 'perubahanWarga'])->name('perubahanWarga'); // memberikan data request perubahan data warga
    Route::get('/perubahan-keluarga', [ 'perubahanKeluarga'])->name('perubahanKeluarga'); // memberikan data request perubahan data keluarga

    /**
     * Route untuk menangani proses konfirmasi dan tolak sebuah data pengajuan
     */
    Route::get('/detail/{id}', [ 'detail'])->name('detail'); // memberikan halaman detail sebuah data pengajuan
    Route::get('/detail/{id}/keluarga', [ 'detail'])->name('detailKeluarga'); // memberikan halaman detail keluarga dari sebuah data pengajuan
    Route::get('/detail/{id}/warga/{nik}', [ 'detail'])->name('detailWarga'); // memberikan halaman detail warga dari sebuah data pengajuan
    Route::get('/konfirmasi/{id}', [ 'konfirmasi'])->name('confirmPengajuan'); // melakukan proses konfirmasi/terima sebuah data pengajuan
    Route::post('/tolak/{id}', [ 'tolak'])->name('rejectPengajuan'); // melakukan proses tolak sebuah data pengajuan
});

Route::prefix('bansos')->group(function () {
    Route::get('/kriteria', [])->name('kriteria'); // menampilkan tabel yang berisi semua data kriteria yang digunakan untuk SPK (Sistem Pendukung Keputusan)
    Route::get('/kriteria/ubah/{id}', [])->name('kriteriaForm'); // menampilkan form yang digunakan untuk merubah data kriteria
    Route::put('/kriteria/ubah/{id}', [])->name('kriteriaUpdate'); // menerima data dari form edit dan menyimpannya pada database

    Route::get('/perhitungan', [])->name('perhitungan'); // menampilkan tabel perankingan dari hasil perhitungan SPK (Sistem Pendukung Keputusan)
    Route::get('/perhitungan/detail/{}', []); // menampilkan detail dari keluarga
    Route::post('/tambah', [])->name('tambahPenerimaBansos'); // menangani penerimaan data dari form penambahan penerima bansos dan menyimpan pada database

});

Route::prefix('profile')->group(function () {
    Route::get('/', []); // menampilkan halaman profile user
    Route::get('/ubah', []); // menampilkan halaman form edit user
    Route::put('/ubah', []); // menangani penerimaan data dari form edit user dan menyimpan pada database
});

Route::prefix('publikasi')->group(function () {
    Route::get('/', []); // menampilkan halaman yang berisi tabel daftar publikasi
    Route::get('/detail/{id}', []); // menampilkan detail dari sebuah publikasi
    Route::get('/tambah', []); // menampilkan form untuk menambahkan sebuah article atau pengumuman
    Route::post('/tambah', []); // mmelakukan proses menerima data dari form penambahan data dan mrnyimpannya pada databse
});