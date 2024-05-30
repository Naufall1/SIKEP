<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleAnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('article_announcement')->insert([
            [
                'kode'=>'AR001',
                'user_id' => 13,
                'kategori'=>'Artikel',
                'penulis'=>'Kriswantoro',
                'tanggal_publish'=>'2024-03-24',
                'tanggal_dibuat'=>'2024-03-20',
                'tanggal_edit'=>'2024-03-23',
                'judul'=>'Pengurus RT 1, 2, 3, dan 11 Lakukan Giat Santunan Yatim dan Jompo',
                'isi'=>'Malang, 24 Maret 2024 – Dalam rangka mempererat tali silaturahmi dan rasa kepedulian terhadap sesama, Pengurus RT 1, 2, 3, dan 11 mengadakan kegiatan santunan yatim dan jompo.
                        Acara ini dihadiri oleh puluhan anak yatim dan lansia dari wilayah RT 1, 2, 3, dan 11. Selain santunan, acara ini juga dimeriahkan dengan berbagai hiburan, seperti pembagian doorprize.
                        Ketua Panitia Pelaksana, Indra Putra, dalam sambutannya menyampaikan bahwa kegiatan ini merupakan bentuk kepedulian dan tanggung jawab sosial para pengurus RT terhadap anak yatim dan lansia di wilayahnya.
                        "Kami berharap santunan ini dapat membantu meringankan beban anak yatim dan lansia, serta memberikan mereka kebahagiaan di bulan Ramadhan ini," ujar Indra Putra.

                        Salah satu anak yatim, Agung, menyampaikan rasa terima kasihnya atas bantuan yang diberikan.
                        "Saya senang sekali bisa mendapatkan santunan ini. Saya akan menggunakan uang ini untuk membeli keperluan sekolah," kata Agung.

                        Kegiatan ini disambut baik oleh para warga RT 1, 2, 3, dan 11. Mereka berharap kegiatan seperti ini dapat terus diadakan secara berkala.
                        "Kegiatan ini sangat bermanfaat bagi anak yatim dan lansia. Terima kasih kepada para pengurus RT yang telah mengadakan acara ini," ujar Yudha.

                        Pengurus RT 1, 2, 3, dan 11 berkomitmen untuk terus membantu dan memberikan perhatian kepada anak yatim dan lansia di wilayahnya. Mereka berharap kegiatan santunan ini dapat menjadi inspirasi bagi pihak lain untuk melakukan hal yang sama.',
                'status'=>'Ditampilkan',
                'image_url'=>'ar001.jpg',
                'caption'=>'Ketua Panitia memberikan santunan secara simbolis',
            ],
            [
                'kode'=>'AN001',
                'user_id' => 14,
                'kategori'=>'Pengumuman',
                'penulis'=>'Siti',
                'tanggal_publish'=>'2024-04-02',
                'tanggal_dibuat'=>'2024-04-01',
                'tanggal_edit'=>'2024-04-01',
                'judul'=>'Pemilihan RW 02: Menuju Kepemimpinan Gacor Melalui Sistem Door To Door!',
                'isi'=>'Warga RW 08 yang Budiman!

                        Mari bersama kita ciptakan RW 02 yang maju, sejahtera, dan menyenangkan dengan memilih pemimpin yang tepat, amanah, dan berdedikasi tinggi.
                        Oleh karena itu, kami selaku panitia Pemilihan Ketua RW 02 Periode 2024-2027 akan menyelenggarakan Pemilihan Ketua RW 02 dengan menggunakan sistem Door To Door.

                        Jadwal Pemilihan:

                        Tanggal: Senin, 15 April 2024
                        Waktu: 07.00-Selesai
                        Lokasi: Kunjungan Petugas Pemungutan Suara ke rumah warga

                        Syarat Memilih:
                        Warga RW 08 yang telah berusia 17 tahun ke atas dan terdaftar dalam daftar pemilih tetap
                        Membawa Kartu Tanda Penduduk (KTP) yang masih berlaku',
                'status'=>'Ditampilkan',
                'image_url'=>'an001.jpg',
                'caption'=>'tata cara pemilihan suara door to door',
            ],
        ]);
    }
}
