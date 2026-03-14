<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare Admin | Aktivitas Saya</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        :root {
            --primary-dark: #0f172a;
            --accent-gold: #b59410;
            --admin-purple: #7c3aed;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-500: #64748b;
            --white: #ffffff;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--slate-50);
            color: var(--primary-dark);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        #menu-control {
            display: none;
        }

        /* --- Sidebar --- */
        .sidebar-wrapper {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--primary-dark);
            color: var(--white);
            z-index: 1100;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-header {
            padding: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 0;
        }

        .btn-close-sidebar {
            position: absolute;
            right: 20px;
            top: 35px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 15px;
        }

        .nav-item-custom {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .nav-item-custom i {
            width: 20px;
            margin-right: 12px;
        }

        .nav-item-custom:hover,
        .nav-item-custom.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }

        .nav-item-custom.active {
            background: var(--admin-purple);
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
        }

        /* --- Main Content --- */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin 0.3s ease-in-out;
        }

        .top-bar {
            height: 80px;
            background: var(--white);
            border-bottom: 1px solid var(--slate-200);
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* --- Activity List Styles --- */
        .log-card {
            background: white;
            border-radius: 24px;
            border: 1px solid var(--slate-200);
            margin-bottom: 1.5rem;
            padding: 24px;
            position: relative;
            transition: 0.3s;
        }

        .log-card:hover {
            border-color: var(--admin-purple);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        }

        .admin-info-header {
            background: var(--white);
            border: 1px solid var(--slate-200);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .status-badge {
            font-size: 0.7rem;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 50px;
            text-transform: uppercase;
        }

        .change-arrow {
            color: var(--slate-500);
            margin: 0 8px;
            font-size: 0.8rem;
        }

        .log-details {
            background: var(--slate-50);
            border-radius: 16px;
            padding: 15px;
            margin-top: 15px;
            font-size: 0.85rem;
        }

        .log-label {
            font-weight: 800;
            font-size: 0.65rem;
            text-transform: uppercase;
            color: var(--slate-500);
            margin-bottom: 5px;
            display: block;
        }

        /* --- Responsive --- */
        @media (max-width: 991.98px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .btn-close-sidebar {
                display: flex;
            }

            #menu-control:checked~.sidebar-wrapper {
                transform: translateX(0);
            }

            #menu-control:checked~.sidebar-overlay {
                opacity: 1;
                visibility: visible;
            }

            .top-bar {
                padding: 0 20px;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('Css/MyAlert.css') }}">
</head>

