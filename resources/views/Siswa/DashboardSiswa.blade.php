<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare | Portal Siswa (Pure CSS)</title>

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
            --student-blue: #4361ee;
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

        /* --- Checkbox Hack for Sidebar --- */
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

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 15px;
        }

        .sidebar-header {
            padding: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
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
            background: var(--student-blue);
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* --- Main Content --- */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding-bottom: 50px;
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

        .welcome-banner {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 24px;
            padding: 40px;
            color: white;
            margin-bottom: 40px;
        }

        /* --- Simplified Report Card --- */
        .report-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--slate-200);
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .report-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 5px;
        }

        .report-info {
            font-size: 0.85rem;
            color: var(--slate-500);
            margin-bottom: 15px;
        }

        .status-badge {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 15px;
        }

        .badge-pending {
            background: #fffbeb;
            color: #92400e;
        }

        .badge-danger {
            background: #fad6d6;
            color: #9e0e0e;
        }

        .badge-success {
            background: #cfeed8;
            color: #166534;
        }

        .badge-rejected {
            background: #fef2f2;
            color: #991b1b;
        }

        .badge-diproses {
            background: #e0f2fe;
            color: #0369a1;
        }

        /* Diproses */
        .status-badge.baru {
            background: #e0f2fe;
            color: #0dcaf0;
            /* biru muda / info */
        }

        .btn-detail {
            background: var(--slate-100);
            color: var(--primary-dark);
            text-decoration: none;
            text-align: center;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            display: block;
        }

        /* --- Responsive Behavior (Pure CSS) --- */
        @media (max-width: 991.98px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
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

            /* Logika Checkbox saat dicentang */
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

        /* Label as Button Hamburger */
        .hamburger-label {
            cursor: pointer;
            padding: 8px 12px;
            background: var(--slate-100);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .report-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('Css/MyAlert.css') }}">
</head>

