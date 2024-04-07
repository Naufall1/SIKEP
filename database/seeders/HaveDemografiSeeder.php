<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HaveDemografiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('have_demografi')->insert([
            [
                'NIK'=>9135792468024680,
                'demografi_id' => 1,
                'tanggal_kejadian'=>'2024-03-20',
                'tanggal_request'=>'2024-03-23',
                'catatan'=>NULL,
                'dokumen_pendukung'=>'dokumen1.jpg',
                'status_request'=>'Menunggu'
            ],
            [
                'NIK'=>7913579246801357,
                'demografi_id' => 2,
                'tanggal_kejadian'=>'2024-03-18',
                'tanggal_request'=>'2024-03-20',
                'catatan'=>NULL,
                'dokumen_pendukung'=>'dokumen2.jpg',
                'status_request'=>'Menunggu'
            ],
            [
                'NIK'=>5792468013579246,
                'demografi_id' => 4,
                'tanggal_kejadian'=>'2024-03-29',
                'tanggal_request'=>'2024-03-30',
                'catatan'=>NULL,
                'dokumen_pendukung'=>'dokumen3.jpg',
                'status_request'=>'Menunggu'
            ],
            [
                'NIK'=>2313673003240001,
                'demografi_id' => 3,
                'tanggal_kejadian'=>'2024-03-30',
                'tanggal_request'=>'2024-03-31',
                'catatan'=>NULL,
                'dokumen_pendukung'=>'dokumen4.jpg',
                'status_request'=>'Dikonfirmasi'
            ],
            [
                'NIK'=>5792468013579246,
                'demografi_id' => 3,
                'tanggal_kejadian'=>'2024-03-30',
                'tanggal_request'=>'2024-03-31',
                'catatan'=>NULL,
                'dokumen_pendukung'=>'dokumen4.jpg',
                'status_request'=>'Dikonfirmasi'
            ],
        ]);
    }
}
