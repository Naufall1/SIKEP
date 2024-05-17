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
        Schema::create('keluargaModified', function (Blueprint $table) {
            $table->id('id_modify_keluarga');
            $table->char('no_kk', 16);
            $table->unsignedBigInteger('user_id');
            $table->string('kepala_keluarga', 100)->nullable();
            $table->string('image_kk', 100)->nullable();
            $table->integer('tagihan_listrik')->nullable();
            $table->integer('luas_bangunan')->nullable();
            $table->datetime('tanggal_request');
            $table->enum('status_request', ['Menunggu', 'Dikonfirmasi', 'Ditolak']);
            $table->text('catatan')->nullable();

            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluargaModified');
    }
};
