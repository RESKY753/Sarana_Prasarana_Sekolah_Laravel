<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
    $data = [[
        'username'=>'Reskycuy',
        'password'=>'cuy 123',

      ],[
        'username'=>'maul',
        'password'=>'maul 123',

      ],[
        'username'=>'Razaqa',
        'password'=>'raz 123',

      ],[
        'username'=>'malvien',
        'password'=>'punn 123',

      ],[
        'username'=>'Rezka',
        'password'=>'rezka 123',

      ]];
        //query untuk tambah data ke db
      DB::table('admin')->insert($data);
}
}