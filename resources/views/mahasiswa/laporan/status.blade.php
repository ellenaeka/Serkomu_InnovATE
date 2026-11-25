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

        button, input {
            font-family: inherit;
        }

        .app {
            position: relative;
            width: 100%;
            max-width: 1400px;
            min-height: 100vh;
            margin: 0 auto;
            padding: 0 32px 180px;
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
            width: 34px;
            height: 34px;
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
            margin: 20px 0 12px;
        }

        .back-btn {
            width: 36px;
            height: 36px;
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
            font-size: 19px;
            margin: 0 0 4px;
            font-weight: 800;
        }

        .page-heading p {
            font-size: 11px;
            margin: 0;
            color: var(--muted);
        }

        .intro {
            font-size: 13px;
            color: #68748c;
            line-height: 1.7;
            margin: 15px 0 20px;
        }

        /* SUCCESS NOTIFICATION */

        .success-card {
            display: flex;
            gap: 13px;
            align-items: flex-start;
            padding: 17px;
            margin-bottom: 18px;
            background: #eaf7ef;
            border: 1px solid #ccebd7;
            border-radius: 16px;
        }

        .success-icon {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #d3f0dd;
            color: #21834c;
            border-radius: 50%;
            font-size: 19px;
        }

        .success-content {
            flex: 1;
            min-width: 0;
        }

        .success-content h3 {
            margin: 0 0 6px;
            font-size: 14px;
            color: #237344;
        }

        .success-content p {
            margin: 0;
            font-size: 12px;
            line-height: 1.6;
            color: #52715d;
        }

        .tracking-code-box {
            margin-top: 13px;
            padding: 12px;
            background: white;
            border: 1px dashed #8ac9a0;
            border-radius: 10px;
        }

        .tracking-code-box span {
            display: block;
            font-size: 10px;
            color: #778198;
            margin-bottom: 6px;
        }

        .tracking-code-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .tracking-code-row strong {
            font-size: 16px;
            color: #315b9c;
            letter-spacing: .5px;
            overflow-wrap: anywhere;
        }

        .copy-btn {
            flex-shrink: 0;
            border: none;
            background: #eaf0ff;
            color: #315b9c;
            border-radius: 8px;
            padding: 8px 10px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 700;
        }

        /* TRACKING CARD */

        .tracking-card {
            background: white;
            padding: 20px;
            border-radius: 19px;
            box-shadow: 0 5px 18px rgba(40,60,110,.06);
            margin-bottom: 20px;
        }

        .tracking-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .tracking-heading label {
            font-size: 11px;
            font-weight: 800;
            color: #315b9c;
            letter-spacing: .5px;
        }

        .privacy {
            color: #6d7890;
            font-size: 10px;
            white-space: nowrap;
        }

        .privacy i {
            color: var(--primary);
            margin-right: 3px;
        }

        .search-row {
            display: flex;
            align-items: stretch;
            gap: 9px;
        }

        .input-wrap {
            position: relative;
            flex: 1;
            min-width: 0;
        }

        .input-wrap i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #7b879c;
            font-size: 14px;
        }

        .input-wrap input {
            width: 100%;
            height: 46px;
            padding: 0 10px 0 38px;
            border: 1px solid #e5eaf4;
            border-radius: 11px;
            background: #f7f8fc;
            outline: none;
            color: var(--text);
            font-size: 12px;
        }

        .input-wrap input:focus {
            border-color: #7da9e8;
            background: white;
        }

        .input-wrap input::placeholder {
            color: #a2aabd;
        }

        .btn-search {
            min-width: 90px;
            padding: 0 16px;
            border: none;
            border-radius: 11px;
            background: #1261b7;
            color: white;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .btn-search:hover {
            background: #084e9a;
        }

        .error {
            margin-top: 8px;
            font-size: 11px;
            color: #c0392b;
        }

        /* RESULT */

        .result-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin: 20px 2px 0;
        }

        .result-title {
            color: #0861bb;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .verified {
            background: #e7f6ef;
            color: #168252;
            border-radius: 20px;
            padding: 6px 10px;
            font-size: 10px;
            font-weight: 700;
        }

        .result-card {
            background: white;
            border-radius: 17px;
            padding: 20px;
            margin-top: 12px;
            box-shadow: 0 4px 15px rgba(40,60,110,.05);
        }

        .result-card h3 {
            margin: 0 0 15px;
            font-size: 15px;
            color: #263b60;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 12px;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row span {
            color: #778198;
            flex-shrink: 0;
        }

        .detail-row strong {
            text-align: right;
            color: #34486c;
            overflow-wrap: anywhere;
            line-height: 1.6;
        }

        .description-box {
            background: #f7f8fc;
            border-radius: 10px;
            padding: 13px;
            margin-top: 13px;
        }

        .description-box span {
            font-size: 11px;
            color: #778198;
            font-weight: 700;
        }

        .description-box p {
            font-size: 12px;
            line-height: 1.7;
            color: #34486c;
            margin: 8px 0 0;
            overflow-wrap: anywhere;
        }

        /* STATUS COLORS */

        .status-pill {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 11px;
            font-size: 10px;
            font-weight: 700;
        }

        .status-waiting {
            background: #fff4d6;
            color: #a66a00;
        }

        .status-processing {
            background: #e5efff;
            color: #285db5;
        }

        .status-completed {
            background: #e3f5e9;
            color: #237344;
        }

        .status-cancelled {
            background: #ffe8e8;
            color: #bc4141;
        }

        .status-default {
            background: #edf0f5;
            color: #64748b;
        }

        /* FOLLOW UP */

        .follow-up-box {
            margin-top: 16px;
            padding: 15px;
            background: #edf3ff;
            border: 1px solid #dce7ff;
            border-radius: 12px;
        }

        .follow-up-box strong {
            display: block;
            font-size: 12px;
            color: #315b9c;
            margin-bottom: 7px;
        }

        .follow-up-box p {
            font-size: 12px;
            color: #536681;
            line-height: 1.7;
            margin: 0;
            overflow-wrap: anywhere;
        }

        /* INFORMATION */

        .information-card {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            background: #edf1ff;
            border-radius: 16px;
            padding: 16px;
            margin-top: 22px;
        }

        .information-icon {
            width: 29px;
            height: 29px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #dce7ff;
            color: #1264bd;
            border-radius: 50%;
            font-size: 14px;
        }

        .information-content strong {
            display: block;
            font-size: 12px;
            color: #315b9c;
            margin-bottom: 6px;
        }

        .information-content p {
            margin: 0;
            font-size: 11px;
            color: #66738c;
            line-height: 1.7;
        }

        /* BOTTOM AREA */

        .bottom-area {
            position: fixed;
            z-index: 1000;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: min(420px, calc(100% - 24px));
            padding: 12px 8px 15px;
            background: linear-gradient(
                to bottom,
                rgba(247,248,255,0),
                #f7f8ff 18%
            );
        }

        .help-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
            min-height: 43px;
            background: white;
            border-radius: 30px;
            color: #0861bb;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(40,60,110,.07);
            margin-bottom: 12px;
        }

        .bottom-nav {
            width: 100%;
            min-height: 62px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            background: white;
            border: 1px solid #e2e8f5;
            border-radius: 35px;
            padding: 6px 4px;
            box-shadow: 0 5px 15px rgba(40,60,110,.08);
        }

        .nav-item {
            flex: 1 1 0;
            min-width: 0;
            min-height: 48px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            color: #68748a;
            font-size: 10px;
            padding: 5px 2px;
            border-radius: 25px;
            transition: background .2s, color .2s;
            white-space: nowrap;
        }

        .nav-item i {
            font-size: 17px;
        }

        .nav-item.active {
            background: #eaf0ff;
            color: #0861bb;
            font-weight: 800;
        }

        .nav-item:active {
            transform: none;
        }

        /* RESPONSIVE */

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

        @media (max-width: 500px) {
            .app {
                padding: 0 17px 180px;
            }

            .page-heading h1 {
                font-size: 17px;
            }

            .tracking-card,
            .result-card {
                padding: 16px;
            }

            .btn-search {
                min-width: 75px;
                padding: 0 11px;
            }
        }

        @media (max-width: 350px) {
            .tracking-heading label {
                font-size: 9px;
            }

            .privacy {
                font-size: 8px;
            }

            .nav-item {
                font-size: 9px;
            }

            .nav-item i {
                font-size: 15px;
            }

            .tracking-code-row strong {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();
    $emergencyPhone = config('serkomu.emergency_phone');

    $statusClass = 'status-default';

    if (isset($laporan)) {
        $statusClass = match($laporan->status) {
            'Menunggu' => 'status-waiting',
            'Diproses' => 'status-processing',
            'Selesai' => 'status-completed',
            'Dibatalkan' => 'status-cancelled',
            default => 'status-default',
        };
    }
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

        <a href="{{ route('mahasiswa.dashboard') }}"
           class="back-btn">

            <i class="bi bi-arrow-left"></i>

        </a>

        <div>

            <h1>Cek Status Laporan</h1>

            <p>Layanan Dukungan &amp; Penanganan Terpadu</p>

        </div>

    </section>

    <p class="intro">
        Pantau perkembangan dan tindak lanjut laporan
        secara transparan melalui kode pelacakan yang telah diberikan.
    </p>

    <!-- NOTIFIKASI BERHASIL -->

    @if(session('success'))

        <section class="success-card">

            <div class="success-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div class="success-content">

                <h3>Laporan Berhasil Dikirim!</h3>

                <p>
                    {{ session('success') }}
                    Simpan kode pelacakan berikut untuk memeriksa
                    perkembangan laporan Anda.
                </p>

                @if(session('tracking_code'))

                    <div class="tracking-code-box">

                        <span>KODE PELACAKAN LAPORAN</span>

                        <div class="tracking-code-row">

                            <strong id="trackingCode">
                                {{ session('tracking_code') }}
                            </strong>

                            <button type="button"
                                    class="copy-btn"
                                    onclick="copyTrackingCode()">

                                <i class="bi bi-copy"></i>
                                Salin

                            </button>

                        </div>

                    </div>

                @endif

            </div>

        </section>

    @endif

    <!-- FORM PENCARIAN -->

    <section class="tracking-card">

        <form action="{{ route('mahasiswa.status.track') }}"
              method="POST">

            @csrf

            <div class="tracking-heading">

                <label for="tracking_code">
                    KODE PELACAKAN
                </label>

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
                        value="{{ old('tracking_code', session('tracking_code')) }}"
                        placeholder="SRK-2026-0001"
                        maxlength="50"
                        required
                    >

                </div>

                <button type="submit" class="btn-search">
                    Periksa
                </button>

            </div>

            @error('tracking_code')

                <div class="error">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                </div>

            @enderror

        </form>

    </section>

    <!-- HASIL PELACAKAN -->

    @if(isset($laporan) && $laporan)

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

                <h3>
                    <i class="bi bi-file-earmark-text"></i>
                    Informasi Laporan
                </h3>

                <div class="detail-row">

                    <span>Kode Laporan</span>

                    <strong>
                        {{ $laporan->tracking_code }}
                    </strong>

                </div>

                <div class="detail-row">

                    <span>Jenis Kejadian</span>

                    <strong>
                        {{ $laporan->incident_type }}
                    </strong>

                </div>

                <div class="detail-row">

                    <span>Pelapor</span>

                    <strong>
                        {{ $laporan->reporter_name }}
                    </strong>

                </div>

                <div class="detail-row">

                    <span>Kategori Lokasi</span>

                    <strong>
                        {{ $laporan->location_category }}
                    </strong>

                </div>

                <div class="detail-row">

                    <span>Lokasi Kejadian</span>

                    <strong>
                        {{ $laporan->location }}
                    </strong>

                </div>

                <div class="detail-row">

                    <span>Detail Lokasi</span>

                    <strong>
                        {{ $laporan->detail_location }}
                    </strong>

                </div>

                <div class="detail-row">

                    <span>Waktu Kejadian</span>

                    <strong>
                        {{ \Carbon\Carbon::parse($laporan->incident_time)->translatedFormat('d F Y, H:i') }}
                    </strong>

                </div>

                <div class="detail-row">

                    <span>Status Laporan</span>

                    <strong>
                        <span class="status-pill {{ $statusClass }}">
                            {{ $laporan->status }}
                        </span>
                    </strong>

                </div>

                <div class="description-box">

                    <span>
                        <i class="bi bi-chat-left-text"></i>
                        Ringkasan Kejadian
                    </span>

                    <p>
                        {{ $laporan->description }}
                    </p>

                </div>

                <div class="follow-up-box">

                    <strong>
                        <i class="bi bi-clipboard-check"></i>
                        Informasi Tindak Lanjut
                    </strong>

                    <p>
                        {{ $laporan->follow_up ?: 'Belum ada tindak lanjut dari petugas. Silakan periksa kembali secara berkala.' }}
                    </p>

                </div>

            </div>

        </section>

    @endif

    <!-- INFORMASI LAYANAN -->

    <section class="information-card">

        <div class="information-icon">
            <i class="bi bi-info-lg"></i>
        </div>

        <div class="information-content">

            <strong>Informasi Layanan</strong>

            <p>
                Status laporan diperbarui oleh petugas sesuai
                perkembangan penanganan. Simpan kode pelacakan
                untuk memeriksa laporan Anda kembali.
                Sistem ini bukan pelacak ambulans GPS waktu nyata.
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

        <a href="{{ route('mahasiswa.dashboard') }}"
           class="nav-item">

            <i class="bi bi-house-door"></i>
            <span>Beranda</span>

        </a>

        <a href="{{ route('emergency-reports.create') }}"
           class="nav-item">

            <i class="bi bi-list-check"></i>
            <span>Lapor</span>

        </a>

        <a href="{{ route('mahasiswa.klinik') }}"
           class="nav-item">

            <i class="bi bi-plus-square"></i>
            <span>Klinik</span>

        </a>

        <a href="{{ route('mahasiswa.status') }}"
           class="nav-item active">

            <i class="bi bi-clipboard-check"></i>
            <span>Status</span>

        </a>

        <a href="{{ route('mahasiswa.dashboard') }}"
           class="nav-item">

            <i class="bi bi-person"></i>
            <span>Akun</span>

        </a>

    </nav>

</div>

<script>
    function copyTrackingCode() {

        const codeElement = document.getElementById('trackingCode');

        if (!codeElement) {
            return;
        }

        const code = codeElement.innerText.trim();

        if (navigator.clipboard && window.isSecureContext) {

            navigator.clipboard.writeText(code)
                .then(() => {
                    showCopySuccess();
                })
                .catch(() => {
                    fallbackCopy(code);
                });

        } else {

            fallbackCopy(code);

        }
    }

    function fallbackCopy(code) {

        const textarea = document.createElement('textarea');

        textarea.value = code;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';

        document.body.appendChild(textarea);

        textarea.select();

        try {
            document.execCommand('copy');
            showCopySuccess();
        } catch (error) {
            alert('Kode pelacakan: ' + code);
        }

        document.body.removeChild(textarea);
    }

    function showCopySuccess() {

        const button = document.querySelector('.copy-btn');

        if (!button) {
            return;
        }

        button.innerHTML = '<i class="bi bi-check2"></i> Tersalin';

        setTimeout(() => {
            button.innerHTML = '<i class="bi bi-copy"></i> Salin';
        }, 2000);
    }
</script>

</body>
</html>
