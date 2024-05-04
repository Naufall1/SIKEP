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
                'user_id' => '4',
                'jenis' => 'Migrasi Keluar'
            ],
            [
                'demografi_id'=>2,
                'user_id' => '4',
                'jenis' => 'Migrasi Masuk'
            ],
            [
                'demografi_id' => 3,
                'user_id' => '3',
                'jenis' => 'Meninggal'
            ],
            [
                'demografi_id' => 4,
                'user_id' => '11',
                'jenis' => 'Lahir'
            ],
            [
                'demografi_id' => 5,
                'user_id' => '3',
                'jenis' => 'Lahir'
            ],
            [
                'demografi_id' => 6,
                'user_id' => '6',
                'jenis' => 'Migrasi Masuk'
            ],
            [
                'demografi_id' => 7,
                'user_id' => '6',
                'jenis' => 'Migrasi Masuk'
            ],
        ]);
    }
}
