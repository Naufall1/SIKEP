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
        Schema::create('pengajuan_keluarga', function (Blueprint $table) {
            $table->id();
            $table->char('no_kk', 16);
            $table->date('tanggal_request');
            $table->enum('status_request', ['Dikonfirmasi', 'Ditolak', 'Menunggu']);
            $table->text('catatan')->nullable();

            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_keluarga');
    }
};
