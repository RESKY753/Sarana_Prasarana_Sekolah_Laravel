<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AspirasiController extends Controller
{

    function index()
    {
        // $aspirasi = DB::table('aspirasi')
        //     ->leftjoin('progres_aspirasi', 'aspirasi.id_aspirasi', '=', 'progres_aspirasi.id_aspirasi')
        //     ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
        //     ->select(
        //         'aspirasi.id_aspirasi',
        //         'aspirasi.judul_aspirasi',
        //         'aspirasi.tanggal_lapor',
        //         'aspirasi.lokasi',
        //         'progres_aspirasi.status',
        //         'progres_aspirasi.tanggal_update',
        //         'kategori.ket_kategori'
        //     )
        //     ->orderBy('tanggal_update', 'desc')
        //     ->get();

        // Subquery: ambil progres TERBARU untuk setiap id_aspirasi
        $latestProgres = DB::table('progres_aspirasi as p1')
            ->select('p1.*') // ambil semua kolom dari progres terbaru
            ->whereRaw('p1.tanggal_update = (
            SELECT MAX(p2.tanggal_update) 
            FROM progres_aspirasi as p2 
            WHERE p2.id_aspirasi = p1.id_aspirasi
        )');
        // Penjelasan:
        // - Kita bandingkan setiap baris (p1)
        // - Dengan tanggal_update paling besar (MAX)
        // - Untuk id_aspirasi yang sama
        // Jadi hasilnya hanya 1 progres TERBARU per aspirasi

        $aspirasi = DB::table('aspirasi')
            // Join ke subquery tadi (bukan ke semua progres)
            ->leftJoinSub($latestProgres, 'progres_aspirasi', function ($join) {
                $join->on('aspirasi.id_aspirasi', '=', 'progres_aspirasi.id_aspirasi');
            })
            // Join kategori seperti biasa
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')

            // Pilih kolom yang ingin ditampilkan
            ->select(
                'aspirasi.id_aspirasi',
                'aspirasi.judul_aspirasi',
                'aspirasi.tanggal_lapor',
                'aspirasi.lokasi',
                'progres_aspirasi.status',         // status terbaru saja
                'progres_aspirasi.tanggal_update', // tanggal update terbaru
                'kategori.ket_kategori'
            )
            ->orderBy('tanggal_update', 'desc')

            // Ambil semua hasil
            ->get();

        // Kirim ke view
        return view('Siswa.DashboardSiswa', compact('aspirasi'));
    }
    function create()
    {   

        $kategori = DB::table('kategori')
            ->get();

        return view('Siswa.FormAspirasi', compact('kategori'));
    }
    function store(Request $request)
    {
        $id_siswa = auth('siswa')->user()->id_siswa;

        //memebuat validasi untuk form tambah nilai
        $request->validate(
            [
                'judul_aspirasi' => 'required',
                'id_kategori' => 'required',
                'lokasi' => 'required',
                'ket_aspirasi' => 'required',
            ],
            [
                'judul_aspirasi.required' => 'Isi judul',
                'id_kategori.required' => 'Mohon isi kategori',
                'lokasi.required' => 'Isi lokasinya',
                'ket_aspirasi.required' => 'Mohon isi keterangannya'
            ]
        );
        // perintah untuk memasukan data ketabel nilai
        DB::table('aspirasi')->insert(
            [
                'id_siswa' => $id_siswa,
                'id_kategori' => $request->id_kategori,
                'tanggal_lapor' => now(),
                'judul_aspirasi' => $request->judul_aspirasi,
                'lokasi' => $request->lokasi,
                'ket_aspirasi' => $request->ket_aspirasi,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        //mengarahkan ke url /nilai atau ke fungsi index atau tampilan nilai
        return redirect('Siswa/DashboardSiswa')->with('success', "Data Berhasil Ditambahkan");
    }
    function DetailAspirasiSiswa($id){
        $aspirasi = DB::table('aspirasi')
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
            ->select(
            'aspirasi.id_aspirasi',
            'aspirasi.judul_aspirasi',
            'aspirasi.tanggal_lapor',
            'aspirasi.id_kategori',
            'aspirasi.lokasi',
            'aspirasi.ket_aspirasi',
            'kategori.ket_kategori'
            )
            ->where('aspirasi.id_aspirasi', $id)
            ->first();

        $progres = DB::table('progres_aspirasi')
            ->join('admin', 'progres_aspirasi.id_admin', '=', 'admin.id_admin')
            ->select(
                'progres_aspirasi.id_progres',
                'progres_aspirasi.status',
                'admin.username',
                'progres_aspirasi.tanggal_update',
                'progres_aspirasi.ket_progres',
                'progres_aspirasi.umpan_balik'
            )
            ->where('id_aspirasi', $id)
            ->orderBy('tanggal_update', 'desc')
            ->get();

            return view('Siswa.DetailAspirasiSiswa', compact('aspirasi', 'progres'));
    }
    function RiwayatAspirasiSiswa(){
        // dd($id, auth('siswa')->user()->id_siswa);
        // dd(DB::table('aspirasi')
        //     ->where('id_siswa', 1)
        //     ->get());

        $id_siswa = auth('siswa')->user()->id_siswa;
        // Ambil id siswa yang sedang login dari guard 'siswa'

        $aspirasi = DB::table('aspirasi')
            // Mulai query dari tabel aspirasi

            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
            // Join ke tabel kategori supaya bisa ambil nama / keterangan kategori

            ->leftJoin('progres_aspirasi', function ($join) {
                // Left join supaya aspirasi tetap tampil
                // walaupun belum punya progres

                $join->on('aspirasi.id_aspirasi', '=', 'progres_aspirasi.id_aspirasi')
                    // Samakan id_aspirasi di kedua tabel

                    ->whereRaw('progres_aspirasi.tanggal_update = (
            SELECT MAX(tanggal_update)
            FROM progres_aspirasi
            WHERE progres_aspirasi.id_aspirasi = aspirasi.id_aspirasi
        )');
                // Ambil hanya progres dengan tanggal_update TERBESAR
                // Artinya: hanya status terbaru
                // Ini yang mencegah data duplikat
            })

            ->where('aspirasi.id_siswa', $id_siswa)
            // Filter supaya hanya ambil aspirasi milik siswa yang login

            ->select(
                'aspirasi.id_aspirasi',
                // ID aspirasi

                'aspirasi.judul_aspirasi',
                // Judul laporan

                'aspirasi.tanggal_lapor',
                // Tanggal laporan dibuat

                'aspirasi.lokasi',
                // Lokasi kejadian

                'aspirasi.ket_aspirasi',
                // Isi / deskripsi aspirasi

                'kategori.ket_kategori',
                // Nama atau keterangan kategori

                'progres_aspirasi.status',
                // Status TERBARU (hasil subquery max tanggal)

                'progres_aspirasi.tanggal_update'
                // Tanggal update status terbaru
            )

            ->get();
        // Eksekusi query dan ambil semua hasil sebagai collection
        return view('Siswa.RiwayatAspirasiSiswa', compact('aspirasi'));
    }
    function RiwayatDetailAspirasiSiswa($id){
        $aspirasi = DB::table('aspirasi')
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
            ->select(
                'aspirasi.id_aspirasi',
                'aspirasi.judul_aspirasi',
                'aspirasi.tanggal_lapor',
                'aspirasi.id_kategori',
                'aspirasi.lokasi',
                'aspirasi.ket_aspirasi',
                'kategori.ket_kategori'
            )
            ->where('aspirasi.id_aspirasi', $id)
            ->first();

        $progres = DB::table('progres_aspirasi')
            ->select(
                'id_progres',
                'status',
                'tanggal_update',
                'ket_progres',
                'umpan_balik'
            )
            ->where('id_aspirasi', $id)
            ->orderBy('tanggal_update', 'desc')
            ->get();

        return view('Siswa.RiwayatDetailAspirasiSiswa', compact('aspirasi', 'progres'));
    }
    function HapusAspirasiSiswa($id){
        DB::table('aspirasi')
        ->where('id_aspirasi', $id)
        ->delete();

        return redirect('/Siswa/RiwayatAspirasiSiswa')->with('success', 'Data Berhasil Dihapus');
    
        }
    //=============================Untuk Admin=======================================================================================

    function indexAdmin(){

        // 1. Membuat subquery untuk mencari ID progres TERAKHIR (tertinggi) untuk tiap aspirasi
        // Kita gunakan id_progres (Primary Key) karena lebih akurat daripada tanggal (yang bisa kembar)
        $subqueryProgresTerbaru = DB::table('progres_aspirasi')
            ->select(DB::raw('MAX(id_progres) as last_id')) // Ambil ID yang paling besar
            ->groupBy('id_aspirasi'); // Kelompokkan berdasarkan aspirasi-nya

        // 2. Query Utama untuk mengambil data Aspirasi
        $aspirasi = DB::table('aspirasi')
            // Join ke tabel progres_aspirasi dengan kondisi khusus
            ->leftJoin('progres_aspirasi', function ($join) use ($subqueryProgresTerbaru) {
                $join->on('aspirasi.id_aspirasi', '=', 'progres_aspirasi.id_aspirasi')
                    // KUNCI UTAMA: Hanya join baris yang ID-nya ada di daftar ID terbaru tadi
                    ->whereIn('progres_aspirasi.id_progres', $subqueryProgresTerbaru);
            })

            // Join ke tabel kategori untuk mengambil nama kategorinya
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
            ->join('siswa', 'aspirasi.id_siswa', '=', 'siswa.id_siswa')


            // Menentukan kolom mana saja yang mau ditampilkan di halaman Admin
            ->select(
                'aspirasi.id_aspirasi',
                'aspirasi.judul_aspirasi',
                'aspirasi.tanggal_lapor',
                'aspirasi.lokasi',
                'aspirasi.ket_aspirasi',
                'progres_aspirasi.status',          // Ini otomatis jadi status yang paling baru
                'progres_aspirasi.tanggal_update',  // Tanggal saat status diubah terakhir kali
                'progres_aspirasi.ket_progres',  // Tanggal saat status diubah terakhir kali
                'kategori.ket_kategori',             // Nama kategori (misal: Infrastruktur, dll)
                'siswa.Nama'
            )

            // MENGURUTKAN: Agar data yang baru diupdate/baru lapor muncul di paling atas
            // DESC (Descending) artinya dari yang terbaru ke yang terlama
            ->orderBy('progres_aspirasi.tanggal_update', 'desc') // Utamakan yang baru di-update
            ->orderBy('aspirasi.tanggal_lapor', 'desc')         // Baru urutkan berdasarkan tanggal lapor
            // Eksekusi query dan ambil semua datanya
            ->get();
        $data = $aspirasi->first() ?? (object)['status' => ''];
        $totalData = DB::table('aspirasi')->count();
        $dataSiswa = DB::table('siswa')
        ->get();
        $kategori = DB::table('kategori')
        ->get();
        // 3. Mengirim data ke view Admin/Dasboard_admin.blade.php
        return view('Admin.Dasboard_admin', compact('data','aspirasi', 'totalData', 'dataSiswa', 'kategori'));
    }
    ///belum di benerin
    function DetailAspirasiAdmin($id)
    {
        $data = DB::table('aspirasi')
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
            ->join('siswa','aspirasi.id_siswa','=','siswa.id_siswa')
            ->select(
                'aspirasi.id_aspirasi',
                'aspirasi.judul_aspirasi',
                'aspirasi.tanggal_lapor',
                'aspirasi.id_kategori',
                'aspirasi.lokasi',
                'aspirasi.ket_aspirasi',
                'kategori.ket_kategori',
                'siswa.Nama'
            )
            ->where('aspirasi.id_aspirasi', $id)
            ->first();

        $progres = DB::table('progres_aspirasi')
            ->select(
                'id_progres',
                'status',
                'tanggal_update',
                'ket_progres',
                'umpan_balik'
            )
            ->where('id_aspirasi', $id)
            ->orderBy('tanggal_update', 'desc')
            ->get();

        return view('Admin.Dasboard_admin', compact('data', 'progres'));
    }
    function RiwayatAdmin(){
        $id_admin = auth()->guard('admin')->user()->id_admin;
        $p = DB::table('progres_aspirasi')
            ->join('aspirasi', 'progres_aspirasi.id_aspirasi', '=', 'aspirasi.id_aspirasi')
            ->select(
                'progres_aspirasi.id_aspirasi',
                'progres_aspirasi.tanggal_update',
                'progres_aspirasi.umpan_balik',
                'progres_aspirasi.status',
                'progres_aspirasi.ket_progres',
                'aspirasi.judul_aspirasi'
            )
            ->where('id_admin', $id_admin)
            ->orderBy('tanggal_update', 'desc')
            ->get(); ///hasil colection atau banyak data karena tidak menggunakan first

        // 2. Gunakan method map() untuk "memodifikasi" setiap baris data
        $p = $p->map(function ($item) {

            // --- LOGIKA PENCARIAN STATUS SEBELUMNYA ---

            // Kita buat properti baru bernama 'status_lama' di dalam objek $item
            $item->status_lama = DB::table('progres_aspirasi')
                // Cari data yang punya id_aspirasi yang sama dengan baris ini
                ->where('id_aspirasi', $item->id_aspirasi)

                // Cari data yang waktunya terjadi SEBELUM waktu di baris ini
                ->where('tanggal_update', '<', $item->tanggal_update)

                // Urutkan dari yang terbaru (biar dapet status yang tepat sebelum ini)
                ->orderBy('tanggal_update', 'desc')

                // Ambil hanya teks di kolom 'status' saja (misal: "Menunggu")
                ->value('status');

            // Kembalikan data $item yang sudah "diperkaya" dengan info status_lama
            return $item;
        });

        // Eksekusi query dan ambil semua hasil sebagai collection
        return view('Admin.RiwayatAdmin', compact('p'));
    }

    public function filter(Request $request)
    {
        /**
         * [1] DEFINISI QUERY AWAL (Pondasi)
         * DB::table('aspirasi') -> Menunjuk tabel utama 'aspirasi'.
         * join('siswa', ...) -> Menarik data dari tabel siswa agar kolom 'Nama' bisa dibaca.
         * join('kategori', ...) -> Menarik data kategori agar kita bisa filter pakai ID Kategori.
         * select(...) -> Memilih kolom apa saja yang mau kita "angkut" ke halaman web.
         */
        $query = DB::table('aspirasi')
            ->join('siswa', 'aspirasi.id_siswa', '=', 'siswa.id_siswa')
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
            ->select('aspirasi.*', 'siswa.Nama', 'kategori.ket_kategori');

        /**
         * [2] LOGIKA STATUS TERBARU (Subquery)
         * Karena satu laporan bisa punya banyak status (menunggu -> proses -> selesai),
         * kita cari ID Progres yang paling BESAR (terbaru) supaya datanya nggak duplikat di tabel.
         */
        $subquery = DB::table('progres_aspirasi')
            ->select(DB::raw('MAX(id_progres) as last_id'))
            ->groupBy('id_aspirasi');

        $query->leftJoin('progres_aspirasi', function ($join) use ($subquery) {
            $join->on('aspirasi.id_aspirasi', '=', 'progres_aspirasi.id_aspirasi')
                ->whereIn('progres_aspirasi.id_progres', $subquery);
        })->addSelect('progres_aspirasi.status', 'progres_aspirasi.tanggal_update', 'progres_aspirasi.ket_progres');

    // ================================================================
    // [3] PROSES PENYARINGAN (FILTERING)
    // ================================================================

        /**
         * $request->filled('siswa') -> Cek apakah kotak pencarian nama diisi oleh admin.
         * 'LIKE' -> Mencari data yang MIRIP (tidak harus persis).
         * '%' . $request->siswa . '%' -> Wildcard, cari teks tersebut di posisi mana saja.
         */
        if ($request->filled('siswa')) {
            $query->where('siswa.Nama', 'LIKE', '%' . $request->siswa . '%');
        }

        /**
         * whereMonth -> Fungsi sakti Laravel untuk mengambil angka BULAN (1-12) 
         * saja dari kolom tanggal_lapor, mengabaikan tanggal dan tahunnya.
         */
        if ($request->filled('bulan')) {
            $query->whereMonth('aspirasi.tanggal_lapor', $request->bulan);
        }

        /**
         * where('aspirasi.id_kategori', ...) -> Mencari data yang ID Kategorinya 
         * sama persis dengan pilihan di dropdown.
         */
        if ($request->filled('kategori')) {
            $query->where('aspirasi.id_kategori', $request->kategori);
        }

        /**
         * whereDate -> Memotong data DATETIME menjadi format DATE saja (YYYY-MM-DD)
         * agar bisa dicocokkan dengan input kalender.
         */
        if ($request->filled('tanggal')) {
            $query->whereDate('aspirasi.tanggal_lapor', $request->tanggal);
        }

    // ================================================================
    // [4] EKSEKUSI DATA
    // ================================================================

        /**
         * orderBy -> Mengurutkan data. 'desc' (Descending) artinya yang terbaru paling atas.
         * get() -> "Tombol Enter". Baru di baris inilah Laravel beneran manggil database.
         */
        $aspirasi = $query->orderBy('progres_aspirasi.tanggal_update', 'desc') // Utamakan yang baru di-update
            ->orderBy('aspirasi.tanggal_lapor', 'desc')         // Baru urutkan berdasarkan tanggal lapor
            ->get();

        /**
         * count() -> Menghitung ada berapa baris data yang berhasil difilter.
         */
        $totalData = $aspirasi->count();
        $data = $aspirasi->first() ?? (object)['status' => ''];

        /**
         * [6] PENGAMBILAN DATA MASTER
         * Mengambil daftar siswa dan kategori lagi supaya pilihan di form (datalist)
         * tetap muncul/tidak kosong setelah halaman refresh.
         */
        $dataSiswa = DB::table('siswa')->get();
        $kategori = DB::table('kategori')->get();

        /**
         * [7] PENGIRIMAN DATA
         * compact -> Membungkus semua variabel tadi untuk dilempar ke file Blade.
         */
        return view('Admin.Dasboard_admin', compact('data','aspirasi', 'totalData', 'dataSiswa', 'kategori'));
    }

}