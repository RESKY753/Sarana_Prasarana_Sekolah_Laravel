<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare | Detail Laporan</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

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
            background: rgba(15, 23, 42, 0.1);
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

        /* --- Detail Content Styles --- */
        .detail-container {
            background: white;
            border-radius: 24px;
            border: 1px solid var(--slate-200);
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            margin-bottom: 30px;
        }

        .detail-header {
            padding: 30px;
            background: var(--slate-50);
            border-bottom: 1px solid var(--slate-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .badge-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .badge-baru {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .badge-menunggu {
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .badge-process {
            background: #e0f2fe;
            color: #075985;
            border: 1px solid #bae6fd;
        }

        .badge-selesai {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .badge-ditolak {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            padding: 30px;
        }

        .info-item label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--slate-500);
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .info-item p {
            margin: 0;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .content-section {
            padding: 0 30px 25px;
        }

        .section-label {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--slate-500);
            text-transform: uppercase;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .box-content {
            background: var(--slate-50);
            padding: 18px;
            border-radius: 16px;
            border: 1px solid var(--slate-200);
            color: #475569;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .box-feedback {
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            color: #166534;
        }

        .timeline-container {
            padding: 30px;
            border-top: 1px solid var(--slate-200);
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            padding-bottom: 20px;
            border-left: 2px solid var(--slate-200);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -7px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--student-blue);
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

        /* --- STYLING BALON CHAT POP-UP --- */
        #detail-chat-stream {
            height: 350px;
            overflow-y: auto;
            padding: 15px;
            background: #f8fafc;
            border-radius: 12px;
        }

        .chat-bubble {
            max-width: 75%;
            padding: 10px 14px;
            border-radius: 16px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .chat-bubble.me {
            background: var(--student-blue);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .chat-bubble.admin-reply {
            background: var(--slate-200);
            color: var(--primary-dark);
            border-bottom-left-radius: 4px;
        }

        .ticket-context-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            color: #b45309;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>

    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-database-compat.js"></script>
</head>
<link rel="stylesheet" href="{{ asset('Css/MyAlert.css') }}">

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
                <a href="{{ url('/Siswa/DashboardSiswa') }}" class="nav-item-custom active">
                    <i class="fa-solid fa-shapes"></i> Beranda
                </a>
                <a href="{{ url('/Siswa/KirimAspirasi') }}" class="nav-item-custom">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
                </a>
                <a href="/Siswa/RiwayatAspirasiSiswa" class="nav-item-custom">
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

                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-800 mb-1">Detail Progres Laporan</h3>
                            <p class="text-muted small">Nomor Tiket: <span
                                    class="fw-bold text-primary">#SPR-231{{ $aspirasi->id_aspirasi }}</span></p>
                        </div>
                        <a href="/Siswa/DashboardSiswa"
                            class="btn btn-light rounded-3 btn-sm fw-bold text-muted border">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <div class="detail-container">
                        <div class="detail-header">
                            <div>
                                <h4 class="fw-700 mb-1">{{ $aspirasi->judul_aspirasi }}</h4>
                                <div class="d-flex align-items-center gap-2">

                                    @php
                                        $status = $progres->first()->status ?? 'baru';
                                    @endphp
                                    @switch($status)
                                        @case('menunggu')
                                            <span class="badge-status badge-menunggu">
                                                Menunggu
                                            </span>
                                        @break

                                        @case('diproses')
                                            <span class="badge-status badge-process">
                                                Diproses
                                            </span>
                                        @break

                                        @case('selesai')
                                            <span class="badge-status badge-selesai">
                                                Selesai
                                            </span>
                                        @break

                                        @case('ditolak')
                                            <span class="badge-status badge-ditolak">
                                                Ditolak
                                            </span>
                                        @break

                                        @default
                                            <span class="badge-status badge-baru">
                                                Baru
                                            </span>
                                    @endswitch
                                    <span class="text-muted small">• Update terakhir:
                                        @if ($progres->isNotEmpty())
                                            {{ $progres->first()->tanggal_update }}
                                        @else
                                            Belum ada Update
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-secondary btn-sm rounded-3 fw-bold"
                                    onclick="window.print()">
                                    <i class="fa-solid fa-print me-1"></i> Cetak
                                </button>
                            </div>
                        </div>

                        <div class="info-grid">
                            <div class="info-item">
                                <label>Kategori</label>
                                <p><i class="fa-solid fa-tools text-primary me-2"></i>{{ $aspirasi->ket_kategori }}</p>
                            </div>
                            <div class="info-item">
                                <label>Lokasi</label>
                                <p><i class="fa-solid fa-location-dot text-danger me-2"></i>{{ $aspirasi->lokasi }}</p>
                            </div>
                        </div>

                        <div class="content-section">
                            <label class="section-label">
                                <i class="fa-solid fa-comment-dots"></i> Deskripsi Laporan Anda
                            </label>
                            <div class="box-content">
                                {{ $aspirasi->ket_aspirasi }}
                            </div>
                        </div>

                        <div class="content-section">
                            <label class="section-label text-primary">
                                <i class="fa-solid fa-spinner"></i> Keterangan Progres Admin
                            </label>
                            <div class="box-content border-primary border-opacity-25">
                                <div class="d-flex justify-content-between mb-2">
                                    <span
                                        class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 rounded small">Tahap
                                        Teknisi</span>
                                    <small class="text-muted italic">
                                        @if ($progres->isNotEmpty())
                                            {{ $progres->first()->tanggal_update }}
                                        @else
                                            Belum ada Update
                                        @endif
                                    </small>
                                </div>
                                @if ($progres->isNotEmpty())
                                    {{ $progres->first()->ket_progres }}
                                @else
                                    Menunggu Respon
                                @endif
                            </div>
                        </div>

                        <div class="content-section">
                            <label class="section-label text-success">
                                <i class="fa-solid fa-envelope-open-text"></i> Umpan Balik Admin
                            </label>
                            <div class="box-content box-feedback">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fa-solid fa-user-shield"></i>
                                    <span class="fw-bold small">Admin
                                        Sarpras({{ $progres->first()->username ?? 'System' }})</span>
                                </div>
                                @if ($progres->isNotEmpty())
                                    {{ $progres->first()->umpan_balik }}
                                @else
                                    Belum ada umpan balik
                                @endif
                            </div>
                        </div>

                        <!-- Timeline Ringkas -->
                        <div class="timeline-container">
                            <h6 class="fw-800 mb-4 text-uppercase small" style="letter-spacing: 1px;">Histori Status
                            </h6>

                            @foreach ($progres as $item)
                                <div class="timeline-item mb-0">
                                    @switch($item->status)
                                        @case('menunggu')
                                            <p class="fw-bold small text-primary mb-0">
                                                {{ ucfirst($item->status) }}
                                            </p>
                                            <p class="small text-muted">
                                                {{ $item->tanggal_update }}
                                            </p>
                                        @break

                                        @case('diproses')
                                            <p class="fw-bold small text-primary mb-0">
                                                {{ ucfirst($item->status) }}
                                            </p>
                                            <p class="small text-muted">
                                                {{ $item->tanggal_update }}
                                            </p>
                                        @break

                                        @case('selesai')
                                            <p class="fw-bold small text-success mb-0">
                                                {{ ucfirst($item->status) }}
                                            </p>
                                            <p class="small text-muted">
                                                {{ $item->tanggal_update }}
                                            </p>
                                        @break

                                        @case('ditolak')
                                            <p class="fw-bold small text-danger mb-0">
                                                {{ ucfirst($item->status) }}
                                            </p>
                                            <p class="small text-muted">
                                                {{ $item->tanggal_update }}
                                            </p>
                                        @break
                                    @endswitch <!-- <--- PASTIKAN TAG INI ADA SEBELUM DIV PENUTUP TIMELINE ITEM -->
                                </div>
                            @endforeach

                            <div class="timeline-item">
                                <p class="mb-0 fw-bold small text-primary">Laporan Dikirim</p>
                                <p class="small text-muted mb-0">{{ $aspirasi->tanggal_lapor }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-4 bg-light border text-center">
                        <p class="small text-muted mb-0">Butuh bantuan lebih lanjut terkait laporan ini?
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalChatDetailReport"
                                class="fw-bold text-primary">
                                <i class="fa-solid fa-comments me-1"></i>Hubungi Admin
                            </a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalChatDetailReport" tabindex="-1" aria-labelledby="modalChatDetailReportLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header bg-dark text-white rounded-top-4 border-0 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <button id="detail-btn-back" class="btn btn-sm btn-link text-white p-0 me-2 d-none"
                            onclick="bukaDaftarChatDetail()">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <div class="bg-success rounded-circle" style="width: 10px; height: 10px;"></div>
                        <h5 class="fw-bold mb-0" id="modalChatDetailReportLabel" style="font-size: 1.05rem;">
                            Chat Layanan Sarpras
                        </h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body p-0">
                    <div id="detail-screen-chat-list" class="p-2 d-none">
                        <div class="text-muted small p-2 fw-bold border-bottom mb-1">Daftar Obrolan</div>
                        <div id="detail-container-daftar-admin" style="max-height: 400px; overflow-y: auto;">
                            <div class="text-center text-muted my-4 py-2 small">Belum ada riwayat obrolan</div>
                        </div>
                    </div>

                    <div id="detail-screen-room-chat">
                        <div id="detail-chat-stream"></div>

                        <div class="p-3 border-top bg-white rounded-bottom-4">
                            <div class="input-group">
                                <input type="text" id="detail-msg-input"
                                    class="form-control border-0 bg-light rounded-pill px-3"
                                    placeholder="Ketik pesan keluhan lanjutan...">
                                <button class="btn btn-primary rounded-pill ms-2 px-3"
                                    onclick="kirimPesanDetailSiswa()">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('Js/MyAlert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // MASUKKAN KREDENSIAL TOKEN FIREBASE ASLI MILIKMU DISINI
        const firebaseConfig = {
            apiKey: "{{ env('MIX_FIREBASE_API_KEY') }}",
            authDomain: "sarpascarechat.firebaseapp.com",
            databaseURL: "{{ env('MIX_FIREBASE_DATABASE_URL') }}",
            projectId: "{{ env('MIX_FIREBASE_PROJECT_ID') }}",
            storageBucket: "sarpascarechat.firebasestorage.app",
            messagingSenderId: "{{ env('MIX_FIREBASE_MESSAGING_SENDER_ID') }}",
            appId: "{{ env('MIX_FIREBASE_APP_ID') }}",
            measurementId: "G-03MNS2WXDL"
        };

        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }
        const database = firebase.database();

        // Parameter Identifikasi Sesi Pengguna & Laporan Aktif
        const currentStudentName = "{{ auth('siswa')->user()->Nama }}";
        const currentTicketNumber = "#SPR-231{{ $aspirasi->id_aspirasi }}";
        const currentReportTitle = "{{ $aspirasi->judul_aspirasi }}";

        @php
            $targetAdmin = 'Admin Pusat';
            if ($progres->isNotEmpty() && $progres->first()->username) {
                $targetAdmin = $progres->first()->username;
            }
        @endphp

        const defaultAdminTarget = "{{ $targetAdmin }}";
        let currentAdminTarget = defaultAdminTarget; // Dinamis bisa berubah kalau pindah chat

        const cleanStudentNode = currentStudentName.replace(/[.#$\[\]]/g, "-");
        const studentRootRef = database.ref('chats/' + cleanStudentNode);

        let chatDetailRef = database.ref('chats/' + cleanStudentNode + '/' + currentAdminTarget.replace(/[.#$\[\]]/g, "-"));
        let activeChatListener = null;

        // Fungsi Kirim Pesan Manual Siswa
        function kirimPesanDetailSiswa() {
            const field = document.getElementById('detail-msg-input');
            const teks = field.value.trim();

            if (teks !== "") {
                chatDetailRef.push({
                    sender: currentStudentName,
                    role: 'siswa',
                    message: teks,
                    timestamp: Date.now()
                });
                field.value = "";
            }
        }

        // Jalankan trigger enter key pada input chat
        document.getElementById('detail-msg-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                kirimPesanDetailSiswa();
            }
        });

        // Deteksi Trigger Ketika Dialog Box Pertama Kali Diklik
        let isContextSent = false;
        const modalChatEl = document.getElementById('modalChatDetailReport');
        modalChatEl.addEventListener('shown.bs.modal', function() {
            // Pas pertama buka, pastikan langsung masuk ke room chat laporan ini
            bukaRoomChatDetail(currentAdminTarget.replace(/[.#$\[\]]/g, "-"));
            document.getElementById('detail-btn-back').classList.remove('d-none'); // Munculkan panah kembali

            if (!isContextSent && currentAdminTarget === defaultAdminTarget) {
                chatDetailRef.push({
                    sender: currentStudentName,
                    role: 'siswa',
                    message: `📢 *Menanyakan Progres Tiket ${currentTicketNumber}*\nLaporan: ${currentReportTitle}`,
                    timestamp: Date.now()
                });
                isContextSent = true;
            }
        });

        // KUNCI UTAMA: Fungsi memantau isi pesan room yang sedang aktif
        function initRoomChatListener() {
            if (activeChatListener) {
                chatDetailRef.off('child_added', activeChatListener);
            }

            const viewContainer = document.getElementById('detail-chat-stream');
            viewContainer.innerHTML = ""; // bersihkan obrolan lama

            activeChatListener = chatDetailRef.on('child_added', (snapshot) => {
                const dataPayload = snapshot.val();

                let formatWaktu = "";
                if (dataPayload.timestamp) {
                    const date = new Date(dataPayload.timestamp);
                    const infoHari = date.toLocaleDateString('id-ID', {
                        weekday: 'short'
                    });
                    const jam = String(date.getHours()).padStart(2, '0');
                    const menit = String(date.getMinutes()).padStart(2, '0');
                    formatWaktu = `${infoHari}, ${jam}:${menit}`;
                }

                let bubbleStyle = 'me-auto chat-bubble admin-reply';
                if (dataPayload.role === 'siswa') {
                    bubbleStyle = dataPayload.message.includes('📢 *Menanyakan Progres Tiket') ?
                        'mx-auto ticket-context-box text-center border' :
                        'ms-auto chat-bubble me';
                }

                if (dataPayload.message.includes('📢 *Menanyakan Progres Tiket')) {
                    viewContainer.innerHTML +=
                        `<div class="${bubbleStyle}"><i class="fa-solid fa-info-circle"></i> ${dataPayload.message.replace(/\n/g, '<br>')}</div>`;
                } else {
                    let alignTime = dataPayload.role === 'siswa' ? 'text-end text-white-50' :
                        'text-start text-muted';
                    viewContainer.innerHTML +=
                        `<div class="d-flex w-100">
                            <div class="${bubbleStyle}">
                                <strong>${dataPayload.sender}:</strong><br>
                                ${dataPayload.message}
                                <div class="${alignTime}" style="font-size: 0.7rem; margin-top: 4px;">${formatWaktu}</div>
                            </div>
                        </div>`;
                }
                viewContainer.scrollTop = viewContainer.scrollHeight;
            });
        }

        // FUNGSI NAVIGASI 1: KLIK PANAH KEMBALI KELUAR KE DAFTAR CHAT ALL ADMIN
        // FUNGSI NAVIGASI 1: KEMBALI KE DAFTAR CHAT ALL ADMIN (FIXED FOR DETAIL)
        function bukaDaftarChatDetail() {
            document.getElementById('modalChatDetailReportLabel').innerText = "Daftar Obrolan Sarpras";
            document.getElementById('detail-btn-back').classList.add('d-none'); // Sembunyikan panah sementara di list

            document.getElementById('detail-screen-room-chat').classList.add('d-none');
            document.getElementById('detail-screen-chat-list').classList.remove('d-none');

            const containerDaftar = document.getElementById('detail-container-daftar-admin');

            // Gunakan penanganan snapshot .forEach() agar pembacaan node stabil
            studentRootRef.once('value', (snapshot) => {
                if (!snapshot.exists()) {
                    containerDaftar.innerHTML =
                        `<div class="text-center text-muted my-4 py-2 small">Belum ada riwayat obrolan</div>`;
                    return;
                }

                let htmlDaftar = "";
                const batasWaktu7Hari = Date.now() - (7 * 24 * 60 * 60 * 1000); // Batas retensi 7 hari

                snapshot.forEach((adminSnapshot) => {
                    const adminNodeKey = adminSnapshot.key;

                    let lastMessageText = "Belum ada pesan";
                    let lastMessageTime = "";
                    let unreadCount = 0;
                    let lastTimestamp = 0;
                    let hasValidMessages = false;

                    // Loop isi pesan di dalam node admin
                    adminSnapshot.forEach((msgSnapshot) => {
                        const msgKey = msgSnapshot.key;
                        const msgData = msgSnapshot.val();

                        // Cek kadaluwarsa 7 hari
                        if (msgData.timestamp && msgData.timestamp < batasWaktu7Hari) {
                            studentRootRef.child(`${adminNodeKey}/${msgKey}`).remove();
                            return;
                        }

                        hasValidMessages = true;
                        lastMessageText = msgData.message || "Pesan teks";
                        lastTimestamp = msgData.timestamp;

                        if (msgData.role !== 'siswa' && msgData.is_read !== true) {
                            unreadCount++;
                        }
                    });

                    // Jika tidak ada pesan valid, lewati admin ini
                    if (!hasValidMessages) return;

                    if (lastTimestamp) {
                        const date = new Date(lastTimestamp);
                        lastMessageTime = date.toLocaleDateString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }

                    let badgeUnreadHtml = unreadCount > 0 ?
                        `<span class="badge rounded-pill bg-danger ms-auto" style="font-size: 0.7rem;">${unreadCount}</span>` :
                        '';

                    const namaAdminAsli = adminNodeKey.replace(/-/g, " ");

                    htmlDaftar += `
                <div class="d-flex align-items-center p-3 border-bottom list-group-item-action" style="cursor: pointer; transition: 0.2s;" onclick="bukaRoomChatDetail('${adminNodeKey}')">
                    <img src="https://ui-avatars.com/api/?name=${namaAdminAsli}&background=64748b&color=fff" class="rounded-circle me-3" width="35">
                    <div class="flex-grow-1" style="max-width: 70%;">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong class="small text-dark d-block text-truncate">${namaAdminAsli}</strong>
                            <span class="text-muted" style="font-size: 0.65rem;">${lastMessageTime}</span>
                        </div>
                        <div class="text-muted small text-truncate" style="font-size:0.75rem; margin-top: 2px;">
                            ${lastMessageText.includes('📢 *Menanyakan Progres Tiket') ? '🎯 Menanyakan Progres Laporan' : lastMessageText}
                        </div>
                    </div>
                    ${badgeUnreadHtml}
                </div>
            `;
                });

                containerDaftar.innerHTML = htmlDaftar !== "" ? htmlDaftar :
                    `<div class="text-center text-muted my-4 py-2 small">Belum ada riwayat obrolan</div>`;
            });
        }
        // FUNGSI NAVIGASI 2: KLIK SALAH SATU DAFTAR CHAT MASUK KE ROOM LAGI
        function bukaRoomChatDetail(adminNodeKey) {
            currentAdminTarget = adminNodeKey.replace(/-/g, " ");
            chatDetailRef = database.ref('chats/' + cleanStudentNode + '/' + adminNodeKey);

            // Set Header Title Modal
            document.getElementById('modalChatDetailReportLabel').innerText = currentAdminTarget;
            document.getElementById('detail-btn-back').classList.remove('d-none'); // Munculkan panah lagi

            document.getElementById('detail-screen-chat-list').classList.add('d-none');
            document.getElementById('detail-screen-room-chat').classList.remove('d-none');

            // Tandai pesan sebagai sudah dibaca
            chatDetailRef.once('value', (snapshot) => {
                const msgs = snapshot.val();
                if (msgs) {
                    Object.keys(msgs).forEach((key) => {
                        if (msgs[key].role !== 'siswa') {
                            chatDetailRef.child(key).update({
                                is_read: true
                            });
                        }
                    });
                }
            });

            initRoomChatListener(); // Jalankan stream room chat-nya
        }
    </script>
    <script>
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
