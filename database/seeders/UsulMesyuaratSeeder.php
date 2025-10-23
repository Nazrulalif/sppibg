<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsulMesyuaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usul_mesyuarat')->insert([
            [
                'id_pengguna' => 1,
                'usul' => 'Cadangan menambah baik kemudahan perpustakaan dengan membeli buku-buku baru',
                'id_mesyuarat' => 1,
                'id_kategori' => 3,
                'status' => 1,
                'pengesahan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 2,
                'usul' => 'Mengadakan program motivasi untuk pelajar tingkatan 5 menghadapi SPM',
                'id_mesyuarat' => 1,
                'id_kategori' => 2,
                'status' => 1,
                'pengesahan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 3,
                'usul' => 'Peruntukan kewangan untuk aktiviti sukan tahunan',
                'id_mesyuarat' => 2,
                'id_kategori' => 1,
                'status' => 0,
                'pengesahan' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
