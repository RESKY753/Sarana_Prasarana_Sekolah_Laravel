<?php

namespace App\Models;

// Class bawaan Laravel yang memberi kemampuan autentikasi:
// login, logout, session, Auth::attempt(), Auth::check()
use Illuminate\Foundation\Auth\User as Authenticatable;

// Trait untuk fitur notifikasi (opsional, tapi standar pada model Auth)
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable // WAJIB extends Authenticatable, bukan Model
{
    use Notifiable;

    // Menentukan nama tabel di database
    protected $table = 'siswa';

    // Menentukan primary key karena bukan "id"
    protected $primaryKey = 'id_siswa';

    // Kolom yang boleh diisi secara mass assignment
    protected $fillable = [
        'nis',        // username siswa untuk login
        'password',   // password (harus dalam bentuk hash)
        'Nama',       // nama lengkap siswa
    ];

    // Kolom yang disembunyikan saat data di-dump atau diubah ke JSON
    protected $hidden = [
        'password',
    ];

    // Relasi: satu siswa bisa memiliki banyak aspirasi
    public function aspirasi()
    {
        return $this->hasMany(
            Aspirasi::class, // model yang berelasi
            'id_siswa',      // foreign key di tabel aspirasi
            'id_siswa'       // primary key di tabel siswa
        );
    }

    // Memberi tahu Laravel bahwa kolom login adalah "nis"
    // bukan "email" atau "id"
    public function getAuthIdentifierName()
    {
        return 'nis';
    }
}
