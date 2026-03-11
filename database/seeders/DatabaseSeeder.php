<?php

namespace Database\Seeders;

use App\Models\Aspirasi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //ini adalah peru=intah untuk memasukan data ke db 
        // User::factory(10)->create();
        // $this->call(AdminSeeder::class);
        $this->call(SiswaSeeder::class);
        // $this->call(KategoriSeeder::class);
        // $this->call(AspirasiSeeder::class);
        // $this->call(ProgresAspirasiSeeder::class);
    }
}
