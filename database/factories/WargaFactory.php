<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

         // Contoh daftar agama
         $religions = ['Buddha', 'Hindu', 'Islam', 'Katolik', 'Kristen', 'Konghuchu'];

        // Contoh daftar status perkawinan
        $status_perkawinan = ["Kawin", "Belum Kawin", "Cerai", "Cerai Hidup"];

        // Contoh daftar status keluarga
        $familyStatuses = ["Kepala Keluarga", "Suami", "Istri", "Anak", "Menantu", "Cucu", "Orang Tua", "Mertua", "Famili Lain", "Pembantu", "Lainnya"];

        // Contoh daftar status warga
        $citizenStatuses = ['Aktif', 'Meninggal', 'Migrasi Keluar', 'Menunggu', 'Tidak Aktif'];

        // Contoh daftar jenis pekerjaan
        $jobs = ["Belum/Tidak Bekerja", "Mengurus Rumah Tangga", "Pelajar/Mahasiswa", "Pensiunan", "Pegawai Negeri Sipil", "Tentara Nasional Indonesia", "Kepolisian RI", "Perdagangan", "Petani/Pekebun", "Peternak", "Nelayan/Perikanan", "Industri", "Konstruksi", "Transportasi", "Karyawan Swasta", "Karyawan BUMN", "Karyawan BUMD", "Karyawan Honorer", "Buruh Harian Lepas", "Buruh Tani/Perkebunan", "Buruh Nelayan/Perikanan", "Buruh Peternakan", "Pembantu Rumah Tangga", "Tukang Cukur", "Tukang Listrik", "Tukang Batu", "Tukang Kayu", "Tukang Sol Sepatu", "Tukang Las/Pandai Besi", "Tukang Jahit", "Penata Rambut", "Penata Rias", "Penata Busana", "Mekanik", "Tukang Gigi", "Seniman", "Tabib", "Paraji", "Perancang Busana", "Penerjemah", "Imam Masjid", "Pendeta", "Pastur", "Wartawan", "Ustadz/Mubaligh", "Juru Masak", "Promotor Acara", "Anggota DPR-RI", "Anggota DPD", "Anggota BPK", "Presiden", "Wakil Presiden", "Anggota Mahkamah Konstitusi", "Anggota Kabinet/Kementerian", "Duta Besar", "Gubernur", "Wakil Gubernur", "Bupati", "Wakil Bupati", "Walikota", "Wakil Walikota", "Anggota DPRD Provinsi", "Anggota DPRD Kabupaten", "Dosen", "Guru", "Pilot", "Pengacara", "Notaris", "Arsitek", "Akuntan", "Konsultan", "Dokter", "Bidan", "Perawat", "Apoteker", "Psikiater/Psikolog", "Penyiar Televisi", "Penyiar Radio", "Pelaut", "Peneliti", "Sopir", "Pialang", "Paranormal", "Pedagang", "Perangkat Desa", "Kepala Desa", "Biarawati", "Wiraswasta", "Anggota Lembaga Tinggi", "Artis", "Atlit", "Chef", "Manajer", "Tenaga Tata Usaha", "Operator", "Pekerja Pengolahan, Kerajinan", "Teknisi", "Asisten Ahli", "Lainnya"];

        // Contoh daftar pendidikan
        $educations = ['Tidak/Belum Sekolah', 'Belum Tamat SD/Sederajat', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 'Strata II'];

        return [
            'NIK' => $this->generateNIK(),
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'agama' => $this->faker->randomElement($religions),
            'status_perkawinan' => $this->faker->randomElement($status_perkawinan),
            'status_keluarga' => $this->faker->randomElement($familyStatuses),
            'status_warga' => $this->faker->randomElement($citizenStatuses),
            'jenis_pekerjaan' => $this->faker->randomElement($jobs),
            'penghasilan' => $this->faker->numberBetween(0, 10000000),
            'kewarganegaraan' => $this->faker->randomElement(['WNI']),
            'pendidikan' => $this->faker->randomElement($educations),
            'no_paspor' => $this->faker->optional()->regexify('[A-Z]{1}[0-9]{7}'),
            'no_kitas' => $this->faker->optional()->regexify('[0-9]{10}'),
            'nama_ayah' => $this->faker->name('male'),
            'nama_ibu' => $this->faker->name('female'),
        ];
    }

    private function generateNIK() : string
    {
        $faker = \Faker\Factory::create('id_ID');

        // Kode provinsi, kota, kecamatan (contoh: Jakarta Pusat)
        $provinceCode = '31';
        $cityCode = '01';
        $districtCode = '01';

        // Tanggal lahir dan jenis kelamin
        $birthDate = $faker->dateTimeBetween('-90 years', 'now');
        $birthDay = $birthDate->format('d');
        $birthMonth = $birthDate->format('m');
        $birthYear = $birthDate->format('y');
        $gender = $faker->randomElement(['male', 'female']);

        // Penyesuaian untuk perempuan
        if ($gender == 'female') {
            $birthDay += 40;
        }

        // Nomor urut registrasi
        $uniqueNumber = $faker->unique()->numberBetween(1000, 9999);

        // Gabungkan menjadi NIK
        return $provinceCode . $cityCode . $districtCode . $birthDay . $birthMonth . $birthYear . $uniqueNumber;
    }
}
// Keluarga::factory()->count(3)->create()->each(function ($keluarga) {$jumlahWarga = rand(1, 10);Warga::factory()->count($jumlahWarga)->create(['no_kk' => $keluarga->no_kk]);});