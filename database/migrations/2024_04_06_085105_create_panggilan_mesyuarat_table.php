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
        Schema::create('panggilan_mesyuarat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_panggilan');
            $table->integer('id_mesyuarat');
            $table->string('tandatangan');
            $table->integer('draf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panggilan_mesyuarat');
    }
};
