{{-- @dd(auth()->guard('admin')->user()->usename) --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare Admin | Dashboard Manajemen Aspirasi</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        /* ===============================
       ROOT VARIABLES
       =============================== */
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

        /* ===============================
       SIDEBAR
       =============================== */
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
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 0;
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

        /* ===============================
       MAIN CONTENT
       =============================== */
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

        /* ===============================
       TABLE STYLES
       =============================== */
        .table-container {
            background: white;
            border-radius: 24px;
            border: 1px solid var(--slate-200);
            overflow: hidden;
        }

        .table thead th {
            background: var(--slate-50);
            padding: 18px 24px;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--slate-500);
            border-bottom: 1px solid var(--slate-200);
        }

        .table tbody td {
            padding: 16px 24px;
            vertical-align: middle;
            border-bottom: 1px solid var(--slate-100);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .action-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--slate-200);
            background: white;
            color: var(--slate-500);
            transition: 0.2s;
        }

        .action-btn:hover {
            background: var(--admin-purple);
            color: white;
            transform: translateY(-2px);
        }

        /* ===============================
       MODAL CUSTOM
       =============================== */
        .modal-custom .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .modal-custom .timeline-item {
            position: relative;
            padding-left: 30px;
            padding-bottom: 20px;
            border-left: 2px dashed #e2e8f0;
        }

        .modal-custom .timeline-item:last-child {
            border-left-color: transparent;
        }

        .modal-custom .timeline-marker {
            position: absolute;
            left: -9px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--white);
            border: 3px solid var(--admin-purple);
        }

        .modal-custom .btn-check:checked+.btn-outline-primary {
            background-color: #0d6efd;
            color: #fff;
        }

        .modal-custom .btn-check:checked+.btn-outline-success {
            background-color: #198754;
            color: #fff;
        }

        .modal-custom .btn-check:checked+.btn-outline-danger {
            background-color: #dc3545;
            color: #fff;
        }

        /* ===============================
       RESPONSIVE SIDEBAR & MODAL FIX
       =============================== */
        @media (max-width: 991.98px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }
        }

        @media (min-width: 992px) {
            .modal-dialog {
                /* geser modal supaya tidak nabrak sidebar */
                margin-left: calc(var(--sidebar-width) + 1.5rem);
                margin-right: 1.5rem;
                max-width: calc(100% - var(--sidebar-width) - 3rem);
            }
        }

        /* ===============================
       RESPONSIVE TABLE
       =============================== */
        .table-responsive {
            overflow-x: auto;
        }

        .table td,
        .table th {
            white-space: nowrap;
        }

        /* Overlay saat sidebar terbuka di mobile */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            display: none;
        }

        @media (max-width: 991.98px) {

            /* Sembunyikan sidebar ke kiri */
            .sidebar-wrapper {
                transform: translateX(-100%);
            }

            /* Tampilkan saat checkbox di-check */
            #menu-control:checked~.sidebar-wrapper {
                transform: translateX(0);
            }

            #menu-control:checked~.sidebar-overlay {
                display: block;
            }
        }

        /* Efek saat baris 'dituju' dari link riwayat */
        tr:target {
            background-color: rgba(124, 58, 237, 0.1) !important;
            /* Warna ungu pudar sesuai tema purple kamu */
            border: 2px solid var(--admin-purple);
            transition: all 0.5s ease;
        }

        .btn-reset {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
            width: 100%;
            /* Biar bisa diklik sepanjang baris dropdown */
            text-align: left;
            /* Biar teksnya tetep di kiri kayak link biasa */
        }
    </style>
    {{-- style untuk alert --}}
    <link rel="stylesheet" href="{{ asset('Css/MyAlert.css') }}">
</head>

