<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   //ini perintah untuk manmbah kolom atau field pada tabel yang telah di buat
        Schema::table('progres_aspirasi', function (Blueprint $table) {
            $table->string('ket_progres', 80);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_aspirasi');
    }
};
