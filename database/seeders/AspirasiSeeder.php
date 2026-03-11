<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class AspirasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [[
            'id_kategori' => '1',
            'id_siswa' => '1',
            'tanggal_lapor' => now(),
            'lokasi' => 'Kelas X AKL 1',
            'ket_aspirasi' => 'Tembok berlubang',
            'judul_aspirasi' => 'Tembok berlubang',

        ], [
            'id_kategori' => '1',
            'id_siswa' => '2',
            'tanggal_lapor' => now(),
            'lokasi' => 'XI RPL 2',
            'ket_aspirasi' => 'Para Rusak',
            'judul_aspirasi' => 'Para Rusak',

        ], [
            'id_kategori' => '1',
            'id_siswa' => '3',
            'tanggal_lapor' => now(),
            'lokasi' => 'Lorem Ipsum',
            'ket_aspirasi' => 'Lorem Ipsum',
            'judul_aspirasi' => 'Dolor Amet Sit Amet',

        ], [
            'id_kategori' => '1',
            'id_siswa' => '4',
            'tanggal_lapor' => now(),
            'lokasi' => 'Ipsum Amet',
            'ket_aspirasi' => 'Sit Dolor',
            'judul_aspirasi' => 'Amet Dolor Sit Amet',
        ], [
            'id_kategori' => '1',
            'id_siswa' => '5',
            'tanggal_lapor' => now(),
            'lokasi' => 'Amet Lorem',
            'ket_aspirasi' => 'Ipsum Lorem',
            'judul_aspirasi' => 'Lorem Ipsum Dolor Amet Sit Amet',

        ]];

        //ini adalah perintah memasukan banyak data sekaligus dengan array asosiatif
        DB::table('aspirasi')->insert($data);
    }
}
