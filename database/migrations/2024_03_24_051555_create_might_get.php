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
        Schema::create('might_get', function (Blueprint $table) {
            $table->char('no_kk', 6);
            $table->char('bansos_kode', 12);
            $table->date('tanggal_menerima');

            $table->unique(['no_kk', 'bansos_kode']);

            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
            $table->foreign('bansos_kode')->references('bansos_kode')->on('bansos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('might_get');
    }
};
