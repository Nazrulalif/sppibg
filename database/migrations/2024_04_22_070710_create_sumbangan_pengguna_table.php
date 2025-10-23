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
        Schema::create('sumbangan_pengguna', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sumbangan');
            $table->integer('id_pengguna');
            $table->integer('id_transaksi');
            $table->integer('jumlah_sumbangan');
            $table->string('jenis_pembayaran')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumbangan_pengguna');
    }
};
