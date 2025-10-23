<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SumbanganPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sumbangan_pengguna')->insert([
            [
                'id_sumbangan' => 1,
                'id_pengguna' => 1,
                'jumlah_sumbangan' => 500.00,
                'id_transaksi' => 'TXN001',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_sumbangan' => 1,
                'id_pengguna' => 2,
                'jumlah_sumbangan' => 300.00,
                'id_transaksi' => 'TXN002',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_sumbangan' => 2,
                'id_pengguna' => 3,
                'jumlah_sumbangan' => 100.00,
                'id_transaksi' => 'TXN003',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_sumbangan' => 3,
                'id_pengguna' => 4,
                'jumlah_sumbangan' => 200.00,
                'id_transaksi' => 'TXN004',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
