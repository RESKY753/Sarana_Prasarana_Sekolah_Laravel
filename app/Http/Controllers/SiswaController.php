<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{

    function HistoriById(){
        // $id_siswa = Auth::guard('siswa')->id();

        // $histori = Histori::where('id_siswa', $id_siswa)->get();

        // return view('histori.index', compact('histori'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = DB::table('siswa')
        ->get();
        $totalAspirasi = DB::table('aspirasi')
        ->where('id_siswa',)
        ->count();
        $totalSiswa = DB::table('siswa')->count();
        return view('Admin.DataSiswa', compact('siswa', 'totalSiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        $id_siswa = auth('siswa')->user()->id_siswa;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function ProsesLoginSiswa(Request $request){
        //ini adalah proses login dengan auth attempt Sumber YT:Awe wewewewe
        if (Auth::guard('siswa')->attempt([
            'nis' => $request->nis,
            'password' => $request->password,
        ])) {
            // dd(session()->all()); //unutk mengecek apakh sesi tersimpan saat login

            return redirect()->route('DashboardSiswa')->with('success', 'Berhasil Login');
        }

        return back()->with('error', 'NIS atau Password salah');
        // return redirect()->route('welcome')->with('error', 'Nis atau Passwor Salah');
    }
    function DashboardSiswa(){
        return view('Siswa.DashboardSiswa');
    }
    function welcome(){
        return view('Auth.auth');
    }
    public function LogoutSiswa(Request $request)
    {
        // 1. Logout dari guard admin
        auth()->guard('siswa')->logout();

        // 2. Hapus semua data session biar bersih
        $request->session()->invalidate();

        // 3. Bikin token session baru buat keamanan (mencegah CSRF attack)
        $request->session()->regenerateToken();

        // 4. Lempar balik ke halaman login
        return redirect('/')->with('success', 'Berhasil keluar, sampai jumpa lagi!');
    }
}
