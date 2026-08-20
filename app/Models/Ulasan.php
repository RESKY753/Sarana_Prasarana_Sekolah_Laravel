<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    protected $guarded = ['id_ulasan'];
    public $timestamps = false;

    public function aspirasi(){
        return $this->hasOne( Aspirasi::class, 'id_aspirasi', 'id_aspirasi');
    }
}
