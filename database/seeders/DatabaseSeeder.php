<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*Keluarga::factory()->count(800)->create()->each(
            function ($keluarga) {
                $jumlahWarga = rand(0, 5);
                Warga::factory()->count(1)->create(['no_kk' => $keluarga->no_kk, 'nama' => $keluarga->kepala_keluarga, 'status_keluarga' => 'Kepala Keluarga']);
                Warga::factory()->count($jumlahWarga)->create(['no_kk' => $keluarga->no_kk]);
            });*/
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            //KeluargaSeeder::class,
            //WargaSeeder::class,
            //DemografiSeeder::class,
            //HaveDemografiSeeder::class,
            BansosSeeder::class,
            //ArticleAnnouncementSeeder::class,
            //MightGetSeeder::class,
            //WargaModifiedSeeder::class,
            //KeluargaModifiedSeeder::class,
            //PengajuanSeeder::class,
        ]);
    }
}