<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SerKoMu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        :root {
            --bg: #f4f6fb; --primary: #4264b5; --text: #263454;
            --muted: #5f6b85; --border: #e8ecf6; --shadow: 0 8px 25px rgba(40,60,110,.06);
        }
        body {
            margin: 0; min-height: 100vh;
            font-family: Arial, sans-serif; color: var(--text);
            background: linear-gradient(180deg,#f0f5ff,#f9faff);
            display: flex; align-items: center; justify-content: center;
            padding: 24px; line-height: 1.5;
        }
        a { text-decoration: none; color: inherit; }
        button, input, select { font-family: inherit; }
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible {
            outline: 3px solid rgba(66,100,181,.35); outline-offset: 2px;
        }
        .wrap { width: 100%; max-width: 440px; }
        .brand { display: flex; justify-content: center; margin-bottom: 24px; }
        .card {
            background: #fff; border: 1px solid var(--border);
            border-radius: 26px; padding: 30px 26px; box-shadow: var(--shadow);
        }
        .card h1 { margin: 0 0 6px; font-size: 20px; font-weight: 800; text-align: center; }
        .card .lead { margin: 0 0 22px; font-size: 13px; color: var(--muted); text-align: center; }
        .form-group { margin-bottom: 14px; }
        .form-group label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input-wrap > i.lead-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: #98a4bd; font-size: 15px; pointer-events: none;
        }
        .input-wrap input,
        .input-wrap select {
            width: 100%; min-height: 46px; padding: 12px 14px 12px 40px; font-size: 14px; color: var(--text);
            border: 1px solid #dde4f3; border-radius: 14px; background: #fff; outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .input-wrap input:focus,
        .input-wrap select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(66,100,181,.12); }
        .input-wrap input.is-invalid,
        .input-wrap select.is-invalid { border-color: #cf5555; }
        .input-wrap select {
            -webkit-appearance: none; appearance: none;
            padding-right: 40px; cursor: pointer;
        }
        .input-wrap select:invalid { color: #8a94ab; }
        .input-wrap select option { color: var(--text); }
        .input-wrap > i.trail-icon {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            color: #98a4bd; font-size: 13px; pointer-events: none;
        }
        .toggle-pass {
            position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
            border: 0; background: none; color: #98a4bd; font-size: 16px;
            width: 40px; height: 40px; cursor: pointer; border-radius: 10px;
        }
        .toggle-pass:hover { color: var(--primary); background: #f0f5ff; }
        .has-toggle input { padding-right: 46px; }
        .hint { font-size: 12px; color: var(--muted); margin-top: 5px; }
        .error { font-size: 12px; color: #b03a3a; margin-top: 5px; }
        .btn-primary {
            display: block; width: 100%; min-height: 48px; margin-top: 6px; padding: 14px;
            background: var(--primary); color: #fff; border: 0; border-radius: 14px;
            font-size: 14px; font-weight: 800; cursor: pointer; transition: background .2s;
        }
        .btn-primary:hover { background: #36539b; }
        .alt { text-align: center; margin-top: 18px; font-size: 13px; color: var(--muted); }
        .alt a { color: var(--primary); font-weight: 700; }
        .alt a:hover { text-decoration: underline; }
        .notice {
            display: flex; gap: 8px; margin-top: 16px; padding: 12px 14px;
            background: #f0f3ff; border-radius: 12px;
            font-size: 12px; color: #4f5f8a; line-height: 1.6;
        }
        @media (max-width: 480px) {
            body { padding: 16px; align-items: flex-start; }
            .card { padding: 24px 18px; }
        }
    </style>
</head>
<body>
<div class="wrap">

    <div class="brand">
        <x-brand-logo size="lg" align="center" subtitle="Student Health Assistance" />
    </div>

    <div class="card">
        <h1>Buat Akun Mahasiswa</h1>
        <p class="lead">Daftar untuk mengakses layanan kesehatan dan pelaporan darurat kampus.</p>

        <form action="{{ route('register.process') }}" method="POST" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrap">
                    <i class="bi bi-person lead-icon"></i>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                           placeholder="Nama sesuai KTM" autocomplete="name" required>
                </div>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="nim">NIM</label>
                <div class="input-wrap">
                    <i class="bi bi-hash lead-icon"></i>
                    <input type="text" id="nim" name="nim" value="{{ old('nim') }}"
                           class="{{ $errors->has('nim') ? 'is-invalid' : '' }}"
                           placeholder="Contoh: 102022300199" inputmode="numeric" required>
                </div>
                @error('nim') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="fakultas">Fakultas</label>
                <div class="input-wrap">
                    <i class="bi bi-building lead-icon" aria-hidden="true"></i>
                    <select id="fakultas" name="fakultas"
                            class="{{ $errors->has('fakultas') ? 'is-invalid' : '' }}" required>
                        <option value="" disabled {{ old('fakultas') ? '' : 'selected' }}>Pilih fakultas</option>
                        @foreach(config('serkomu.fakultas_list', []) as $fakultas)
                            <option value="{{ $fakultas }}" {{ old('fakultas') === $fakultas ? 'selected' : '' }}>{{ $fakultas }}</option>
                        @endforeach
                    </select>
                    <i class="bi bi-chevron-down trail-icon" aria-hidden="true"></i>
                </div>
                @error('fakultas') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="program_studi">Program Studi</label>
                <div class="input-wrap">
                    <i class="bi bi-mortarboard lead-icon" aria-hidden="true"></i>
                    <input type="text" id="program_studi" name="program_studi" value="{{ old('program_studi') }}"
                           class="{{ $errors->has('program_studi') ? 'is-invalid' : '' }}"
                           placeholder="Contoh: Sistem Informasi" maxlength="100" required>
                </div>
                @error('program_studi') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Mahasiswa</label>
                <div class="input-wrap">
                    <i class="bi bi-envelope lead-icon"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="nama@student.telkomuniversity.ac.id" autocomplete="email" required>
                </div>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrap has-toggle">
                    <i class="bi bi-lock lead-icon"></i>
                    <input type="password" id="password" name="password"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="Minimal 8 karakter" autocomplete="new-password" required>
                    <button type="button" class="toggle-pass" data-target="password" aria-label="Tampilkan kata sandi">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-wrap has-toggle">
                    <i class="bi bi-shield-lock lead-icon"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           placeholder="Ulangi kata sandi" autocomplete="new-password" required>
                    <button type="button" class="toggle-pass" data-target="password_confirmation" aria-label="Tampilkan kata sandi">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-primary">Daftar</button>
        </form>

        <div class="alt">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>

        <div class="notice">
            <i class="bi bi-info-circle"></i>
            <span>Data Anda digunakan hanya untuk layanan SerKoMu dan dilindungi sesuai kebijakan privasi kampus.</span>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-pass').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = document.getElementById(btn.dataset.target);
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.querySelector('i').className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    });
</script>
</body>
</html>