<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --bg: #f4f6fb;
            --surface: #ffffff;
            --soft: #eef3ff;
            --primary: #4264b5;
            --primary-dark: #263f78;
            --text: #263454;
            --muted: #7d89a2;
            --danger: #bc4141;
            --border: #edf0f7;
            --shadow: 0 8px 25px rgba(40, 60, 110, .06);
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--text);
            background: var(--bg);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
        }

        /* MAIN CONTAINER */

        .page-wrap {
            width: 100%;
            min-height: 100vh;
            padding: 24px;
        }

        .app-shell {
            width: 100%;
            max-width: 1400px;
            min-height: calc(100vh - 48px);
            margin: auto;
            padding: 30px 38px 120px;
            background: #f9faff;
            border-radius: 28px;
            box-shadow: var(--shadow);
        }

        /* HEADER */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            background: #edf3ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* MEDICAL CROSS */

        
.medical-cross {
    position: relative;
    display: inline-block;
    width: 32px;
    height: 32px;
    flex: 0 0 auto;
    background: linear-gradient(
        145deg,
        #70baff 0%,
        #2474d8 65%,
        #1558b5 100%
    );
    clip-path: polygon(
        35% 0,
        65% 0,
        65% 35%,
        100% 35%,
        100% 65%,
        65% 65%,
        65% 100%,
        35% 100%,
        35% 65%,
        0 65%,
        0 35%,
        35% 35%
    );
    filter: drop-shadow(0 2px 3px rgba(31, 95, 191, .25));
}

