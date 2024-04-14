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
                'username' => 'ketuart1',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 1,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart2',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 2,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart3',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 3,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart4',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 4,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart5',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 5,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart6',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 6,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart7',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 7,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart8',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 8,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart9',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 9,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart10',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 10,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart11',
                'password' => Hash::make('admin'),
                'nama' => 'Pak RT',
                'keterangan' => 11,
            ],
            [
                'level_id' => 3,
                'username' => 'admin1',
                'password' => Hash::make('admin'),
                'nama' => 'Admin',
                'keterangan' => 'admin 1',
            ],
            [
                'level_id' => 3,
                'username' => 'admin2',
                'password' => Hash::make('admin'),
                'nama' => 'Admin',
                'keterangan' => 'admin 2',
            ],
        ]);
    }
}
