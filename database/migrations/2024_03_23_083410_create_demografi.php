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
        Schema::create('demografi', function (Blueprint $table) {
            $table->id('demografi_id');
            $table->unsignedBigInteger('user_id');
            $table->string('jenis', 100);

            $table->foreign('user_id')->references('user_id')->on('user');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demografi');
    }
};
