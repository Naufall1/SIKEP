<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            KeluargaSeeder::class,
            WargaSeeder::class,
            DemografiSeeder::class,
            HaveDemografiSeeder::class,
            BansosSeeder::class,
            ArticleAnnouncementSeeder::class,
            MightGetSeeder::class,
            WargaModifiedSeeder::class,
            KeluargaModifiedSeeder::class,
            PengajuanSeeder::class,
        ]);
    }
}
