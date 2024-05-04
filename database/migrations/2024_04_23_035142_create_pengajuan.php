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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->char('no_kk', 16);
            $table->date('tanggal_request');
            $table->enum('status_request', ['Dikonfirmasi', 'Ditolak', 'Menunggu']);
            $table->text('catatan')->nullable();
            $table->enum('tipe', ['Pembaruan', 'Perubahan Keluarga', 'Perubahan Warga']);

            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
