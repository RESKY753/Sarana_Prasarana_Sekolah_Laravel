<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\table;

class SiswaController extends Controller
{

    function HistoriById()
    {
        // $id_siswa = Auth::guard('siswa')->id();

        // $histori = Histori::where('id_siswa', $id_siswa)->get();

        // return view('histori.index', compact('histori'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index() //fungsi untuk menampilkan data siswa
    {
        $siswa = DB::table('siswa') //panggil tabel siswa
            ->get(); //ambil semua data yang ada di table

        //variabel $totalAspirasi nggak di pakai
        $totalAspirasi = DB::table('aspirasi') //panggil tabel asirasi
            ->where('id_siswa',)
            ->count();

        $totalSiswa = DB::table('siswa')->count(); //hitung total siswa dari tabel siswa dengan count
        return view('Admin.DataSiswa', compact('siswa', 'totalSiswa')); //kirim ke Admin.DataSiwa untuk di eksekusi
    }

    function filterDataSiswa(Request $request)
    {
        $query = DB::table('siswa');

        if ($request->filled('Nama')) {
            $query->where('Nama', 'LIKE', '%' . $request->Nama . '%');
        }

        $siswa = $query->orderby('Nama', 'asc')
            ->get();

        $totalSiswa = $siswa->count();

        return view('Admin.DataSiswa', compact('siswa', 'totalSiswa'));
    }

    function HapusSiswa($id)
    {
        DB::table('siswa') //pagil tabel aspirasi
            ->where('id_siswa', $id) //hapus data sesuai dengan id_aspirasi
            ->delete(); //perintah hapus

        return redirect('Admin/DataSiswa')->with('success', 'Siswa Berhasil Dihapus');
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
    public function updateProfile(Request $request)
    {
        $id_siswa = auth('siswa')->user()->id_siswa;

        $request->validate([
            'Nama' => 'required',
            'password' => 'nullable|min:6'
        ], [
            'Nama.required' => 'Nama tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $data = ([
            'Nama' => $request->Nama,
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('siswa')
            ->where('id_siswa', $id_siswa)
            ->update($data);

        return redirect()->back()->with('success', 'Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function ProsesLoginSiswa(Request $request)
    {
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
    function DashboardSiswa()
    {
        return view('Siswa.DashboardSiswa');
    }
    function welcome()
    {
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

        // 4. Lempar balik ke halaman login dengan pesan success
        return redirect('/')->with('success', 'Berhasil keluar, sampai jumpa lagi!');
    }
}
