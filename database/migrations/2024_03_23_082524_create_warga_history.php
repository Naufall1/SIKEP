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
        Schema::create('wargaHistory', function (Blueprint $table) {
            $table->id('id_history_warga');
            $table->char('NIK', 16);
            $table->char('no_kk', 16);
            $table->string('nama', 100);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->string('status_keluarga', 15);
            $table->enum('status_warga', ['Aktif', 'Meninggal', 'Migrasi']);
            $table->string('jenis_pekerjaan', 50);
            $table->integer('penghasilan');
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->string('pendidikan', 50);
            $table->char('no_paspor', 10)->nullable();
            $table->char('no_kitas', 10)->nullable();
            $table->string('nama_ayah', 100);
            $table->string('nama_ibu', 100);
            $table->datetime('valid_from');
            $table->datetime('valid_to');

            $table->foreign('NIK')->references('NIK')->on('warga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargaHistory');
    }
};