<body>

    <!-- Checkbox sebagai pengganti state JS -->
    <input type="checkbox" id="menu-control">

    <!-- Overlay (diklik untuk menutup menu) -->
    <label for="menu-control" class="sidebar-overlay"></label>

    <!-- Sidebar -->
    <aside class="sidebar-wrapper">
        <div class="sidebar-header">
            {{-- ini untuk judul --}}
            <h2 class="brand-title">Sarpras<span style="color:var(--accent-gold)">Care</span></h2>
            <p class="mb-0 text-muted small" style="letter-spacing: 1px; font-size: 0.65rem;">PORTAL SISWA</p>
        </div>

        <div class="sidebar-content">
            <nav class="sidebar-menu">
                {{-- ini adalah tombol untuk berpindah ke halaman dashboard siswa --}}
                <a href="{{ url('/Siswa/DashboardSiswa') }}" class="nav-item-custom active">
                    <i class="fa-solid fa-shapes"></i> Beranda
                </a>
                {{-- ini adalah tombol untuk berpindah ke halaman FormAspirasi --}}
                <a href="{{ url('/Siswa/KirimAspirasi') }}" class="nav-item-custom">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
                </a>
                {{-- ini adalah tombol untuk berpindah ke halaman RiwayatAspirasiSiswa --}}
                <a href="/Siswa/RiwayatAspirasiSiswa" class="nav-item-custom">
                    <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Saya
                </a>
            </nav>
        </div>

        <div class="sidebar-footer">
            <!-- Tombol Logout -->
            <form action="{{ url('Siswa/LogoutSiswa') }}" method="post">
                @csrf
                <button onclick="confirmHapus(this); return false;"
                    class="btn btn-danger bg-opacity-25 border-0 w-100 py-3 rounded-4 fw-bold text-decoration-none d-block text-center"
                    style="color: #fca5a5;">
                    <i class="fa-solid fa-power-off me-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <header class="top-bar">
            <div class="d-flex align-items-center">
                <!-- Label ini terhubung ke checkbox #menu-control -->
                <label for="menu-control" class="hamburger-label d-lg-none me-3">
                    <i class="fa-solid fa-bars-staggered"></i>
                </label>
                <span class="text-muted small fw-bold d-none d-md-block">SMK SANGKURIANG 1 CIMAHI</span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    {{-- ini untuk mengambil nama dari db sesuai session atau sesuai dengan sesi login --}}
                    <p class="mb-0 fw-bold small">{{ auth('siswa')->user()->Nama }}</p>
                    {{-- ini untuk mengambil kelas dari db sesuai session atau sesuai dengan sesi login --}}
                    <p class="mb-0 text-muted small">{{ auth('siswa')->user()->kelas }}</p>
                </div>
                {{-- untuk menggenerated gambar profile sesuai dengan nama yang di amabil dari sesi login --}}
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalEditProfile">
                    <img src="https://ui-avatars.com/api/?name={{ auth('siswa')->user()->Nama }}&background=4361ee&color=fff"
                        class="rounded-circle border border-2 border-white" width="40">
                </a>
            </div>
        </header>

        <div class="content-body p-4 p-lg-5">

            <!-- Banner -->
            <div class="welcome-banner text-center text-md-start">
                {{-- ini untuk mengambil nama dari db sesuai session atau sesuai dengan sesi login --}}
                <h1 class="fw-800 mb-2">Halo, {{ auth('siswa')->user()->Nama }}! 👋</h1>
                <p class="opacity-75 mb-4 small">Laporkan kerusakan fasilitas sekolahmu di sini.</p>
                <a href="{{ url('/Siswa/KirimAspirasi') }}"
                    class="btn btn-primary bg-white text-dark border-0 fw-bold rounded-pill px-4 py-2 text-decoration-none d-inline-block">
                    <i class="fa-solid fa-plus me-2"></i> Buat Laporan
                </a>
            </div>

            <!-- Reports Grid -->
            <h5 class="fw-800 mb-4">Semua laporan</h5>

            <div class="row g-3 align-items-stretch">
                {{-- perulangan untuk menampilkan banyak data yang data aspirasinya di ambil dari aspirasicontrollers --}}
                @foreach ($aspirasi as $data)
                    <div class="col-md-6 col-xl-4 d-flex">
                        <div class="report-card shadow-sm w-100">
                            <div>
                                @switch($data->status)
                                    {{-- menentukan style status dengan switch --}}
                                    @case('menunggu')
                                        {{-- jika menunggu tampilkan ini --}}
                                        <div class="status-badge badge-pending">
                                            {{ ucfirst($data->status) }}
                                        </div>
                                    @break

                                    @case('diproses')
                                        {{-- sama --}}
                                        <div class="status-badge  badge-diproses">
                                            {{ ucfirst($data->status) }}
                                        </div>
                                    @break

                                    @case('selesai')
                                        {{-- sama --}}
                                        <div class="status-badge badge-success">
                                            {{ ucfirst($data->status) }}
                                        </div>
                                    @break

                                    @case('ditolak')
                                        {{-- sama  --}}
                                        <div class="status-badge badge-danger">
                                            {{ ucfirst($data->status) }}
                                        </div>
                                    @break

                                    @default
                                        {{-- Kalau status kosong / null --}}
                                        <div class="status-badge badge-info">
                                            Baru
                                        </div>
                                @endswitch

                                <h6 class="report-title">
                                    {{ $data->judul_aspirasi }}{{-- tampilkan judul --}}
                                </h6>

                                <div class="report-info">
                                    <div>
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ $data->lokasi }}{{-- tampilkan lokasi --}}
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-calendar"></i>
                                        {{ $data->tanggal_lapor }}{{-- tampilkan tanggal lapor --}}
                                    </div>
                                </div>
                            </div>
                            {{-- lihat detail aspirasi sesuai dengan  id_aspirasinya --}}
                            <a href="/Siswa/Aspirasi/{{ $data->id_aspirasi }}" class="btn-detail mt-3">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>

    </main>

    <div class="modal fade" id="modalEditProfile" tabindex="-1" aria-labelledby="modalEditProfileLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold mb-0" id="modalEditProfileLabel">Edit Profil Saya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ url('Siswa/UpdateProfile') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body p-4">
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="https://ui-avatars.com/api/?name={{ auth('siswa')->user()->Nama }}&background=7c3aed&color=fff"
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
                            <label class="form-label small fw-bold text-muted">Nis</label>
                            <input name="" type="number"
                                class="form-control rounded-3 border-slate-200 bg-light"
                                value="{{ auth('siswa')->user()->nis }}" readonly>{{-- masukan username dari sesi login --}}
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Username</label>
                            <input name="Nama" type="text"
                                class="form-control rounded-3 border-slate-200 bg-light"
                                value="{{ auth('siswa')->user()->Nama }}" required>{{-- masukan username dari sesi login --}}
                            @error('Nama')
                                <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kelas</label>
                            <input name="username" type="text"
                                class="form-control rounded-3 border-slate-200 bg-light"
                                value="{{ auth('siswa')->user()->kelas }}" readonly>{{-- masukan username dari sesi login --}}
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password</label>
                            <input type="password" placeholder="Kosongkan jika tidak di ubah" name="password"
                                class="form-control rounded-3 border-slate-200" minlength="6">
                            @error('password')
                                <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-grid">
                            <button class="btn btn-primary py-2 rounded-3 fw-bold shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('Js/MyAlert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
        function confirmHapus(btn) {
            MyAlert.show({
                type: 'warning',
                title: 'Anda akan keluar?',
                message: 'Kamu akan keluar dari akun ini, Keluar?',
                showCancel: true,
                confirmText: 'Ya, Keluar!',
                cancelText: 'Batal',
                autoClose: false, // <--- INI KUNCINYA BANG! Biar gak nutup sendiri
                closeOnOverlay: false, // Biar gak sengaja ke-close pas klik luar box
                onConfirm: function() {
                    // Baru beneran hapus kalau diklik "Ya"
                    btn.closest('form').submit();
                }
            });
        }
    </script>
</body>

</html>
