<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgresAspirasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [[
            'id_aspirasi' => 1,
            'id_admin' => 1,
            'tanggal_update' => now(),
            'umpan_balik' => null,
            'status' => 'diproses',
            'ket_progres' => 'menunggu',

        ], [
            'id_aspirasi' => 2,
            'id_admin' => 1,
            'tanggal_update' => now(),
            'umpan_balik' => null,
            'status' => 'diproses',
            'ket_progres' => 'sedang di perbaiki',
        ], [
            'id_aspirasi' => 3,
            'id_admin' => 4,
            'tanggal_update' => now(),
            'umpan_balik' => null,
            'status' => 'diproses',
            'ket_progres' => 'OTW',
        ], [
            'id_aspirasi' => 4,
            'id_admin' => 4,
            'tanggal_update' => now(),
            'umpan_balik' => null,
            'status' => 'diproses',
            'ket_progres' => 'Sedang diperbaiki',
        ], [
            'id_aspirasi' => 5,
            'tanggal_update' => now(),
            'id_admin' => 5,
            'umpan_balik' => null,
            'status' => 'diproses',
            'ket_progres' => 'Sedang OTW',
        ]];
        DB::table('progres_aspirasi')->insert($data);
    }
}
