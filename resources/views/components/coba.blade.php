<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare | Portal Siswa (Pure CSS)</title>

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

        /* --- STYLE TAMBAHAN KHUSUS CHAT KOTAK --- */
        .chat-btn-trigger {
            background: var(--slate-100);
            color: var(--primary-dark);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all 0.2s;
        }

        .chat-btn-trigger:hover {
            background: var(--student-blue);
            color: var(--white);
        }

        #chat-stream-box {
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
    </style>
    <link rel="stylesheet" href="{{ asset('Css/MyAlert.css') }}">

    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-database-compat.js"></script>
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
                <button onclick="confirmHapus(this); return false;"
                    class="btn btn-danger bg-opacity-25 border-0 w-100 py-3 rounded-4 fw-bold text-decoration-none d-block text-center"
                    style="color: #fca5a5;">
                    <i class="fa-solid fa-power-off me-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>
    <script src="{{ asset('Js/MyAlert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ISI DENGAN BLOK DATA DARI FIREBASE CONFIG KAMU YANG TADI DI NOTEPAD
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

        const currentStudentName = "{{ auth('siswa')->user()->Nama }}";
        const cleanStudentNode = currentStudentName.replace(/[.#$\[\]]/g, "-");

        // Referensi ke root chat siswa ini: chats/Nama-Siswa
        const studentRootRef = database.ref('chats/' + cleanStudentNode);

        let activeAdminTarget = ""; // Menyimpan admin yang sedang dibuka chatnya
        let activeChatListener = null; // Menyimpan fungsi pemantau pesan aktif
        let lastTotalUnreadSiswa = null; // Tracker penyimpan status unread sisi siswa (BARU)

        // ==========================================
        // 1. ENGINE REAL-TIME: DETEKSI DAFTAR CHAT, HITUNG NOTIFIKASI & TOAST SISI SISWA
        // ==========================================
        studentRootRef.on('value', (snapshot) => {
            const containerDaftar = document.getElementById('container-daftar-admin') || document.getElementById(
                'detail-container-daftar-admin');
            const badgeGlobal = document.getElementById('badge-chat-global');

            if (!snapshot.exists()) {
                if (containerDaftar) containerDaftar.innerHTML =
                    `<div class="text-center text-muted my-4 py-2 small">Belum ada riwayat obrolan</div>`;
                if (badgeGlobal) badgeGlobal.classList.add('d-none');
                lastTotalUnreadSiswa = 0;
                return;
            }

            let htmlDaftar = "";
            let totalUnreadGlobalSiswa = 0;
            let latestAdminName = "Admin Sarpras";
            let latestAdminMsg = "Mengirim pesan baru";
            const batasWaktu7Hari = Date.now() - (7 * 24 * 60 * 60 * 1000); // Retensi 7 Hari

            // MENGGUNAKAN FOREACH BAWAAN FIREBASE (Jauh lebih stabil & aman)
            snapshot.forEach((adminSnapshot) => {
                const adminNodeKey = adminSnapshot.key; // Mengambil nama admin/node (Contoh: Admin-Pusat)

                let lastMessageText = "Belum ada pesan";
                let lastMessageTime = "";
                let unreadCount = 0;
                let lastTimestamp = 0;
                let hasValidMessages = false;

                // Loop isi pesan di dalam node admin ini
                adminSnapshot.forEach((msgSnapshot) => {
                    const msgKey = msgSnapshot.key;
                    const msgData = msgSnapshot.val();
                    if (!msgData) return;

                    // Cek Aturan 7 Hari (Hapus jika kadaluwarsa)
                    if (msgData.timestamp && msgData.timestamp < batasWaktu7Hari) {
                        studentRootRef.child(`${adminNodeKey}/${msgKey}`).remove();
                        return;
                    }

                    hasValidMessages = true;
                    if (msgData.message && !msgData.message.includes(
                        '📢 *Menanyakan Progres Tiket')) {
                        lastMessageText = msgData.message;
                    } else if (msgData.message && msgData.message.includes(
                            '📢 *Menanyakan Progres Tiket') && lastMessageText ===
                        "Belum ada pesan") {
                        lastMessageText = "🎯 Menanyakan Progres Laporan";
                    }

                    lastTimestamp = msgData.timestamp;

                    // Hitung Unread jika pengirim adalah Admin
                    if (msgData.role !== 'siswa' && msgData.is_read !== true) {
                        unreadCount++;
                        totalUnreadGlobalSiswa++;
                        latestAdminName = msgData.sender || "Admin";
                        latestAdminMsg = msgData.message || "Mengirim pesan baru";
                    }
                });

                // Jika tidak ada pesan valid atau habis terhapus sistem 7 hari, lewati admin ini
                if (!hasValidMessages) return;

                // Ambil waktu dari pesan paling terakhir
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

                // Tentukan fungsi click modal secara fleksibel (apakah di halaman detail atau dashboard)
                const fungsiKlik = typeof bukaRoomChatDetail === 'function' ?
                    `bukaRoomChatDetail('${adminNodeKey}')` : `bukaRoomChat('${adminNodeKey}')`;

                htmlDaftar += `
                    <div class="d-flex align-items-center p-3 border-bottom list-group-item-action" style="cursor: pointer; transition: 0.2s;" onclick="${fungsiKlik}">
                        <img src="https://ui-avatars.com/api/?name=${namaAdminAsli}&background=64748b&color=fff" class="rounded-circle me-3" width="40">
                        <div class="flex-grow-1" style="max-width: 70%;">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="small text-dark d-block text-truncate">${namaAdminAsli}</strong>
                                <span class="text-muted" style="font-size: 0.65rem;">${lastMessageTime}</span>
                            </div>
                            <div class="text-muted small text-truncate" style="margin-top: 2px;">
                                ${lastMessageText}
                            </div>
                        </div>
                        ${badgeUnreadHtml}
                    </div>
                `;
            });

            if (containerDaftar) {
                containerDaftar.innerHTML = htmlDaftar !== "" ? htmlDaftar :
                    `<div class="text-center text-muted my-4 py-2 small">Belum ada riwayat obrolan</div>`;
            }

            // Update Angka Notifikasi Global di Atas Tombol Chat
            if (badgeGlobal) {
                if (totalUnreadGlobalSiswa > 0) {
                    badgeGlobal.innerText = totalUnreadGlobalSiswa;
                    badgeGlobal.classList.remove('d-none');
                } else {
                    badgeGlobal.classList.add('d-none');
                }
            }

            // ==========================================
            // LOGIKA PEMICU POP-UP TOAST CUSTOM SISI SISWA (BARU - ANTI CRASH)
            // ==========================================
            const toastSiswa = document.getElementById('customChatToastSiswa');

            if (toastSiswa && totalUnreadGlobalSiswa > 0) {
                let pemicuToastSiswa = false;

                // KONDISI 1: Siswa baru refresh web & ada pesan unread tertunggak dari admin
                if (lastTotalUnreadSiswa === null) {
                    document.getElementById('custom-siswa-toast-title').innerText = "Pesan Belum Dibaca";
                    document.getElementById('custom-siswa-toast-body').innerText =
                        `Ada ${totalUnreadGlobalSiswa} balasan dari Admin menunggu tanggapanmu.`;
                    pemicuToastSiswa = true;
                }
                // KONDISI 2: Saat web kebuka tiba-tiba ada chat masuk baru dari admin
                else if (totalUnreadGlobalSiswa > lastTotalUnreadSiswa) {
                    document.getElementById('custom-siswa-toast-title').innerText =
                        `Balasan dari ${latestAdminName}`;
                    document.getElementById('custom-siswa-toast-body').innerText = (latestAdminMsg && latestAdminMsg
                            .includes('📢 *Menanyakan Progres Tiket')) ? "🎯 Menanyakan Progres Laporan" :
                        latestAdminMsg;
                    pemicuToastSiswa = true;
                }

                if (pemicuToastSiswa) {
                    toastSiswa.style.display = 'block';
                    try {
                        playNotificationSound();
                    } catch (e) {}

                    setTimeout(() => {
                        toastSiswa.style.display = 'none';
                    }, 5000);
                }
            }

            lastTotalUnreadSiswa = totalUnreadGlobalSiswa;
        });

        // ==========================================
        // 2. LOGIKA INTERAKSI: PERPINDAHAN WINDOWS CHAT
        // ==========================================
        function bukaRoomChat(adminNodeKey) {
            activeAdminTarget = adminNodeKey;
            const namaAdminAsli = adminNodeKey.replace(/-/g, " ");

            // Atur UI Header Modal
            document.getElementById('modalChatAdminLabel').innerText = namaAdminAsli;
            document.getElementById('btn-back-to-list').classList.remove('d-none');

            // Pindah Screen
            document.getElementById('screen-chat-list').classList.add('d-none');
            document.getElementById('screen-room-chat').classList.remove('d-none');

            const chatStream = document.getElementById('chat-stream-box');
            chatStream.innerHTML = ""; // Bersihkan layar chat lama

            if (activeChatListener) {
                studentRootRef.child(adminNodeKey).off('child_added', activeChatListener);
            }

            const currentChatRef = studentRootRef.child(adminNodeKey);

            // KETIKA CHAT DIBUKA: Tandai semua pesan dari admin ini sebagai SUDAH DIBACA (is_read: true)
            currentChatRef.once('value', (snapshot) => {
                const msgs = snapshot.val();
                if (msgs) {
                    Object.keys(msgs).forEach((key) => {
                        if (msgs[key].role !== 'siswa') {
                            currentChatRef.child(key).update({
                                is_read: true
                            });
                        }
                    });
                }
            });

            // Hidupkan listener real-time untuk room chat yang aktif dibuka (FIXED FILTER LOG)
            activeChatListener = currentChatRef.on('child_added', (snapshot) => {
                const payload = snapshot.val();
                if (!payload) return;

                // FILTER: Jika pesan mengandung teks otomatis tiket, JANGAN TAMPILKAN di dashboard beranda
                if (payload.message && payload.message.includes('📢 *Menanyakan Progres Tiket')) return;

                // Format Jam Menit & Hari
                let formatWaktu = "";
                if (payload.timestamp) {
                    const date = new Date(payload.timestamp);
                    const infoHari = date.toLocaleDateString('id-ID', {
                        weekday: 'short'
                    });
                    const jam = String(date.getHours()).padStart(2, '0');
                    const menit = String(date.getMinutes()).padStart(2, '0');
                    formatWaktu = `${infoHari}, ${jam}:${menit}`;
                }

                // Tentukan gaya styling balon chat (Siswa kanan, Admin kiri)
                let bubbleStyle = 'me-auto chat-bubble admin-reply';
                if (payload.role === 'siswa') {
                    bubbleStyle = 'ms-auto chat-bubble me';
                }

                let alignTime = payload.role === 'siswa' ? 'text-end text-white-50' : 'text-start text-muted';

                // Cetak obrolan murni
                chatStream.innerHTML += `
                    <div class="d-flex w-100">
                        <div class="${bubbleStyle}">
                            <strong>${payload.sender}:</strong><br>
                            ${payload.message}
                            <div class="${alignTime}" style="font-size: 0.7rem; margin-top: 4px;">${formatWaktu}</div>
                        </div>
                    </div>`;

                chatStream.scrollTop = chatStream.scrollHeight; // Auto gulir ke bawah
            });
        }

        function bukaDaftarChat() {
            activeAdminTarget = "";
            document.getElementById('modalChatAdminLabel').innerText = "Pesan SarprasCare";
            document.getElementById('btn-back-to-list').classList.add('d-none');

            document.getElementById('screen-chat-list').classList.remove('d-none');
            document.getElementById('screen-room-chat').classList.add('d-none');
        }

        // Fungsi Kirim Pesan dari Dashboard
        function kirimPesanSiswaDashboard() {
            const field = document.getElementById('siswa-message-input');
            const teks = field.value.trim();

            if (teks !== "" && activeAdminTarget !== "") {
                database.ref('chats/' + cleanStudentNode + '/' + activeAdminTarget).push({
                    sender: currentStudentName,
                    role: 'siswa',
                    message: teks,
                    timestamp: Date.now(),
                    is_read: false
                });
                field.value = "";
            }
        }

        // Jalankan trigger enter key pada input chat dashboard
        document.getElementById('siswa-message-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                kirimPesanSiswaDashboard();
            }
        });

        // Simulasi sound notifikasi web sederhana menggunakan Audio API bawaan browser
        function playNotificationSound() {
            const context = new(window.AudioContext || window.webkitAudioContext)();
            const osc = context.createOscillator();
            const gain = context.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(587.33, context.currentTime); // Nada D5 suara ting bening
            osc.connect(gain);
            gain.connect(context.destination);
            osc.start();
            gain.gain.setValueAtTime(0.3, context.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, context.currentTime + 0.15);
            osc.stop(context.currentTime + 0.15);
        }
    </script>

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

        function confirmHapus(btn) {
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
