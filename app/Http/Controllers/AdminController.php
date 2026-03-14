<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        return view('Admin.TambahSiswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'Nama' => 'required',
                'nis' => 'required|max:10',
                'kelas' => 'required',
                'password' => 'required|min:6'
            ],
            [
                'Nama.required' => 'Nama siswa jangan dikosongin ya, bg!',
                'nis.required' => 'NIS-nya diisi dulu.',
                'password.min' => 'Password minimal 6 karakter.',
                'password.required' => 'Isi password terlebih dahulu.',
                'nis.max' => 'Maximal 10 karakter',
                'kelas.required' => 'Kelas wajib di isi'
            ]
        );

        DB::table('siswa')
        ->insert([
            'Nama' => $request->Nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password)
        ]
        );

        return redirect('Admin/DataSiswa')->with('success','Siswa berhasil ditambahkan!');
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
        $siswa = DB::table('siswa')
        ->get()
        ->where('id_siswa', $id)->first();
         
        return view('Admin.EditSiswa', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id_admin = auth()->guard('admin')->user()->id_admin;

        //validasi
        $request->validate(
            [
                'username' => 'required',
                'password' => 'nullable|min:6'
            ],
            [
                'username.required' => 'isi username',
            ]
        );
        //buat variabel data untuk menampung inputan username dari user
        $data = ([
            'username' => $request->username,
        ]);

        //Cek apakah user mengisi input password
        if ($request->filled('password')) {
            // Jika diisi, kita hash dulu baru masukkan ke array $data
            $data['password'] = Hash::make($request->password);
        }

        DB::table('admin')
        ->where('id_admin', $id_admin)
        ->update($data);

        return redirect()->back()->with('success', 'Profil berhasil di ubah!');
    }

    function updatesiswa(Request $request, string $id){
        $request->validate([
            'nis' => 'required',
            'Nama' => 'required',
            'kelas' => 'required',
            'password' => 'nullable|min:6'
        ],[
            'nis.required' => 'Nis tidak boleh kosong!',
            'Nama.required' => 'Nama tidak boleh kosong',
            'kelas.required' => 'Pilih kelas',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $data = ([
            'nis' => $request->nis,
            'Nama' => $request->Nama,
            'kelas' => $request->kelas
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            }

        DB::table('siswa')
        ->where('id_siswa', $id)
        ->update($data);

        return redirect('Admin/DataSiswa')->with('success', 'Data berhasil di ubah!');
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
