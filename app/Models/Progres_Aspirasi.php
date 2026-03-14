<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progres_Aspirasi extends Model
{
    protected $table = 'progres_aspirasi';//panggil tabel progres

    protected $guarded = ['id_progres'];//kolom yang tidak boleh diisi

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');//banyak progres bisa di isi oleh 1 admin
    }
    function Aspirasi(){
        return $this->belongsTo(Aspirasi::class, 'id_aspirasi', 'id_aspirasi');//banyak progres dimiliki 1 aspirasi
    }
}
