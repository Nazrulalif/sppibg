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
        Schema::create('mesyuarat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mesyuarat');
            $table->date('tarikh');
            $table->time('masa_mula');
            $table->time('masa_tamat');
            $table->string('kepada');
            $table->string('tempat');
            $table->string('agenda');
            $table->string('warna');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesyuarat');
    }
};
