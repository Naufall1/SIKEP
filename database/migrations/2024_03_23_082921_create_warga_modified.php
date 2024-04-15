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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', '-'])->nullable();
            $table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati', '-'])->nullable();
            $table->string('status_keluarga', 15)->nullable();
            $table->enum('status_warga', ['Aktif', 'Meninggal', 'Migrasi', '-'])->nullable();
            $table->string('jenis_pekerjaan', 50)->nullable();
            $table->integer('penghasilan')->nullable();
            $table->string('pendidikan', 50)->nullable();
            $table->date('tanggal_request');
            $table->string('status_request', 20);

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
