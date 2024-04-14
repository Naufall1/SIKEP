<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MightGetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('might_get')->insert([
            [
                'no_kk' => '2313678100011671',
                'bansos_kode' => 'BPNT',
                'tanggal_menerima' => '2024-01-29'
            ],
            [
                'no_kk' => '2313678100011671',
                'bansos_kode' => 'PKH',
                'tanggal_menerima' => '2024-01-19'
            ],
            [
                'no_kk' => '6543210987654321',
                'bansos_kode' => 'BLT',
                'tanggal_menerima' => '2024-01-24'
            ],
            [
                'no_kk' => '2313678100011671',
                'bansos_kode' => 'BSU',
                'tanggal_menerima' => '2024-01-12'
            ],
            [
                'no_kk' => '6543210987654321',
                'bansos_kode' => 'BSU',
                'tanggal_menerima' => '2024-02-01'
            ],
        ]);
    }
}
