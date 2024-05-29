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
            $table->enum('kategori', ['Artikel', 'Pengumuman']);
            $table->string('penulis', 100);
            $table->date('tanggal_publish')->nullable();
            $table->date('tanggal_dibuat');
            $table->date('tanggal_edit')->nullable();
            $table->string('judul', 255);
            $table->text('isi');
            $table->enum('status', ['Ditampilkan', 'Disembunyikan']);
            $table->text('image_url');
            $table->string('caption', 50);

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
