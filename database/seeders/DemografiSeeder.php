<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemografiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('demografi')->insert([
            [
                'demografi_id' => 1,
                'user_id' => '2',
                'jenis' => 'Migrasi Keluar'
            ],
            [
                'demografi_id'=>2,
                'user_id' => '2',
                'jenis' => 'Migrasi Masuk'
            ],
            [
                'demografi_id' => 3,
                'user_id' => '2',
                'jenis' => 'Kelahiran'
            ],
            [
                'demografi_id' => 4,
                'user_id' => '2',
                'jenis' => 'Kematian'
            ],
        ]);
    }
}
