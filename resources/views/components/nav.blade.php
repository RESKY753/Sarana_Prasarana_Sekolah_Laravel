<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SarprasCare | Portal Siswa (Pure CSS)</title>

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

    .badge-pending { background: #fffbeb; color: #92400e; }
    .badge-success { background: #f0fdf4; color: #166534; }
    .badge-rejected { background: #fef2f2; color: #991b1b; }

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
  <aside class="sidebar-wrapper">
    @yield('nav')
    <div class="sidebar-header">
      <h2 class="brand-title">Sarpras<span style="color:var(--accent-gold)">Care</span></h2>
      <p class="mb-0 text-muted small" style="letter-spacing: 1px; font-size: 0.65rem;">PORTAL SISWA</p>
    </div>

    <div class="sidebar-content">
      <nav class="sidebar-menu">
        <a href="#" class="nav-item-custom active">
          <i class="fa-solid fa-shapes"></i> Beranda
        </a>
        <a href="#" class="nav-item-custom">
          <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
        </a>
        <a href="#" class="nav-item-custom">
          <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Saya
        </a>
      </nav>
    </div>

    <div class="sidebar-footer">
      <!-- Tanpa JS, link logout langsung mengarah ke halaman tujuan -->
      <a href="login.html" class="btn btn-danger bg-opacity-25 border-0 w-100 py-3 rounded-4 fw-bold text-decoration-none d-block text-center" style="color: #fca5a5;">
        <i class="fa-solid fa-power-off me-2"></i> Logout
      </a>
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
          <p class="mb-0 fw-bold small">Zaki Raihan</p>
          <p class="mb-0 text-muted small">Kelas XII RPL 1</p>
        </div>
        <img src="https://ui-avatars.com/api/?name=Zaki+Raihan&background=4361ee&color=fff" class="rounded-circle border border-2 border-white" width="40">
      </div>
    </header>

    <div class="content-body p-4 p-lg-5">
      
      <!-- Banner -->
      <div class="welcome-banner text-center text-md-start">
        <h1 class="fw-800 mb-2">Halo, Zaki! 👋</h1>
        <p class="opacity-75 mb-4 small">Laporkan kerusakan fasilitas sekolahmu di sini.</p>
        <a href="#" class="btn btn-primary bg-white text-dark border-0 fw-bold rounded-pill px-4 py-2 text-decoration-none d-inline-block">
          <i class="fa-solid fa-plus me-2"></i> Buat Laporan
        </a>
      </div>

      <!-- Reports Grid -->
      <h5 class="fw-800 mb-4">Laporan Saya</h5>
      
      <div class="row g-3">
        <!-- Laporan 1 -->
        <div class="col-md-6 col-xl-4">
          <div class="report-card shadow-sm">
            <div>
              <div class="status-badge badge-pending">Sedang Diproses</div>
              <h6 class="report-title">AC Ruang Kelas Bocor</h6>
              <div class="report-info">
                <div><i class="fa-solid fa-location-dot"></i> Ruang Kelas XII RPL 1</div>
                <div><i class="fa-solid fa-calendar"></i> 06 Feb 2026</div>
              </div>
            </div>
            <a href="#" class="btn-detail">Lihat Detail</a>
          </div>
        </div>

        <!-- Laporan 2 -->
        <div class="col-md-6 col-xl-4">
          <div class="report-card shadow-sm">
            <div>
              <div class="status-badge badge-success">Selesai Perbaikan</div>
              <h6 class="report-title">Engsel Pintu Kamar Mandi</h6>
              <div class="report-info">
                <div><i class="fa-solid fa-location-dot"></i> Lab Fisika Lt. 2</div>
                <div><i class="fa-solid fa-calendar"></i> 02 Feb 2026</div>
              </div>
            </div>
            <a href="#" class="btn-detail">Lihat Detail</a>
          </div>
        </div>
      </div>

    </div>
  </main>

</body>

</html>