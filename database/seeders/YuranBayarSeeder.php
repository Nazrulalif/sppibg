<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YuranBayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('yuran_bayar')->insert([
            [
                'id_pembayaran' => 'PAY001',
                'id_yuran' => 1,
                'id_pelajar' => 1,
                'jumlah_yuran' => 50.00,
                'jenis_pembayaran' => 'Tunai',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pembayaran' => 'PAY002',
                'id_yuran' => 2,
                'id_pelajar' => 2,
                'jumlah_yuran' => 50.00,
                'jenis_pembayaran' => 'Online',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pembayaran' => 'PAY003',
                'id_yuran' => 3,
                'id_pelajar' => 3,
                'jumlah_yuran' => 50.00,
                'jenis_pembayaran' => 'Tunai',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
