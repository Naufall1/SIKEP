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
                'RT' => "01",
                'RW' => "02",
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_1.jpg',
                'tagihan_listrik' => 100000,
                'luas_bangunan' => 100,
                "status"=>"Aktif"
            ],
            [
                'no_kk' => '6543210987654321',
                'kepala_keluarga' => 'Ana Sulistyowati',
                'alamat' => 'Jl. Sudirman No. 23',
                'RT' => "02",
                'RW' => "02",
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_2.jpg',
                'tagihan_listrik' => 200000,
                'luas_bangunan' => 150,
                "status"=>"Aktif"
            ],
            [
                'no_kk' => '9876543210987654',
                'kepala_keluarga' => 'Cipto Adi',
                'alamat' => 'Jl. Diponegoro No. 34',
                'RT' => "03",
                'RW' => "02",
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_3.jpg',
                'tagihan_listrik' => 300000,
                'luas_bangunan' => 200,
                "status"=>"Aktif"
            ],
            [
                'no_kk' => '4321098765432109',
                'kepala_keluarga' => 'Dini Lestari',
                'alamat' => 'Jl. Gatot Subroto No. 45',
                'RT' => "04",
                'RW' => "02",
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_4.jpg',
                'tagihan_listrik' => 400000,
                'luas_bangunan' => 250,
                "status"=>"Aktif"
            ],
            [
                'no_kk' => '2109876543210987',
                'kepala_keluarga' => 'Eko Wahyudi',
                'alamat' => 'Jl. A Yani No. 56',
                'RT' => "05",
                'RW' => "02",
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_5.jpg',
                'tagihan_listrik' => 260000,
                'luas_bangunan' => 250,
                "status"=>"Aktif"
            ],
            [
                "no_kk"=> "2313678100011671",
                "kepala_keluarga"=> "Budi Santoso",
                "alamat"=> "Jl. RA. Kartini No.10",
                "RT"=> "06",
                "RW"=> "02",
                "kode_pos"=> "65115",
                "kelurahan"=> "Gadingkasri",
                "kecamatan"=> "Klojen",
                "kota"=> "Malang",
                "provinsi"=> "Jawa Timur",
                "image_kk"=> "kk_11.jpg",
                "tagihan_listrik"=> "300000",
                "luas_bangunan"=> "300",
                "status"=>"Aktif"
            ],
            [
                "no_kk"=> "2313576100022561",
                "kepala_keluarga"=> "Bambang Raharjo",
                "alamat"=> "Jl. A Yani No. 04'",
                "RT"=> "07",
                "RW"=> "02",
                "kode_pos"=> "65115",
                "kelurahan"=> "Gadingkasri",
                "kecamatan"=> "Klojen",
                "kota"=> "Malang",
                "provinsi"=> "Jawa Timur",
                "image_kk"=> "kk_12.jpg",
                "tagihan_listrik"=> "150000",
                "luas_bangunan"=> "270",
                "status"=>"Aktif"
            ],
            [
                "no_kk"=> "2314531100099812",
                "kepala_keluarga"=> "Dodi",
                "alamat"=> "Jl. MT. Haryono No.18",
                "RT"=> "08",
                "RW"=> "02",
                "kode_pos"=> "65115",
                "kelurahan"=> "Gadingkasri",
                "kecamatan"=> "Klojen",
                "kota"=> "Malang",
                "provinsi"=> "Jawa Timur",
                "image_kk"=> "kk_13.jpg",
                "tagihan_listrik"=> "200000",
                "luas_bangunan"=> "310",
                "status"=>"Aktif"
            ],
            [
                "no_kk"=> "2318121009022314",
                "kepala_keluarga"=> "Joni",
                "alamat"=> "Jl. A Yani No. 17'",
                "RT"=> "09",
                "RW"=> "02",
                "kode_pos"=> "65115",
                "kelurahan"=> "Gadingkasri",
                "kecamatan"=> "Klojen",
                "kota"=> "Malang",
                "provinsi"=> "Jawa Timur",
                "image_kk"=> "kk_14.jpg",
                "tagihan_listrik"=> "250000",
                "luas_bangunan"=> "200",
                "status"=>"Aktif"
            ],
            [
                "no_kk"=> "2314239200016131",
                "kepala_keluarga"=> "Muhammad Farhan ",
                "alamat"=> "Jl. RA. Kartini No.27",
                "RT"=> "10",
                "RW"=> "02",
                "kode_pos"=> "65115",
                "kelurahan"=> "Gadingkasri",
                "kecamatan"=> "Klojen",
                "kota"=> "Malang",
                "provinsi"=> "Jawa Timur",
                "image_kk"=> "kk_15.jpg",
                "tagihan_listrik"=> "200000",
                "luas_bangunan"=> "280",
                "status"=>"Aktif"
            ],
            [
                'no_kk' => '6539139200016131',
                'kepala_keluarga' => 'Aditya Pratama',
                'alamat' => 'Jl. Ikan Piranha No. 22',
                'RT' => "05",
                'RW' => "02",
                'kode_pos' => '65115',
                'kelurahan' => 'Gadingkasri',
                'kecamatan' => 'Klojen',
                'kota' => 'Malang',
                'provinsi' => 'Jawa Timur',
                'image_kk' => 'kk_16.jpg',
                'tagihan_listrik' => 200000,
                'luas_bangunan' => 120,
                "status"=>"Menunggu"
            ],
        ]);

    }
}