<body>

    <input type="checkbox" id="menu-control">
    <label for="menu-control" class="sidebar-overlay"></label>

    <!-- Sidebar -->
    <aside class="sidebar-wrapper">
        <div class="sidebar-header">
            <h2 class="brand-title">Sarpras<span style="color:var(--accent-gold)">Care</span></h2>
            <p class="mb-0 text-muted small">PANEL ADMIN</p>
            <label for="menu-control" class="btn-close-sidebar">
                <i class="fa-solid fa-xmark"></i>
            </label>
        </div>

        <div class="sidebar-content">
            <nav class="sidebar-menu">
                <a href="{{ url('Admin/DashboardAdmin') }}" class="nav-item-custom">{{-- untuk mengalihkan halaman --}}
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
                <a href="#" class="nav-item-custom active">
                    <i class="fa-solid fa-list-check"></i> Riwayat
                </a>
                <a href="{{ url('Admin/DataSiswa') }}" class="nav-item-custom">
                    <i class="fa-solid fa-users"></i> Data Siswa
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="top-bar">
            <div class="d-flex align-items-center">
                <label for="menu-control" class="btn btn-light d-lg-none me-3">
                    <i class="fa-solid fa-bars-staggered"></i>
                </label>
                <h5 class="fw-bold mb-0">Manajemen Aspirasi</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <div class="profile-trigger d-flex align-items-center gap-3" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="text-end d-none d-md-block">
                            <p class="mb-0 fw-bold small">{{ auth()->guard('admin')->user()->username }}</p>
                            <p class="mb-0 text-muted small" style="font-size: 0.7rem;">Admin Utama</p>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Admin&background=7c3aed&color=fff"
                            class="rounded-circle shadow-sm" width="40">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2"
                        style="min-width: 200px;">
                        <li>
                            <h6 class="dropdown-header small text-muted text-uppercase fw-bold">Pengaturan</h6>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="#"
                                data-bs-toggle="modal" data-bs-target="#modalEditProfile">
                                <i class="fa-solid fa-user-gear text-primary"></i>
                                <span>Edit Profil Saya</span>
                            </a>
                        </li>
                        <form action="{{ url('Admin/LogoutAdmin') }}" method="POST">
                            @csrf
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <button type="submit"
                                    class="ps-3 dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 text-danger btn-reset">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Keluar</span>
                                </button>
                            </li>
                        </form>
                    </ul>
                </div>
        </header>

        <div class="p-4 p-lg-5">

            <!-- Profil Admin yang Sedang Aktif -->
            <div class="admin-info-header shadow-sm">
                <img src="https://ui-avatars.com/api/?name={{ auth()->guard('admin')->user()->username }}&background=0f172a&color=fff"
                    class="rounded-4" width="60">
                <div>
                    <h4 class="fw-800 mb-0">{{ auth()->guard('admin')->user()->username }}</h4>
                    <p class="text-muted small mb-0">Admin Utama</span> • Terakhir aktif: Hari ini, 21:15</p>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h5 class="fw-800 mb-1">Daftar Perubahan Status</h5>
                    <p class="text-muted small mb-0">Riwayat aspirasi yang pernah Anda kelola.</p>
                </div>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-sm border-slate-200 rounded-3 px-3"
                        placeholder="Cari ID Tiket..." style="width: 200px;">
                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap">{{-- untuk filter data --}}
                <a href="?range=hari-ini"
                    class="btn btn-sm rounded-pill px-3 {{ request('range') == 'hari-ini' ? 'btn-primary' : 'btn-light border text-muted' }}">Hari
                    Ini</a>
                <a href="?range=kemarin"
                    class="btn btn-sm rounded-pill px-3 {{ request('range') == 'kemarin' ? 'btn-primary' : 'btn-light border text-muted' }}">Kemarin</a>
                <a href="?range=minggu-ini"
                    class="btn btn-sm rounded-pill px-3 {{ request('range') == 'minggu-ini' ? 'btn-primary' : 'btn-light border text-muted' }}">Minggu
                    Ini</a>
                <a href="?range=minggu-lalu"
                    class="btn btn-sm rounded-pill px-3 {{ request('range') == 'minggu-lalu' ? 'btn-primary' : 'btn-light border text-muted' }}">Minggu
                    Lalu</a>
                <a href="?range=bulan-ini"
                    class="btn btn-sm rounded-pill px-3 {{ request('range') == 'bulan-ini' ? 'btn-primary' : 'btn-light border text-muted' }}">Bulan
                    Ini</a>
                <a href="?range=bulan-lalu"
                    class="btn btn-sm rounded-pill px-3 {{ request('range') == 'bulan-lalu' ? 'btn-primary' : 'btn-light border text-muted' }}">Bulan
                    Lalu</a>
                <a href="{{ url()->current() }}" class="btn btn-sm rounded-pill px-3 btn-secondary">Reset</a>
            </div><br>

            <!-- Log List -->
            <div class="row">
                <div class="col-12">
                    @foreach ($p as $progres)
                        {{-- inisialisasi data --}}
                        @if ($progres->status == 'selesai')
                            {{-- jika status = selesai maka tampilkan kode di bawah --}}
                            <!-- Item 1 -->
                            <div class="log-card">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                                            <i class="fa-solid fa-clipboard-check"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Memperbarui Tiket <a
                                                    class=" text-decoration-none"
                                                    href="{{ url('Admin/DashboardAdmin') }}#aspirasi-231{{ $progres->id_aspirasi }}">#SPR-231{{ $progres->id_aspirasi }}</a>{{-- untukl menampilkan id_aspirasi dan jika di klik aka di alihkan ke laporannya langsung --}}
                                            </h6>
                                            <h6 class="fw-bold mb-0 ml-4 pt-1">{{ $progres->judul_aspirasi }}</h6>
                                            {{-- menampilkan judul aspirasi --}}
                                            <p class="text-muted xsmall mb-0">Dilakukan
                                                pada{{ $progres->tanggal_update }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @switch($progres->status_lama)
                                            {{-- menentukan status dengan switch --}}
                                            @case('menunggu')
                                                {{-- jika status = menunggu tampilkan tampilan di bawah --}}
                                                <span
                                                    class="status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @case('diproses')
                                                {{-- sama --}}
                                                <span
                                                    class="status-badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @default
                                        @endswitch
                                        <i class="fa-solid fa-arrow-right-long change-arrow"></i>
                                        <span
                                            class="status-badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">{{ $progres->status }}</span>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <span class="log-label">Keterangan Progres (Teknis)</span>
                                        <div class="log-details border-start border-4 border-primary">
                                            {{ $progres->ket_progres }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="log-label">Umpan Balik (Pesan ke Siswa)</span>
                                        <div
                                            class="log-details border-start border-4 border-success bg-success bg-opacity-10">
                                            {{ $progres->umpan_balik }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($progres->status == 'diproses')
                            {{-- jika status = diproses tampilkan kode dibawah ini --}}
                            <!-- Item 2 -->
                            <div class="log-card">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                                            <i class="fa-solid fa-spinner"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Memperbarui Tiket <a
                                                    class=" text-decoration-none"
                                                    href="{{ url('Admin/DashboardAdmin') }}#aspirasi-231{{ $progres->id_aspirasi }}">#SPR-231{{ $progres->id_aspirasi }}</a>
                                            </h6>
                                            <h6 class="fw-bold mb-0 ml-4 pt-1">{{ $progres->judul_aspirasi }}</h6>
                                            <p class="text-muted xsmall mb-0">Dilakukan pada
                                                {{ $progres->tanggal_update }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @switch($progres->status_lama)
                                            @case('menunggu')
                                                <span
                                                    class="status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @case('selesai')
                                                <span
                                                    class="status-badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @case('ditolak')
                                                <span
                                                    class="status-badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @default
                                                <span
                                                    class="status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">menunggu</span>
                                        @endswitch
                                        <i class="fa-solid fa-arrow-right-long change-arrow"></i>
                                        <span
                                            class="status-badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">{{ $progres->status }}</span>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <span class="log-label">Keterangan Progres (Teknis)</span>
                                        <div class="log-details border-start border-4 border-primary">
                                            {{ $progres->ket_progres }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($progres->status == 'menunggu')
                            {{-- jika status = menunggu tampilkan kode dibawah ini --}}
                            <!-- Item 3 -->
                            <div class="log-card">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4">
                                            <i class="fa-solid fa-spinner"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Memperbarui Tiket <a
                                                    class=" text-decoration-none"
                                                    href="{{ url('Admin/DashboardAdmin') }}#aspirasi-231{{ $progres->id_aspirasi }}">#SPR-231{{ $progres->id_aspirasi }}</a>
                                            </h6>
                                            <h6 class="fw-bold mb-0 ml-4 pt-1">{{ $progres->judul_aspirasi }}</h6>
                                            <p class="text-muted xsmall mb-0">Dilakukan pada
                                                {{ $progres->tanggal_update }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @switch($progres->status_lama)
                                            @case('selesai')
                                                <span
                                                    class="status-badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @case('diproses')
                                                <span
                                                    class="status-badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @case('ditolak')
                                                <span
                                                    class="status-badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @default
                                                <span
                                                    class="status-badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">baru</span>
                                        @endswitch
                                        <i class="fa-solid fa-arrow-right-long change-arrow"></i>
                                        <span
                                            class="status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">{{ $progres->status }}</span>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <span class="log-label">Alasan Penolakan</span>
                                        <div
                                            class="log-details border-start border-4 border-warning bg-warning bg-opacity-10">
                                            {{ $progres->ket_progres }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- item 4 --}}
                            @else{{-- jika status = tidak ada yang sama dengan yang diatas, tampilkan kode dibawah ini --}}
                            <div class="log-card">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-4">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Memperbarui Tiket <a
                                                    class=" text-decoration-none"
                                                    href="{{ url('Admin/DashboardAdmin') }}#aspirasi-231{{ $progres->id_aspirasi }}">#SPR-231{{ $progres->id_aspirasi }}</a>
                                            </h6>
                                            <h6 class="fw-bold mb-0 ml-4 pt-1">{{ $progres->judul_aspirasi }}</h6>
                                            <p class="text-muted xsmall mb-0">Dilakukan pada
                                                {{ $progres->tanggal_update }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @switch($progres->status_lama)
                                            @case('menunggu')
                                                <span
                                                    class="status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @case('diproses')
                                                <span
                                                    class="status-badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">{{ $progres->status_lama }}</span>
                                            @break

                                            @default
                                                <span
                                                    class="status-badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">Baru</span>
                                        @endswitch
                                        <i class="fa-solid fa-arrow-right-long change-arrow"></i>
                                        <span
                                            class="status-badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">{{ $progres->status }}</span>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <span class="log-label">Alasan Penolakan</span>
                                        <div
                                            class="log-details border-start border-4 border-danger bg-danger bg-opacity-10">
                                            {{ $progres->ket_progres }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif{{-- akhir if --}}
                    @endforeach{{-- akhir foreach --}}
                </div>
            </div>
        </div>
    </main>
    {{-- MOdal untuk edit profile --}}
    <div class="modal fade" id="modalEditProfile" tabindex="-1" aria-labelledby="modalEditProfileLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold mb-0" id="modalEditProfileLabel">Edit Profil Saya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ url('Admin/Profile/Update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body p-4">
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->guard('admin')->user()->username }}&background=7c3aed&color=fff"
                                    class="rounded-circle border border-4 border-white shadow-sm" width="90">
                                <label
                                    class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center border border-2 border-white"
                                    style="width: 30px; height: 30px; cursor: pointer;">
                                    <i class="fa-solid fa-camera small"></i>
                                    <input type="file" name="photo" hidden>
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Username Admin</label>
                            <input name="username" type="text"
                                class="form-control rounded-3 border-slate-200 bg-light"
                                value="{{ auth()->guard('admin')->user()->username }}" required>{{-- masukan username dari sesi login --}}
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password</label>
                            <input type="password" placeholder="Kosongkan jika tidak di ubah" name="password"
                                class="form-control rounded-3 border-slate-200">
                        </div>


                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2 rounded-3 fw-bold shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Js/MyAlert.js') }}"></script>
    <script>
        // 1. Cek kalau ada pesan sukses dari Controller
        @if (session('success'))
            // Ganti 'tampilkanAlert' dengan nama fungsi yang ada di MyAlert.js Abang
            MyAlert.show({
                type: 'success',
                title: 'Berhasil!',
                message: "{{ session('success') }}",
                autoClose: 3000, // 3000 = 3 detik
                confirmText: 'Sip!'
            });
        @endif

        // 2. Cek kalau ada pesan error (misal: login gagal)
        @if (session('error'))
            MyAlert.show({
                type: 'error',
                title: 'error!',
                message: '{{ session('error') }}',
                autoClose: 3000, // 3000 = 3 detik
                confirmText: 'Sip!'
            });
        @endif
    </script>
</body>

</html>
