<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progres_Aspirasi extends Model
{
    protected $table = 'progres_aspirasi';

    protected $guarded = ['id_progres'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
    function Aspirasi(){
        return $this->belongsTo(Aspirasi::class, 'id_aspirasi', 'id_aspirasi');
    }
}
