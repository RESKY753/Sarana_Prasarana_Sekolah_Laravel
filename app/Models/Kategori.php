<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';//panggil tabel kategori
    protected $guarded = ['id_kategori'];//kolom yang tidak boleh di isi

    function Aspirasi(){
        return $this->hasOne(Aspirasi::class, 'id_kategori' , 'id_kategori');//1 kategori mempunyai 1 aspirasi
    }
}
