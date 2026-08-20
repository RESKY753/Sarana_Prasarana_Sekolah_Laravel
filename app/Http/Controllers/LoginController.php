<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function ProsesLogin(Request $request)
    {
        // Validasi input agar tidak kosong
        $request->validate([
            'login_input' => 'required', // Ini nama field baru dari form
            'password' => 'required',
        ]);

        $loginInput = $request->login_input;
        $password = $request->password;

        // 1. Cek apakah input berupa angka (Asumsi: 0NIS siswa adalah angka)
        if (is_numeric($loginInput)) {
            // Coba login sebagai Siswa menggunakan guard 'siswa'
            if (Auth::guard('siswa')->attempt(['nis' => $loginInput, 'password' => $password])) {
                return redirect()->route('DashboardSiswa')->with('success', 'Berhasil Login');
            }
        } else {
            // 2. Jika bukan angka, asumsikan ini Username Admin
            // Coba login sebagai Admin menggunakan guard 'admin' (atau guard bawaan Anda, sesuaikan namanya)
            if (Auth::guard('admin')->attempt(['username' => $loginInput, 'password' => $password])) {
                return redirect()->route('DashboardAdmin')->with('success', 'Berhasil Login');
            }
        }

        // 3. Jika kedua percobaan di atas gagal
        return back()->with('error', 'NIS/Username atau Password salah')->withInput();
    }
}
