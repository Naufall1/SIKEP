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
                'password' => Hash::make('ketuarw002'),
                'nama' => 'Pak RW',
                'keterangan' => 'ketua',
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart1',
                'password' => Hash::make('ketuart001'),
                'nama' => 'Pak RT 001',
                'keterangan' => 1,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart2',
                'password' => Hash::make('ketuart002'),
                'nama' => 'Pak RT 002',
                'keterangan' => 2,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart3',
                'password' => Hash::make('ketuart003'),
                'nama' => 'Pak RT 003',
                'keterangan' => 3,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart4',
                'password' => Hash::make('ketuart004'),
                'nama' => 'Pak RT 004',
                'keterangan' => 4,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart5',
                'password' => Hash::make('ketuart005'),
                'nama' => 'Pak RT 005',
                'keterangan' => 5,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart6',
                'password' => Hash::make('ketuart006'),
                'nama' => 'Pak RT 006',
                'keterangan' => 6,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart7',
                'password' => Hash::make('ketuart007'),
                'nama' => 'Pak RT 007',
                'keterangan' => 7,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart8',
                'password' => Hash::make('ketuart008'),
                'nama' => 'Pak RT 008',
                'keterangan' => 8,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart9',
                'password' => Hash::make('ketuart009'),
                'nama' => 'Pak RT 009',
                'keterangan' => 9,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart10',
                'password' => Hash::make('ketuart010'),
                'nama' => 'Pak RT 010',
                'keterangan' => 10,
            ],
            [
                'level_id' => 2,
                'username' => 'ketuart11',
                'password' => Hash::make('ketuart011'),
                'nama' => 'Pak RT 011',
                'keterangan' => 11,
            ],
            [
                'level_id' => 3,
                'username' => 'admin1',
                'password' => Hash::make('admin01'),
                'nama' => 'Admin',
                'keterangan' => 'admin 1',
            ],
            [
                'level_id' => 3,
                'username' => 'admin2',
                'password' => Hash::make('admin02'),
                'nama' => 'Admin',
                'keterangan' => 'admin 2',
            ],
        ]);
    }
}
