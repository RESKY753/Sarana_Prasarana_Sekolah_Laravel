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
        $id_siswa = auth('siswa')->user()->id_siswa; //ambil id_siswa dari sesi login

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
            ->where('id_siswa', $id_siswa)

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
        $id_siswa = auth('siswa')->user()->id_siswa;//ambil id_siswa dari sesi login

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
        DB::table('aspirasi')->insert(//masukan data ke table aspirasi
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
        //arahkan siswa ke dasboard jika tambah laporan berhasil, dengan pesan success
        return redirect('Siswa/DashboardSiswa')->with('success', "Data Berhasil Ditambahkan");
    }
    function DetailAspirasiSiswa($id){//tampilkan detail aspirasi sesuia id
        $aspirasi = DB::table('aspirasi')//panggil tabel aspirasi
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')//join dengan kategori
            ->select(//pilih kolom
            'aspirasi.id_aspirasi',
            'aspirasi.judul_aspirasi',
            'aspirasi.tanggal_lapor',
            'aspirasi.id_kategori',
            'aspirasi.lokasi',
            'aspirasi.ket_aspirasi',
            'kategori.ket_kategori'
            )
            ->where('aspirasi.id_aspirasi', $id)//tampilkan detail aspirasi dengan where sesuai dengan id di atas/id_aspirasi
            ->first();//panggil satu data saja

        $progres = DB::table('progres_aspirasi')//paggila tabel progres
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
            ->orderBy('tanggal_update', 'desc')//kelompokan sesuai tanggal update dan tampilkan data dengan tanggal terbaru paling atas(desc)
            ->get();//ambil semua datanya
            //kirim ke Siswa.DetailAspirasi untuk di eksekusi
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
            ->where('aspirasi.id_aspirasi', $id)//tampilkan data sesuai dengan id_aspirasi dengan parameterr di atas
            ->first();

        $progres = DB::table('progres_aspirasi')
            ->select(
                'id_progres',
                'status',
                'tanggal_update',
                'ket_progres',
                'umpan_balik'
            )
            ->where('id_aspirasi', $id)//sama
            ->orderBy('tanggal_update', 'desc')
            ->get();

        return view('Siswa.RiwayatDetailAspirasiSiswa', compact('aspirasi', 'progres'));
    }

    //ini belum dipakai
    function RiwayatProgresAspirasi($id)
    {
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
            ->where('aspirasi.id_aspirasi', $id) //tampilkan data sesuai dengan id_aspirasi dengan parameterr di atas
            ->first();

        $progres = DB::table('progres_aspirasi')
            ->select(
                'id_progres',
                'status',
                'tanggal_update',
                'ket_progres',
                'umpan_balik'
            )
            ->where('id_aspirasi', $id) //sama
            ->where('status','menunggu') //sama
            ->orderBy('tanggal_update', 'desc')
            ->get();

        return view('Siswa.RiwayatDetailAspirasiSiswa', compact('aspirasi', 'progres'));
    }
    function HapusAspirasiSiswa($id){
        DB::table('aspirasi')//pagil tabel aspirasi
        ->where('id_aspirasi', $id) //hapus data sesuai dengan id_aspirasi
        ->delete();//perintah hapus

        return redirect('/Siswa/RiwayatAspirasiSiswa')->with('success', 'Data Berhasil Dihapus');
    
        }
    //=============================Untuk Admin=======================================================================================

    function indexAdmin()
    {

        // 1. SUBQUERY: Mencari "Pemenang" ID Progres Terakhir
        // Kita butuh ini karena satu aspirasi bisa punya banyak baris progres (Lapor -> Proses -> Selesai).
        // Tanpa subquery ini, data aspirasi di tabel bakal muncul berulang-ulang (duplikat).
        $subqueryProgresTerbaru = DB::table('progres_aspirasi')
            // DB::raw: Izin ke Laravel buat nulis perintah SQL murni 'MAX'
            // MAX(id_progres): Mencari angka ID terbesar (karena ID terbesar = status terbaru)
            // as last_id: Kasih nama panggilan 'last_id' biar gampang dipanggil nanti
            ->select(DB::raw('MAX(id_progres) as last_id'))
            // groupBy: Kelompokkan ID terbesar itu berdasarkan masing-masing aspirasi
            ->groupBy('id_aspirasi');

        // 2. QUERY UTAMA: Mengambil Data Aspirasi & Menempelkan Status Terbarunya
        $aspirasi = DB::table('aspirasi')

            /**
             * FUNGSI ->leftJoin() : 
             * 'Nempelin' tabel progres_aspirasi ke tabel aspirasi.
             * Pake 'Left' supaya kalau ada aspirasi yang BELUM ADA progresnya, datanya nggak ilang.
             */
            ->leftJoin('progres_aspirasi', function ($join) use ($subqueryProgresTerbaru) {

                /**
                 * FUNGSI $join->on() :
                 * Ngasih tau Laravel kunci penghubungnya: Kolom id_aspirasi di kedua tabel.
                 */
                $join->on('aspirasi.id_aspirasi', '=', 'progres_aspirasi.id_aspirasi')

                    /**
                     * FUNGSI ->whereIn() :
                     * Filter 'Sakti' kita. Kita bilang ke database:
                     * "Jangan ambil semua progres, ambil baris progres yang ID-nya 
                     * masuk dalam daftar 'last_id' (terbesar) yang kita cari di subquery tadi!"
                     */
                    ->whereIn('progres_aspirasi.id_progres', $subqueryProgresTerbaru);
            })

            /**
             * FUNGSI ->join() biasa (Inner Join):
             * Menghubungkan tabel kategori dan siswa.
             * Ini wajib ada pasangannya. Kalau id_kategori di aspirasi kosong, data gak bakal muncul.
             */
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
            ->join('siswa', 'aspirasi.id_siswa', '=', 'siswa.id_siswa')

            /**
             * FUNGSI ->select() :
             * Milih kolom mana aja yang mau kita angkut ke View.
             * NamaTabel.NamaKolom biar database gak bingung kalau ada nama kolom yang sama.
             */
            ->select(
                'aspirasi.id_aspirasi',
                'aspirasi.judul_aspirasi',
                'aspirasi.tanggal_lapor',
                'aspirasi.lokasi',
                'aspirasi.ket_aspirasi',
                'progres_aspirasi.status',        // Status TERBARU hasil filter MAX tadi
                'progres_aspirasi.tanggal_update', // Kapan statusnya berubah
                'progres_aspirasi.ket_progres',    // Catatan dari admin soal progresnya
                'kategori.ket_kategori',           // Nama kategori (Infrastruktur/Layanan, dll)
                'siswa.Nama'                       // Nama siswa yang lapor
            )

            /**
             * FUNGSI ->orderBy() :
             * Ngatur barisan. 'desc' (Descending) artinya dari yang paling baru ke lama.
             */
            ->orderBy('progres_aspirasi.tanggal_update', 'desc')
            ->orderBy('aspirasi.tanggal_lapor', 'desc')

            // Terakhir, tarik semua datanya!
            ->get();

        // 3. PENDUKUNG DASHBOARD:
        // Ambil baris pertama buat ditampilin di header (opsional)
        $data = $aspirasi->first() ?? (object)['status' => ''];

        // Hitung total laporan buat di kotak statistik
        $totalData = DB::table('aspirasi')
            // 1. Tempelkan tabel progres (pake Left Join biar yang NULL/Baru tetep kehitung)
            ->leftJoin('progres_aspirasi', 'aspirasi.id_aspirasi', '=', 'progres_aspirasi.id_aspirasi')

            // 2. KUNCI UTAMA: Hanya ambil baris progres yang ID-nya paling besar (Terbaru)
            // Ini biar kalau ada 10 riwayat, yang diambil cuma 1 yang paling baru
            ->whereIn('progres_aspirasi.id_progres', function ($query) {
                $query->selectRaw('MAX(id_progres)')
                    ->from('progres_aspirasi')
                    ->groupBy('id_aspirasi');
            })

            // 3. Baru deh filter statusnya (Menunggu atau Diproses)
            ->whereIn('progres_aspirasi.status', ['menunggu', 'diproses'])

            // 4. Eksekusi hitung
            ->count();
        // $totalData = DB::table('aspirasi')->count();

        // Ambil data siswa & kategori buat isi dropdown di Modal (kalau mau tambah data)
        $dataSiswa = DB::table('siswa')->get();
        $kategori = DB::table('kategori')->get();

        /**
         * FUNGSI compact() :
         * Cara simpel buat ngirim banyak variabel ke file Blade.
         * Nama variabel di dalam kurung harus sama persis dengan nama variabel di atas.
         */
        return view('Admin.Dasboard_admin', compact('data', 'aspirasi', 'totalData', 'dataSiswa', 'kategori'));
    }


    function DaftarAspirasi()
    {

        // 1. SUBQUERY: Mencari "Pemenang" ID Progres Terakhir
        // Kita butuh ini karena satu aspirasi bisa punya banyak baris progres (Lapor -> Proses -> Selesai).
        // Tanpa subquery ini, data aspirasi di tabel bakal muncul berulang-ulang (duplikat).
        $subqueryProgresTerbaru = DB::table('progres_aspirasi')
            // DB::raw: Izin ke Laravel buat nulis perintah SQL murni 'MAX'
            // MAX(id_progres): Mencari angka ID terbesar (karena ID terbesar = status terbaru)
            // as last_id: Kasih nama panggilan 'last_id' biar gampang dipanggil nanti
            ->select(DB::raw('MAX(id_progres) as last_id'))
            // groupBy: Kelompokkan ID terbesar itu berdasarkan masing-masing aspirasi
            ->groupBy('id_aspirasi');

        // 2. QUERY UTAMA: Mengambil Data Aspirasi & Menempelkan Status Terbarunya
        $aspirasi = DB::table('aspirasi')

            /**
             * FUNGSI ->leftJoin() : 
             * 'Nempelin' tabel progres_aspirasi ke tabel aspirasi.
             * Pake 'Left' supaya kalau ada aspirasi yang BELUM ADA progresnya, datanya nggak ilang.
             */
            ->leftJoin('progres_aspirasi', function ($join) use ($subqueryProgresTerbaru) {

                /**
                 * FUNGSI $join->on() :
                 * Ngasih tau Laravel kunci penghubungnya: Kolom id_aspirasi di kedua tabel.
                 */
                $join->on('aspirasi.id_aspirasi', '=', 'progres_aspirasi.id_aspirasi')

                    /**
                     * FUNGSI ->whereIn() :
                     * Filter 'Sakti' kita. Kita bilang ke database:
                     * "Jangan ambil semua progres, ambil baris progres yang ID-nya 
                     * masuk dalam daftar 'last_id' (terbesar) yang kita cari di subquery tadi!"
                     */
                    ->whereIn('progres_aspirasi.id_progres', $subqueryProgresTerbaru);
            })

            /**
             * FUNGSI ->join() biasa (Inner Join):
             * Menghubungkan tabel kategori dan siswa.
             * Ini wajib ada pasangannya. Kalau id_kategori di aspirasi kosong, data gak bakal muncul.
             */
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')
            ->join('siswa', 'aspirasi.id_siswa', '=', 'siswa.id_siswa')

            /**
             * FUNGSI ->select() :
             * Milih kolom mana aja yang mau kita angkut ke View.
             * NamaTabel.NamaKolom biar database gak bingung kalau ada nama kolom yang sama.
             */
            ->select(
                'aspirasi.id_aspirasi',
                'aspirasi.judul_aspirasi',
                'aspirasi.tanggal_lapor',
                'aspirasi.lokasi',
                'aspirasi.ket_aspirasi',
                'progres_aspirasi.status',        // Status TERBARU hasil filter MAX tadi
                'progres_aspirasi.tanggal_update', // Kapan statusnya berubah
                'progres_aspirasi.ket_progres',    // Catatan dari admin soal progresnya
                'kategori.ket_kategori',           // Nama kategori (Infrastruktur/Layanan, dll)
                'siswa.Nama'                       // Nama siswa yang lapor
            )

            /**
             * FUNGSI ->orderBy() :
             * Ngatur barisan. 'desc' (Descending) artinya dari yang paling baru ke lama.
             */
            ->orderBy('progres_aspirasi.tanggal_update', 'desc')
            ->orderBy('aspirasi.tanggal_lapor', 'desc')

            // Terakhir, tarik semua datanya!
            ->get();

        // 3. PENDUKUNG DASHBOARD:
        // Ambil baris pertama buat ditampilin di header (opsional)
        $data = $aspirasi->first() ?? (object)['status' => ''];

        // Hitung total laporan buat di kotak statistik
        $totalData = DB::table('aspirasi')->count();

        // Ambil data siswa & kategori buat isi dropdown di Modal (kalau mau tambah data)
        $dataSiswa = DB::table('siswa')->get();
        $kategori = DB::table('kategori')->get();

        /**
         * FUNGSI compact() :
         * Cara simpel buat ngirim banyak variabel ke file Blade.
         * Nama variabel di dalam kurung harus sama persis dengan nama variabel di atas.
         */
        return view('Admin.DaftarAspirasi', compact('data', 'aspirasi', 'totalData', 'dataSiswa', 'kategori'));
    }
    ///belum di benerin
    function DetailAspirasiAdmin($id)
    {   //panggil tabel aspirasi di variabel data
        $data = DB::table('aspirasi')
            ->join('kategori', 'aspirasi.id_kategori', '=', 'kategori.id_kategori')//join dengan tabel kategori unutk mengambil keterangan kategori
            ->join('siswa','aspirasi.id_siswa','=','siswa.id_siswa')//join dengan tabel siswa untuk mengambil Nama siswa
            ->select(//pilih kolom yang ingin di tampilkan
                'aspirasi.id_aspirasi',
                'aspirasi.judul_aspirasi',
                'aspirasi.tanggal_lapor',
                'aspirasi.id_kategori',
                'aspirasi.lokasi',
                'aspirasi.ket_aspirasi',
                'kategori.ket_kategori',
                'siswa.Nama'
            )
            ->where('aspirasi.id_aspirasi', $id)//tampilkan aspirasi sesuai dengan id aspirasi dengan where
            ->first();//panggil data pertamannya saja
        // panggil tabel progres aspirasi di varibel progres
        $progres = DB::table('progres_aspirasi')
            ->select(
                'id_progres',
                'status',
                'tanggal_update',
                'ket_progres',
                'umpan_balik'
            )
            ->where('id_aspirasi', $id)
            ->orderBy('tanggal_update', 'desc')//kelompokan berdasarkan tanggaal update,yang dimana tanggal yang paling baru akan tampil di paling atas(decs)
            ->get();//get = ambil semua data
            // kirim variabel data dan progres ke Admin.Dashboard_admin blade
        return view('Admin.Dasboard_admin', compact('data', 'progres'));
    }
    function RiwayatAdmin(){
        $id_admin = auth()->guard('admin')->user()->id_admin;//mengambil id_admin dari sesi login admin
        $p = DB::table('progres_aspirasi')//panggil tabel
            ->join('aspirasi', 'progres_aspirasi.id_aspirasi', '=', 'aspirasi.id_aspirasi')//join tabel aspirasi
            ->select(//pilih data kolom yang ingin di tampilkan
                'progres_aspirasi.id_aspirasi',
                'progres_aspirasi.tanggal_update',
                'progres_aspirasi.umpan_balik',
                'progres_aspirasi.status',
                'progres_aspirasi.ket_progres',
                'aspirasi.judul_aspirasi'
            )
            ->where('id_admin', $id_admin)//tampilkan data sesuai id_admin dengan where yang variabel tadi kita buat
            ->orderBy('tanggal_update', 'desc')//kelompokan data berdasarkan tanggal uppdate, dan tampilkan data dengan tanggal update yang terbaru paling atas
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