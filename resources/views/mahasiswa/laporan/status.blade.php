
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Laporan - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --primary: #0861bb;
            --blue: #1264bd;
            --bg: #f7f8ff;
            --text: #1d2c49;
            --muted: #778198;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef1fa;
            color: var(--text);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .app {
            position: relative;
            width: 100%;
            max-width: 1400px;
            min-height: 100vh;
            margin: 0 auto;
            padding: 0 32px 120px;
            background: var(--bg);
            overflow: hidden;
        }

        /* HEADER */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 0;
            border-bottom: 1px solid #edf0f7;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .brand-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e5edff;
            color: var(--primary);
            border-radius: 50%;
            font-size: 18px;
        }

        .brand-name {
            color: var(--primary);
            font-weight: 800;
            font-size: 16px;
        }

        .brand-subtitle {
            font-size: 9px;
            color: var(--muted);
            margin-top: 2px;
        }

        .profile-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            font-size: 14px;
        }

        /* PAGE TITLE */

        .page-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 12px 0;
        }

        .back-btn {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eaf0ff;
            color: var(--primary);
            border-radius: 50%;
            font-size: 17px;
        }

        .page-heading h1 {
            font-size: 16px;
            margin: 0 0 3px;
            font-weight: 800;
        }

        .page-heading p {
            font-size: 10px;
            margin: 0;
            color: var(--muted);
        }

        .intro {
            font-size: 12px;
            color: #68748c;
            line-height: 1.6;
            margin: 12px 0 15px;
        }

        /* TRACKING CARD */

        .tracking-card {
            background: white;
            padding: 15px 13px;
            border-radius: 19px;
            box-shadow: 0 5px 18px rgba(40,60,110,.06);
            margin-bottom: 17px;
        }

        .tracking-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-bottom: 9px;
        }

        .tracking-heading label {
            font-size: 10px;
            font-weight: 800;
            color: #315b9c;
            letter-spacing: .5px;
        }

        .privacy {
            color: #6d7890;
            font-size: 9px;
            white-space: nowrap;
        }

        .privacy i {
            color: var(--primary);
            margin-right: 3px;
        }

        .search-row {
            display: flex;
            align-items: stretch;
            gap: 7px;
        }

        .input-wrap {
            position: relative;
            flex: 1;
            min-width: 0;
        }

        .input-wrap i {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #7b879c;
            font-size: 13px;
        }

        .input-wrap input {
            width: 100%;
            height: 42px;
            padding: 0 8px 0 33px;
            border: 1px solid transparent;
            border-radius: 11px;
            background: #f0f3fc;
            outline: none;
            color: var(--text);
            font-size: 11px;
        }

        .input-wrap input:focus {
            border-color: #7da9e8;
            background: #f6f8ff;
        }

        .input-wrap input::placeholder {
            color: #a2aabd;
        }

        .btn-search {
            min-width: 74px;
            height: 42px;
            padding: 0 13px;
            border: none;
            border-radius: 11px;
            background: #1261b7;
            color: white;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(18,97,183,.20);
        }

        .btn-search:hover {
            background: #084e9a;
        }

        .error {
            margin-top: 8px;
            font-size: 11px;
            color: #c0392b;
        }

        /* TRACKING RESULT */

        .result-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin: 19px 2px 0;
        }

        .result-title {
            color: #0861bb;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .verified {
            background: #e7f6ef;
            color: #168252;
            border-radius: 20px;
            padding: 5px 9px;
            font-size: 9px;
            font-weight: 700;
        }

        .verified i {
            margin-right: 3px;
        }

        .result-card {
            background: white;
            border-radius: 16px;
            padding: 15px;
            margin-top: 12px;
            box-shadow: 0 4px 15px rgba(40,60,110,.05);
        }

        .result-card p {
            font-size: 11px;
            line-height: 1.6;
            margin: 9px 0;
            overflow-wrap: anywhere;
        }

        .result-card strong {
            color: #34486c;
        }

        .status-pill {
            display: inline-block;
            background: #eaf2ff;
            color: #2864b0;
            border-radius: 20px;
            padding: 5px 9px;
            font-size: 10px;
            font-weight: 700;
        }

        /* INFORMATION */

        .information-card {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #edf1ff;
            border-radius: 16px;
            padding: 15px 13px;
            margin-top: 65px;
        }

        .information-icon {
            width: 25px;
            height: 25px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #dce7ff;
            color: #1264bd;
            border-radius: 50%;
            font-size: 13px;
        }

        .information-content strong {
            display: block;
            font-size: 10px;
            color: #315b9c;
            margin-bottom: 5px;
        }

        .information-content p {
            margin: 0;
            font-size: 10px;
            color: #66738c;
            line-height: 1.6;
        }

        /* BOTTOM AREA */

        .bottom-area {
            position: fixed;
            z-index: 10;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 420px;
            padding: 12px 14px 17px;
            background: linear-gradient(
                to bottom,
                rgba(247,248,255,0),
                #f7f8ff 15%
            );
        }

        .help-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
            height: 42px;
            background: white;
            border-radius: 30px;
            color: #0861bb;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(40,60,110,.07);
            margin-bottom: 29px;
        }

        .bottom-nav {
            display: flex;
            align-items: center;
            justify-content: space-around;
            background: white;
            border: 1px solid #e2e8f5;
            border-radius: 35px;
            padding: 7px 3px;
            box-shadow: 0 5px 15px rgba(40,60,110,.08);
        }

        .nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            color: #68748a;
            font-size: 9px;
            padding: 6px 2px;
            border-radius: 25px;
        }

        .nav-item i {
            font-size: 15px;
        }

        .nav-item.active {
            background: #eaf0ff;
            color: #0861bb;
            font-weight: 800;
        }

        @media (min-width: 600px) {
            body {
                padding: 20px 0;
            }

            .app {
                min-height: calc(100vh - 40px);
                border-radius: 20px;
                box-shadow: 0 8px 35px rgba(40,60,110,.09);
            }

            .bottom-area {
                bottom: 20px;
            }
        }

        @media (max-width: 350px) {
            .tracking-heading label {
                font-size: 9px;
            }

            .privacy {
                font-size: 8px;
            }

            .btn-search {
                min-width: 65px;
                padding: 0 9px;
            }
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();
    $emergencyPhone = config('serkomu.emergency_phone');
@endphp

<div class="app">

    <!-- HEADER -->
    <header class="topbar">

        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-shield-plus"></i>
            </div>

            <div>
                <div class="brand-name">serkomu.</div>
                <div class="brand-subtitle">Telkom University</div>
            </div>
        </div>

        <a href="{{ route('mahasiswa.dashboard') }}"
           class="profile-btn"
           aria-label="Profil">
            <i class="bi bi-person-fill"></i>
        </a>

    </header>

    <!-- JUDUL -->
    <section class="page-heading">

        <a href="{{ route('mahasiswa.dashboard') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div>
            <h1>Cek Status Laporan</h1>
            <p>Layanan Dukungan &amp; Penanganan Terpadu</p>
        </div>

    </section>

    <p class="intro">
        Pantau perkembangan dan tindak lanjut laporan
        secara transparan.
    </p>

    <!-- FORM PENCARIAN -->
    <section class="tracking-card">

        <form action="{{ route('mahasiswa.status.track') }}" method="POST">
            @csrf

            <div class="tracking-heading">
                <label for="tracking_code">KODE PELACAKAN</label>

                <span class="privacy">
                    <i class="bi bi-shield-check"></i>
                    Privasi Aman
                </span>
            </div>

            <div class="search-row">

                <div class="input-wrap">
                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="tracking_code"
                        name="tracking_code"
                        value="{{ old('tracking_code') }}"
                        placeholder="SRK-2026-0001"
                        required
                    >
                </div>

                <button type="submit" class="btn-search">
                    Periksa
                </button>

            </div>

            @error('tracking_code')
                <div class="error">{{ $message }}</div>
            @enderror

        </form>

    </section>

    <!-- HASIL PELACAKAN -->
    @isset($laporan)

        <section>

            <div class="result-heading">
                <span class="result-title">
                    <i class="bi bi-record-circle"></i>
                    HASIL PELACAKAN
                </span>

                <span class="verified">
                    <i class="bi bi-check-circle-fill"></i>
                    Terverifikasi
                </span>
            </div>

            <div class="result-card">

                <p>
                    <strong>Kode Laporan:</strong><br>
                    {{ $laporan->tracking_code }}
                </p>

                <p>
                    <strong>Jenis Kejadian:</strong><br>
                    {{ $laporan->incident_type }}
                </p>

                <p>
                    <strong>Lokasi:</strong><br>
                    {{ $laporan->location }}
                </p>

                <p>
                    <strong>Status:</strong><br>
                    <span class="status-pill">
                        {{ $laporan->status }}
                    </span>
                </p>

                <p>
                    <strong>Tindak Lanjut:</strong><br>
                    {{ $laporan->follow_up ?? 'Belum ada tindak lanjut.' }}
                </p>

            </div>

        </section>

    @endisset

    <!-- INFORMASI LAYANAN -->
    <section class="information-card">

        <div class="information-icon">
            <i class="bi bi-info-lg"></i>
        </div>

        <div class="information-content">
            <strong>Informasi Layanan</strong>

            <p>
                Status ini adalah pencatatan administratif berkala,
                bukan pelacak ambulans GPS waktu nyata.
            </p>
        </div>

    </section>

</div>

<!-- TOMBOL BANTUAN DAN NAVIGASI -->
<div class="bottom-area">

    @if($emergencyPhone)
        <a href="tel:{{ $emergencyPhone }}" class="help-btn">
    @else
        <a href="{{ route('mahasiswa.dashboard') }}#kontak-darurat"
           class="help-btn">
    @endif
            <i class="bi bi-headset"></i>
            Hubungi Bantuan Langsung
        </a>

    <nav class="bottom-nav">

        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item">
            <i class="bi bi-house-door"></i>
            <span>Beranda</span>
        </a>

        <a href="{{ route('emergency-reports.create') }}" class="nav-item">
            <i class="bi bi-list-check"></i>
            <span>Lapor</span>
        </a>

        <a href="{{ route('mahasiswa.klinik') }}" class="nav-item">
            <i class="bi bi-plus-square"></i>
            <span>Klinik</span>
        </a>

        <a href="{{ route('mahasiswa.status') }}" class="nav-item active">
            <i class="bi bi-clipboard-check"></i>
            <span>Status</span>
        </a>

        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item">
            <i class="bi bi-person"></i>
            <span>Akun</span>
        </a>

    </nav>

</div>

</body>
</html>