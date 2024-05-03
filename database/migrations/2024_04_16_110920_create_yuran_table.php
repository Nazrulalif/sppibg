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
        Schema::create('yuran', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('yuran');
            $table->integer('tahun_pelajar_id');
            $table->integer('yuran_tambahan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yuran');
    }
};
