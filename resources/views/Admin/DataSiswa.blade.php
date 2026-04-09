<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare Admin | Data Siswa</title>

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

        /* --- Profile Dropdown & Modal --- */
        .profile-trigger {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 12px;
            transition: 0.2s;
        }

        .profile-trigger:hover {
            background: var(--slate-100);
        }

        /* --- Table Custom --- */
        .data-card {
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
            letter-spacing: 0.5px;
            color: var(--slate-500);
            border-bottom: 1px solid var(--slate-200);
        }

        .table tbody td {
            padding: 18px 24px;
            vertical-align: middle;
            border-bottom: 1px solid var(--slate-100);
        }

        .student-avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            object-fit: cover;
        }

        .badge-active {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 8px;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--slate-200);
            background: white;
            color: var(--slate-500);
            transition: 0.2s;
            cursor: pointer;
        }

        .action-btn:hover {
            background: var(--admin-purple);
            color: white;
            border-color: var(--admin-purple);
        }

        .search-input {
            background: var(--slate-50);
            border: 1px solid var(--slate-200);
            padding: 10px 15px 10px 40px;
            border-radius: 12px;
            font-size: 0.85rem;
            width: 300px;
            transition: 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--admin-purple);
            background: white;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
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

            .search-input {
                width: 100%;
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
                <a href="{{ url('Admin/Riwayat') }}" class="nav-item-custom">
                    <i class="fa-solid fa-list-check"></i> Riwayat
                </a>
                <a href="{{ url('Admin/Daftar_Aspirasi') }}" class="nav-item-custom">
                    <i class="fa-solid fa-list-check"></i> Daftar Aspirasi
                </a>
                <a href="#" class="nav-item-custom active">
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
                <h5 class="fw-bold mb-0">Database Siswa</h5>
            </div>

            <!-- Pojok Kanan Atas: Profile Edit Trigger -->
            <div class="dropdown">
                <div class="profile-trigger d-flex align-items-center gap-3" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="text-end d-none d-md-block">
                        <p class="mb-0 fw-bold small">{{ auth()->guard('admin')->user()->username }}</p>
                        <p class="mb-0 text-muted small" style="font-size: 0.7rem;">Admin Utama</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ auth()->guard('admin')->user()->username }}&background=7c3aed&color=fff"
                        class="rounded-circle shadow-sm" width="40">
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2" style="min-width: 200px;">
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
                    <form action="{{ url('Admin/LogoutAdmin') }}" method="POST">{{-- untuk logout --}}
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

            <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-4">
                <div>
                    <h4 class="fw-800 mb-1">Manajemen Pengguna</h4>
                    <p class="text-muted small mb-0">Total {{ $totalSiswa }} siswa terdaftar dalam sistem.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div>{{-- untuk tambah siswa --}}
                        <a href="{{ url('Admin/FormTambah') }}"
                            class="btn btn-primary bg-white text-dark border-0 fw-bold px-2 py-2 text-decoration-none d-inline-block shadow-sm">
                            <i class="fa-solid fa-plus me-2"></i> Tambah Siswa
                        </a>
                    </div>
                    <div>{{-- untuk tambah siswa --}}
                        <a href="{{ url('Admin/DataSiswa') }}"
                            class="btn btn-primary bg-white text-dark border-0 fw-bold px-4 py-2 text-decoration-none d-inline-block shadow-sm">
                            Reset
                        </a>
                    </div>
                    <form action="/Admin/DataSiswa/Filter" method="GET">

                        <div class="position-relative d-flex align-items-center flex-grow-1">
                            <i class="fa-solid fa-magnifying-glass position-absolute text-muted ms-3"></i>
                            <input name="Nama" id="siswaFilter" type="text" list="siswaOptions"
                                class="search-input ps-5 form-control border-0 shadow-sm"
                                placeholder="Cari nama, NISN, atau kelas..." style="height: 45px;">

                            <datalist id="siswaOptions">
                                @foreach ($siswa as $data)
                                    <option value="{{ $data->Nama }}">{{ $data->Nama }}</option>
                                    <!-- Menampilkan nama siswa sebagai saran ketikan -->
                                @endforeach
                            </datalist>
                            <button type="submit" hidden>kirim</button>
                        </div>
                    </form>
                </div>


                <div class="data-card shadow-sm">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>NISN</th>
                                    <th>Kelas / Jurusan</th>
                                    <th>Total Laporan</th>
                                    <th>Status Akun</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Siswa 1 -->
                                @forelse ($siswa as $data)
                                    {{-- perulangang dengan menginisialisai siswa menjadi data --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://ui-avatars.com/api/?name={{ $data->Nama }}&background=4361ee&color=fff"
                                                    class="student-avatar rounded-circle">
                                                <div>
                                                    <div class="fw-bold small">{{ $data->Nama }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><code class="text-dark fw-bold">{{ $data->nis }}</code></td>
                                        <td>
                                            <div class="small fw-semibold">{{ $data->kelas }}</div>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-primary">12</span> <small
                                                class="text-muted">Aspirasi</small>
                                        </td>
                                        <td>
                                            <span class="badge-active">AKTIF</span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="/Admin/EditSiswa/{{ $data->id_siswa }}"
                                                    class="action-btn text-decoration-none" title="Edit Data"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <form action="/Admin/DataSiswa/Hapus/{{ $data->id_siswa }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="action-btn text-danger" title="Nonaktifkan"
                                                        onclick="confirmHapus(this); return false;"><i
                                                            class="fa-solid fa-user-slash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>
                                                <h6 class="fw-bold text-muted">Siswa tidak ada!</h6>
                                                <p class="small text-muted">Nama siswa tersebut tidak ada.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>

    <!-- MODAL EDIT PROFIL ADMIN -->
    <div class="modal fade" id="modalEditProfile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold mb-0">Edit Profil Saya</h5>
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

        function confirmHapus(btn) {
            MyAlert.show({
                type: 'warning',
                title: 'Hapus siswa ini?',
                message: 'Kamu akan menghapus siswa ini. Yakin mau hapus?',
                showCancel: true,
                confirmText: 'Ya, Hapus!',
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
