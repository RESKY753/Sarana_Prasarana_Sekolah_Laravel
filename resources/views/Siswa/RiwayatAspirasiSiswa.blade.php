<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare | Riwayat Laporan</title>

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

        .hamburger-label {
            cursor: pointer;
            padding: 8px 12px;
            background: var(--slate-100);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* --- Riwayat Styles --- */
        .filter-pills {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .pill-item {
            padding: 8px 20px;
            border-radius: 50px;
            background: white;
            border: 1px solid var(--slate-200);
            color: var(--slate-500);
            font-weight: 600;
            font-size: 0.85rem;
            white-space: nowrap;
            cursor: pointer;
            transition: 0.2s;
        }

        .pill-item.active {
            background: var(--primary-dark);
            color: white;
            border-color: var(--primary-dark);
        }

        .report-card {
            background: white;
            border: 1px solid var(--slate-200);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 16px;
            transition: 0.3s;
            display: block;
            text-decoration: none;
            color: inherit;
            position: relative;
        }

        .report-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            border-color: var(--student-blue);
        }

        .status-badge {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 50px;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .status-process {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .status-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #dcfce7;
        }

        .badge-ditolak {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .badge-baru {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .card-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--slate-100);
            color: var(--student-blue);
            font-size: 1.2rem;
        }

        /* --- STYLING BINTANG RATING (TAMBAHAN FITUR ULASAN) --- */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 8px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 2rem;
            color: #cbd5e1;
            cursor: pointer;
            transition: color 0.2s ease-in-out, transform 0.1s ease;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            color: #f59e0b;
        }

        .star-rating label:hover {
            transform: scale(1.15);
        }

        /* Z-INDEX SUPAYA TOMBOL DIPRIORITAS KAN PAS DIKLIK MOBILE */
        .btn-ulasan-action {
            position: relative;
            z-index: 10;
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

    <aside class="sidebar-wrapper">
        <div class="sidebar-header">
            <h2 class="brand-title">Sarpras<span style="color:var(--accent-gold)">Care</span></h2>
            <p class="mb-0 text-muted small" style="letter-spacing: 1px; font-size: 0.65rem;">PORTAL SISWA</p>
        </div>

        <div class="sidebar-content">
            <nav class="sidebar-menu">
                <a href="{{ url('/Siswa/DashboardSiswa') }}" class="nav-item-custom">
                    <i class="fa-solid fa-shapes"></i> Beranda
                </a>
                <a href="{{ url('/Siswa/KirimAspirasi') }}" class="nav-item-custom">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
                </a>
                <a href="/Siswa/RiwayatAspirasiSiswa" class="nav-item-custom active">
                    <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Saya
                </a>
            </nav>
        </div>

        <div class="sidebar-footer">
            <form action="{{ url('Siswa/LogoutSiswa') }}" method="post">
                @csrf
                <button onclick="confirmlogout(this); return false;"
                    class="btn btn-danger bg-opacity-25 border-0 w-100 py-3 rounded-4 fw-bold text-decoration-none d-block text-center"
                    style="color: #fca5a5;">
                    <i class="fa-solid fa-power-off me-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-bar">
            <div class="d-flex align-items-center">
                <label for="menu-control" class="hamburger-label d-lg-none me-3">
                    <i class="fa-solid fa-bars-staggered"></i>
                </label>
                <span class="text-muted small fw-bold d-none d-md-block">SMK SANGKURIANG 1 CIMAHI</span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <p class="mb-0 fw-bold small">{{ auth('siswa')->user()->Nama }}</p>
                    <p class="mb-0 text-muted small">{{ auth('siswa')->user()->kelas }}</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ auth('siswa')->user()->Nama }}&background=4361ee&color=fff"
                    class="rounded-circle border border-2 border-white" width="40">
            </div>
        </header>

        <div class="content-body p-4 p-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">

                    <!-- Header Page -->
                    <div class="mb-4">
                        <h3 class="fw-800 mb-1">Riwayat Laporan</h3>
                        <p class="text-muted small">Pantau status perbaikan fasilitas yang telah Anda ajukan.</p>
                    </div>

                    <!-- Filter Status -->
                    <div class="filter-pills mb-4">
                        <div class="pill-item active">Semua</div>
                        <div class="pill-item">Pending</div>
                        <div class="pill-item">Proses</div>
                        <div class="pill-item">Selesai</div>
                    </div>

              <!-- List Laporan -->
                    @foreach ($aspirasi as $riwayat)
                        <div class="report-list">
                            <div class="report-card position-relative">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="card-icon">
                                            <i class="fa-solid fa-wind"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ $riwayat->judul_aspirasi }}</h6>
                                            <p class="small text-muted mb-0">Tiket: #{{ $riwayat->id_aspirasi }}</p>
                                        </div>
                                    </div>

                                    <!-- POSISI BADGE STATUS & TOMBOL ULASAN -->
                                    <div class="d-flex flex-column align-items-end gap-2" style="position: relative; z-index: 10;">
                                        @switch($riwayat->status)
                                            @case('menunggu')
                                                <span class="status-badge status-pending">{{ $riwayat->status }}</span>
                                            @break

                                            @case('diproses')
                                                <span class="status-badge status-process">{{ $riwayat->status }}</span>
                                            @break

                                            @case('selesai')
                                                <span class="status-badge status-success">{{ $riwayat->status }}</span>
                                            @break

                                            @case('ditolak')
                                                <span class="status-badge badge-ditolak">{{ $riwayat->status }}</span>
                                            @break

                                            @default
                                                <span class="status-badge badge-baru">{{ $riwayat->status }}</span>
                                        @endswitch

                                        <!-- TOMBOL ULASAN -->
                                        @if ($riwayat->status == 'selesai')
                                            @if (empty($riwayat->rating))
                                                <button type="button"
                                                    class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3 py-1 btn-ulasan-action"
                                                    style="font-size: 0.75rem;"
                                                    onclick="bukaModalUlasan('{{ $riwayat->id_aspirasi }}', '{{ $riwayat->judul_aspirasi }}');">
                                                    <i class="fa-solid fa-star me-1"></i> Ulas
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-warning text-dark fw-bold rounded-pill px-2.5 py-1 btn-ulasan-action"
                                                    style="font-size: 0.7rem; background-color: #fff8e1;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalLihatUlasan-{{ $riwayat->id_aspirasi }}">
                                                    <i class="fa-solid fa-star text-warning me-1"></i> Lihat Ulasan ({{ $riwayat->rating }}/5)
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <p class="small text-muted mb-3 line-clamp-2">{{ $riwayat->ket_aspirasi }}</p>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-calendar text-muted small"></i>
                                        <span class="small text-muted">{{ $riwayat->tanggal_lapor }}</span>
                                    </div>

                                    <!-- STRETCHED LINK (Area Card Bisa Diklik Menuju Detail) -->
                                    <a href="/Siswa/RiwayatAspirasi/{{ $riwayat->id_aspirasi }}" class="text-primary small fw-bold text-decoration-none stretched-link">
                                        Lihat Detail <i class="fa-solid fa-chevron-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL LIHAT ULASAN (Wajib Ada di Dalam Loop Foreach) -->
                        @if ($riwayat->status == 'selesai' && !empty($riwayat->rating))
                            <div class="modal fade" id="modalLihatUlasan-{{ $riwayat->id_aspirasi }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered my-0 mx-auto" style="max-width: 340px;">
                                    <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                                        <div class="modal-header bg-warning text-dark border-0 py-2 px-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fa-solid fa-star text-dark" style="font-size: 0.85rem;"></i>
                                                <h6 class="fw-bold mb-0" style="font-size: 0.85rem;">Ulasan Anda</h6>
                                            </div>
                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-3 text-center">
                                            <p class="text-muted small mb-2" style="font-size: 0.75rem;">
                                                Penanganan laporan: <strong class="text-dark">{{ $riwayat->judul_aspirasi }}</strong>
                                            </p>

                                            <!-- Rating Bintang -->
                                            <div class="fs-4 text-warning mb-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $riwayat->rating)
                                                        <i class="fa-solid fa-star me-1 text-warning" style="font-size: 1.3rem;"></i>
                                                    @else
                                                        <i class="fa-regular fa-star me-1 text-muted opacity-50" style="font-size: 1.3rem;"></i>
                                                    @endif
                                                @endfor
                                            </div>

                                            <!-- Catatan Ulasan -->
                                            <div class="bg-light p-2.5 rounded-3 text-start border">
                                                <label class="form-label small fw-bold text-muted mb-1 d-block" style="font-size: 0.7rem;">Catatan Anda:</label>
                                                <p class="mb-0 text-dark small" style="font-size: 0.78rem; font-style: italic;">
                                                    {{ $riwayat->deskripsi && $riwayat->deskripsi != '-' ? $riwayat->deskripsi : 'Tidak ada catatan tambahan.' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0 p-2 bg-light d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3" style="font-size: 0.75rem;" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <!-- Pagination Simple -->
                    <div class="mt-4 d-flex justify-content-center">
                        <nav>
                            <ul class="pagination pagination-sm">
                                <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- MODAL BERI ULASAN (Form Input) -->
    <div class="modal fade" id="modalUlasanSiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered my-0 mx-auto" style="max-width: 340px;">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                <div class="modal-header bg-primary text-white border-0 py-2 px-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-star text-warning" style="font-size: 0.85rem;"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.85rem;">Beri Ulasan Penanganan</h6>
                    </div>
                    <button type="button" class="btn-close btn-close-white btn-sm" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('Siswa/Ulasan/Simpan') }}" method="POST">
                    @csrf
                    <div class="modal-body p-2.5 text-center">
                        <input type="hidden" name="id_aspirasi" id="ulasan_id_aspirasi">

                        <p class="text-muted small mb-1" style="font-size: 0.75rem;">
                            Bagaimana kepuasanmu terhadap penanganan <strong id="ulasan_judul_tiket" class="text-dark">#SPR</strong>?
                        </p>

                        <!-- Bintang Rating -->
                        <div class="mb-1">
                            @error('rating')
                                <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                            @enderror
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5" required />
                                <label for="star5" title="Sangat Puas" style="font-size: 1.4rem;"><i class="fa-solid fa-star"></i></label>

                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4" title="Puas" style="font-size: 1.4rem;"><i class="fa-solid fa-star"></i></label>

                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3" title="Cukup" style="font-size: 1.4rem;"><i class="fa-solid fa-star"></i></label>

                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2" title="Kurang Puas" style="font-size: 1.4rem;"><i class="fa-solid fa-star"></i></label>

                                <input type="radio" id="star1" name="rating" value="1" />
                                <label for="star1" title="Sangat Kecewa" style="font-size: 1.4rem;"><i class="fa-solid fa-star"></i></label>
                            </div>
                            <div class="form-text text-muted mt-0" style="font-size: 0.65rem;">Pilih bintang 1 sampai 5</div>
                        </div>

                        <!-- Textarea -->
                        <div class="text-start mb-2">
                            <label class="form-label small fw-bold text-muted mb-1" style="font-size: 0.7rem;">Catatan Tambahan (Opsional)</label>
                            <textarea name="deskripsi" class="form-control rounded-3 border-slate-200" rows="2"
                                style="font-size: 0.75rem; padding: 6px 10px;" placeholder="Tuliskan masukan atau ucapan terima kasih..."></textarea>
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit" class="btn btn-primary w-100 py-1.5 rounded-3 fw-bold shadow-sm" style="font-size: 0.8rem;">
                            <i class="fa-solid fa-paper-plane me-1"></i> Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Js/MyAlert.js') }}"></script>

    <script>
        function bukaModalUlasan(idAspirasi, judulAspirasi) {
            document.getElementById('ulasan_id_aspirasi').value = idAspirasi;
            document.getElementById('ulasan_judul_tiket').innerText = '#' + idAspirasi + ' (' + judulAspirasi + ')';

            var modalUlasan = new bootstrap.Modal(document.getElementById('modalUlasanSiswa'));
            modalUlasan.show();
        }

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

        function confirmlogout(btn) {
            MyAlert.show({
                type: 'warning',
                title: 'Anda akan keluar?',
                message: 'Kamu akan keluar dari akun ini, Keluar?',
                showCancel: true,
                confirmText: 'Ya, Keluar!',
                cancelText: 'Batal',
                autoClose: false,
                closeOnOverlay: false,
                onConfirm: function() {
                    btn.closest('form').submit();
                }
            });
        }
    </script>

</body>

</html>
