<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('acara')->insert([
            [
                'nama_acara' => 'Hari Keluarga PIBG',
                'tarikh' => '2025-12-20',
                'masa_mula' => '08:00:00',
                'masa_tamat' => '13:00:00',
                'kepada' => 'Semua Ahli PIBG dan Keluarga',
                'tempat' => 'Padang Sekolah',
                'agenda' => 'Aktiviti keluarga dan sukan',
                'warna' => '#9b59b6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_acara' => 'Program Motivasi Pelajar',
                'tarikh' => '2025-11-10',
                'masa_mula' => '09:00:00',
                'masa_tamat' => '15:00:00',
                'kepada' => 'Pelajar Tingkatan 5',
                'tempat' => 'Dewan Besar',
                'agenda' => 'Ceramah motivasi menghadapi peperiksaan',
                'warna' => '#f39c12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_acara' => 'Gotong Royong Sekolah',
                'tarikh' => '2025-11-05',
                'masa_mula' => '07:00:00',
                'masa_tamat' => '11:00:00',
                'kepada' => 'Semua Ahli',
                'tempat' => 'Kawasan Sekolah',
                'agenda' => 'Pembersihan dan penambahbaikan kawasan sekolah',
                'warna' => '#16a085',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
