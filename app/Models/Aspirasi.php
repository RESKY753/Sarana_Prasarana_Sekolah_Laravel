<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $guarded = ['id_aspirasi'];

      public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
    function Kategori(){
        return $this->hasOne(Kategori::class, 'id_kategori', 'id_kategori');
    }
    function ProgresAspirasi(){
        return $this->hasMany(Progres_Aspirasi::class, 'id_aspirasi', 'id_aspirasi');
    }
}
