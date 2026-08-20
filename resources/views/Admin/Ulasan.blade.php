<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SarprasCare Admin | Data Ulasan Siswa</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Eksternal ditaruh sebelum style internal agar tidak menimpa layout -->
    <link rel="stylesheet" href="{{ asset('Css/MyAlert.css') }}">

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

        /* --- FIX TOTAL KUNCI SCROLLING --- */
        html,
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
            /* Kunci body agar tidak bentrok */
        }

        #menu-control {
            display: none;
        }

        /* --- SIDEBAR NAVIGASI --- */
        .sidebar-wrapper {
            width: var(--sidebar-width);
            height: 100vh;
            height: 100dvh;
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
            padding: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.4rem;
            margin-bottom: 0;
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
        }

        .nav-item-custom {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.88rem;
            border-radius: 12px;
            margin-bottom: 6px;
        }

        .nav-item-custom i {
            width: 20px;
            margin-right: 10px;
        }

        .nav-item-custom:hover,
        .nav-item-custom.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }

        .nav-item-custom.active {
            background: var(--admin-purple);
        }

        /* --- MAIN CONTENT INTERNAL SCROLL (KUNCI PERBAIKAN) --- */
        .main-content {
            margin-left: var(--sidebar-width);
            height: 100vh !important;
            height: 100dvh !important;
            overflow-y: auto !important;
            /* Paksa scrollbar berjalan DI DALAM main-content */
            -webkit-overflow-scrolling: touch;
            background-color: var(--slate-50);
        }

        .top-bar {
            height: 70px;
            background: var(--white);
            border-bottom: 1px solid var(--slate-200);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* --- CARD STATISTIK --- */
        .card-stat {
            background: #ffffff;
            border: 1px solid var(--slate-200);
            border-radius: 16px;
            padding: 16px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .rating-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-dark);
            line-height: 1;
        }

        .badge-rating {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 50px;
            display: inline-block;
        }

        .badge-star-5 {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .badge-star-4 {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-star-3 {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .badge-star-2 {
            background: #fff7ed;
            color: #9a3412;
            border: 1px solid #ffedd5;
        }

        .badge-star-1 {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* --- TABEL DESKTOP --- */
        .table-desktop {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--slate-200);
            overflow: hidden;
        }

        .table-desktop th {
            background: #f8fafc;
            color: var(--slate-500);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            padding: 16px 20px;
            border-bottom: 1px solid var(--slate-200);
        }

        .table-desktop td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid var(--slate-100);
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            display: none;
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

        /* --- MEDIA QUERIES MOBILE --- */
        @media (max-width: 991.98px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }

            #menu-control:checked~.sidebar-wrapper {
                transform: translateX(0);
            }

            #menu-control:checked~.sidebar-overlay {
                display: block;
            }

            .top-bar {
                padding: 0 16px;
            }

            .rating-number {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

    <input type="checkbox" id="menu-control" style="display: none;">
    <label for="menu-control" class="sidebar-overlay"></label>

    <!-- SIDEBAR NAVIGASI -->
    <aside class="sidebar-wrapper">
        <div class="sidebar-header">
            <h2 class="brand-title">Sarpras<span style="color:var(--accent-gold)">Care</span></h2>
            <p class="mb-0 text-muted small">PANEL ADMIN</p>
        </div>
        <div class="sidebar-content">
            <nav class="sidebar-menu">
                <a href="{{ url('Admin/DashboardAdmin') }}" class="nav-item-custom">
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
                <a href="{{ url('Admin/Ulasan') }}" class="nav-item-custom active">
                    <i class="fa-solid fa-star"></i> Ulasan
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="main-content">
        <header class="top-bar">
            <div class="d-flex align-items-center">
                <label for="menu-control" class="btn btn-light d-lg-none me-3">
                    <i class="fa-solid fa-bars-staggered"></i>
                </label>
                <h5 class="fw-bold mb-0 fs-6 fs-md-5">Ulasan & Kepuasan Siswa</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <div class="profile-trigger d-flex align-items-center gap-2" data-bs-toggle="dropdown"
                        aria-expanded="false" style="cursor: pointer;">
                        <div class="text-end d-none d-md-block">
                            <p class="mb-0 fw-bold small">{{ auth()->guard('admin')->user()->username }}</p>
                            <p class="mb-0 text-muted small" style="font-size: 0.7rem;">Admin Utama</p>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ auth()->guard('admin')->user()->username }}&background=7c3aed&color=fff"
                            class="rounded-circle shadow-sm" width="36">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2"
                        style="min-width: 180px;">
                        <li>
                            <h6 class="dropdown-header small text-muted text-uppercase fw-bold">Pengaturan</h6>
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

        <div class="p-3 p-md-4 p-lg-5">
            <div class="mb-4">
                <h4 class="fw-800 mb-1 fs-5 fs-md-4"><i class="fa-solid fa-star text-warning me-2"></i>Ulasan & Kepuasan
                    Siswa</h4>
                <p class="text-muted small mb-0">Daftar umpan balik dan rating penanganan sarana prasarana sekolah dari
                    siswa.</p>
            </div>

            <!-- STATISTIK RATING CARD -->
            <div class="row g-2 g-md-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card-stat text-center">
                        <span class="text-muted small fw-bold d-block mb-2">RATA-RATA RATING</span>
                        <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                            <span class="rating-number">{{ $Rata_rata }}</span>
                            <div class="text-center text-sm-start">
                                <div class="text-warning small d-flex gap-1 justify-content-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($Rata_rata))
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star text-muted opacity-50"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-muted small d-block mt-1" style="font-size: 0.68rem;">dari 5.0
                                    bintang</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card-stat text-center">
                        <span class="text-muted small fw-bold d-block mb-1">TOTAL ULASAN</span>
                        <span class="rating-number text-primary">{{ $totalUlasan }}</span>
                        <span class="text-muted small d-block mt-1" style="font-size: 0.68rem;">Laporan telah
                            diulas</span>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card-stat text-center">
                        <span class="text-muted small fw-bold d-block mb-1">ULASAN POSITIF</span>
                        <span class="rating-number text-success">{{ $ulasanPositif }}</span>
                        <span class="text-muted small d-block mt-1" style="font-size: 0.68rem;">Sangat Puas /
                            Puas</span>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card-stat text-center">
                        <span class="text-muted small fw-bold d-block mb-1">PERLU EVALUASI</span>
                        <span class="rating-number text-danger">{{ $perluEvaluasi }}</span>
                        <span class="text-muted small d-block mt-1" style="font-size: 0.68rem;">Kecewa / Kurang
                            Puas</span>
                    </div>
                </div>
            </div>

            <!-- TABEL (TAMPIL HANYA DI DESKTOP) -->
            <div class="d-none d-md-block">
                <div class="table-desktop shadow-sm">
                    <table class="table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Aspirasi / Fasilitas</th>
                                <th>Rating</th>
                                <th>Catatan / Masukan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ulasan as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->Nama ?? ($item->nama ?? 'Siswa')) }}&background=4361ee&color=fff"
                                                class="rounded-circle" width="38" height="38" alt="Avatar">
                                            <div>
                                                <h6 class="fw-bold mb-0 text-dark small" style="font-size: 0.85rem;">
                                                    {{ $item->Nama ?? ($item->nama ?? 'Siswa') }}
                                                </h6>
                                                <span class="text-muted small" style="font-size: 0.7rem;">Kelas:
                                                    {{ $item->kelas ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-bold mb-1 text-dark small" style="font-size: 0.85rem;">
                                            {{ $item->judul_aspirasi }}
                                        </h6>
                                        <div class="d-flex gap-1">
                                            <span class="badge bg-light text-secondary border"
                                                style="font-size: 0.65rem;">
                                                <a class="text-decoration-none text-secondary"
                                                    href="{{ url('Admin/Daftar_Aspirasi') }}#aspirasi-231{{ $item->id_aspirasi }}">#SPR-231{{ $item->id_aspirasi }}</a>
                                            </span>
                                            <span class="badge bg-primary bg-opacity-10 text-primary"
                                                style="font-size: 0.65rem;">{{ $item->ket_kategori }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-rating badge-star-{{ $item->rating }}">
                                            <i class="fa-solid fa-star text-warning me-1"></i>{{ $item->rating }}/5
                                        </span>
                                    </td>
                                    <td style="max-width: 250px;">
                                        <p class="mb-0 text-dark small fst-italic text-truncate"
                                            style="font-size: 0.8rem;" title="{{ $item->deskripsi }}">
                                            "{{ $item->deskripsi && $item->deskripsi != '-' ? $item->deskripsi : 'Tidak ada catatan.' }}"
                                        </p>
                                    </td>
                                    <td>
                                        <span class="text-muted small d-block" style="font-size: 0.75rem;">
                                            <i class="fa-regular fa-calendar me-1"></i>
                                            {{ date('d M Y', strtotime($item->tanggal)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 bg-white">
                                        <i class="fa-solid fa-star-half-stroke text-muted fs-1 mb-2"></i>
                                        <p class="text-muted fw-bold mb-0">Belum ada ulasan yang dikirimkan oleh siswa.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- LIST CARD (KHUSUS TAMPIL DI MOBILE / HP) -->
            <div class="d-block d-md-none">
                <div class="d-flex flex-column gap-3">
                    @forelse ($ulasan as $item)
                        <div class="bg-white p-3 rounded-4 border shadow-sm">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->Nama ?? ($item->nama ?? 'Siswa')) }}&background=4361ee&color=fff"
                                        class="rounded-circle" width="34" height="34" alt="Avatar">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark small" style="font-size: 0.85rem;">
                                            {{ $item->Nama ?? ($item->nama ?? 'Siswa') }}</h6>
                                        <span class="text-muted small" style="font-size: 0.68rem;">Kelas:
                                            {{ $item->kelas ?? '-' }}</span>
                                    </div>
                                </div>
                                <span class="badge-rating badge-star-{{ $item->rating }}">
                                    <i class="fa-solid fa-star text-warning me-1"></i>{{ $item->rating }}/5
                                </span>
                            </div>

                            <div class="border-top border-bottom py-2 my-2">
                                <h6 class="fw-bold text-dark mb-1 small">{{ $item->judul_aspirasi }}</h6>
                                <p class="mb-0 text-muted small fst-italic" style="font-size: 0.78rem;">
                                    "{{ $item->deskripsi && $item->deskripsi != '-' ? $item->deskripsi : 'Tidak ada catatan.' }}"
                                </p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-1">
                                    <span class="badge bg-light text-secondary border"
                                        style="font-size: 0.62rem;">#SPR-231{{ $item->id_aspirasi }}</span>
                                    <span class="badge bg-primary bg-opacity-10 text-primary"
                                        style="font-size: 0.62rem;">{{ $item->ket_kategori }}</span>
                                </div>
                                <span class="text-muted small" style="font-size: 0.68rem;">
                                    <i
                                        class="fa-regular fa-calendar me-1"></i>{{ date('d M Y', strtotime($item->tanggal)) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded-4 text-center border">
                            <i class="fa-solid fa-star-half-stroke text-muted fs-2 mb-2"></i>
                            <p class="text-muted fw-bold mb-0 small">Belum ada ulasan yang dikirimkan oleh siswa.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Js/MyAlert.js') }}"></script>
</body>

</html>
