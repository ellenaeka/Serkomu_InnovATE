<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kata Sandi - SerKoMu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        :root {
            --bg: #f4f6fb; --primary: #4264b5; --text: #263454;
            --muted: #5f6b85; --border: #e8ecf6; --shadow: 0 6px 20px rgba(40,60,110,.06);
            --radius-sm: 14px; --radius-md: 20px; --radius-lg: 26px;
        }
        body { margin: 0; font-family: Arial, sans-serif; color: var(--text); background: var(--bg); }
        a { text-decoration: none; color: inherit; }
        button, input { font-family: inherit; }
        a:focus-visible, button:focus-visible, input:focus-visible {
            outline: 3px solid rgba(66,100,181,.45); outline-offset: 3px;
        }
        .page-wrap { width: 100%; min-height: 100vh; padding: 24px; }
        .app-shell {
            width: 100%; max-width: 760px; min-height: calc(100vh - 48px);
            margin: auto; padding: 26px 32px 48px;
            background: #f9faff; border-radius: var(--radius-lg); box-shadow: var(--shadow);
        }
        .topbar { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; gap: 12px; margin-bottom: 18px; }
        .topbar .sk-logo { justify-self: end; }
        .back-link {
            justify-self: start;
            display: inline-flex; align-items: center; gap: 8px; min-height: 44px; padding: 10px 16px;
            border-radius: 50px; background: #fff; border: 1px solid var(--border);
            font-size: 13px; font-weight: 700; color: var(--primary);
        }
        .back-link:hover { background: #eef3ff; }
        .topbar h1 { font-size: 17px; font-weight: 800; margin: 0; text-align: center; }

        .hero {
            text-align: center; padding: 24px 22px; border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            background: linear-gradient(120deg,#f0f5ff,#fff); box-shadow: var(--shadow); margin-bottom: 16px;
        }
        .hero-icon {
            position: relative; width: 64px; height: 64px; margin: 0 auto 14px;
            border-radius: 50%; background: #e3ecff; color: var(--primary);
            display: grid; place-items: center; font-size: 28px;
        }
        .hero-icon::after {
            content: ""; position: absolute; right: 2px; bottom: 2px; width: 12px; height: 12px;
            border-radius: 50%; background: #38a36b; border: 2px solid #fff;
        }
        .chip { display: inline-block; background: #e7efff; color: #34497a; font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 30px; margin-bottom: 10px; }
        .hero p { margin: 0 auto; max-width: 440px; font-size: 14px; line-height: 1.65; color: var(--muted); }

        .panel {
            background: #fff; border: 1px solid var(--border); border-radius: var(--radius-md);
            padding: 20px; margin-bottom: 16px; box-shadow: var(--shadow);
        }
        .panel-title { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 800; margin: 0 0 14px; }
        .panel-title i { color: var(--primary); font-size: 18px; }
        .panel-sub { font-size: 12px; color: var(--muted); margin: -8px 0 14px 28px; }

        .row {
            display: flex; justify-content: space-between; align-items: center; gap: 10px;
            padding: 12px 14px; background: #f8f9fc; border-radius: 12px; margin-bottom: 8px;
        }
        .row .label { font-size: 11.5px; color: var(--muted); margin-bottom: 4px; }
        .row .value { font-size: 14px; font-weight: 700; overflow-wrap: anywhere; }
        .pill { font-size: 11px; font-weight: 700; padding: 5px 10px; border-radius: 20px; background: #e3f5e9; color: #1f6b3e; white-space: nowrap; }

        .tip { display: flex; gap: 12px; padding: 13px 14px; background: #f8f9fc; border-radius: 12px; margin-bottom: 8px; }
        .tip-num {
            flex-shrink: 0; width: 26px; height: 26px; border-radius: 50%;
            background: #eaf0ff; color: var(--primary); font-size: 11px; font-weight: 800;
            display: grid; place-items: center;
        }
        .tip p { margin: 0; font-size: 13px; line-height: 1.6; color: #44526d; }

        .privacy { background: #f0f3ff; border-color: #e0e7fb; }
        .privacy strong { display: block; font-size: 13px; margin-bottom: 8px; color: #2f4f96; }
        .privacy p { margin: 0; font-size: 13px; line-height: 1.65; color: #4f5f8a; }

        .btn-primary {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; min-height: 48px; padding: 14px; background: var(--primary); color: #fff;
            border: 0; border-radius: var(--radius-sm); font-size: 14px; font-weight: 800; cursor: pointer;
        }
        .btn-primary:hover { background: #36539b; }
        .btn-ghost {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; min-height: 48px; margin-top: 10px; padding: 12px; text-align: center;
            background: #fff; border: 1px solid var(--border); color: var(--primary);
            border-radius: var(--radius-sm); font-size: 14px; font-weight: 700;
        }

        .form-group { margin-bottom: 14px; }
        .form-group label { display: block; font-size: 12.5px; font-weight: 700; margin-bottom: 6px; }
        .form-group input { width: 100%; min-height: 46px; padding: 12px 14px; font-size: 14px; color: var(--text); border: 1px solid #dde4f3; border-radius: var(--radius-sm); background: #fff; outline: none; }
        .form-group input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(66,100,181,.12); }
        .form-hint { font-size: 11.5px; color: var(--muted); margin-top: 5px; }
        .alert-error { background: #ffe8e8; color: #b03a3a; border-radius: 12px; padding: 12px 14px; font-size: 12px; margin-bottom: 14px; line-height: 1.6; }

        /* MODAL */
        .modal-backdrop {
            position: fixed; inset: 0; z-index: 2000; display: none;
            align-items: center; justify-content: center; padding: 20px;
            background: rgba(32,45,75,.45);
        }
        .modal-backdrop.open { display: flex; }
        .modal {
            position: relative; width: 100%; max-width: 360px; padding: 28px 24px 24px;
            background: #fff; border-radius: 22px; text-align: center; box-shadow: 0 20px 50px rgba(35,55,100,.25);
        }
        .modal-close { position: absolute; top: 10px; right: 10px; width: 44px; height: 44px; border-radius: 50%; background: none; border: 0; font-size: 16px; color: var(--muted); cursor: pointer; }
        .modal-close:hover { background: #f0f4ff; }
        .modal .hero-icon { width: 52px; height: 52px; font-size: 24px; }
        .modal .hero-icon::after { display: none; }
        .modal h3 { margin: 0 0 10px; font-size: 16px; color: var(--primary); }
        .modal p { margin: 0 0 18px; font-size: 13px; line-height: 1.65; color: var(--muted); }

        @media (max-width: 600px) {
            .page-wrap { padding: 0; }
            .app-shell { min-height: 100vh; border-radius: 0; padding: 17px 16px 40px; box-shadow: none; }
            .topbar { grid-template-columns: auto 1fr; }
            .topbar .sk-logo { display: none; }
            .topbar h1 { text-align: left; }
        }
    </style>
</head>
<body>
@php
    $user = auth()->user();
    $ssoUrl = config('serkomu.sso_password_url');
@endphp

<div class="page-wrap">
<main class="app-shell">

    <header class="topbar">
        <a href="{{ route('mahasiswa.akun') }}" class="back-link" aria-label="Kembali ke Profil"><i class="bi bi-arrow-left" aria-hidden="true"></i> Profil</a>
        <h1>Ubah Kata Sandi</h1>
        <x-brand-logo size="sm" subtitle="" :href="route('mahasiswa.dashboard')" />
    </header>

    <section class="hero">
        <div class="hero-icon"><i class="bi bi-shield-fill-check"></i></div>
        <span class="chip"><i class="bi bi-lock"></i> Keamanan Akun SSO</span>
        @if($user->isSSO())
        <p>Kata sandi akun mahasiswa dikelola terpusat melalui sistem SSO Telkom University.</p>
        @else
        <p>Perbarui kata sandi akun SerKoMu Anda secara berkala untuk menjaga keamanan data.</p>
        @endif
    </section>

    @if($user->isSSO())
    <section class="panel">
        <h2 class="panel-title"><i class="bi bi-person-badge"></i> Informasi Akun Terhubung</h2>
        <div class="row">
            <div>
                <div class="label">Tipe Akun</div>
                <div class="value">Akun Mahasiswa SSO</div>
            </div>
            <span class="pill">Aktif</span>
        </div>
        <div class="row">
            <div>
                <div class="label">Email Mahasiswa</div>
                <div class="value">{{ $user->email }}</div>
            </div>
        </div>
        <div class="row">
            <div>
                <div class="label">Status Autentikasi</div>
                <div class="value">Terverifikasi</div>
            </div>
            <span class="pill"><i class="bi bi-check-circle-fill"></i> Valid</span>
        </div>
    </section>

    @endif

    <section class="panel">
        <h2 class="panel-title"><i class="bi bi-shield-check"></i> Panduan Keamanan Kata Sandi</h2>
        <div class="panel-sub">Standar proteksi identitas digital kampus</div>
        <div class="tip">
            <div class="tip-num">1</div>
            <p>Gunakan kombinasi minimal <strong>8 karakter</strong> dengan huruf besar, huruf kecil, angka, dan simbol.</p>
        </div>
        <div class="tip">
            <div class="tip-num">2</div>
            <p>Hindari menggunakan kata sandi yang sama pada berbagai akun media sosial atau portal lain.</p>
        </div>
        <div class="tip">
            <div class="tip-num">3</div>
            <p>Jangan pernah membagikan informasi kredensial login SSO kepada siapa pun, termasuk staf kampus.</p>
        </div>
    </section>

    @if($user->isSSO())
    <section class="panel privacy">
        <strong><i class="bi bi-info-circle"></i> Informasi Privasi & Kredensial</strong>
        <p>Pengubahan kata sandi dilakukan melalui layanan resmi universitas, bukan langsung di SerKomU. SerKomU tidak menyimpan kredensial kata sandi mahasiswa demi menjaga kerahasiaan data Anda.</p>
    </section>
    @endif

    @if($user->isSSO())
    @if($ssoUrl)
        <a href="{{ $ssoUrl }}" target="_blank" rel="noopener" class="btn-primary">
            Kelola Kata Sandi melalui SSO <i class="bi bi-box-arrow-up-right"></i>
        </a>
    @else
        <button type="button" class="btn-primary" id="openModal">
            Kelola Kata Sandi melalui SSO <i class="bi bi-box-arrow-up-right"></i>
        </button>
    @endif
    @else
    <form action="{{ route('mahasiswa.akun.password') }}" method="POST" class="panel">
        @csrf
        @method('PUT')
        <h2 class="panel-title"><i class="bi bi-key"></i> Ganti Kata Sandi</h2>
        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <div><i class="bi bi-exclamation-circle"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif
        <div class="form-group">
            <label for="current_password">Kata Sandi Lama</label>
            <input type="password" id="current_password" name="current_password" autocomplete="current-password" required>
        </div>
        <div class="form-group">
            <label for="password">Kata Sandi Baru</label>
            <input type="password" id="password" name="password" autocomplete="new-password" required>
            <div class="form-hint">Minimal 8 karakter.</div>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required>
        </div>
        <button type="submit" class="btn-primary">Simpan Kata Sandi</button>
    </form>
    @endif
    <a href="{{ route('mahasiswa.akun') }}" class="btn-ghost"><i class="bi bi-arrow-left"></i> Kembali ke Profil</a>
</main>
</div>

<!-- MODAL (tampil jika URL SSO belum dikonfigurasi / mode prototype) -->
<div class="modal-backdrop" id="modal">
    <div class="modal">
        <button type="button" class="modal-close" id="closeModal" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
        <div class="hero-icon"><i class="bi bi-shield-fill-check"></i></div>
        <h3>Pengelolaan Kata Sandi</h3>
        <p>Perubahan kata sandi dilakukan melalui layanan SSO resmi Telkom University untuk menjaga keamanan akun mahasiswa.</p>
        <button type="button" class="btn-primary" id="okModal">Mengerti</button>
    </div>
</div>

<script>
    const modal = document.getElementById('modal');
    const openBtn = document.getElementById('openModal');
    if (openBtn) openBtn.addEventListener('click', () => modal.classList.add('open'));
    ['closeModal', 'okModal'].forEach(id =>
        document.getElementById(id).addEventListener('click', () => modal.classList.remove('open')));
    modal.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('open'); });
</script>
</body>
</html>