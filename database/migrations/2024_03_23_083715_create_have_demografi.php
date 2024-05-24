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
        Schema::create('have_demografi', function (Blueprint $table) {
            $table->char('NIK', 16);
            $table->unsignedBigInteger('demografi_id');
            $table->date('tanggal_kejadian')->nullable(); // nullable just for dev
            $table->dateTime('tanggal_request');
            $table->text('catatan')->nullable();
            $table->text('dokumen_pendukung');
            $table->enum('status_request', ['Dikonfirmasi', 'Ditolak', 'Menunggu']);

            $table->unique(['NIK', 'demografi_id', 'tanggal_request']);

            $table->foreign('NIK')->references('NIK')->on('warga');
            $table->foreign('demografi_id')->references('demografi_id')->on('demografi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('have_demografi');
    }
};
