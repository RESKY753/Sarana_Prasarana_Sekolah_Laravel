<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Aspirasi</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
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
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .nav-item-custom {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: rgba(255,255,255,0.6);
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

    .nav-item-custom:hover, .nav-item-custom.active {
      background: rgba(255,255,255,0.1);
      color: var(--white);
    }

    .nav-item-custom.active {
      background: var(--student-blue);
    }

    .sidebar-footer {
      padding: 20px;
      border-top: 1px solid rgba(255,255,255,0.05);
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

    /* --- Form Styles --- */
    .form-container {
      background: white;
      border-radius: 20px;
      border: 1px solid var(--slate-200);
      padding: 30px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .form-label {
      font-weight: 600;
      font-size: 0.9rem;
      color: var(--primary-dark);
      margin-bottom: 8px;
    }

    .form-control, .form-select {
      border-radius: 10px;
      border: 1px solid var(--slate-200);
      padding: 12px 15px;
      font-size: 0.9rem;
      transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--student-blue);
      box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
    }

    .btn-submit {
      background: var(--student-blue);
      color: white;
      border: none;
      border-radius: 12px;
      padding: 14px 20px;
      font-weight: 700;
      width: 100%;
      transition: all 0.3s;
    }

    .btn-submit:hover {
      background: #3651d1;
      transform: translateY(-2px);
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
      #menu-control:checked ~ .sidebar-wrapper {
        transform: translateX(0);
      }
      #menu-control:checked ~ .sidebar-overlay {
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
  </style>
</head>

<body>

  <!-- Checkbox sebagai pengganti state JS -->
  <input type="checkbox" id="menu-control">
  
  <!-- Overlay (diklik untuk menutup menu) -->
  <label for="menu-control" class="sidebar-overlay"></label>

  <!-- Sidebar -->
   <!-- Sidebar -->
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
        <a href="{{ url('/Siswa/KirimAspirasi') }}" class="nav-item-custom active">
          <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
        </a>
        <a href="/Siswa/RiwayatAspirasiSiswa" class="nav-item-custom">
          <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Saya
        </a>
      </nav>
    </div>

    <div class="sidebar-footer">
      <!-- Tanpa JS, link logout langsung mengarah ke halaman tujuan -->
     <form action="{{ url('Admin/LogoutSiswa') }}" method="post">
        @csrf
        <button class="btn btn-danger bg-opacity-25 border-0 w-100 py-3 rounded-4 fw-bold text-decoration-none d-block text-center" style="color: #fca5a5;">
          <i class="fa-solid fa-power-off me-2"></i> Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- Main Content -->
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
        <img src="https://ui-avatars.com/api/?name={{ auth('siswa')->user()->Nama }}&background=4361ee&color=fff" class="rounded-circle border border-2 border-white" width="40">
      </div>
    </header>

    <div class="content-body p-4 p-lg-5">
      
      {{-- <!-- Banner -->
      <div class="welcome-banner text-center text-md-start">
        <h1 class="fw-800 mb-2">Halo, Zaki! 👋</h1>
        <p class="opacity-75 mb-4 small">Suara Anda penting. Laporkan kerusakan atau kirim aspirasi untuk fasilitas sekolah yang lebih baik.</p>
      </div> --}}

      <!-- Form Section -->
      <div class="row justify-content-center" id="form-section">
        <div class="col-lg-8 col-xl-7">
          <div class="form-container">
            <h5 class="fw-800 mb-4"><i class="fa-solid fa-file-pen text-primary me-2"></i> Form Pelaporan & Aspirasi</h5>
            
            <form action="/Siswa/Store" method="POST">
              @csrf
              <input type="number" value="{{ auth('siswa')->user()->id_siswa }}" hidden>
              <div class="mb-3">
                <label class="form-label">Judul Aspirasi / Laporan</label>
                <input type="text" name="judul_aspirasi" class="form-control" placeholder="Contoh: Perbaikan AC Kelas" required>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Kategori</label>
                  <select class="form-select" name="id_kategori" required>
                    <option value="" selected disabled>Pilih Kategori</option>  
                    @foreach ($kategori as $kategori)
                    <option value="{{$kategori->id_kategori}}" {{old('id_kategori') == $kategori->id_kategori? 'selected' : ''}}>{{$kategori->ket_kategori}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Tanggal Lapor</label>
                  <input type="date" class="form-control" name="tanggal_lapor" value="<?= date('Y-m-d') ?>" readonly>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" class="form-control" name="lokasi" placeholder="Contoh: Lab Komputer 1 / Kantin" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Keterangan / Detail</label>
                <textarea class="form-control" rows="3" name="ket_aspirasi" placeholder="Jelaskan secara detail kerusakan atau keadaan..." required></textarea>
              </div>
              <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane me-2"></i> Kirim Laporan Sekarang
              </button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </main>

</body>

</html>