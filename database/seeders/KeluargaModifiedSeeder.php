<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeluargaModifiedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('keluargamodified')->insert([
            [
                'no_kk' => '9876543210987654',
                'user_id'=> 4,
                'kepala_keluarga' => 'Maya Dewi',
                'image_kk' => 'kk_3_modified.jpg',
                'tagihan_listrik' => null,
                'luas_bangunan' => null,
                'tanggal_request' => '2024-04-27',
                'status_request' => 'Menunggu',
                'catatan' => null,
            ],
            [
                "no_kk"=> "2313678100011671",
                'user_id'=> 6,
                "kepala_keluarga"=> "Budi Santoso",
                "image_kk"=> "kk_11.jpg",
                "tagihan_listrik"=> "400000",
                "luas_bangunan"=> "300",
                'tanggal_request' => '2024-04-30',
                'status_request' => 'Menunggu',
                'catatan' => null,
            ],
        ]);
    }
}
