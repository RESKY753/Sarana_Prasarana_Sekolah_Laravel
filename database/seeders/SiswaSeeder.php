<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            '0971111111' => 'Alfian',
            '0971111112' => 'Malvien R S',
            '0971111113' => 'Maull',
            '0971111114' => 'Resky A',
            '0971111115' => 'Rezka'
        ];

        foreach ($students as $nis => $nama) {
            DB::table('siswa')
                ->where('nis', $nis)
                ->update(['nama' => $nama]);
        }
    }
}
