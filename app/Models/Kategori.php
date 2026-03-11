<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $guarded = ['id_kategori'];

    function Aspirasi(){
        return $this->hasOne(Aspirasi::class, 'id_kategori' , 'id_kategori');
    }
}
