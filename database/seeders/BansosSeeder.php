<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bansos')->insert([
            [
                'bansos_kode' => 'BPNT',
                'bansos_nama' => 'Bantuan Pangan Non Tunai',
                'keterangan' => 'BPNT adalah program bansos pangan yang diberikan kepada KPM melalui mekanisme perbankan.'
            ],
            [
                'bansos_kode' => 'PKH',
                'bansos_nama' => 'Program Keluarga Harapan',
                'keterangan' => 'PKH adalah program bansos bersyarat yang ditujukan kepada keluarga miskin dan rentan miskin dengan fokus pada peningkatan kualitas sumber daya manusia (SDM).'
            ],
            [
                'bansos_kode' => 'BLT',
                'bansos_nama' => 'Bantuan Langsung Tunai',
                'keterangan' => 'BLT adalah program bansos tunai yang diberikan kepada masyarakat untuk membantu meringankan beban ekonomi akibat kenaikan harga bahan bakar minyak (BBM).'
            ],
            [
                'bansos_kode' => 'BSU',
                'bansos_nama' => 'Bantuan Subsidi Upah',
                'keterangan' => 'BSU adalah program bansos tunai yang diberikan kepada pekerja/buruh yang memiliki gaji di bawah Rp 3,5 juta per bulan.'
            ],
        ]);
    }
}
