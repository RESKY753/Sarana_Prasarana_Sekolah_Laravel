<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth as FacadesAuth;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // [1] Membuat objek query awal dari Model Aspirasi.
        // Di tahap ini, Laravel baru menyiapkan perintah "SELECT * FROM aspirasi".
        $query = Aspirasi::query();

        // [2] Mengecek apakah input 'siswa' di form filter diisi oleh admin.
        // Jika kosong, blok kode di dalam { } ini akan dilewati.
        if ($request->filled('siswa')) {

            // [3] whereHas: Fungsi sakti untuk memfilter data berdasarkan kolom di tabel relasi.
            // 'siswa' di sini adalah nama fungsi relasi yang ada di dalam file Model Aspirasi.
            $query->whereHas('siswa', function ($q) use ($request) {

                // [4] Di dalam fungsi anonim ini ($q), kita sekarang sedang berada di konteks Tabel Siswa.
                // Kita suruh Laravel mencari baris yang kolom 'Nama'-nya mirip dengan input dari admin.
                // '%' . $request->siswa . '%' artinya mencari teks yang mengandung kata tersebut (depan/belakang).
                $q->where('Nama', 'LIKE', '%' . $request->siswa . '%');
            });
        }

        // [3] Cek apakah admin milih bulan di dropdown
        if ($request->filled('bulan')) {
            // ->whereMonth: Fungsi khusus Laravel buat nyaring BULAN saja dari kolom tanggal_lapor
            $query->whereMonth('tanggal_lapor', $request->bulan);
        }

        // [4] Cek apakah admin milih kategori di dropdown
        if ($request->filled('kategori')) {
            // Sesuaikan 'judul_aspirasi' dengan kolom kategori di database abang
            $query->where('judul_aspirasi', 'LIKE', '%' . $request->kategori . '%');
        }

        // [5] Cek apakah admin milih tanggal spesifik di kalender
        if ($request->filled('tanggal')) {
            // ->whereDate: Memastikan tanggal, bulan, dan tahunnya sama persis dengan pilihan admin
            $query->whereDate('tanggal_lapor', $request->tanggal);
        }

        // [6] ->latest(): Urutkan dari yang tanggalnya paling baru (DESC)
        // [7] ->get(): "Eksekusi!" Baru di baris inilah Laravel beneran narik data ke Database.
        $aspirasi = $query->latest()->get();
        $totalData = $aspirasi->count();

        // [BAGIAN KRUSIAL] Ambil data dari Model Siswa buat Datalist
        // Kita ambil dari Siswa::all() karena kolom 'Nama' cuma ada di tabel Siswa
        $dataSiswa = Siswa::all(); // <-- INI DIUBAH (Jangan ambil dari Aspirasi)

        // Ambil data kategori buat dropdown
        $kategori = Kategori::all();

        // Kirim variabel 'dataSiswa' (sesuai @foreach di Blade)
        return view('Admin.Dasboard_admin', compact('aspirasi', 'dataSiswa', 'totalData', 'kategori'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    function ProsesLoginAdmin(Request $request)
    {
        //ini adalah proses login dengan auth attempt Sumber YT:Awe wewewewe
        if (Auth::guard('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            // dd(session()->all()); //unutk mengecek apakh sesi tersimpan saat login

            return redirect()->route('DashboardAdmin')->with('success', 'Behasil Login');
        }
        return back()->with('erroradmin', 'Username Password salah');
        // return redirect()->route('welcome')->with('error', 'Nis atau Passwor Salah');
    }
    function DasboardAdmin()
    {
        return view('Admin.Dasboard_admin');
    }
    function welcome()
    {
        return view('Auth.auth');
    }
    public function LogoutAdmin(Request $request)
    {
        // 1. Logout dari guard admin
        auth()->guard('admin')->logout();

        // 2. Hapus semua data session biar bersih
        $request->session()->invalidate();

        // 3. Bikin token session baru buat keamanan (mencegah CSRF attack)
        $request->session()->regenerateToken();

        // 4. Lempar balik ke halaman login
        return redirect('/')->with('success', 'Berhasil keluar, sampai jumpa lagi!');
    }
}
