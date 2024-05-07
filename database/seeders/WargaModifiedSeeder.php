<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaModifiedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wargamodified')->insert([
            [
                'NIK' => '7913579246801357',
                'no_kk' => '9876543210987654',
                'user_id' => 4,
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'status_keluarga' => 'Kepala Keluarga',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Mengurus Rumah Tangga',
                'penghasilan' => 0,
                'pendidikan' => 'Diploma IV/Strata 1',
                'tanggal_request' => '2024-04-27',
                'status_request' => 'Menunggu',
                'catatan' => null,
            ],
            [
                'NIK' => '2313570960022561',
                'no_kk' => '2313576100022561',
                'user_id' => 11,
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'status_keluarga' => 'Anak',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Pegawai Negeri Sipil',
                'penghasilan' => "6000000",
                'pendidikan' => 'Diploma IV/Strata 1',
                'tanggal_request' => '2024-04-29',
                'status_request' => 'Menunggu',
                'catatan' => null,
            ],
        ]);
    }
}