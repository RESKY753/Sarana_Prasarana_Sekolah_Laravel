<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\SiswaController;
use App\Models\Admin;
use App\Models\Progres_Aspirasi;
use Database\Seeders\AspirasiSeeder;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

//===========================untuk login=======================================
// Route::get('/', function () {
//     return view('Auth.auth');
// });
///================================tampilan awal alias login==========================================
Route::get('/', [SiswaController::class, 'welcome'])->name('login');

// ===========================================Proses login siswa=====================================
Route::post('/ProsesLoginSiswa', [SiswaController::class, 'ProsesLoginSiswa'])
    ->name('ProsesLoginSiswa');

// ===========================================Proses login admin=====================================
Route::post('/ProsesLoginAdmin', [AdminController::class, 'ProsesLoginAdmin'])
    ->name('ProsesLoginAdmin');

//===========================================Admin===========================================================
// Semua route yang ada di dalam kurung kurawal grup ini akan diproteksi.
// 'auth:admin' artinya: Laravel akan mengecek apakah user sudah login menggunakan Guard 'admin'.
Route::middleware(['auth:admin'])->group(function () {

    // Contoh: Halaman Dashboard Admin
    // Cuma orang yang sudah login sebagai admin yang bisa buka ini.
    // Kalau belum login, mereka bakal otomatis "ditendang" (di-redirect).
    Route::get('Admin/DashboardAdmin', [AspirasiController::class, 'indexAdmin'])
        ->name('DashboardAdmin');

    // Route admin lainnya taruh di sini biar aman juga
    Route::post('Admin/Aspirasi/Tambah', [ProgresController::class, 'store']);
    Route::get('Admin/DataSiswa', [SiswaController::class, 'index']);
    Route::get('Admin/Riwayat', [AspirasiController::class, 'RiwayatAdmin']);
    Route::get('Admin/DashboardAdmin/Filter', [AspirasiController::class, 'filter']);
    Route::post('Admin/LogoutAdmin', [AdminController::class, 'LogoutAdmin']);
    Route::put('Admin/Profile/Update', [AdminController::class, 'update']);
    Route::get('Admin/FormTambah', [AdminController::class, 'create']);
    Route::post('Admin/TambahSiswa', [AdminController::class, 'store']);
    Route::get('Admin/EditSiswa/{id}', [AdminController::class, 'edit']);
    Route::put('Admin/UpdateSiswa/{id}', [AdminController::class, 'updatesiswa']);
    Route::get('Admin/DataSiswa/Filter', [SiswaController::class, 'filterDataSiswa']);
    Route::delete('Admin/DataSiswa/Hapus/{id}', [SiswaController::class, 'HapusSiswa']);
});

//===========================================================================================================

//===========================================Siswa===========================================================
// Semua route yang ada di dalam kurung kurawal grup ini akan diproteksi.
// 'auth:admin' artinya: Laravel akan mengecek apakah user sudah login menggunakan Guard 'admin'.
Route::middleware(['auth:siswa'])->group(function () {

    // Contoh: Halaman Dashboard siswa
    // Cuma orang yang sudah login sebagai siswa yang bisa buka ini.
    // Kalau belum login, mereka bakal otomatis "ditendang" (di-redirect).
    Route::get('Siswa/DashboardSiswa', [AspirasiController::class, 'index'], [SiswaController::class, 'DashboardSiswa'])->name('DashboardSiswa');
    Route::get('Siswa/KirimAspirasi', [AspirasiController::class, 'create']);
    Route::post('/Siswa/Store', [AspirasiController::class, 'store']);
    Route::get('/Siswa/Aspirasi/{id}', [AspirasiController::class, 'DetailAspirasiSIswa']);
    Route::get('/Siswa/RiwayatAspirasi/{id}', [AspirasiController::class, 'RiwayatDetailAspirasiSiswa']);
    Route::delete('/Siswa/RiwayatAspirasi/Delete/{id}', [AspirasiController::class, 'HapusAspirasiSiswa']);
    Route::get('/Siswa/RiwayatAspirasiSiswa', [AspirasiController::class, 'RiwayatAspirasiSiswa']);
    Route::post('Siswa/LogoutSiswa', [SiswaController::class, 'LogoutSiswa']);
    Route::get('Siswa/RiwayatAspirasi/Progres/{id}', [AspirasiController::class, 'RiwayatProgresAspirasi']);
    Route::put('Siswa/UpdateProfile', [SiswaController::class, 'updateProfile']);
});

Route::get(
    '/tes',
    function () {
        return view('Admin.HistoriAdmin');
    }
);
