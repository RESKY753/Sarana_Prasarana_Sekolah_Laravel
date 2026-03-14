<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';//panggil tabel aspirasi
    protected $guarded = ['id_aspirasi'];//kolom yang tidak boleh disi user

      public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');//banyak aspirasi di isi 1 siswa
    }
    function Kategori(){
        return $this->hasOne(Kategori::class, 'id_kategori', 'id_kategori'); //1 aspirasi memiki 1 kategori
    }
    function ProgresAspirasi(){
        return $this->hasMany(Progres_Aspirasi::class, 'id_aspirasi', 'id_aspirasi');//1 aspirasi memiliki banyak progres
    }
}
