{{-- @dd(auth()->guard('admin')->user()->username) --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare Admin | Dashboard Manajemen Aspirasi</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- CDN Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        /* SIDEBAR */
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

        /* MAIN CONTENT */
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

        /* TABLES */
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

        .action-btn,
        .chat-admin-btn {
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

        .chat-admin-btn:hover {
            background: #25d366;
            color: white;
            transform: translateY(-2px);
        }

        /* CHAT STYLING INSIDE MODAL */
        .chat-bubble {
            max-width: 75%;
            padding: 10px 14px;
            border-radius: 16px;
            margin-bottom: 10px;
            font-size: 0.88rem;
            position: relative;
        }

        .chat-bubble.me {
            background: var(--admin-purple);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .chat-bubble.siswa-reply {
            background: #e2e8f0;
            color: #1e293b;
            border-bottom-left-radius: 4px;
        }

        /* RESPONSIVE */
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
                margin-left: calc(var(--sidebar-width) + 1.5rem);
                /* Ini yang bikin dia ketarik ke kiri dekat sidebar! */
            }


            #modalChatAdminMurni .modal-dialog {
                max-width: 500px;
                /* Batasi khusus modal chat agar tidak terlalu lebar */
            }
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table td,
        .table th {
            white-space: nowrap;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            display: none;
        }

        @media (max-width: 991.98px) {
            #menu-control:checked~.sidebar-wrapper {
                transform: translateX(0);
            }

            #menu-control:checked~.sidebar-overlay {
                display: block;
            }
        }

        tr:target {
            background-color: rgba(124, 58, 237, 0.1) !important;
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
            text-align: left;
        }
    </style>
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
                <a href="{{ url('Admin/DashboardAdmin') }}" class="nav-item-custom active">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
                <a href="{{ url('Admin/Riwayat') }}" class="nav-item-custom">
                    <i class="fa-solid fa-list-check"></i> Riwayat
                </a>
                <a href="{{ url('Admin/Daftar_Aspirasi') }}" class="nav-item-custom">
                    <i class="fa-solid fa-list-check"></i> Daftar Aspirasi
                </a>
                <a href="{{ url('Admin/DataSiswa') }}" class="nav-item-custom">
                    <i class="fa-solid fa-users"></i> Data Siswa
                </a>
                <a href="{{ url('Admin/Ulasan') }}" class="nav-item-custom">
                    <i class="fa-solid fa-star"></i> Ulasan
                </a>
            </nav>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-bar">
            <div class="d-flex align-items-center">
                <label for="menu-control" class="btn btn-light d-lg-none me-3">
                    <i class="fa-solid fa-bars-staggered"></i>
                </label>
                <h5 class="fw-bold mb-0">Manajemen Aspirasi</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- TOMBOL DAFTAR CHAT GLOBAL ADMIN (BARU) -->
                <button class="btn btn-light rounded-circle p-2 position-relative shadow-sm border"
                    data-bs-toggle="modal" data-bs-target="#modalDaftarChatGlobalAdmin"
                    title="Buka Daftar Obrolan Masuk">
                    <i class="fa-solid fa-comments text-dark fs-5"></i>
                    <!-- Badge jumlah total unread dari semua siswa -->
                    <span id="admin-badge-global"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none"
                        style="font-size: 0.65rem; padding: 4px 6px;">
                        0
                    </span>
                </button>

                <div class="dropdown">
                    <div class="profile-trigger d-flex align-items-center gap-3" data-bs-toggle="dropdown"
                        aria-expanded="false" style="cursor: pointer;">
                        <div class="text-end d-none d-md-block">
                            <p class="mb-0 fw-bold small">{{ auth()->guard('admin')->user()->username }}</p>
                            <p class="mb-0 text-muted small" style="font-size: 0.7rem;">Admin Utama</p>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ auth()->guard('admin')->user()->username }}&background=7c3aed&color=fff"
                            class="rounded-circle shadow-sm" width="40">
                    </div>
                    <!-- Dropdown menu logout tetep sama dibawahnya... -->
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
            </div>
        </header>

        <div class="p-4 p-lg-5">
            {{-- Statistik --}}
            <div class="row g-3 mb-4">

                {{-- Total Laporan --}}
                <div class="col-md-6 col-lg">
                    <div
                        class="p-4 bg-white rounded-4 border border-slate-200 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small fw-bold mb-1">TOTAL</p>
                            <h2 class="fw-800 mb-0 text-dark">{{ $totalData }}</h2>
                        </div>
                        <div class="p-3 bg-light text-dark rounded-3">
                            <i class="bi bi-file-earmark-text fs-3"></i>
                        </div>
                    </div>
                </div>

                {{-- Menunggu --}}
                <div class="col-md-6 col-lg">
                    <div
                        class="p-4 bg-warning-subtle rounded-4 border border-warning-subtle d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-warning-emphasis small fw-bold mb-1">MENUNGGU</p>
                            <h2 class="fw-800 mb-0 text-warning-emphasis">{{ $menunggu ?? 0 }}</h2>
                        </div>
                        <div class="p-3 bg-warning text-white rounded-3">
                            <i class="bi bi-clock-history fs-3"></i>
                        </div>
                    </div>
                </div>

                {{-- Diproses --}}
                <div class="col-md-6 col-lg">
                    <div
                        class="p-4 bg-primary-subtle rounded-4 border border-primary-subtle d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-primary small fw-bold mb-1">DIPROSES</p>
                            <h2 class="fw-800 mb-0 text-primary">{{ $proses ?? 0 }}</h2>
                        </div>
                        <div class="p-3 bg-primary text-white rounded-3">
                            <i class="bi bi-gear-wide-connected fs-3"></i>
                        </div>
                    </div>
                </div>

                {{-- Selesai --}}
                <div class="col-md-6 col-lg">
                    <div
                        class="p-4 bg-success-subtle rounded-4 border border-success-subtle d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-success small fw-bold mb-1">SELESAI</p>
                            <h2 class="fw-800 mb-0 text-success">{{ $selesai ?? 0 }}</h2>
                        </div>
                        <div class="p-3 bg-success text-white rounded-3">
                            <i class="bi bi-check-circle fs-3"></i>
                        </div>
                    </div>
                </div>

                {{-- Ditolak --}}
                <div class="col-md-6 col-lg">
                    <div
                        class="p-4 bg-danger-subtle rounded-4 border border-danger-subtle d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-danger small fw-bold mb-1">DITOLAK</p>
                            <h2 class="fw-800 mb-0 text-danger">{{ $ditolak ?? 0 }}</h2>
                        </div>
                        <div class="p-3 bg-danger text-white rounded-3">
                            <i class="bi bi-x-circle fs-3"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- NAVIGASI FILTER --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form action="{{ url('Admin/DashboardAdmin/Filter') }}" method="GET"
                    class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-muted"><i class="fa-solid fa-user me-1"></i>
                            Cari Siswa</label>
                        <input class="form-control rounded-3 border-slate-200" list="siswaOptions" id="siswaFilter"
                            name="siswa" placeholder="Ketik nama siswa...">
                        <datalist id="siswaOptions">
                            @foreach ($dataSiswa as $s)
                                <option value="{{ $s->id_siswa }}">{{ $s->Nama }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted"><i
                                class="fa-solid fa-calendar-days me-1"></i> Bulan</label>
                        <select name="bulan" class="form-select rounded-3 border-slate-200">
                            <option value="">Semua Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>

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

                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted"><i
                                class="fa-solid fa-calendar-range me-1"></i> Tanggal</label>
                        <input type="date" name="tanggal" class="form-control rounded-3 border-slate-200">
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold shadow-sm">
                            <i class="fa-solid fa-filter"></i> Filter
                        </button>
                        <a href="{{ url('Admin/DashboardAdmin') }}" class="btn btn-light border rounded-3 fw-bold"
                            title="Reset">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

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
                    @forelse ($aspirasi as $data)
                        @if ($data->status == 'menunggu' || $data->status == 'diproses' || $data->status == '')
                            <tr id="aspirasi-231{{ $data->id_aspirasi }}">
                                <td><span class="fw-bold text-primary">{{ $data->tanggal_lapor }}</span></td>
                                <td><span class="fw-bold text-primary">#SPR-231{{ $data->id_aspirasi }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $data->judul_aspirasi }}</div>
                                    <div class="text-muted small">{{ $data->lokasi }}</div>
                                </td>
                                <td>
                                    @switch($data->status)
                                        @case('menunggu')
                                            <span
                                                class="status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">{{ ucfirst($data->status) }}</span>
                                        @break

                                        @case('diproses')
                                            <span
                                                class="status-badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">{{ ucfirst($data->status) }}</span>
                                        @break

                                        @case('selesai')
                                            <span
                                                class="status-badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">{{ ucfirst($data->status) }}</span>
                                        @break

                                        @case('ditolak')
                                            <span
                                                class="status-badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">{{ ucfirst($data->status) }}</span>
                                        @break

                                        @default
                                            <span
                                                class="status-badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">Baru</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="action-btn" title="Kelola Aspirasi" data-bs-toggle="modal"
                                            data-bs-target="#actionModal"
                                            onclick="populateModal('#SPR-231{{ $data->id_aspirasi }}','{{ $data->id_aspirasi }}','{{ $data->Nama }}','{{ $data->judul_aspirasi }}','{{ $data->lokasi }}','{{ $data->status }}','{{ $data->ket_aspirasi }}','{{ $data->tanggal_update }}','{{ $data->tanggal_lapor }}', '{{ $data->ket_progres }}')">
                                            <i class="fa-solid fa-gear"></i>
                                        </button>

                                        <button class="chat-admin-btn position-relative" title="Hubungi Siswa"
                                            data-bs-toggle="modal" data-bs-target="#modalChatAdminMurni"
                                            onclick="bukaChatDariAdmin('{{ $data->Nama }}')">
                                            <i class="fa-solid fa-comment-dots"></i>
                                            <span id="badge-unread-{{ str_replace(' ', '-', $data->Nama) }}"
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none"
                                                style="font-size:0.6rem; padding: 3px 5px;">0</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @empty
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
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </main>

        <div class="modal fade modal-custom" id="actionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                    <div class="modal-header border-0 bg-primary bg-opacity-10 px-4 py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white rounded-3 p-2 d-flex"><i
                                    class="fa-solid fa-clipboard-check"></i></div>
                            <div>
                                <h5 class="modal-title fw-bold mb-0" id="modalTicketID">Update Progres Aspirasi</h5>
                                <small class="text-muted">Manajemen Laporan Infrastruktur</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="row g-0">
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
                                        <p class="mb-0 small" id="modalDesc" style="line-height:1.6;">Deskripsi...</p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small d-block mb-2">Tanggal Lapor:</label>
                                    <div class="timeline-container ps-2">
                                        <div class="timeline-item">
                                            <div class="timeline-marker"></div>
                                            <div class="small">
                                                <p class="fw-bold mb-0" id="modalTanggalLapor">-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-muted small d-block mb-2">Tanggal Update:</label>
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

                            <div class="col-lg-6 p-4 bg-light">
                                <h6 class="fw-bold small text-uppercase text-muted mb-4">Panel Kontrol Admin</h6>
                                <form action="{{ url('Admin/Aspirasi/Tambah') }}" method="post">
                                    @csrf
                                    <input name="id_aspirasi" id="ID" value="#ID" hidden>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold small">Status Sebelumnya:</label>
                                        <div id="prevStatusBadge"></div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold small text-primary">Ubah Status Laporan:</label>
                                        <select name="status" id="statusSelect" class="form-select" required>
                                            <option value="">Menunggu Respon</option>
                                            <option value="menunggu">Menunggu</option>
                                            <option value="diproses">Proses</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold small">Tanggal Update</label>
                                        <input class="form-control border-0 shadow-sm rounded-4 p-3 small" type="date"
                                            name="tanggal_update" value="<?= date('Y-m-d') ?>" readonly>
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
                                                    class="fa-solid fa-comment-dots me-1"></i> Pesan untuk Siswa</label>
                                            <textarea class="form-control border-0 shadow-sm rounded-3 small" rows="2"
                                                placeholder="Sampaikan bahwa masalah telah tuntas..." name="umpan_balik"></textarea>
                                            <div class="form-text text-success" style="font-size:0.7rem;">Umpan balik ini
                                                akan tampil di dashboard siswa.</div>
                                        </div>
                                    </div>
                                    <div class="pt-2">
                                        <button type="submit"
                                            class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-sm"><i
                                                class="fa-solid fa-save me-2"></i> Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalChatAdminMurni" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-header bg-dark text-white rounded-top-4 border-0 py-3">
                        <div class="d-flex align-items-center gap-2">
                            <img id="chat-siswa-avatar" src="" class="rounded-circle" width="35">
                            <h5 class="fw-bold mb-0" id="chat-siswa-title" style="font-size: 1.05rem;">Nama Siswa</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0 bg-light">
                        <div id="admin-chat-stream-box"
                            style="height: 380px; overflow-y: auto; padding: 15px; background: #f8fafc;"></div>

                        <div class="p-3 border-top bg-white rounded-bottom-4">
                            <div class="input-group">
                                <input type="text" id="admin-message-input"
                                    class="form-control border-0 bg-light rounded-pill px-3"
                                    placeholder="Ketik balasan admin ke siswa...">
                                <button class="btn btn-primary rounded-pill ms-2 px-3" onclick="kirimPesanDariAdmin()">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditProfile" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="fw-bold mb-0">Edit Profil Saya</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                                    class="form-control rounded-3 border-slate-200  bg-light"
                                    value="{{ auth()->guard('admin')->user()->username }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Password</label>
                                <input type="password" placeholder="Kosongkan jika tidak di ubah" name="password"
                                    class="form-control rounded-3 border-slate-200">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-2 rounded-3 fw-bold shadow-sm">Simpan
                                    Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL BARU: DAFTAR CHAT GLOBAL SISI ADMIN (ALA WA LIST) -->
        <div class="modal fade" id="modalDaftarChatGlobalAdmin" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"
                style="max-width: 450px; margin: auto; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%;">
                <div class="modal-content border-0 rounded-4 shadow-lg">

                    <div class="modal-header bg-dark text-white rounded-top-4 border-0 py-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-comments text-success"></i>
                            <h5 class="fw-bold mb-0" style="font-size: 1.05rem;">Kotak Masuk Pesan Siswa</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-0 bg-white">
                        <div class="text-muted small p-3 fw-bold border-bottom mb-1 bg-light">Riwayat Percakapan</div>
                        <div id="admin-container-daftar-chat-global" style="max-height: 420px; overflow-y: auto;">
                            <div class="text-center text-muted my-4 py-3 small">Belum ada obrolan masuk</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="customChatToastAdmin"
            style="position: fixed; top: 20px; right: 20px; z-index: 9999; width: 320px; background: #1e293b; color: white; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); display: none; padding: 16px; border-left: 5px solid #7c3aed; transition: all 0.3s ease;">
            <div style="display: flex; align-items: start; gap: 12px;">
                <div style="background: rgba(124, 58, 237, 0.2); padding: 8px; border-radius: 8px; color: #a78bfa;">
                    <i class="fa-solid fa-bell fs-5"></i>
                </div>
                <div style="flex-grow: 1;">
                    <strong id="custom-toast-title"
                        style="display: block; font-size: 0.9rem; color: #f3f4f6; margin-bottom: 2px;">Pesan Baru!</strong>
                    <span id="custom-toast-body"
                        style="font-size: 0.8rem; color: #cbd5e1; display: block; line-height: 1.4;">Ada obrolan masuk dari
                        siswa.</span>
                </div>
                <button onclick="document.getElementById('customChatToastAdmin').style.display = 'none'"
                    style="background: none; border: none; color: #94a3b8; cursor: pointer; font-size: 1rem; padding: 0; line-height: 1;">&times;</button>
            </div>
        </div>

        <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('Js/MyAlert.js') }}"></script>

        <script>
            // MENGAMBIL DATA DARI VARIABEL LARAVEL CONFIG .ENV AMAN
            const firebaseConfig = {
                apiKey: "{{ env('MIX_FIREBASE_API_KEY') }}",
                authDomain: "sarpascarechat.firebaseapp.com",
                databaseURL: "{{ env('MIX_FIREBASE_DATABASE_URL') }}",
                projectId: "sarpascarechat",
                storageBucket: "sarpascarechat.firebasestorage.app",
                messagingSenderId: "{{ env('MIX_FIREBASE_MESSAGING_SENDER_ID') }}",
                appId: "{{ env('MIX_FIREBASE_APP_ID') }}",
                measurementId: "G-03MNS2WXDL"
            };

            if (!firebase.apps.length) {
                firebase.initializeApp(firebaseConfig);
            }
            const database = firebase.database();
            const currentAdminUsername = "{{ auth()->guard('admin')->user()->username }}";
            const cleanAdminNode = currentAdminUsername.replace(/[.#$\[\]]/g, "-");

            let activeSiswaTarget = "";
            let activeAdminChatListener = null;
            let lastTotalUnreadAdmin = null; // Tracker status unread

            // ========================================================
            // ENGINE Realtime: DETEKSI NOTIFIKASI, LIST GLOBAL & TOAST POP-UP
            // ========================================================
            database.ref('chats').on('value', (snapshot) => {
                const containerGlobal = document.getElementById('admin-container-daftar-chat-global');
                const badgeGlobal = document.getElementById('admin-badge-global');

                // Sembunyikan semua badge unread row di tabel dulu
                document.querySelectorAll('[id^="badge-unread-"]').forEach(badge => badge.classList.add('d-none'));

                if (!snapshot.exists()) {
                    if (containerGlobal) containerGlobal.innerHTML =
                        `<div class="text-center text-muted my-4 py-3 small">Belum ada obrolan masuk</div>`;
                    if (badgeGlobal) badgeGlobal.classList.add('d-none');
                    lastTotalUnreadAdmin = 0;
                    return;
                }

                let htmlListGlobal = "";
                let totalUnreadGlobal = 0;
                let latestSenderName = "Siswa";
                let latestMessageContent = "Mengirim pesan baru";

                snapshot.forEach((siswaSnapshot) => {
                    const cleanStudentNode = siswaSnapshot.key;

                    if (siswaSnapshot.hasChild(cleanAdminNode)) {
                        let unreadCountRow = 0;
                        let lastMessageText = "Belum ada pesan";
                        let lastTimestamp = 0;
                        let lastMessageTime = "";

                        siswaSnapshot.child(cleanAdminNode).forEach((msgSnapshot) => {
                            const msgData = msgSnapshot.val();
                            if (!msgData) return;

                            if (msgData.message && !msgData.message.includes(
                                    '📢 *Menanyakan Progres Tiket')) {
                                lastMessageText = msgData.message;
                            } else if (msgData.message && msgData.message.includes(
                                    '📢 *Menanyakan Progres Tiket') && lastMessageText ===
                                "Belum ada pesan") {
                                lastMessageText = "🎯 Menanyakan Progres Laporan";
                            }

                            lastTimestamp = msgData.timestamp;

                            if (msgData.role === 'siswa' && msgData.is_read !== true) {
                                unreadCountRow++;
                                totalUnreadGlobal++;
                                // Cari pengirim pesan terakhir secara aman
                                latestSenderName = msgData.sender || "Siswa";
                                latestMessageContent = msgData.message || "Mengirim pesan";
                            }
                        });

                        if (unreadCountRow > 0) {
                            const badgeRow = document.getElementById(`badge-unread-${cleanStudentNode}`);
                            if (badgeRow) {
                                badgeRow.innerText = unreadCountRow;
                                badgeRow.classList.remove('d-none');
                            }
                        }

                        if (lastTimestamp) {
                            const date = new Date(lastTimestamp);
                            lastMessageTime = date.toLocaleDateString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                        }

                        let badgeUnreadListHtml = unreadCountRow > 0 ?
                            `<span class="badge rounded-pill bg-danger ms-auto" style="font-size: 0.7rem; padding: 4px 6px;">${unreadCountRow}</span>` :
                            '';

                        const namaSiswaAsli = cleanStudentNode.replace(/-/g, " ");

                        htmlListGlobal += `
                    <div class="d-flex align-items-center p-3 border-bottom list-group-item-action" style="cursor: pointer; transition: 0.2s;" 
                         data-bs-dismiss="modal" onclick="setTimeout(() => { var myModal = new bootstrap.Modal(document.getElementById('modalChatAdminMurni')); bukaChatDariAdmin('${namaSiswaAsli}'); myModal.show(); }, 300)">
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(namaSiswaAsli)}&background=7c3aed&color=fff" class="rounded-circle me-3" width="40">
                        <div class="flex-grow-1" style="max-width: 72%;">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="small text-dark d-block text-truncate">${namaSiswaAsli}</strong>
                                <span class="text-muted" style="font-size: 0.65rem;">${lastMessageTime}</span>
                            </div>
                            <div class="text-muted small text-truncate" style="margin-top: 2px; font-size: 0.8rem;">
                                ${lastMessageText}
                            </div>
                        </div>
                        ${badgeUnreadListHtml}
                    </div>
                `;
                    }
                });

                if (containerGlobal) {
                    containerGlobal.innerHTML = htmlListGlobal !== "" ? htmlListGlobal :
                        `<div class="text-center text-muted my-4 py-3 small">Belum ada obrolan masuk</div>`;
                }

                if (badgeGlobal) {
                    if (totalUnreadGlobal > 0) {
                        badgeGlobal.innerText = totalUnreadGlobal;
                        badgeGlobal.classList.remove('d-none');
                    } else {
                        badgeGlobal.classList.add('d-none');
                    }
                }

                // ==========================================
                // FIX TRIGGER POP-UP TOAST CUSTOM ANTI-CRASH
                // ==========================================
                const customToast = document.getElementById('customChatToastAdmin');

                if (customToast && totalUnreadGlobal > 0) {
                    let pemicuToast = false;

                    // KONDISI 1: Baru refresh/login & ada pesan unread
                    if (lastTotalUnreadAdmin === null) {
                        document.getElementById('custom-toast-title').innerText = "Kotak Masuk Belum Dibaca";
                        document.getElementById('custom-toast-body').innerText =
                            `Ada ${totalUnreadGlobal} pesan tertunggak menunggu respon Anda.`;
                        pemicuToast = true;
                    }
                    // KONDISI 2: Ada chat baru masuk
                    else if (totalUnreadGlobal > lastTotalUnreadAdmin) {
                        document.getElementById('custom-toast-title').innerText = `Pesan Baru dari ${latestSenderName}`;
                        document.getElementById('custom-toast-body').innerText = (latestMessageContent &&
                                latestMessageContent.includes('📢 *Menanyakan Progres Tiket')) ?
                            "🎯 Menanyakan Progres Laporan" : latestMessageContent;
                        pemicuToast = true;
                    }

                    if (pemicuToast) {
                        customToast.style.display = 'block';
                        try {
                            playNotificationSound();
                        } catch (e) {}

                        // Sembunyikan setelah 5 detik
                        setTimeout(() => {
                            customToast.style.display = 'none';
                        }, 5000);
                    }
                }

                lastTotalUnreadAdmin = totalUnreadGlobal;
            });

            // ========================================================
            // LOGIKA ROOM CHAT UTAMA SISI ADMIN
            // ========================================================
            function bukaChatDariAdmin(namaSiswaAsli) {
                activeSiswaTarget = namaSiswaAsli;
                const cleanStudentNode = namaSiswaAsli.replace(/[.#$\[\]]/g, "-");

                document.getElementById('chat-siswa-title').innerText = namaSiswaAsli;
                document.getElementById('chat-siswa-avatar').src =
                    `https://ui-avatars.com/api/?name=${encodeURIComponent(namaSiswaAsli)}&background=7c3aed&color=fff`;

                const chatBoxRef = database.ref(`chats/${cleanStudentNode}/${cleanAdminNode}`);
                const streamBox = document.getElementById('admin-chat-stream-box');
                streamBox.innerHTML = "";

                if (activeAdminChatListener) {
                    chatBoxRef.off('child_added', activeAdminChatListener);
                }

                chatBoxRef.once('value', (snapshot) => {
                    if (snapshot.exists()) {
                        snapshot.forEach((child) => {
                            if (child.val().role === 'siswa') {
                                chatBoxRef.child(child.key).update({
                                    is_read: true
                                });
                            }
                        });
                    }
                });

                activeAdminChatListener = chatBoxRef.on('child_added', (snapshot) => {
                    const payload = snapshot.val();
                    if (!payload) return;

                    if (payload.message && payload.message.includes('📢 *Menanyakan Progres Tiket')) return;

                    let formatWaktu = "";
                    if (payload.timestamp) {
                        const date = new Date(payload.timestamp);
                        formatWaktu = date.toLocaleDateString('id-ID', {
                            weekday: 'short',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }

                    let flexPosition = 'flex-start';
                    let bubbleBg = '#f1f5f9';
                    let textColor = '#334155';
                    let timeColor = 'text-muted';
                    let textAlign = 'left';

                    if (payload.role === 'admin') {
                        flexPosition = 'flex-end';
                        bubbleBg = '#7c3aed';
                        textColor = '#ffffff';
                        timeColor = 'text-white-50';
                        textAlign = 'right';
                    }

                    streamBox.innerHTML += `
            <div style="display: flex; width: 100%; justify-content: ${flexPosition}; margin-bottom: 12px; padding: 0 10px;">
                <div style="max-width: 75%; background-color: ${bubbleBg}; color: ${textColor}; padding: 10px 14px; border-radius: 16px; text-align: ${textAlign}; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <strong style="font-size: 0.85rem; display: block; margin-bottom: 2px;">${payload.sender}</strong>
                    <span style="font-size: 0.9rem; display: inline-block; word-break: break-word; text-align: left;">${payload.message}</span>
                    <div class="${timeColor}" style="font-size: 0.65rem; margin-top: 5px; text-align: ${textAlign};">${formatWaktu}</div>
                </div>
            </div>`;

                    streamBox.scrollTop = streamBox.scrollHeight;
                });
            }

            function kirimPesanDariAdmin() {
                const field = document.getElementById('admin-message-input');
                const teks = field.value.trim();

                if (teks !== "" && activeSiswaTarget !== "") {
                    const cleanStudentNode = activeSiswaTarget.replace(/[.#$\[\]]/g, "-");

                    database.ref(`chats/${cleanStudentNode}/${cleanAdminNode}`).push({
                        sender: currentAdminUsername,
                        role: 'admin',
                        message: teks,
                        timestamp: Date.now(),
                        is_read: false
                    });
                    field.value = "";
                }
            }

            document.getElementById('admin-message-input').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') kirimPesanDariAdmin();
            });

            function playNotificationSound() {
                const context = new(window.AudioContext || window.webkitAudioContext)();
                const osc = context.createOscillator();
                const gain = context.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(587.33, context.currentTime);
                osc.connect(gain);
                gain.connect(context.destination);
                osc.start();
                gain.gain.setValueAtTime(0.3, context.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, context.currentTime + 0.2);
                osc.stop(context.currentTime + 0.2);
            }

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

                const avatarUrl =
                    `https://ui-avatars.com/api/?name=${encodeURIComponent(studentName)}&background=7c3aed&color=fff`;
                document.getElementById('modalAvatarImg').src = avatarUrl;

                const selectStatus = document.getElementById('statusSelect');
                if (selectStatus) selectStatus.value = status;

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

            document.getElementById('statusSelect').addEventListener('change', function() {
                document.getElementById('feedbackContainer').style.display = (this.value === 'selesai') ? 'block' :
                    'none';
            });
        </script>
        {{-- ALERT TOAST NOTIFICATION --}}
        <script>
            @if (session('success'))
                MyAlert.show({
                    type: 'success',
                    title: 'Berhasil!',
                    message: "{{ session('success') }}",
                    autoClose: 3000,
                    confirmText: 'Sip!'
                });
            @endif

            @if (session('error'))
                MyAlert.show({
                    type: 'error',
                    title: 'error!',
                    message: '{{ session('error') }}',
                    autoClose: 3000,
                    confirmText: 'Sip!'
                });
            @endif
        </script>
    </body>

    </html>
