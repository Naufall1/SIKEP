<?php

namespace App\Http\Controllers;

use App\Models\KeluargaModel;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function warga(){
        return view('penduduk.warga');
    }
    public function loadDummyKeluarga(){
        // Data dummy
        $dummyData = [
            [
                'no_kk' => '1234567890',
                'kepala_keluarga' => 'John Doe',
                'alamat' => 'Jl. Contoh No. 123',
                'RT' => '001',
                'RW' => '002',
                'kode_pos' => '12345',
                'kelurahan' => 'Contoh Kelurahan',
                'kecamatan' => 'Contoh Kecamatan',
                'kota' => 'Contoh Kota',
                'provinsi' => 'Contoh Provinsi',
                'tagihan_listrik' => '500000',
                'luas_bangunan' => '200',
                'image_kk' => 'hiden.jpg',
            ],
            [
                'no_kk' => '0987654321',
                'kepala_keluarga' => 'Jane Doe',
                'alamat' => 'Jl. Dummy No. 456',
                'RT' => '003',
                'RW' => '004',
                'kode_pos' => '54321',
                'kelurahan' => 'Dummy Kelurahan',
                'kecamatan' => 'Dummy Kecamatan',
                'kota' => 'Dummy Kota',
                'provinsi' => 'Dummy Provinsi',
                'tagihan_listrik' => '600000',
                'luas_bangunan' => '250',
                'image_kk' => 'hiden.jpg',
            ]
        ];
        foreach ($dummyData as $data) {
            KeluargaModel::create($data);
        }
        return 'OK';
    }
    public function keluarga(){
        $data = KeluargaModel::all();
        return view('penduduk.keluarga', ['dataKeluarga' => $data]);
    }
}
