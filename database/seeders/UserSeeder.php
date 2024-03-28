<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'level_id' => 1,
                'username' => 'ketuarw',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RW',
                'keterangan' => 'ketua',
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 'ketua',
            ],
            [
                'level_id' => 3,
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'nama' => 'Admin',
                'keterangan' => '-',
            ]
        ]);
    }
}