<body>


    <input type="checkbox" id="menu-control" style="display: none;">
    <label for="menu-control" class="sidebar-overlay"></label>

    <aside class="sidebar-wrapper">
        <div class="sidebar-header">
            <h2 class="brand-title">Sarpras<span style="color:var(--accent-gold)">Care</span></h2>
            <p class="mb-0 text-muted small">PANEL ADMIN</p>
        </div>
        <div class="sidebar-content">
            <nav class="sidebar-menu">
                {{-- href{{ url() }} berfungsi untuk memindahkan tampilan jika tombol di klik --}}
                <a href="{{ url('Admin/DashboardAdmin') }}" class="nav-item-custom">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
                <a href="{{ url('Admin/Riwayat') }}" class="nav-item-custom">
                    <i class="fa-solid fa-list-check"></i> Riwayat
                </a>
                <a href="{{ url('Admin/Daftar_Aspirasi') }}" class="nav-item-custom active">
                    <i class="fa-solid fa-list-check"></i> Daftar Aspirasi
                </a>
                <a href="{{ url('Admin/DataSiswa') }}" class="nav-item-custom">
                    <i class="fa-solid fa-users"></i> Data Siswa
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
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
                            {{-- ambil username admin dari sesi login --}}
                            <p class="mb-0 fw-bold small">{{ auth()->guard('admin')->user()->username }}</p>
                            <p class="mb-0 text-muted small" style="font-size: 0.7rem;">Admin Utama</p>
                        </div>
                        {{-- untuk membuat gambar profile sesuai dengan nama admmin yang diambil dari sesi login --}}
                        <img src="https://ui-avatars.com/api/?name={{ auth()->guard('admin')->user()->username }}&background=7c3aed&color=fff"
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
                        {{-- aksi form untuk logout yang jika di klik akan mengsubmit perintah logout ke url LogoutAdmin --}}
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
            <!-- Info Card -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 border border-slate-200">
                        <p class="text-muted small fw-bold mb-1">TOTAL LAPORAN</p>
                        {{-- untuk menampilkan total laporan dari tabel aspirasi --}}
                        <h2 class="fw-800 mb-0">{{ $totalData }}</h2>
                    </div>
                </div>
            </div>
            {{-- NAVIGASI FILTER --}}
            <!-- Wrapper kartu dengan style tanpa border, bayangan halus, sudut melengkung (rounded-4), dan margin bawah -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4"> <!-- Padding dalam kartu sebesar level 4 -->

                    <!-- Form yang mengirim data ke route Filter menggunakan metode GET -->
                    <form action="{{ url('Admin/DashboardAdmin/Filter') }}" method="GET"
                        class="row g-3 align-items-end">

                        <!-- Kolom Input Pencarian Siswa (Lebar 3/12 pada layar medium) -->
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted"><i class="fa-solid fa-user me-1"></i>
                                Cari Siswa</label>
                            <!-- Input teks dengan fitur 'list' yang terhubung ke datalist id="siswaOptions" -->
                            <input class="form-control rounded-3 border-slate-200" list="siswaOptions" id="siswaFilter"
                                name="siswa" placeholder="Ketik nama siswa...">

                            <!-- Daftar pilihan otomatis (autocomplete) yang diambil dari variabel $allSiswa -->
                            <datalist id="siswaOptions">
                                @foreach ($dataSiswa as $s)
                                    <option value="{{ $s->id_siswa }}">{{ $s->Nama }}</option>
                                    <!-- Menampilkan nama siswa sebagai saran ketikan -->
                                @endforeach
                            </datalist>
                        </div>

                        <!-- Kolom Dropdown Pilih Bulan (Lebar 2/12) -->
                        <div class="col-md-2">
                            <label class="form-label small fw-bold text-muted"><i
                                    class="fa-solid fa-calendar-days me-1"></i> Bulan</label>
                            <select name="bulan" class="form-select rounded-3 border-slate-200">
                                <option value="">Semua Bulan</option>
                                <!-- Perulangan dari angka 1 sampai 12 untuk membuat daftar bulan -->
                                @for ($i = 1; $i <= 12; $i++)
                                    <!-- date('F') mengubah angka menjadi nama bulan dalam bahasa Inggris -->
                                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Kolom Dropdown Pilih Kategori (Lebar 3/12) -->
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted"><i class="fa-solid fa-tags me-1"></i>
                                Kategori</label>
                            <select name="kategori" class="form-select rounded-3 border-slate-200">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kolom Input Kalender/Tanggal Spesifik (Lebar 2/12) -->
                        <div class="col-md-2">
                            <label class="form-label small fw-bold text-muted"><i
                                    class="fa-solid fa-calendar-range me-1"></i> Tanggal</label>
                            <input type="date" name="tanggal" class="form-control rounded-3 border-slate-200">
                        </div>

                        <!-- Kolom Tombol Aksi (Lebar 2/12) -->
                        <div class="col-md-2 d-flex gap-2">
                            <!-- Tombol Submit untuk menjalankan filter -->
                            <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold shadow-sm">
                                <i class="fa-solid fa-filter"></i> Filter
                            </button>
                            <!-- Tombol Reset (Link) untuk kembali ke halaman Dashboard utama tanpa filter -->
                            <a href="{{ url('Admin/DashboardAdmin') }}"
                                class="btn btn-light border rounded-3 fw-bold" title="Reset">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        </div>
                    </form>

                </div>
            </div>
            {{-- AKHIR FILTER --}}
            <!-- MAIN TABLE -->
            <div class="table-container shadow-sm table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal Lapor</th>
                            <th>ID Tiket</th>
                            <th>Kategori & Masalah</th>
                            <th>Status Saat Ini</th>
                            <th class="text-center">Aksi Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- perualangan sama seperti foreach, tapi bisa juga untuk mengecek data kosong --}}
                        @forelse ($aspirasi as $data)
                            {{-- menginisialisasi variabel aspirasi menjadi $data, fungsi forelse sama seperti foreach yang membedakan forelse bisa menampilkan tampilan yang kita atur jika data kosong --}}
                            <tr id="aspirasi-231{{ $data->id_aspirasi }}">
                                <td><span class="fw-bold text-primary">{{ $data->tanggal_lapor }}</span></td>
                                {{-- tampilkan data tanggal lapor --}}
                                <td><span class="fw-bold text-primary">#SPR-231{{ $data->id_aspirasi }}</span>
                                </td>
                                {{-- tampilkan data id_aspirasi --}}
                                <td>
                                    <div class="fw-bold">{{ $data->judul_aspirasi }}</div>{{-- tampilkan judul aspirasi --}}
                                    <div class="text-muted small">{{ $data->lokasi }}</div>{{-- tampilkan lokasi --}}
                                </td>
                                <td>
                                    @switch($data->status)
                                        {{-- perkondisian dengan swicth yang mengecek isi status --}}
                                        @case('menunggu')
                                            {{-- jika status = menuggu maka tampilkan span dibawah --}}
                                            <span
                                                class="status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                                {{ ucfirst($data->status) }}{{-- ucfirst berfungsi untuk membuat data menjadi kapital di awal  --}}
                                            </span>
                                        @break

                                        @case('diproses')
                                            {{-- jika status = diproses maka tampilkan span dibawah --}}
                                            <span
                                                class="status-badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                                                {{ ucfirst($data->status) }}
                                            </span>
                                        @break

                                        @case('selesai')
                                            {{-- jika status = selesai maka tampilkan span dibawah --}}
                                            <span
                                                class="status-badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">

                                                {{ ucfirst($data->status) }}
                                            </span>
                                        @break

                                        @case('ditolak')
                                            {{-- jika status = ditolak maka tampilkan span dibawah --}}
                                            <span
                                                class="status-badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">

                                                {{ ucfirst($data->status) }}
                                            </span>
                                        @break

                                        @default
                                            {{-- Kalau status kosong / null tampilkan span dibawah --}}
                                            <span
                                                class="status-badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">

                                                Baru
                                            </span>
                                            @endswitch{{-- akhir switch --}}

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            {{-- ini adalah fungsi unutk mengisi data dari db dengan menggunakan jd dengan get element berdasarkan atribut id --}}
                                            <button class="action-btn" title="Kelola Aspirasi" data-bs-toggle="modal"
                                                data-bs-target="#actionModal"
                                                onclick="populateModal('#SPR-231{{ $data->id_aspirasi }}','{{ $data->id_aspirasi }}','{{ $data->Nama }}','{{ $data->judul_aspirasi }}','{{ $data->lokasi }}','{{ $data->status }}','{{ $data->ket_aspirasi }}','{{ $data->tanggal_update }}','{{ $data->tanggal_lapor }}', '{{ $data->ket_progres }}')">
                                                <i class="fa-solid fa-gear"></i>{{-- fungsi untuk mengambil data dari db dan memasukannya ke dalam elemen sesuai dengan id yang ada di parameter --}}
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- empty buat ngecek data apakah kosong, kalau kosong tampilin kodde dibawah --}}
                                    @empty
                                        {{-- kalau tidak ada laporan yang ini tampil --}}
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>
                                                    <h6 class="fw-bold text-muted">Laporan Tidak ada!</h6>
                                                    <p class="small text-muted">Siswa belum membuat laporan atau Pastikan nama
                                                        siswa benar.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse{{-- akhir forelse --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- MODAL KELOLA ASPIRASI -->
                    <div class="modal fade modal-custom" id="actionModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                                <div class="modal-header border-0 bg-primary bg-opacity-10 px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary text-white rounded-3 p-2 d-flex">
                                            <i class="fa-solid fa-clipboard-check"></i>
                                        </div>
                                        <div>
                                            {{-- <input type="text" id="ID" value="#ID"> --}}
                                            <h5 class="modal-title fw-bold mb-0" id="modalTicketID">Update Progres Aspirasi</h5>
                                            <small class="text-muted">Manajemen Laporan Infrastruktur</small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body p-0">
                                    <div class="row g-0">

                                        <!-- KIRI: DATA LAPORAN -->
                                        <div class="col-lg-6 border-end p-4 bg-white">
                                            <h6 class="fw-bold small text-uppercase text-muted mb-4">Informasi Laporan</h6>
                                            <div
                                                class="d-flex align-items-center gap-3 mb-4 p-3 border rounded-4 bg-light bg-opacity-50">
                                                <img id="modalAvatarImg" src="" class="rounded-circle" width="45">
                                                <div>
                                                    <h6 class="fw-bold mb-0" id="modalStudentName">Nama Siswa</h6>
                                                    <p class="text-muted small mb-0">Identitas Terverifikasi</p>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="text-muted small d-block mb-1">Masalah:</label>
                                                <h6 class="fw-bold" id="modalSubject">Subjek Laporan</h6>

                                                <label class="text-muted small d-block mb-1">Lokasi:</label>
                                                <h6 class="fw-bold" id="lokasi">Lokasi</h6>

                                                <label class="text-muted small d-block mb-1">Keterangan Progres:</label>
                                                <h6 class="fw-bold" id="ket">keterangan</h6>

                                                <label class="text-muted small d-block mt-3 mb-1">Deskripsi Awal:</label>
                                                <div class="p-3 rounded-4 bg-soft-warning border-start border-4 border-warning">
                                                    <p class="mb-0 small" id="modalDesc" style="line-height:1.6;">Deskripsi...
                                                    </p>
                                                </div>
                                            </div>

                                            <div>
                                                <label class="text-muted small d-block mb-3">Tanggal Lapor:</label>
                                                <div class="timeline-container ps-2">
                                                    <div class="timeline-item">
                                                        <div class="timeline-marker"></div>
                                                        <div class="small">
                                                            {{-- <p class="fw-bold mb-0">{{ $aspirasi->tanggal_lapor }}</p> --}}
                                                            <p class="fw-bold mb-0" id="modalTanggalLapor">-</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="text-muted small d-block mb-3">Tanggal Update:</label>
                                                <div class="timeline-container ps-2">
                                                    <div class="timeline-item">
                                                        <div class="timeline-marker"></div>
                                                        <div class="small">
                                                            <p class="fw-bold mb-0" id="tanggal_update">Tanggal update</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- KANAN: PANEL ADMIN -->
                                        <div class="col-lg-6 p-4 bg-light">
                                            <h6 class="fw-bold small text-uppercase text-muted mb-4">Panel Kontrol Admin</h6>
                                            <form action="{{ url('Admin/Aspirasi/Tambah') }}" method="post">
                                                {{-- untuk menambahkan data yang datanya di kirim ke url tambah --}}
                                                @csrf
                                                {{-- Mengambil id aspirasi dari fungsi js populateModal yang diamana id itu berisi ID yang di buat dari fungsi --}}
                                                <input name="id_aspirasi" id="ID" value="#ID"
                                                    hidden>{{-- mengisi value id_aspirasi --}}
                                                <div class="mb-4">
                                                    <label class="form-label fw-bold small">Status Sebelumnya:</label>
                                                    <div id="prevStatusBadge"></div>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label fw-bold small text-primary">Ubah Status
                                                        Laporan:</label>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <select name="status" id="statusSelect" class="form-select" required>
                                                            <option value="" @selected($data->status == '')>Menunggu Respon
                                                            </option>
                                                            <option value="menunggu" @selected($data->status == 'menunggu')>
                                                                Menunggu
                                                            </option>
                                                            <option value="diproses" @selected($data->status == 'diproses')>
                                                                Proses
                                                            </option>
                                                            <option value="selesai" @selected($data->status == 'selesai')>
                                                                Selesai
                                                            </option>
                                                            <option value="ditolak" @selected($data->status == 'ditolak')>
                                                                Ditolak
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <label class="form-label fw-bold small">Tanggal Update</label>
                                                    <input class="form-control border-0 shadow-sm rounded-4 p-3 small"
                                                        type="date" class="form-control" name="tanggal_update"
                                                        value="<?= date('Y-m-d') ?>" readonly>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label fw-bold small">Keterangan Progres (Internal)</label>
                                                    <textarea class="form-control border-0 shadow-sm rounded-4 p-3 small" rows="3"
                                                        placeholder="Tulis catatan perbaikan di sini..." name="ket_progres" required></textarea>
                                                </div>

                                                <div class="mb-4" id="feedbackContainer" style="display:none;">
                                                    <div
                                                        class="p-3 bg-success bg-opacity-10 rounded-4 border border-success border-opacity-25">
                                                        <label class="form-label fw-bold small text-success"><i
                                                                class="fa-solid fa-comment-dots me-1"></i> Pesan untuk
                                                            Siswa</label>
                                                        <textarea class="form-control border-0 shadow-sm rounded-3 small" rows="2"
                                                            placeholder="Sampaikan bahwa masalah telah tuntas..." name="umpan_balik"></textarea>
                                                        <div class="form-text text-success" style="font-size:0.7rem;">Umpan balik
                                                            ini akan tampil di dashboard siswa.</div>
                                                    </div>
                                                </div>

                                                <div class="pt-2">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-sm">
                                                        <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                <script src="{{ asset('Js/MyAlert.js') }}"></script>
                <script>
                    // Fungsi populateModal tetap sama
                    function populateModal(ticketID, ID, studentName, subject, lokasi, status, description, tanggal_update, tglLapor,
                        ket) {
                        document.getElementById('modalTicketID').innerText = ticketID;
                        document.getElementById('ID').value = ID;
                        document.getElementById('modalStudentName').innerText = studentName;
                        document.getElementById('modalSubject').innerText = subject;
                        document.getElementById('lokasi').innerText = lokasi;
                        document.getElementById('modalDesc').innerText = description;
                        document.getElementById('tanggal_update').innerText = tanggal_update;
                        document.getElementById('modalTanggalLapor').innerText = tglLapor;
                        document.getElementById('ket').innerText = ket;


                        // 2. LOGIKA UPDATE AVATAR (Tambahkan ini)
                        // Kita buat URL API avatar menggunakan studentName yang diklik
                        const avatarUrl =
                            `https://ui-avatars.com/api/?name=${encodeURIComponent(studentName)}&background=7c3aed&color=fff`;

                        // Pasang URL-nya ke tag img yang id-nya 'modalAvatarImg'
                        document.getElementById('modalAvatarImg').src = avatarUrl;

                        const selectStatus = document.getElementById('statusSelect');
                        if (selectStatus) {
                            selectStatus.value = status;
                        }

                        const feedbackContainer = document.getElementById('feedbackContainer');
                        feedbackContainer.style.display = (status === 'selesai') ? 'block' : 'none';

                        const badgeContainer = document.getElementById('prevStatusBadge');
                        badgeContainer.innerHTML = '';
                        let badgeClass = '';

                        switch (status.toLowerCase()) {
                            case 'menunggu':
                                badgeClass = 'bg-warning bg-opacity-10 text-warning border border-warning';
                                break;
                            case 'diproses':
                                badgeClass = 'bg-primary bg-opacity-10 text-primary border border-primary';
                                break;
                            case 'selesai':
                                badgeClass = 'bg-success bg-opacity-10 text-success border border-success';
                                break;
                            default:
                                badgeClass = 'bg-secondary bg-opacity-10 text-secondary border border-secondary';
                        }
                        badgeContainer.innerHTML = `<span class="status-badge ${badgeClass}">${status.toUpperCase()}</span>`;
                    }

                    // Event listener untuk select status
                    document.getElementById('statusSelect').addEventListener('change', function() {
                        const feedbackContainer = document.getElementById('feedbackContainer');
                        feedbackContainer.style.display = (this.value === 'selesai') ? 'block' : 'none';
                    });

                    // PERBAIKAN VALIDASI FORM: Menggunakan querySelector untuk mencari form berdasarkan atribut action
                    const formAspirasi = document.querySelector('form[action*="Admin/Aspirasi/Tambah"]');
                    if (formAspirasi) {
                        formAspirasi.addEventListener('submit', function(e) {
                            const selectedStatus = document.getElementById('statusSelect').value;
                            if (!selectedStatus) {
                                alert('Waduh Bang, pilih statusnya dulu dong!');
                                e.preventDefault();
                                return;
                            }
                        });
                    }
                </script>
                {{-- untuk alert --}}
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
