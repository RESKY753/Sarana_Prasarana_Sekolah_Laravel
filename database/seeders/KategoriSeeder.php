<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [[
            'ket_kategori' => 'Kursi Atau Meja',
            
        ], [
            'ket_kategori' => 'Bangunan',

        ], [
            'ket_kategori' => 'Area Terbuka',

        ], [
            'ket_kategori' => 'Fasilitas Umum',

        ], [
            'ket_kategori' => 'Peralatan',
        ]];

        DB::table('kategori')->insert($data);
    }
}
