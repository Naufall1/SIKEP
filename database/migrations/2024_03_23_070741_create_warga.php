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
        Schema::create('warga', function (Blueprint $table) {
            $table->char('NIK', 16)->primary();
            $table->char('no_kk', 16);
            $table->string('nama', 100);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->string('status_keluarga', 15);
            $table->enum('status_warga', ['Aktif', 'Meninggal', 'Migrasi', 'Menunggu']);
            $table->string('jenis_pekerjaan', 50);
            $table->unsignedBigInteger('penghasilan');
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->string('pendidikan', 50);
            $table->char('no_paspor', 10)->nullable();
            $table->char('no_kitas', 10)->nullable();
            $table->string('nama_ayah', 100);
            $table->string('nama_ibu', 100);

            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