.medical-cross::before,
.medical-cross::after {
    content: none;
}


        .brand-name {
            color: var(--primary);
            font-size: 21px;
            font-weight: 800;
            line-height: 1;
        }

        .brand-subtitle {
            font-size: 10px;
            color: var(--muted);
            margin-top: 4px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 15px 7px 8px;
            border: 1px solid var(--border);
            border-radius: 50px;
            background: white;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--primary);
            color: white;
            font-weight: 700;
        }

        .user-name {
            font-size: 12px;
            font-weight: 700;
        }

        .user-status {
            font-size: 10px;
            color: #27865a;
            margin-top: 3px;
        }

        .menu-btn {
            border: 0;
            background: var(--soft);
            border-radius: 50%;
            width: 42px;
            height: 42px;
            color: var(--text);
            font-size: 20px;
            cursor: pointer;
        }

        /* HERO */

        .hero-card {
            position: relative;
            overflow: hidden;
            padding: 34px;
            border-radius: 26px;
            background: linear-gradient(120deg, #f0f5ff, #ffffff);
            box-shadow: var(--shadow);
            margin-bottom: 28px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 30px;
            background: #e7efff;
            color: #3c527f;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .hero-badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
        }

        .hero-title {
            font-size: clamp(26px, 3vw, 36px);
            line-height: 1.2;
            font-weight: 800;
            max-width: 750px;
            margin: 0 0 12px;
            color: #202d4b;
        }

        .hero-title .accent {
            color: #477de0;
        }

        .hero-desc {
            max-width: 650px;
            color: #68758e;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 0 22px;
        }

        .hero-icon-box {
            position: absolute;
            right: 45px;
            top: 30px;
            width: 88px;
            height: 88px;
            background: white;
            border-radius: 22px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 25px rgba(60, 118, 227, .15);
        }

        /* EMERGENCY BUTTON */

        .btn-emergency {
            display: flex;
            align-items: center;
            gap: 14px;
            width: 100%;
            max-width: 520px;
            padding: 17px 20px;
            color: white;
            background: linear-gradient(135deg, #c6534c, #a83d38);
            border: 2px solid rgba(255,255,255,.25);
            border-radius: 16px;
            box-shadow: 0 10px 22px rgba(188,65,65,.25);
            transition: .2s ease;
        }

        .btn-emergency:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 13px 25px rgba(188,65,65,.32);
        }

        .emergency-icon {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            border-radius: 13px;
            background: rgba(255,255,255,.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .emergency-title {
            font-size: 14px;
            font-weight: 800;
            display: block;
        }

        .emergency-desc {
            display: block;
            font-size: 11px;
            margin-top: 4px;
            opacity: .95;
        }

        /* DASHBOARD TWO COLUMNS */

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(300px, 1fr);
            gap: 24px;
            align-items: start;
        }

        .column {
            min-width: 0;
        }

        .section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 15px;
        }

        .section-overline {
            color: #8994a9;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .section-title {
            font-size: 17px;
            font-weight: 800;
            margin: 0;
        }

        .campus-badge {
            font-size: 11px;
            color: var(--primary);
            font-weight: 700;
            white-space: nowrap;
        }

        /* SERVICE CARDS */

        .service-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .service-card {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 115px;
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 19px;
            background: white;
            box-shadow: var(--shadow);
            transition: .2s;
        }

        .service-card:hover,
        .small-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(40,60,110,.10);
        }

        .service-card.primary-soft {
            background: #f0f5ff;
        }

        .service-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #eaf0ff;
            color: var(--primary);
            font-size: 22px;
        }

        .service-content {
            flex: 1;
            min-width: 0;
        }

        .service-title {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .service-desc {
            font-size: 11px;
            line-height: 1.5;
            color: var(--muted);
            margin: 0;
        }

        .mini-badge {
            display: inline-block;
            background: #dce9ff;
            color: #4778d4;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 9px;
            margin-top: 5px;
        }

        .service-arrow {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #edf2ff;
            color: var(--primary);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .service-grid-small {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 14px;
        }

        .small-card {
            display: block;
            min-height: 140px;
            padding: 18px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 19px;
            box-shadow: var(--shadow);
            transition: .2s;
        }

        .small-icon {
            width: 42px;
            height: 42px;
            background: #edf2ff;
            color: var(--primary);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .small-title {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .small-desc {
            color: var(--muted);
            font-size: 11px;
        }

        /* INFORMATION */

        .info-section {
            margin-top: 25px;
        }

        .info-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 17px;
            margin-bottom: 12px;
            box-shadow: var(--shadow);
        }

        .info-title {
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .info-desc {
            color: var(--muted);
            font-size: 11px;
            margin: 0;
        }

        .info-icon {
            color: #5779db;
            margin-right: 5px;
        }

        .info-badge {
            background: #eaf6ef;
            color: #32845b;
            font-size: 10px;
            padding: 7px 10px;
            border-radius: 20px;
        }

        /* VISIT PANELS */

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 19px;
            padding: 20px;
            margin-bottom: 22px;
            box-shadow: var(--shadow);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
        }

        .panel-heading h3 {
            font-size: 15px;
            font-weight: 800;
            margin: 0;
        }

        .view-all {
            color: var(--primary);
            font-size: 10px;
            font-weight: 700;
        }

        .visit-status {
            background: #eaf6ef;
            color: #32845b;
            border-radius: 25px;
            padding: 9px 12px;
            font-size: 10px;
        }

        .empty-state {
            text-align: center;
            padding: 22px 10px;
            color: #8b97ad;
        }

        .empty-state i {
            font-size: 34px;
            color: #a6b3d9;
            display: block;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 11px;
            line-height: 1.6;
            margin: 0;
        }

        .panel-action {
            display: block;
            width: 100%;
            padding: 11px;
            text-align: center;
            background: #edf1ff;
            color: var(--primary);
            border-radius: 10px;
            font-size: 11px;
            font-weight: 800;
            margin-top: 15px;
        }

        .guide-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 15px;
            margin-top: 15px;
            border-radius: 14px;
            background: #edf2ff;
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        .guide-link i {
            margin-right: 8px;
        }

        .warning-box {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 16px;
            margin-top: 13px;
            box-shadow: var(--shadow);
        }

        .warning-icon {
            color: #c94c4c;
            font-size: 19px;
        }

        .warning-box p {
            margin: 0;
            color: #69758a;
            font-size: 11px;
            line-height: 1.6;
        }

        .warning-box strong {
            color: var(--danger);
        }

        .portal-link {
            text-align: center;
            color: var(--muted);
            font-size: 11px;
            margin-top: 20px;
        }

        /* BOTTOM NAVIGATION */

        .bottom-nav {
            position: fixed;
            z-index: 1000;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: min(650px, calc(100% - 32px));
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 50px;
            background: rgba(255,255,255,.97);
            box-shadow: 0 12px 35px rgba(35,55,100,.14);
        }

        .nav-item-custom {
            flex: 1;
            text-align: center;
            padding: 9px 5px;
            color: #7c879c;
            border-radius: 35px;
            font-size: 10px;
            transition: .2s;
        }

        .nav-item-custom i {
            display: block;
            font-size: 19px;
            margin-bottom: 5px;
        }

        .nav-item-custom.active {
            background: #edf2ff;
            color: var(--primary);
            font-weight: 800;
        }

        /* TABLET */

        @media (max-width: 991px) {
            .page-wrap {
                padding: 14px;
            }

            .app-shell {
                padding: 24px 22px 115px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 29px;
            }
        }

        /* MOBILE */

        @media (max-width: 600px) {
            .page-wrap {
                padding: 0;
            }

            .app-shell {
                min-height: 100vh;
                border-radius: 0;
                padding: 17px 16px 115px;
                box-shadow: none;
            }

            .topbar {
                margin-bottom: 20px;
            }

            .brand-logo {
                width: 36px;
                height: 36px;
            }

            .brand-name {
                font-size: 18px;
            }

            .brand-subtitle {
                font-size: 9px;
            }

            .user-pill {
                padding: 5px 9px 5px 5px;
                gap: 7px;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 11px;
            }

            .user-name {
                font-size: 10px;
                max-width: 90px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .user-status {
                font-size: 9px;
            }

            .menu-btn {
                width: 35px;
                height: 35px;
                font-size: 18px;
            }

            .hero-card {
                padding: 22px 18px;
                border-radius: 23px;
                margin-bottom: 23px;
            }

            .hero-badge {
                font-size: 10px;
                padding: 7px 11px;
                margin-bottom: 14px;
            }

            .hero-title {
                font-size: 25px;
                max-width: 75%;
            }

            .hero-desc {
                font-size: 12px;
                max-width: 75%;
                margin-bottom: 17px;
            }

            .hero-icon-box {
                width: 57px;
                height: 57px;
                right: 16px;
                top: 22px;
                border-radius: 16px;
            }

            .medical-cross {
                width: 26px;
                height: 26px;
            }

            .btn-emergency {
                padding: 13px;
                gap: 10px;
                border-radius: 14px;
            }

            .emergency-icon {
                width: 38px;
                height: 38px;
                font-size: 17px;
            }

            .emergency-title {
                font-size: 12px;
            }

            .emergency-desc {
                font-size: 9px;
            }

            .dashboard-grid {
                gap: 20px;
            }

            .section-head {
                margin-bottom: 12px;
            }

            .section-title {
                font-size: 16px;
            }

            .campus-badge {
                font-size: 9px;
            }

            .service-list {
                grid-template-columns: 1fr;
                gap: 11px;
            }

            .service-card {
                min-height: 95px;
                padding: 14px;
            }

            .service-icon {
                width: 45px;
                height: 45px;
                font-size: 20px;
            }

            .service-title {
                font-size: 13px;
            }

            .service-desc {
                font-size: 10px;
            }

            .service-grid-small {
                gap: 10px;
            }

            .small-card {
                min-height: 125px;
                padding: 13px;
            }

            .small-title {
                font-size: 12px;
            }

            .small-desc {
                font-size: 10px;
            }

            .info-section {
                margin-top: 22px;
            }

            .panel {
                padding: 16px;
            }

            .guide-link {
                font-size: 10px;
            }

            .warning-box {
                padding: 13px;
            }

            .warning-box p {
                font-size: 10px;
            }

            .bottom-nav {
                bottom: 9px;
                width: calc(100% - 20px);
                padding: 7px;
            }

            .nav-item-custom {
                font-size: 9px;
                padding: 8px 2px;
            }

            .nav-item-custom i {
                font-size: 17px;
            }
        }

        @media (max-width: 360px) {
            .app-shell {
                padding-left: 12px;
                padding-right: 12px;
            }

            .hero-title {
                font-size: 22px;
            }

            .hero-desc {
                font-size: 11px;
            }

            .user-name {
                max-width: 70px;
            }
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();
    $emergencyPhone = config('serkomu.emergency_phone');
@endphp

<div class="page-wrap">
    <main class="app-shell">

        <!-- HEADER -->
        <header class="topbar">

            <div class="brand">
                <div class="brand-logo">
                    <span class="medical-cross"></span>
                </div>

                <div>
                    <div class="brand-name">serkomu.</div>
                    <div class="brand-subtitle">Telkom University</div>
                </div>
            </div>

            <div class="topbar-right">

                <div class="user-pill">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>

                    <div>
                        <div class="user-name">{{ $user->name }}</div>
                        <div class="user-status">Mahasiswa Aktif</div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="menu-btn"
                        aria-label="Keluar dari akun"
                        title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>

            </div>
        </header>


        <!-- HERO -->
        <section class="hero-card">

            <div class="hero-badge">
                <span class="dot"></span>
                Layanan Mahasiswa Siaga
            </div>

            <div class="hero-icon-box">
                <span class="medical-cross" style="width:39px;height:39px"></span>
            </div>

            <h1 class="hero-title">
                Bantuan kesehatan,
                <span class="accent">lebih dekat.</span>
            </h1>

            <p class="hero-desc">
                Temukan bantuan dan laporkan kondisi yang membutuhkan
                penanganan dengan cepat melalui SerKoMu.
            </p>

            @if($emergencyPhone)
                <a href="tel:{{ $emergencyPhone }}" class="btn-emergency">
            @else
                <a href="#kontak-darurat" class="btn-emergency">
            @endif
                    <div class="emergency-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>

                    <div>
                        <span class="emergency-title">
                            Telepon Bantuan Darurat
                        </span>
                        <span class="emergency-desc">
                            Panggilan langsung terhubung ke layanan operator
                        </span>
                    </div>
                </a>

        </section>


        <!-- MAIN DASHBOARD -->
        <div class="dashboard-grid">

            <!-- LEFT COLUMN -->
            <div class="column">

                <div class="section-head">
                    <div>
                        <div class="section-overline">Akses Cepat</div>
                        <h2 class="section-title">Layanan SerKoMu</h2>
                    </div>

                    <div class="campus-badge">
                        <i class="bi bi-shield-check"></i>
                        Terkoneksi Kampus
                    </div>
                </div>


                <!-- MAIN SERVICES -->
                <section class="service-list">

                    <a href="#" class="service-card primary-soft">
                        <div class="service-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>

                        <div class="service-content">
                            <div class="service-title">
                                Daftar Kunjungan
                            </div>

                            <span class="mini-badge">
                                Simulasi Pra-Pendaftaran
                            </span>

                            <p class="service-desc" style="margin-top:6px">
                                Daftar dari rumah atau kos sebelum datang
                                ke Telkomedika.
                            </p>
                        </div>

                        <div class="service-arrow">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </a>


                    <a href="{{ route('emergency-reports.create') }}"
                       class="service-card">

                        <div class="service-icon">
                            <i class="bi bi-file-earmark-medical"></i>
                        </div>

                        <div class="service-content">
                            <div class="service-title">Buat Laporan</div>

                            <p class="service-desc">
                                Laporkan insiden kampus secara cepat
                                dan terarah.
                            </p>
                        </div>

                        <div class="service-arrow">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </a>

                </section>


                <!-- SMALL SERVICES -->
                <section class="service-grid-small">

                    <a href="#riwayat-laporan" class="small-card">
                        <div class="small-icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>

                        <div class="small-title">Cek Status</div>
                        <div class="small-desc">
                            Pantau progres laporan
                        </div>
                    </a>

                    <a href="{{ route('mahasiswa.status') }}" class="small-card">
                        <div class="small-icon">
                            <i class="bi bi-chat-dots-fill"></i>
                        </div>

                        <div class="small-title">Kontak Bantuan</div>
                        <div class="small-desc">
                            Direktori resmi staf
                        </div>
                    </a>

                </section>


                <!-- INFORMATION -->
                <section class="info-section">

                    <div class="section-head">
                        <h2 class="section-title">Informasi Layanan</h2>
                    </div>

                    <div class="info-card">
                        <div>
                            <div class="info-title">
                                <i class="bi bi-clock info-icon"></i>
                                Jam Layanan Klinik
                            </div>

                            <p class="info-desc">
                                Senin - Jumat, 08.00 - 16.00 WIB
                            </p>
                        </div>

                        <span class="info-badge">Informasi</span>
                    </div>

                    <a href="#" class="info-card">
                        <div>
                            <div class="info-title">
                                <i class="bi bi-geo-alt info-icon"></i>
                                Lokasi Klinik
                            </div>

                            <p class="info-desc">
                                Gedung Klinik Telkom University
                            </p>
                        </div>

                        <i class="bi bi-chevron-right"></i>
                    </a>

                </section>

            </div>


            <!-- RIGHT COLUMN -->
            <div class="column">

                <!-- UPCOMING VISIT -->
                <section class="panel">

                    <div class="panel-heading">
                        <h3>Kunjungan Mendatang</h3>
                        <a href="#" class="view-all">Lihat semua</a>
                    </div>

                    <div style="display:flex;justify-content:space-between;align-items:center;gap:10px">
                        <strong style="font-size:12px">
                            Poli Umum - Dokter Jaga
                        </strong>

                        <span class="visit-status">Mendatang</span>
                    </div>

                    <p class="info-desc" style="margin-top:12px">
                        Jadwal kunjungan klinik
                    </p>

                    <div class="empty-state">
                        <i class="bi bi-calendar-check"></i>
                        <p>
                            Belum ada jadwal terdaftar.<br>
                            Silakan daftar kunjungan terlebih dahulu.
                        </p>
                    </div>

                    <a href="#" class="panel-action">
                        Daftar Sekarang
                    </a>

                </section>


                <!-- HISTORY -->
                <section class="panel">

                    <div class="panel-heading">
                        <h3>Riwayat Kunjungan Klinik</h3>
                        <a href="#" class="view-all">Lihat semua</a>
                    </div>

                    <div class="empty-state">
                        <i class="bi bi-calendar2-check"></i>

                        <p>
                            Belum ada riwayat kunjungan.<br>
                            Riwayat akan ditampilkan setelah kamu
                            melakukan kunjungan klinik.
                        </p>
                    </div>

                </section>

                <!-- RIWAYAT LAPORAN DARURAT -->
                <section class="panel" id="riwayat-laporan">

                    <div class="panel-heading">
                        <h3>Riwayat Laporan Darurat</h3>
                    </div>

                    @forelse($laporanSaya as $item)

                        <div style="border:1px solid #edf0f7; border-radius:12px; padding:14px; margin-bottom:12px;">

                            <div style="font-size:12px; font-weight:800; margin-bottom:7px;">
                                {{ $item->incident_type }}
                            </div>

                            <p class="info-desc">
                                Lokasi: {{ $item->location }}
                            </p>

                            <p class="info-desc" style="margin-top:6px;">
                                Waktu: {{ $item->incident_time?->format('d-m-Y H:i') ?? '-' }}
                            </p>

                            <div style="margin-top:10px;">
                                <span class="visit-status">
                                    {{ $item->status }}
                                </span>
                            </div>

                            <div style="margin-top:12px; font-size:11px;">
                                <strong>Catatan Tindak Lanjut Petugas:</strong>

                                <p class="info-desc" style="margin-top:6px; line-height:1.6;">
                                    {{ $item->follow_up ?: 'Belum ada catatan tindak lanjut.' }}
                                </p>
                            </div>

                        </div>

                    @empty

                        <div class="empty-state">
                            <i class="bi bi-file-earmark-text"></i>
                            <p>
                                Belum ada laporan darurat.<br>
                                Laporan yang kamu buat akan muncul di sini.
                            </p>
                        </div>

                     @endforelse

                </section>


                <!-- GUIDE -->
                <a href="#" class="guide-link">
                    <span>
                        <i class="bi bi-book"></i>
                        Panduan &amp; Prosedur Tanggap Darurat
                    </span>

                    <i class="bi bi-arrow-right"></i>
                </a>


                <!-- WARNING -->
                <div class="warning-box" id="kontak-darurat">

                    <div class="warning-icon">
                        <i class="bi bi-asterisk"></i>
                    </div>

                    <p>
                        Untuk kondisi krisis dan darurat medis/keamanan,
                        langsung tekan tombol
                        <strong>Telepon Bantuan Darurat</strong>.
                        Panggilan menggunakan sambungan operator resmi
                        kampus tanpa perlu login.
                        @unless($emergencyPhone)
                            <br><br>
                            <strong>Catatan pengaturan:</strong>
                            Nomor telepon darurat belum dikonfigurasi.
                        @endunless
                    </p>

                </div>

            </div>

        </div>

        <footer style="text-align:center;margin-top:30px;font-size:10px;color:#929bb0">
            SerKoMu © 2026 — Student Health Assistance
        </footer>

    </main>
</div>


<!-- BOTTOM NAVIGATION -->
<nav class="bottom-nav">

    <a href="{{ route('mahasiswa.dashboard') }}"
       class="nav-item-custom active">
        <i class="bi bi-house-door-fill"></i>
        Beranda
    </a>

    <a href="{{ route('emergency-reports.create') }}"
       class="nav-item-custom">
        <i class="bi bi-megaphone"></i>
        Lapor
    </a>

    <a href="{{ route('mahasiswa.klinik') }}" class="nav-item-custom">
        <i class="bi bi-hospital"></i>
        Klinik
    </a>

    <a href="{{ route('mahasiswa.status') }}" class="nav-item-custom">
        <i class="bi bi-clipboard-check"></i>
        Status
    </a>

    <a href="#" class="nav-item-custom">
        <i class="bi bi-person"></i>
        Akun
    </a>
</nav>

</body>
</html>
