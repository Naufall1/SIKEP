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
            $table->char('no_kk', 6);
            $table->unsignedBigInteger('user_id');
            $table->string('kepala_keluarga', 100);
            $table->string('image_kk', 100);
            $table->integer('tagihan_listrik');
            $table->date('tanggal_request');
            $table->string('status_request', 20);

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
