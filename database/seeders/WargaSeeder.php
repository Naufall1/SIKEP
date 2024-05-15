<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warga')->insert([
            [
                'NIK' => '2468013579246801',
                'no_kk' => '1234567890123456',
                'nama' => 'Budi Santoso',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1980-01-01',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'status_keluarga' => 'Kepala Keluarga',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Karyawan Swasta',
                'penghasilan' => 5000000,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'Diploma IV/Strata 1',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Sutrisno',
                'nama_ibu' => 'Sulastri',
                'created_at' => now(),
            ],
            [
                'NIK' => '0246801357924680',
                'no_kk' => '1234567890123456',
                'nama' => 'Indah Rahayu',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1982-06-23',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'status_keluarga' => 'Istri',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Mengurus Rumah Tangga',
                'penghasilan' => 0,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'Diploma IV/Strata 1',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Suhendro',
                'nama_ibu' => 'Rini',
                'created_at' => now(),
            ],
            [
                'NIK' => '3579246801357924',
                'no_kk' => '1234567890123456',
                'nama' => 'Amira Putri',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2007-08-30',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'status_keluarga' => 'Anak',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Pelajar/Mahasiswa',
                'penghasilan' => 0,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'SLTA/Sederajat',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Budi Santoso',
                'nama_ibu' => 'Indah Rahayu',
                'created_at' => now(),
            ],
            [
                'NIK' => '4680135792468013',
                'no_kk' => '1234567890123456',
                'nama' => 'Bima Ananta',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2011-11-27',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'status_keluarga' => 'Anak',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Pelajar/Mahasiswa',
                'penghasilan' => 0,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'Tamat SD/Sederajat',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Budi Santoso',
                'nama_ibu' => 'Indah Rahayu',
                'created_at' => now(),
            ],
            [
                'NIK' => '1357924680135792',
                'no_kk' => '2109876543210987',
                'nama' => 'Eko Wahyudi',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1987-09-04',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'status_keluarga' => 'Kepala Keluarga',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Karyawan Swasta',
                'penghasilan' => 4300000,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'Diploma IV/Strata 1',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Bambang',
                'nama_ibu' => 'Rini',
                'created_at' => now(),
            ],
            [
                'NIK' => '6801357924680135',
                'no_kk' => '2109876543210987',
                'nama' => 'Wulan Anggraini',
                'tempat_lahir' => 'Blitar',
                'tanggal_lahir' => '1989-04-19',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'status_keluarga' => 'Istri',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Mengurus Rumah Tangga',
                'penghasilan' => 0,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'Diploma IV/Strata 1',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Surya',
                'nama_ibu' => 'Sukarti',
                'created_at' => now(),
            ],
            [
                'NIK' => '5792468013579246',
                'no_kk' => '6543210987654321',
                'nama' => 'Ana Sulistyowati',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1985-02-02',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'status_perkawinan' => 'Cerai Mati',
                'status_keluarga' => 'Kepala Keluarga',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Belum/Tidak Bekerja',
                'penghasilan' => 0,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'DIPLOMA I/II',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Slamet',
                'nama_ibu' => 'Siti',
                'created_at' => now(),
            ],
            [
                'NIK' => '8024680135792468',
                'no_kk' => '4321098765432109',
                'nama' => 'Dini Lestari',
                'tempat_lahir' => 'Sidoarjo',
                'tanggal_lahir' => '1992-11-06',
                'jenis_kelamin' => 'P',
                'agama' => 'Kristen',
                'status_perkawinan' => 'Belum Kawin',
                'status_keluarga' => 'Kepala Keluarga',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Belum/Tidak Bekerja',
                'penghasilan' => 0,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'Diploma IV/Strata 1',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Sutomo',
                'nama_ibu' => 'Suparti',
                'created_at' => now(),
            ],
            [
                'NIK' => '9135792468024680',
                'no_kk' => '9876543210987654',
                'nama' => 'Cipto Adi',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1988-08-21',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'status_keluarga' => 'Kepala Keluarga',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Pegawai Negeri Sipil',
                'penghasilan' => 6000000,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'Diploma IV/Strata 1',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Suparjo',
                'nama_ibu' => 'Sri',
                'created_at' => now(),
            ],
            [
                'NIK' => '7913579246801357',
                'no_kk' => '9876543210987654',
                'nama' => 'Maya Dewi',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1990-09-29',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'status_keluarga' => 'Istri',
                'status_warga' => 'Aktif',
                'jenis_pekerjaan' => 'Mengurus Rumah Tangga',
                'penghasilan' => 0,
                'kewarganegaraan' => 'WNI',
                'pendidikan' => 'Diploma IV/Strata 1',
                'no_paspor' => NULL,
                'no_kitas' => NULL,
                'nama_ayah' => 'Joko',
                'nama_ibu' => 'Tini',
                'created_at' => now(),
            ],
            [
                "NIK"=> "2313671102950001",
                "no_kk"=> "2313678100011671",
                "nama"=> "Budi Santoso",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1995-02-01",
                "jenis_kelamin"=> "L",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Kepala Keluarga",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Pegawai Negeri Sipil",
                "penghasilan"=> "1000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Diploma IV/Strata 1",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Giono",
                "nama_ibu"=> "Siti Aisyah",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2313671109960001",
                "no_kk"=> "2313678100011671",
                "nama"=> "Fauziah Nuraini",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1996-11-09",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Istri",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Pegawai Negeri Sipil",
                "penghasilan"=> "1000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Diploma IV/Strata 1",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Wartono",
                "nama_ibu"=> "Nur Laila",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2313673003240001",
                "no_kk"=> "2313678100011671",
                "nama"=> "Erika Zahra",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "2024-03-30",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Belum Kawin",
                "status_keluarga"=> "Anak",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Belum/Tidak Bekerja",
                "penghasilan"=> "0",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Tidak/Belum Sekolah",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Budi Santoso",
                "nama_ibu"=> "Fauziah Nuraini",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2313673003241001",
                "no_kk"=> "2313678100011671",
                "nama"=> "Elisha Zahra",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "2024-03-30",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Belum Kawin",
                "status_keluarga"=> "Anak",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Belum/Tidak Bekerja",
                "penghasilan"=> "0",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Tidak/Belum Sekolah",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Budi Santoso",
                "nama_ibu"=> "Fauziah Nuraini",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2313570505060561",
                "no_kk"=> "2313576100022561",
                "nama"=> "Bambang Raharjo",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1960-05-05",
                "jenis_kelamin"=> "L",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Kepala Keluarga",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Kepolisian RI",
                "penghasilan"=> "2000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Akademi/Diploma III/S. Muda",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Sapriadi",
                "nama_ibu"=> "Ummi Haida",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2313570206672561",
                "no_kk"=> "2313576100022561",
                "nama"=> "Dessy Maryanti",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1967-02-06",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Istri",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Mengurus Rumah Tangga",
                "penghasilan"=> "0",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "SLTA/Sederajat",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Suprapto",
                "nama_ibu"=> "Jubaidah",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2313570960022561",
                "no_kk"=> "2313576100022561",
                "nama"=> "Bintang Raharja",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1995-09-02",
                "jenis_kelamin"=> "L",
                "agama"=> "Islam",
                "status_perkawinan"=> "Belum Kawin",
                "status_keluarga"=> "Anak",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Pegawai Negeri Sipil",
                "penghasilan"=> "5000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Diploma IV/Strata 1",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Bambang Raharjo",
                "nama_ibu"=> "Dessy Maryanti",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2314532300019812",
                "no_kk"=> "2314531100099812",
                "nama"=> "Dodi",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1987-11-08",
                "jenis_kelamin"=> "L",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Kepala Keluarga",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Petani/Pekebun",
                "penghasilan"=> "1000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "SLTA/Sederajat",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Hermansyah",
                "nama_ibu"=> "Siti Marya ",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2314531200129812",
                "no_kk"=> "2314531100099812",
                "nama"=> "Lailatul Komariah",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1990-12-26",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Istri",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Wiraswasta",
                "penghasilan"=> "1000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "SLTA/Sederajat",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Sujito",
                "nama_ibu"=> "Hodijah",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2314531902439812",
                "no_kk"=> "2314531100099812",
                "nama"=> "Aisyah Malika",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "2012-12-12",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Belum Kawin",
                "status_keluarga"=> "Anak",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Pelajar/Mahasiswa",
                "penghasilan"=> "0",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Belum Tamat SD/Sederajat",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Dodi",
                "nama_ibu"=> "Lailatul Komariah",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2318121013422314",
                "no_kk"=> "2318121009022314",
                "nama"=> "Joni",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1988-09-11",
                "jenis_kelamin"=> "L",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Kepala Keluarga",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Wiraswasta",
                "penghasilan"=> "5000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Diploma IV/Strata 1",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Imam Kurniawan",
                "nama_ibu"=> "Siti Badriah",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2318122451022314",
                "no_kk"=> "2318121009022314",
                "nama"=> "Siti Riyanti Putri",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1989-09-12",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Istri",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Wiraswasta",
                "penghasilan"=> "2000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "SLTA/Sederajat",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Nanang Haryanto",
                "nama_ibu"=> "Kotrunada",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2318121091022314",
                "no_kk"=> "2318121009022314",
                "nama"=> "Aurelya Azzahra Kartika Putri",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "2010-11-10",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Belum Kawin",
                "status_keluarga"=> "Anak",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Pelajar/Mahasiswa",
                "penghasilan"=> "0",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "SLTP/Sederajat",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Joni",
                "nama_ibu"=> "Siti Riyanti Putri",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2314292347216131",
                "no_kk"=> "2314239200016131",
                "nama"=> "Muhammad Farhan ",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1982-12-12",
                "jenis_kelamin"=> "L",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Kepala Keluarga",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Pegawai Negeri Sipil",
                "penghasilan"=> "4000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Diploma IV/Strata 1",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Arif Haydar",
                "nama_ibu"=> "Muti",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2314239271023131",
                "no_kk"=> "2314239200016131",
                "nama"=> "Bela Aulia",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1984-07-28",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Istri",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Wiraswasta",
                "penghasilan"=> "2000000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Diploma IV/Strata 1",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Basir",
                "nama_ibu"=> "Susi Susanti",
                'created_at' => now(),
            ],
            [
                "NIK"=> "2314238340116131",
                "no_kk"=> "2314239200016131",
                "nama"=> "Almira Zivana Putri",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "2007-05-25",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Belum Kawin",
                "status_keluarga"=> "Anak",
                "status_warga"=> "Aktif",
                "jenis_pekerjaan"=> "Pelajar/Mahasiswa",
                "penghasilan"=> "0",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "SLTA/Sederajat",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Muhammad Farhan ",
                "nama_ibu"=> "Bela Aulia",
                'created_at' => now(),
            ],
            [
                "NIK"=> "7825039271023119",
                "no_kk"=> "6539139200016131",
                "nama"=> "Aditya Pratama",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1990-11-24",
                "jenis_kelamin"=> "L",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Kepala Keluarga",
                "status_warga"=> "Migrasi Keluar",
                "jenis_pekerjaan"=> "Wiraswasta",
                "penghasilan"=> "3500000",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Diploma IV/Strata 1",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Fadhil Rizqi",
                "nama_ibu"=> "Nurlaila Rizky",
                'created_at' => now(),
            ],
            [
                "NIK"=> "9630138340116001",
                "no_kk"=> "6539139200016131",
                "nama"=> "Maya Listiani",
                "tempat_lahir"=> "Malang",
                "tanggal_lahir"=> "1992-08-30",
                "jenis_kelamin"=> "P",
                "agama"=> "Islam",
                "status_perkawinan"=> "Kawin",
                "status_keluarga"=> "Istri",
                "status_warga"=> "Migrasi Keluar",
                "jenis_pekerjaan"=> "Mengurus Rumah Tangga",
                "penghasilan"=> "0",
                "kewarganegaraan"=> "WNI",
                "pendidikan"=> "Diploma IV/Strata 1",
                "no_paspor"=> "NULL",
                "no_kitas"=> "NULL",
                "nama_ayah"=> "Muhammad Rafi ",
                "nama_ibu"=> "Kirana Dewi",
                'created_at' => now(),
            ]
        ]);
    }
}
