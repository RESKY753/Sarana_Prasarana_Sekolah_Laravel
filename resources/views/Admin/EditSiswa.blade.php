<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Edit Siswa - SarprasCare</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-soft: #eef2ff;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-400: #94a3b8;
            --slate-700: #334155;
            --slate-900: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: var(--slate-900);
            min-height: 100vh;
        }

        .form-header-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: var(--slate-900);
        }

        /* Card Styling */
        .premium-card {
            background: #ffffff;
            border: 1px solid var(--slate-200);
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }

        /* Input Styling */
        .input-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--slate-700);
            margin-bottom: 0.6rem;
            display: block;
        }

        .custom-input {
            padding: 0.8rem 1.1rem;
            border-radius: 0.85rem;
            border: 1px solid var(--slate-200);
            background-color: var(--slate-50);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
        }

        .custom-input:focus {
            background-color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        /* Button Styling */
        .btn-submit {
            background: var(--primary);
            color: white;
            padding: 0.9rem 1.5rem;
            border-radius: 1rem;
            font-weight: 700;
            border: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -5px rgba(79, 70, 229, 0.4);
            color: white;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: var(--slate-700);
            border: 1px solid var(--slate-200);
            padding: 0.9rem 1.5rem;
            border-radius: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .btn-cancel:hover {
            background: var(--slate-200);
            color: var(--slate-900);
        }

        .info-section {
            border-right: 1px solid var(--slate-100);
        }

        @media (max-width: 768px) {
            .info-section {
                border-right: none;
                border-bottom: 1px solid var(--slate-100);
                padding-bottom: 1.5rem;
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">

                <!-- Header Section Simple -->
                <div class="mb-4">
                    <h2 class="form-header-title mb-1">Edit Data Siswa</h2>
                    <p class="text-muted small">PEngubahan akun siswa sistem SarprasCare</p>
                </div>

                <!-- Form Card -->
                <div class="premium-card overflow-hidden">
                    <div class="row g-0">
                        <!-- Sisi Kiri: Informasi -->
                        <div class="col-md-4 bg-light p-4 p-lg-5 info-section">
                            <div class="mb-4">
                                <span
                                    class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3"
                                    style="font-size: 0.7rem;">DATA LOGIN</span>
                                <h5 class="fw-bold text-dark mb-3">Informasi Akun</h5>
                                <p class="text-muted small lh-lg">Input NIS sebagai identitas unik. Password ini akan
                                    digunakan siswa untuk mengakses laporan sarana prasarana.</p>
                            </div>

                            <div
                                class="d-flex align-items-center p-3 bg-white rounded-4 border border-slate-200 mb-3 shadow-sm">
                                <div class="text-primary me-3">
                                    <i class="fa-solid fa-user-shield fs-5"></i>
                                </div>
                                <div class="small">
                                    <div class="fw-bold">Privasi Terjamin</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">Password dienkripsi otomatis.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sisi Kanan: Form Input -->
                        <div class="col-md-8 p-4 p-lg-5">
                            <form method="POST" action="/Admin/UpdateSiswa/{{ $siswa->id_siswa }}">
                                @csrf
                                @method('PUT')
                                <div class="row g-4">
                                    <!-- NIS -->
                                    <div class="col-md-12">
                                        <label class="input-label">Nomor Induk Siswa (NIS)</label>
                                        <input type="number" class="form-control custom-input"
                                            placeholder="Masukkan nomor induk siswa" name="nis" maxlength="10" value="{{ $siswa->nis }}">
                                        @error('nis')
                                            <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Nama -->
                                    <div class="col-md-12">
                                        <label class="input-label">Nama Lengkap Siswa</label>
                                        <input type="text" class="form-control custom-input"
                                            placeholder="Masukkan nama lengkap" name="Nama" value="{{ $siswa->Nama }}">
                                        @error('Nama')
                                            <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Kelas -->
                                    <div class="col-md-6">
                                        <label class="input-label">Kelas</label>
                                        <select class="form-select custom-input" name="kelas" >
                                            <option value="" selected disabled>Pilih tingkat...</option>
                                            <option value="X RPL 1" @selected($siswa->kelas == 'X RPL 1')>X RPL 1</option>
                                            <option value="X RPL 2" @selected($siswa->kelas == 'X RPL 2')>X RPL 2</option>
                                            <option value="X RPL 3" @selected($siswa->kelas == 'X RPL 3')>X RPL 3</option>
                                            <option value="X RPL 4" @selected($siswa->kelas == 'X RPL 4')>X RPL 4</option>
                                            <option value="XI RPL 1" @selected($siswa->kelas == 'XI RPL 1')>XI RPL 1</option>
                                            <option value="XI RPL 2" @selected($siswa->kelas == 'XI RPL 2')>XI RPL 2</option>
                                            <option value="XI RPL 3" @selected($siswa->kelas == 'XI RPL 3')>XI RPL 3</option>
                                            <option value="XI RPL 4" @selected($siswa->kelas == 'XI RPL 4')>XI RPL 4</option>
                                            <option value="XII RPL 1" @selected($siswa->kelas == 'XII RPL 1')>XII RPL 1</option>
                                            <option value="XII RPL 2" @selected($siswa->kelas == 'XII RPL 2')>XII RPL 2</option>
                                            <option value="XII RPL 3" @selected($siswa->kelas == 'XII RPL 3')>XII RPL 3</option>
                                            <option value="XII RPL 4" @selected($siswa->kelas == 'XII RPL 4')>XII RPL 4</option>
                                        </select>
                                    </div>
                                    @error('kelas')
                                        <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                    @enderror

                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <label class="input-label">Password</label>
                                        <div class="input-group">
                                            <input name="password" type="password"
                                                class="form-control custom-input border-end-0"
                                                placeholder="Kosongkan jika tidak dirubah">
                                            <button
                                                class="btn border border-start-0 border-slate-200 bg-slate-50 rounded-end-3 text-muted"
                                                type="button" style="border-radius: 0 0.85rem 0.85rem 0;">
                                                <i class="fa-solid fa-eye-slash small"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Action Buttons - SEJAJAR & SAMA UKURAN -->
                                    <div class="col-12 mt-5">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <a href="{{ url('Admin/DataSiswa') }}" class="btn btn-cancel">
                                                    <i class="fa-solid fa-xmark me-2 d-none d-md-inline"></i>Batal
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-submit">
                                                    <i class="fa-solid fa-check me-2 d-none d-md-inline"></i>Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-5 text-center">
                    <p class="text-muted small">
                        &copy; 2024 <span class="fw-bold text-primary">SarprasCare</span> — Dashboard Admin
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
