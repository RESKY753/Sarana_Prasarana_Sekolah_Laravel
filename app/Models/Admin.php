<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ Kita gunakan ini agar model bisa dipakai oleh Laravel Auth (Auth::attempt, validateCredentials, dll)
use Illuminate\Notifications\Notifiable; // ✅ Agar model bisa menerima notifikasi, opsional tapi umum dipakai di user/admin

// Model Admin sekarang extend Authenticatable
// 🔹 Ini penting! Karena Laravel Auth hanya bisa bekerja dengan model yang implement Illuminate\Contracts\Auth\Authenticatable
// 🔹 Kalau kita tetap extends Model biasa, Auth::attempt akan error seperti sebelumnya
class Admin extends Authenticatable
{
    protected $table = 'admin';//panggil tabel yang ingin digunakan
    protected $primaryKey = 'id_admin';//id_admin primary key
    protected $guarded = ['id_admin'];//kolom yang tidak boleh di isi oleh user
    public $timestamps = false;

    public function progres_aspirasi()//fungsi untuk relasi dalam laravel
    {
        return $this->hasMany(Progres_Aspirasi::class, 'id_admin', 'id_admin');//1 admin dapat menambahkan banyak progres_aspirasi
    }
}
