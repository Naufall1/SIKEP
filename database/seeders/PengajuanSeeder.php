<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengajuan')->insert([
            [
                'user_id' => 4,
                'no_kk' => '9876543210987654',
                'tanggal_request' => '2024-03-23',
                'status_request' => 'Menunggu',
                'catatan' => null,
                'tipe'=> 'Pembaruan',
            ],
            [
                'user_id' => 4,
                'no_kk' => '9876543210987654',
                'tanggal_request' => '2024-03-20',
                'status_request' => 'Menunggu',
                'catatan' => null,
                'tipe'=> 'Pembaruan',
            ],
            [
                'user_id' => 3,
                'no_kk' => '6543210987654321',
                'tanggal_request' => '2024-03-30',
                'status_request' => 'Menunggu',
                'catatan' => null,
                'tipe'=> 'Pembaruan',
            ],
            [
                'user_id' => 4,
                'no_kk' => '2313678100011671',
                'tanggal_request' => '2024-03-31',
                'status_request' => 'Dikonfirmasi',
                'catatan' => null,
                'tipe'=> 'Pembaruan',
            ],
            [
                'user_id' => 5,
                'no_kk' => '2313678100011671',
                'tanggal_request' => '2024-03-31',
                'status_request' => 'Dikonfirmasi',
                'catatan' => null,
                'tipe'=> 'Pembaruan',
            ],
            [
                'user_id' => 6,
                'no_kk' => '2313678100011671',
                'tanggal_request' => '2024-04-30',
                'status_request' => 'Menunggu',
                'catatan' => null,
                'tipe'=> 'Perubahan Keluarga',
            ],
            [
                'user_id' => 4,
                'no_kk' => '9876543210987654',
                'tanggal_request' => '2024-03-23',
                'status_request' => 'Menunggu',
                'catatan' => null,
                'tipe'=> 'Perubahan Keluarga',
            ],
            [
                'user_id' => 4,
                'no_kk' => '9876543210987654',
                'tanggal_request' => '2024-04-27',
                'status_request' => 'Menunggu',
                'catatan' => null,
                'tipe'=> 'Perubahan Warga',
            ],
            [
                'user_id' => 4,
                'no_kk' => '2313576100022561',
                'tanggal_request' => '2024-04-29',
                'status_request' => 'Menunggu',
                'catatan' => null,
                'tipe'=> 'Perubahan Warga',
            ],
        ]);
    }
}
