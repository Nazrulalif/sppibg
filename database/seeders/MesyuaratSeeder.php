<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesyuaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mesyuarat')->insert([
            [
                'nama_mesyuarat' => 'Mesyuarat Agung Tahunan 2025',
                'tarikh' => '2025-11-15',
                'masa_mula' => '09:00:00',
                'masa_tamat' => '12:00:00',
                'kepada' => 'Semua Ahli Jawatankuasa',
                'tempat' => 'Dewan Sekolah',
                'agenda' => 'Perbincangan program tahunan dan laporan kewangan',
                'warna' => '#3498db',
                'panggilan_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mesyuarat' => 'Mesyuarat Jawatankuasa Bil 1/2025',
                'tarikh' => '2025-11-01',
                'masa_mula' => '14:00:00',
                'masa_tamat' => '16:00:00',
                'kepada' => 'Ahli Jawatankuasa',
                'tempat' => 'Bilik Mesyuarat PIBG',
                'agenda' => 'Perancangan aktiviti suku tahun pertama',
                'warna' => '#2ecc71',
                'panggilan_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mesyuarat' => 'Mesyuarat Kecemasan',
                'tarikh' => '2025-10-25',
                'masa_mula' => '10:00:00',
                'masa_tamat' => '11:30:00',
                'kepada' => 'Pengerusi dan Setiausaha',
                'tempat' => 'Pejabat Pentadbir',
                'agenda' => 'Perbincangan isu kecemasan sekolah',
                'warna' => '#e74c3c',
                'panggilan_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
