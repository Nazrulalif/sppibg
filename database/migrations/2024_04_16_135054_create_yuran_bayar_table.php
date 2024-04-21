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
        Schema::create('yuran_bayar', function (Blueprint $table) {
            $table->id();
            $table->integer('id_yuran');
            $table->integer('id_pengguna');
            $table->integer('jumlah_bayar');
            $table->integer('jumlah_yang_tinggal');
            $table->string('cara_bayar');
            $table->string('penerangan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yuran_bayar');
    }
};
