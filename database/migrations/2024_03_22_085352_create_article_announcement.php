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
        Schema::create('article_announcement', function (Blueprint $table) {
            $table->char('kode', 10)->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('kategori', 25);
            $table->string('penulis', 100);
            $table->date('tanggal_publish');
            $table->date('tanggal_dibuat');
            $table->date('tanggal_edit');
            $table->string('judul', 255);
            $table->text('isi');
            $table->enum('status', ['Ditampilkan', 'Disembunyikan']);
            $table->text('image_url');

            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_announcement');
    }
};
