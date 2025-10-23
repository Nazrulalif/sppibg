<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UlasanUsulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ulasan_usul')->insert([
            [
                'id_usul' => 1,
                'ulasan' => 'Cadangan yang baik. Perlu dikaji bajet yang diperlukan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usul' => 1,
                'ulasan' => 'Setuju. Boleh bekerjasama dengan Ketua Pustakawan untuk senarai buku.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usul' => 2,
                'ulasan' => 'Program ini sangat penting. Cadangan untuk mengundang motivator professional.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
