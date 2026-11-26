<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - SerKoMu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        :root {
            --bg: #f4f6fb;
            --primary: #4264b5;
            --text: #263454;
            --muted: #5f6b85;            /* kontras 5.3:1 */
            --border: #e8ecf6;
            --radius-sm: 14px;
            --radius-md: 20px;
            --radius-lg: 26px;
            --shadow: 0 6px 20px rgba(40,60,110,.06);
        }
        body { margin: 0; font-family: Arial, sans-serif; color: var(--text); background: var(--bg); }
        a { text-decoration: none; color: inherit; }
        button, input, select { font-family: inherit; }
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible {
            outline: 3px solid rgba(66,100,181,.45); outline-offset: 3px;
        }
        .page-wrap { width: 100%; min-height: 100vh; padding: 24px; }
        .app-shell {
            width: 100%; max-width: 1400px; min-height: calc(100vh - 48px);
            margin: auto; padding: 28px 36px 120px;
            background: #f9faff; border-radius: var(--radius-lg); box-shadow: var(--shadow);
        }

        /* HEADER (sama dengan dashboard) */
        .topbar { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 28px; }
        .back-link {
            display: inline-flex; align-items: center; gap: 8px;
            min-height: 44px; padding: 10px 16px; border-radius: 50px; background: #fff;
            border: 1px solid var(--border); font-size: 13px; font-weight: 700; color: var(--primary);
        }
        .back-link:hover { background: #eef3ff; }

        .page-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; }
        .section-overline { color: var(--muted); font-size: 11px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 4px; }
        .section-title { font-size: 17px; font-weight: 800; margin: 0; }
        .sso-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: #eaf6ef; color: #1f6b3e; font-size: 11px; font-weight: 700;
            padding: 7px 12px; border-radius: 20px; white-space: nowrap;
        }
        .sso-badge .dot { width: 7px; height: 7px; border-radius: 50%; background: #38a36b; }

        .grid { display: grid; grid-template-columns: minmax(0,1.45fr) minmax(320px,1fr); gap: 24px; align-items: start; }
        /* Kolom kanan pendek: ikut turun saat halaman di-scroll agar tidak ada area kosong */
        .column-side { position: sticky; top: 24px; }
        .column { min-width: 0; }

        .alert-success {
            background: #e3f5e9; color: #1f6b3e; border-radius: var(--radius-sm);
            padding: 13px 16px; font-size: 12px; margin-bottom: 18px;
        }
        .alert-error {
            background: #ffe8e8; color: #b03a3a; border-radius: var(--radius-sm);
            padding: 13px 16px; font-size: 12px; margin-bottom: 18px; line-height: 1.6;
        }

        /* KARTU IDENTITAS */
        .identity-card {
            position: relative; overflow: hidden;
            padding: 24px 26px; border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            background: linear-gradient(120deg,#f0f5ff,#fff);
            box-shadow: var(--shadow); margin-bottom: 18px;
            display: flex; align-items: center; gap: 20px;
        }
        .avatar {
            position: relative; flex-shrink: 0;
            width: 74px; height: 74px; border-radius: 50%;
            background: var(--primary); color: #fff;
            display: grid; place-items: center; font-size: 24px; font-weight: 800;
        }
        .avatar .check {
            position: absolute; right: -2px; bottom: -2px;
            width: 24px; height: 24px; border-radius: 50%;
            background: #38a36b; color: #fff; border: 3px solid #fff;
            display: grid; place-items: center; font-size: 11px;
        }
        .identity-info { min-width: 0; }
        .status-chip {
            display: inline-block; background: #e3f5e9; color: #1f6b3e;
            font-size: 11px; font-weight: 700; padding: 5px 10px; border-radius: 20px; margin-bottom: 8px;
        }
        .identity-name { font-size: 22px; font-weight: 800; margin: 0 0 4px; color: #202d4b; overflow-wrap: anywhere; }
        .identity-nim { font-size: 13px; color: var(--muted); margin: 0; }
        .verified-box {
            margin-top: 12px; display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; background: #fff; border: 1px solid var(--border); border-radius: 12px;
        }
        .verified-box i { color: var(--primary); font-size: 18px; }
        .verified-box strong { display: block; font-size: 12px; }
        .verified-box span { font-size: 11px; color: var(--muted); }

        /* STATISTIK PRIBADI */
        .stat-grid { display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: 14px; margin-bottom: 22px; }
        .stat-card {
            display: flex; align-items: center; gap: 13px; padding: 16px 18px;
            background: #fff; border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow);
        }
        .icon-box {
            flex-shrink: 0; width: 44px; height: 44px; border-radius: var(--radius-sm);
            background: #eaf0ff; color: var(--primary); display: grid; place-items: center; font-size: 20px;
        }
        .stat-label { font-size: 12px; color: var(--muted); margin-bottom: 4px; }
        .stat-value { font-size: 16px; font-weight: 800; }

        /* PANEL */
        .panel {
            background: #fff; border: 1px solid var(--border); border-radius: var(--radius-md);
            padding: 20px; margin-bottom: 18px; box-shadow: var(--shadow); min-width: 0;
        }
        /* Field data pribadi: 2 kolom di desktop, Nama selebar penuh */
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
        .field-grid .field { margin-bottom: 0; }
        .field-grid .field-wide { grid-column: 1 / -1; }
        .field {
            display: flex; align-items: center; gap: 13px;
            min-width: 0;
            padding: 12px 14px; margin-bottom: 10px;
            background: #f8f9fc; border: 1px solid transparent; border-radius: var(--radius-sm);
        }
        .field .icon-box { width: 40px; height: 40px; border-radius: 12px; font-size: 17px; background: #eaf0ff; }
        .field-body { flex: 1; min-width: 0; }
        .field-label { font-size: 11.5px; color: var(--muted); margin-bottom: 4px; }
        .field-value { font-size: 14px; font-weight: 700; overflow-wrap: anywhere; }
        .field .lock { color: #8c9ac4; font-size: 14px; }
        .field-editable { background: #f0f5ff; border-color: #e0eaff; }
        .tag-edit { font-size: 10.5px; font-weight: 700; color: #2f4f96; background: #dce9ff; padding: 4px 8px; border-radius: 20px; white-space: nowrap; }

        .btn-soft {
            display: block; width: 100%; min-height: 46px; padding: 12px; margin-top: 12px;
            text-align: center; background: #edf1ff; color: var(--primary);
            border: 0; border-radius: var(--radius-sm); font-size: 13px; font-weight: 800; cursor: pointer;
        }
        .btn-soft:hover { background: #dfe8ff; }
        .btn-primary {
            display: block; width: 100%; min-height: 46px; padding: 12px; text-align: center;
            background: var(--primary); color: #fff; border: 0; border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 800; cursor: pointer;
        }
        .btn-primary:hover { background: #36539b; }
        .note { display: flex; gap: 8px; margin-top: 14px; font-size: 12px; color: var(--muted); line-height: 1.7; }

        /* FORM EDIT PROFIL */
        .edit-form { display: none; margin-top: 12px; }
        .edit-form.open { display: block; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; font-size: 12.5px; font-weight: 700; margin-bottom: 6px; }
        .form-group input,
        .form-group select {
            width: 100%; min-height: 46px; padding: 12px 14px; font-size: 14px; color: var(--text);
            border: 1px solid #dde4f3; border-radius: var(--radius-sm); background: #fff; outline: none;
        }
        .form-group input:focus,
        .form-group select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(66,100,181,.12); }
        .form-group select {
            -webkit-appearance: none; appearance: none; cursor: pointer; padding-right: 40px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 16 16' fill='%235f6b85'%3E%3Cpath d='M1.6 4.6a.75.75 0 0 1 1.06 0L8 9.94l5.34-5.34a.75.75 0 1 1 1.06 1.06L8.53 11.6a.75.75 0 0 1-1.06 0L1.6 5.66a.75.75 0 0 1 0-1.06z'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 14px center;
        }
        .form-group .is-invalid { border-color: #cf5555; }
        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 0 12px; }
        .form-hint { font-size: 11.5px; color: var(--muted); margin-top: 5px; }
        .form-error { font-size: 11.5px; color: #b03a3a; margin-top: 5px; }
        .form-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

        /* MENU PENGATURAN */
        .menu-item {
            display: flex; align-items: center; gap: 13px; padding: 14px 4px;
            min-height: 64px;
            border-bottom: 1px solid var(--border); border-radius: 4px;
        }
        .menu-item:last-child { border-bottom: 0; padding-bottom: 0; }
        .menu-item:first-child { padding-top: 0; }
        .menu-item:hover .menu-title { color: var(--primary); }
        .menu-body { flex: 1; min-width: 0; }
        .menu-title { font-size: 14px; font-weight: 800; margin-bottom: 4px; }
        .menu-desc { font-size: 12px; color: var(--muted); line-height: 1.5; }
        .menu-arrow { color: #8c9ac4; }

        /* DARURAT */
        .emergency-card {
            display: flex; align-items: center; gap: 13px; padding: 16px;
            background: #fff5f4; border: 1px solid #f6dcda; border-radius: var(--radius-md); margin-bottom: 14px;
        }
        .emergency-card .icon-box { background: #ffe3e0; color: #a33d31; }
        .emergency-card strong { display: block; font-size: 13px; color: #a33d31; margin-bottom: 4px; }
        .emergency-card span { font-size: 12px; color: #6e4f4d; line-height: 1.5; }
        .btn-call {
            flex-shrink: 0; display: inline-flex; align-items: center; min-height: 44px;
            padding: 10px 18px; background: #a94339; color: #fff;
            border-radius: var(--radius-sm); font-size: 13px; font-weight: 700;
        }
        .btn-call:hover { background: #913d35; }
        .btn-logout {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; min-height: 48px; padding: 14px; border: 0; border-radius: var(--radius-sm);
            background: #fbe4e1; color: #a33d31; font-size: 13px; font-weight: 800; cursor: pointer;
        }
        .btn-logout:hover { background: #f6d3cf; }
        .app-version { text-align: center; margin-top: 18px; font-size: 12px; color: var(--muted); line-height: 1.7; }

        /* NAVIGASI BAWAH (sama dengan dashboard) */
        .bottom-nav {
            position: fixed; z-index: 1000; bottom: 16px; left: 50%; transform: translateX(-50%);
            display: flex; justify-content: space-around; align-items: center;
            width: min(650px,calc(100% - 32px)); min-height: 68px; padding: 7px;
            border: 1px solid var(--border); border-radius: 50px;
            background: rgba(255,255,255,.98); box-shadow: 0 12px 35px rgba(35,55,100,.14);
        }
        .nav-item-custom {
            flex: 1 1 0; min-width: 0; min-height: 52px;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            gap: 4px; text-align: center; padding: 5px 3px; color: var(--muted);
            border-radius: 35px; font-size: 11.5px; white-space: nowrap;
            transition: background .2s,color .2s;
        }
        .nav-item-custom i { display: block; font-size: 19px; }
        .nav-item-custom:hover { background: #f3f6ff; color: var(--primary); }
        .nav-item-custom.active { background: #edf2ff; color: var(--primary); font-weight: 800; }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .page-wrap { padding: 14px; }
            .app-shell { padding: 24px 22px 120px; }
            .grid { grid-template-columns: 1fr; }
            .column-side { position: static; }
        }
        @media (max-width: 600px) {
            .page-wrap { padding: 0; }
            .app-shell { min-height: 100vh; border-radius: 0; padding: 17px 16px 125px; box-shadow: none; }
            .topbar { margin-bottom: 20px; }
            .field-grid { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .back-link span { display: none; }
            .back-link { padding: 10px 12px; }
            .identity-card { padding: 20px 16px; gap: 14px; border-radius: 23px; }
            .avatar { width: 62px; height: 62px; font-size: 20px; }
            .identity-name { font-size: 18px; }
            .stat-card { padding: 13px; gap: 10px; }
            .icon-box { width: 40px; height: 40px; }
            .panel { padding: 16px; }
            .emergency-card { flex-wrap: wrap; }
            .btn-call { margin-left: auto; }
            .bottom-nav { bottom: 9px; width: calc(100% - 20px); padding: 6px; min-height: 62px; }
            .nav-item-custom { font-size: 11px; padding: 5px 2px; min-height: 48px; }
            .nav-item-custom i { font-size: 17px; }
        }
    </style>
</head>
<body>
@php
    $user = auth()->user();
    $emergencyPhone = config('serkomu.emergency_phone');
    $initials = collect(preg_split('/\s+/', trim($user->name)))
        ->take(2)
        ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
        ->implode('');
@endphp

<div class="page-wrap">
<main class="app-shell">

    <!-- HEADER -->
    <header class="topbar">
        <x-brand-logo :href="route('mahasiswa.dashboard')" />
        <a href="{{ route('mahasiswa.dashboard') }}" class="back-link" aria-label="Kembali ke Beranda">
            <i class="bi bi-arrow-left" aria-hidden="true"></i> <span>Kembali ke Beranda</span>
        </a>
    </header>

    <div class="page-head">
        <div>
            <div class="section-overline">Akun Mahasiswa</div>
            <h1 class="section-title">Profil Saya</h1>
        </div>
        @if($user->isSSO())
        <div class="sso-badge"><span class="dot"></span> SSO Aktif</div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div><i class="bi bi-exclamation-circle"></i> {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="grid">

        <!-- KOLOM KIRI -->
        <div class="column">

            <!-- IDENTITAS -->
            <section class="identity-card">
                <div class="avatar">
                    {{ $initials }}
                    <span class="check"><i class="bi bi-check-lg"></i></span>
                </div>
                <div class="identity-info">
                    <span class="status-chip">Mahasiswa Aktif</span>
                    <h2 class="identity-name">{{ $user->name }}</h2>
                    <p class="identity-nim">NIM: {{ $user->nim ?? '-' }}</p>
                    @if($user->isSSO())
                    <div class="verified-box">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <strong>Akun Terverifikasi SSO</strong>
                            <span>Telkom University Integrated Portal</span>
                        </div>
                    </div>
                    @endif
                </div>
            </section>

            <!-- RINGKASAN PRIBADI -->
            <section class="stat-grid">
                <div class="stat-card">
                    <div class="icon-box"><i class="bi bi-file-earmark-check"></i></div>
                    <div>
                        <div class="stat-label">Laporan Selesai</div>
                        <div class="stat-value">{{ $totalLaporanSelesai ?? 0 }} Selesai</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon-box"><i class="bi bi-hospital"></i></div>
                    <div>
                        <div class="stat-label">Klinik Kampus</div>
                        <div class="stat-value">
                            {{ ($totalKunjungan ?? 0) > 0 ? $totalKunjungan.' Kunjungan' : 'Terdaftar' }}
                        </div>
                    </div>
                </div>
            </section>

            <!-- INFORMASI PRIBADI -->
            <div class="page-head">
                <div>
                    <div class="section-overline">Data Akademik Resmi</div>
                    <h2 class="section-title">Informasi Pribadi</h2>
                </div>
            </div>

            <section class="panel">
              <div class="field-grid">
                <div class="field field-wide">
                    <div class="icon-box"><i class="bi bi-person-vcard"></i></div>
                    <div class="field-body">
                        <div class="field-label">Nama Lengkap</div>
                        <div class="field-value">{{ $user->name }}</div>
                    </div>
                    <i class="bi bi-lock lock" role="img" aria-label="Tidak dapat diubah"></i>
                </div>
                <div class="field">
                    <div class="icon-box"><i class="bi bi-hash"></i></div>
                    <div class="field-body">
                        <div class="field-label">NIM</div>
                        <div class="field-value">{{ $user->nim ?? '-' }}</div>
                    </div>
                    <i class="bi bi-lock lock" role="img" aria-label="Tidak dapat diubah"></i>
                </div>
                <div class="field">
                    <div class="icon-box"><i class="bi bi-at"></i></div>
                    <div class="field-body">
                        <div class="field-label">Email Mahasiswa</div>
                        <div class="field-value">{{ $user->email }}</div>
                    </div>
                    <i class="bi bi-lock lock" role="img" aria-label="Tidak dapat diubah"></i>
                </div>
                <div class="field {{ $user->isSSO() ? '' : 'field-editable' }}">
                    <div class="icon-box"><i class="bi bi-mortarboard"></i></div>
                    <div class="field-body">
                        <div class="field-label">Program Studi</div>
                        <div class="field-value">{{ $user->program_studi ?: 'Belum diisi' }}</div>
                    </div>
                    @if($user->isSSO())
                        <i class="bi bi-lock lock" role="img" aria-label="Tidak dapat diubah"></i>
                    @else
                        <span class="tag-edit">Dapat Diubah</span>
                    @endif
                </div>
                <div class="field {{ $user->isSSO() ? '' : 'field-editable' }}">
                    <div class="icon-box"><i class="bi bi-building"></i></div>
                    <div class="field-body">
                        <div class="field-label">Fakultas</div>
                        <div class="field-value">{{ $user->fakultas ?: 'Belum diisi' }}</div>
                    </div>
                    @if($user->isSSO())
                        <i class="bi bi-lock lock" role="img" aria-label="Tidak dapat diubah"></i>
                    @else
                        <span class="tag-edit">Dapat Diubah</span>
                    @endif
                </div>

                <!-- Kontak yang boleh diubah -->
                <div class="field field-editable">
                    <div class="icon-box"><i class="bi bi-telephone"></i></div>
                    <div class="field-body">
                        <div class="field-label">Nomor Telepon</div>
                        <div class="field-value">{{ $user->phone ?: 'Belum diisi' }}</div>
                    </div>
                    <span class="tag-edit">Dapat Diubah</span>
                </div>
                <div class="field field-editable">
                    <div class="icon-box"><i class="bi bi-whatsapp"></i></div>
                    <div class="field-body">
                        <div class="field-label">WhatsApp</div>
                        <div class="field-value">{{ $user->whatsapp ?: 'Belum diisi' }}</div>
                    </div>
                    <span class="tag-edit">Dapat Diubah</span>
                </div>
              </div>

                <button type="button" class="btn-soft" id="toggleEdit">
                    <i class="bi bi-pencil" aria-hidden="true"></i> {{ $user->isSSO() ? 'Edit Kontak' : 'Edit Profil' }}
                </button>

                <form action="{{ route('mahasiswa.akun.update') }}" method="POST"
                      class="edit-form {{ $errors->any() ? 'open' : '' }}" id="editForm">
                    @csrf
                    @method('PUT')
                    @unless($user->isSSO())
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fakultas">Fakultas</label>
                            <select id="fakultas" name="fakultas" class="{{ $errors->has('fakultas') ? 'is-invalid' : '' }}" required>
                                <option value="" disabled {{ old('fakultas', $user->fakultas) ? '' : 'selected' }}>Pilih fakultas</option>
                                @foreach(config('serkomu.fakultas_list', []) as $fakultas)
                                    <option value="{{ $fakultas }}" {{ old('fakultas', $user->fakultas) === $fakultas ? 'selected' : '' }}>{{ $fakultas }}</option>
                                @endforeach
                            </select>
                            @error('fakultas') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="program_studi">Program Studi</label>
                            <input type="text" id="program_studi" name="program_studi" maxlength="100"
                                   class="{{ $errors->has('program_studi') ? 'is-invalid' : '' }}"
                                   value="{{ old('program_studi', $user->program_studi) }}" placeholder="Contoh: Sistem Informasi" required>
                            @error('program_studi') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    @endunless
                    <div class="form-grid">
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone"
                               value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 0812-3456-7890">
                        @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">WhatsApp</label>
                        <input type="tel" id="whatsapp" name="whatsapp"
                               value="{{ old('whatsapp', $user->whatsapp) }}" placeholder="Contoh: 0812-3456-7890">
                        <div class="form-hint">Digunakan petugas untuk menghubungi Anda terkait laporan.</div>
                        @error('whatsapp') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-soft" id="cancelEdit" style="margin-top:0">Batal</button>
                        <button type="submit" class="btn-primary">Simpan</button>
                    </div>
                </form>

                <div class="note">
                    <i class="bi bi-info-circle"></i>
                    @if($user->isSSO())
                        <span>Program studi dan fakultas mengikuti data SSO kampus. Anda dapat memperbarui nomor telepon dan WhatsApp.</span>
                    @else
                        <span>Anda dapat memperbarui program studi, fakultas, nomor telepon, dan WhatsApp. Nama, NIM, dan email mengikuti data akun.</span>
                    @endif
                </div>
            </section>
        </div>

        <!-- KOLOM KANAN -->
        <div class="column column-side">

            <div class="page-head">
                <div>
                    <div class="section-overline">Pengaturan</div>
                    <h2 class="section-title">Akun & Layanan</h2>
                </div>
            </div>

            <section class="panel">
                <a href="{{ route('mahasiswa.akun.password.form') }}" class="menu-item">
                    <div class="icon-box"><i class="bi bi-key"></i></div>
                    <div class="menu-body">
                        <div class="menu-title">Ubah Kata Sandi</div>
                        <div class="menu-desc">Kelola kredensial SSO Telkom University</div>
                    </div>
                    <i class="bi bi-chevron-right menu-arrow"></i>
                </a>
                <a href="{{ route('panduan-bantuan') }}" class="menu-item">
                    <div class="icon-box"><i class="bi bi-question-circle"></i></div>
                    <div class="menu-body">
                        <div class="menu-title">Bantuan dan Panduan</div>
                        <div class="menu-desc">FAQ, alur penanganan darurat & kontak operator</div>
                    </div>
                    <i class="bi bi-chevron-right menu-arrow"></i>
                </a>
                <a href="#" class="menu-item">
                    <div class="icon-box"><i class="bi bi-shield-lock"></i></div>
                    <div class="menu-body">
                        <div class="menu-title">Kebijakan Privasi</div>
                        <div class="menu-desc">Perlindungan data medis & laporan insiden</div>
                    </div>
                    <i class="bi bi-chevron-right menu-arrow"></i>
                </a>
            </section>

            <section class="emergency-card">
                <div class="icon-box"><i class="bi bi-bell"></i></div>
                <div style="flex:1;min-width:0">
                    <strong>Saluran Darurat Siaga</strong>
                    <span>Klinik & Security Kampus siaga 24/7 untuk insiden genting.</span>
                </div>
                @if($emergencyPhone)
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $emergencyPhone) }}" class="btn-call">Panggil</a>
                @else
                    <a href="{{ route('kontak-darurat') }}" class="btn-call">Kontak</a>
                @endif
            </section>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Keluar Akun
                </button>
            </form>

            <div class="app-version">
                SerKoMu v1.0 • Capstone Prototype InnovATE<br>
                Telkom University Health & Incident Desk
            </div>
        </div>
    </div>
</main>
</div>

<!-- BOTTOM NAVIGATION -->
<nav class="bottom-nav" aria-label="Navigasi utama">
    <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item-custom">
        <i class="bi bi-house-door"></i> Beranda
    </a>
    <a href="{{ route('emergency-reports.create') }}" class="nav-item-custom">
        <i class="bi bi-megaphone"></i> Lapor
    </a>
    <a href="{{ route('mahasiswa.klinik') }}" class="nav-item-custom">
        <i class="bi bi-hospital"></i> Klinik
    </a>
    <a href="{{ route('mahasiswa.akun') }}" class="nav-item-custom active" aria-current="page">
        <i class="bi bi-person-fill"></i> Profil
    </a>
</nav>

<script>
    const form = document.getElementById('editForm');
    const toggle = document.getElementById('toggleEdit');
    toggle.addEventListener('click', () => {
        form.classList.add('open');
        toggle.style.display = 'none';
    });
    document.getElementById('cancelEdit').addEventListener('click', () => {
        form.classList.remove('open');
        toggle.style.display = 'block';
    });
    if (form.classList.contains('open')) toggle.style.display = 'none';
</script>
</body>
</html>