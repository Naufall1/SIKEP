<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('keluarga')->insert([
            [
                'no_kk' => '1234567890123456',
                'kepala_keluarga' => 'Budi Santoso',
                'alamat' => 'Jl. Merdeka No. 12',
                'RT' => 01,
                'RW' => 02,
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_1.jpg',
                'tagihan_listrik' => 100000,
                'luas_bangunan' => 100,
            ],
            [
                'no_kk' => '6543210987654321',
                'kepala_keluarga' => 'Ana Sulistyowati',
                'alamat' => 'Jl. Sudirman No. 23',
                'RT' => 02,
                'RW' => 02,
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_2.jpg',
                'tagihan_listrik' => 200000,
                'luas_bangunan' => 150,
            ],
            [
                'no_kk' => '9876543210987654',
                'kepala_keluarga' => 'Cipto Adi',
                'alamat' => 'Jl. Diponegoro No. 34',
                'RT' => 03,
                'RW' => 02,
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_3.jpg',
                'tagihan_listrik' => 300000,
                'luas_bangunan' => 200,
            ],
            [
                'no_kk' => '4321098765432109',
                'kepala_keluarga' => 'Dini Lestari',
                'alamat' => 'Jl. Gatot Subroto No. 45',
                'RT' => 04,
                'RW' => 02,
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_4.jpg',
                'tagihan_listrik' => 400000,
                'luas_bangunan' => 250,
            ],
            [
                'no_kk' => '2109876543210987',
                'kepala_keluarga' => 'Eko Wahyudi',
                'alamat' => 'Jl. A Yani No. 56',
                'RT' => 05,
                'RW' => 02,
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_5.jpg',
                'tagihan_listrik' => 260000,
                'luas_bangunan' => 250,
            ]
        ]);

    }
}
