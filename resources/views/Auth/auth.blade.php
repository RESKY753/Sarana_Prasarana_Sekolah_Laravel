<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SarprasCare | Login</title>

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
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--slate-50);
            color: var(--primary-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            background: var(--white);
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.05);
            border: 1px solid var(--slate-200);
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .login-tabs {
            display: flex;
            background: var(--slate-100);
            padding: 6px;
            border-radius: 16px;
            margin-bottom: 30px;
        }

        .tab-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background: transparent;
            font-weight: 700;
            font-size: 0.9rem;
            border-radius: 12px;
            color: var(--slate-500);
            transition: 0.3s;
            cursor: pointer;
        }

        .tab-btn.active {
            background: var(--white);
            color: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--primary-dark);
            margin-bottom: 8px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group-custom i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--slate-500);
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 18px 14px 50px;
            background: var(--slate-50);
            border: 1px solid var(--slate-200);
            border-radius: 16px;
            font-weight: 500;
            transition: 0.3s;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--student-blue);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: var(--primary-dark);
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 800;
            font-size: 1rem;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2);
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            font-size: 0.85rem;
            color: var(--slate-500);
        }

        /* Logic Toggle */
        #form-admin {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('Css/MyAlert.css') }}">
</head>

<body>

    <div class="login-container">
        <div class="brand-logo">
            <h1 class="brand-title">Sarpras<span style="color:var(--accent-gold)">Care</span></h1>
            <p class="text-muted small">Silakan login untuk mengakses layanan</p>
        </div>

        <div class="login-tabs">
            <button class="tab-btn active" onclick="switchTab('siswa')">Siswa</button>
            <button class="tab-btn " onclick="switchTab('admin')">Admin</button>
        </div>

        <!-- Form Siswa (NIS + Pass) -->
        {{-- @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
    @endif --}}
        <form id="form-siswa" action="{{ Route('ProsesLoginSiswa') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">NIS (Nomor Induk Siswa)</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-id-card"></i>
                    <input type="number" name="nis" class="form-control-custom" placeholder="Masukkan NIS Anda"
                        required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" class="form-control-custom" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Masuk Sebagai Siswa</button>
        </form>

        <!-- Form Admin (Username + Pass) -->
        <form id="form-admin" action="{{ Route('ProsesLoginAdmin') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username Admin</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-user-shield"></i>
                    <input type="text" class="form-control-custom" placeholder="Masukkan Username" name="username"
                        required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" class="form-control-custom" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login" style="background: var(--student-blue);">Masuk Sebagai
                Admin</button>
        </form>

        <div class="footer-text">
            &copy; 2023 SarprasCare SMK SANGKURIANG 1 CIMAHI. <br>
            <span class="fw-bold">Fast • Reliable • Integrated</span>
        </div>
    </div>
    <script src="{{ asset('Js/MyAlert.js') }}"></script>
    <script>
        // Membuat fungsi bernama switchTab dengan parameter 'type'
        // 'type' akan menentukan tab mana yang aktif (siswa atau admin)
        function switchTab(type) {

            // Mengambil tombol tab pertama (Siswa) berdasarkan class 'tab-btn'
            const btnSiswa = document.querySelectorAll('.tab-btn')[0];

            // Mengambil tombol tab kedua (Admin) berdasarkan class 'tab-btn'
            const btnAdmin = document.querySelectorAll('.tab-btn')[1];

            // Mengambil elemen form siswa berdasarkan id 'form-siswa'
            const formSiswa = document.getElementById('form-siswa');

            // Mengambil elemen form admin berdasarkan id 'form-admin'
            const formAdmin = document.getElementById('form-admin');

            // Mengecek jika type bernilai 'siswa'
            if (type === 'siswa') {

                // Menambahkan class 'active' ke tombol siswa
                btnSiswa.classList.add('active');

                // Menghapus class 'active' dari tombol admin
                btnAdmin.classList.remove('active');

                // Menampilkan form siswa
                formSiswa.style.display = 'block';

                // Menyembunyikan form admin
                formAdmin.style.display = 'none';

            } else {
                // Jika type bukan 'siswa' (berarti admin)

                // Menghapus class 'active' dari tombol siswa
                btnSiswa.classList.remove('active');

                // Menambahkan class 'active' ke tombol admin
                btnAdmin.classList.add('active');

                // Menyembunyikan form siswa
                formSiswa.style.display = 'none';

                // Menampilkan form admin
                formAdmin.style.display = 'block';
            }
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
        @if (session('erroradmin'))
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
