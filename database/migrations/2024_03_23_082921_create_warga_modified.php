<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wargaModified', function (Blueprint $table) {
            $table->id('id_modify_warga');
            $table->char('NIK', 16);
            $table->char('no_kk', 16)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('nama', 100);
            $table->enum('agama', ['Buddha', 'Hindu', 'Islam', 'Katolik', 'Kristen', 'Konghuchu', '-'])->nullable();
            $table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati', '-'])->nullable();
            $table->enum('status_keluarga', ["Kepala Keluarga", "Suami", "Istri", "Anak", "Menantu", "Cucu", "Orang Tua", "Mertua", "Famili Lain", "Pembantu", "Lainnya"])->nullable();
            $table->enum('status_warga', ['Aktif', 'Migrasi Masuk', 'Lahir', 'Meninggal', 'Migrasi Keluar', '-'])->nullable();
            $table->enum('jenis_pekerjaan', ["Belum/Tidak Bekerja", "Mengurus Rumah Tangga", "Pelajar/Mahasiswa", "Pensiunan", "Pegawai Negeri Sipil", "Tentara Nasional Indonesia", "Kepolisian RI", "Perdagangan", "Petani/Pekebun", "Peternak", "Nelayan/Perikanan", "Industri", "Konstruksi", "Transportasi", "Karyawan Swasta", "Karyawan BUMN", "Karyawan BUMD", "Karyawan Honorer", "Buruh Harian Lepas", "Buruh Tani/Perkebunan", "Buruh Nelayan/Perikanan", "Buruh Peternakan", "Pembantu Rumah Tangga", "Tukang Cukur", "Tukang Listrik", "Tukang Batu", "Tukang Kayu", "Tukang Sol Sepatu", "Tukang Las/Pandai Besi", "Tukang Jahit", "Penata Rambut", "Penata Rias", "Penata Busana", "Mekanik", "Tukang Gigi", "Seniman", "Tabib", "Paraji", "Perancang Busana", "Penerjemah", "Imam Masjid", "Pendeta", "Pastur", "Wartawan", "Ustadz/Mubaligh", "Juru Masak", "Promotor Acara", "Anggota DPR-RI", "Anggota DPD", "Anggota BPK", "Presiden", "Wakil Presiden", "Anggota Mahkamah Konstitusi", "Anggota Kabinet/Kementerian", "Duta Besar", "Gubernur", "Wakil Gubernur", "Bupati", "Wakil Bupati", "Walikota", "Wakil Walikota", "Anggota DPRD Provinsi", "Anggota DPRD Kabupaten", "Dosen", "Guru", "Pilot", "Pengacara", "Notaris", "Arsitek", "Akuntan", "Konsultan", "Dokter", "Bidan", "Perawat", "Apoteker", "Psikiater/Psikolog", "Penyiar Televisi", "Penyiar Radio", "Pelaut", "Peneliti", "Sopir", "Pialang", "Paranormal", "Pedagang", "Perangkat Desa", "Kepala Desa", "Biarawati", "Wiraswasta", "Anggota Lembaga Tinggi", "Artis", "Atlit", "Chef", "Manajer", "Tenaga Tata Usaha", "Operator", "Pekerja Pengolahan, Kerajinan", "Teknisi", "Asisten Ahli", "Lainnya"])->nullable();
            $table->integer('penghasilan')->nullable();
            $table->enum('pendidikan', ['Tidak/Belum Sekolah', 'Belum Tamat SD/Sederajat', 'Tamat SD/Sederajat', 'SLTP/Sederajat', 'SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S. Muda', 'Diploma IV/Strata I', 'Strata II'])->nullable();
            $table->char('no_paspor', 10)->nullable();
            $table->char('no_kitas', 10)->nullable();
            $table->datetime('tanggal_request');
            $table->enum('status_request', ['Menunggu', 'Dikonfirmasi', 'Ditolak']);
            $table->text('catatan')->nullable();

            $table->foreign('NIK')->references('NIK')->on('warga');
            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargaModified');
    }
};
