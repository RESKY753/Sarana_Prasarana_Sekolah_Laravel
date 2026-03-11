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
    {
        Schema::create('progres_aspirasi', function (Blueprint $table) {
            $table->id('id_progres');
            $table->unsignedBigInteger('id_aspirasi');

            //membuat relasi atau fk
            $table->foreign('id_aspirasi')->references('id_aspirasi')->on('aspirasi')->onDelete('cascade');
            $table->timestamp('tanggal_update')->useCurrent();
            $table->unsignedBigInteger('id_admin');

            //membuat relasi atau fk
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
            $table->string('umpan_balik',150);
            $table->enum('status',['menunggu', 'diproses', 'selesai']);
            $table->string('ket_progres', 100);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_aspirasis');
    }
};
