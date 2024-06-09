<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\id_ID\Person;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keluarga>
 */
class KeluargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        // Kode provinsi, kota, kecamatan (contoh: Jakarta Pusat)
        $provinceCode = '31';
        $cityCode = '01';
        $districtCode = '01';

        // Tanggal pendaftaran (contoh: tanggal acak dalam format yymmdd)
        $registrationDate = $faker->dateTimeBetween('-10 years', 'now');
        $registrationYear = $registrationDate->format('y');
        $registrationMonth = $registrationDate->format('m');
        $registrationDay = $registrationDate->format('d');

        // Nomor urut registrasi
        $uniqueNumber = $faker->unique()->numberBetween(1000, 9999);

        // Gabungkan menjadi nomor KK
        $no_kk = $provinceCode . $cityCode . $districtCode . $registrationYear . $registrationMonth . $registrationDay . $uniqueNumber;
        return [
            'no_kk' => $no_kk,
            'kepala_keluarga' => $this->faker->name,
            'alamat' => $this->faker->address,
            'RT' => $this->faker->numberBetween(1, 11),
            'RW' => 2,
            'kode_pos' => 65115,
            'kelurahan' => 'Gadingkasri',
            'kecamatan' => 'Klojen',
            'kota' => 'Malang',
            'provinsi' => 'Jawa Timur',
            'image_kk' => 'KK.png',
            'tagihan_listrik' => $this->faker->numberBetween(0, 1000000),
            'luas_bangunan' => $this->faker->numberBetween(0, 1000)
        ];
    }
}
