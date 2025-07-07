<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['kunci' => 'jam_mulai_kerja',    'nilai' => '08:00:00'],
            ['kunci' => 'jam_selesai_kerja',  'nilai' => '17:00:00'],
            ['kunci' => 'toleransi_terlambat','nilai' => '00:15:00'],
            ['kunci' => 'maks_jam_kerja_harian','nilai' => '08:00:00'],
        ];

        foreach ($settings as $s) {
            Pengaturan::updateOrCreate(
                ['kunci' => $s['kunci']],
                ['nilai'  => $s['nilai']]
            );
        }
    }
}
