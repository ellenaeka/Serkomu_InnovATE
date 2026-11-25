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
            --primary: #4264b5;
            --text: #263454;
            --muted: #7d89a2;
            --border: #edf0f7;
            --shadow: 0 8px 25px rgba(40,60,110,.06);
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
            padding: 30px 38px 130px;
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
            display: grid;
            place-items: center;
            color: #2865b5;
            font-size: 23px;
        }
        .brand-name {
            color: var(--primary);
            font-size: 21px;
            font-weight: 800;
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
            display: grid;
            place-items: center;
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
            background: #eef3ff;
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
            background: linear-gradient(120deg,#f0f5ff,#fff);
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
        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
        }
        .hero-title {
            font-size: clamp(26px,3vw,36px);
            line-height: 1.2;
            font-weight: 800;
            max-width: 750px;
            margin: 0 0 12px;
            color: #202d4b;
        }
        .accent {
            color: #477de0;
        }
        .hero-desc {
            max-width: 650px;
            color: #68758e;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 0 22px;
        }
        .btn-emergency {
            display: flex;
            align-items: center;
            gap: 14px;
            width: 100%;
            max-width: 520px;
            padding: 17px 20px;
            color: white;
            background: linear-gradient(135deg,#c6534c,#a83d38);
            border: 2px solid rgba(255,255,255,.25);
            border-radius: 16px;
            box-shadow: 0 10px 22px rgba(188,65,65,.25);
        }
        .emergency-icon {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            border-radius: 13px;
            background: rgba(255,255,255,.16);
            display: grid;
            place-items: center;
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
        }
        /* DASHBOARD GRID */
        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0,1.55fr) minmax(300px,1fr);
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
        /* SERVICES */
        .service-list,
        .service-grid-small {
            display: grid;
            grid-template-columns: repeat(2,minmax(0,1fr));
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
        .service-icon,
        .small-icon {
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 15px;
            background: #eaf0ff;
            color: var(--primary);
        }
        .service-icon {
            width: 48px;
            height: 48px;
            font-size: 22px;
        }
        .service-content {
            flex: 1;
            min-width: 0;
        }
        .service-title,
        .small-title {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .service-desc,
        .small-desc {
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
            display: grid;
            place-items: center;
        }
        .service-grid-small {
            margin-top: 14px;
        }
        .small-card {
            display: block;
            min-height: 130px;
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
            font-size: 20px;
            margin-bottom: 12px;
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
            line-height: 1.5;
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
        /* PANELS */
        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 19px;
            padding: 20px;
            margin-bottom: 22px;
            box-shadow: var(--shadow);
            min-width: 0;
        }
        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 16px;
        }
        .panel-heading h3 {
            font-size: 15px;
            font-weight: 800;
            margin: 0;
        }
        .view-all {
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }
        .view-all:hover {
            text-decoration: underline;
        }
        .visit-item {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 10px;
            background: #fff;
        }
        .visit-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .visit-item strong {
            font-size: 12px;
        }
        .visit-item p {
            margin: 8px 0 0;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.6;
            overflow-wrap: anywhere;
        }
        /* STATUS COLORS */
        .status-pill {
            display: inline-block;
            border-radius: 25px;
            padding: 6px 11px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }
        .status-waiting {
            background: #fff3d6;
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
        /* TRACKING CODE */
        .tracking-box {
            margin-top: 11px;
            padding: 10px 12px;
            background: #f0f5ff;
            border: 1px solid #e0eaff;
            border-radius: 10px;
        }
        .tracking-label {
            display: block;
            color: #7d89a2;
            font-size: 9px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .tracking-value {
            color: #315b9c;
            font-size: 12px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }
        .report-description {
            margin-top: 11px;
            padding: 12px;
            border-radius: 10px;
            background: #f8f9fc;
        }
        .report-description strong {
            display: block;
            font-size: 10px;
            color: #66738c;
            margin-bottom: 6px;
        }
        .report-description p {
            margin: 0;
            font-size: 11px;
            color: #53617b;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }
        .follow-up {
            margin-top: 10px;
            padding: 12px;
            background: #edf4ff;
            border-radius: 10px;
            border-left: 3px solid #477de0;
        }
        .follow-up strong {
            display: block;
            font-size: 10px;
            color: #315b9c;
            margin-bottom: 6px;
        }
        .follow-up p {
            font-size: 11px;
            color: #536681;
            line-height: 1.7;
            margin: 0;
            overflow-wrap: anywhere;
        }
        .panel-action {
            display: block;
            width: 100%;
            padding: 12px;
            text-align: center;
            background: #edf1ff;
            color: var(--primary);
            border-radius: 10px;
            font-size: 11px;
            font-weight: 800;
            margin-top: 15px;
        }
        .panel-action:hover {
            background: #dfe8ff;
        }
        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 25px 12px;
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
            line-height: 1.7;
            margin: 0;
        }
        /* LEGEND STATUS */
        .status-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding-top: 12px;
            margin-top: 12px;
            border-top: 1px solid var(--border);
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 9px;
            color: #68748a;
        }
        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        /* KONTAK BANTUAN M4 DAN M5 */
        .contact-section { margin-top: 25px; }
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .contact-card {
            min-width: 0;
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 22px;
            box-shadow: var(--shadow);
        }
        .contact-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }
        .contact-header i { color: var(--primary); font-size: 21px; }
        .contact-header h3 { font-size: 15px; margin: 0; }
        .contact-label {
            display: inline-block;
            background: #fff0ef;
            color: #b54b45;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            margin-bottom: 15px;
        }
        .phone-display {
            text-align: center;
            padding: 22px 12px;
            background: #f8f9ff;
            border-radius: 15px;
            margin: 18px 0 15px;
        }
        .phone-display > i { font-size: 30px; color: #b54b45; }
        .phone-display small {
            display: block;
            color: var(--muted);
            margin: 10px 0;
            font-size: 11px;
        }
        .phone-display strong {
            display: block;
            font-size: 23px;
            color: #202d4b;
            overflow-wrap: anywhere;
        }
        .contact-call {
            display: block;
            text-align: center;
            padding: 14px;
            background: #a94d43;
            color: white;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
            margin-top: 15px;
        }
        .contact-call:hover { background: #913d35; color: white; }
        .contact-note {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
            margin-top: 13px;
        }
        .contact-note p { margin: 9px 0; }
        .contact-divider {
            border: 0;
            border-top: 1px solid var(--border);
            margin: 18px 0;
        }
        .contact-step {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
        }
        .step-number {
            flex-shrink: 0;
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            background: #4264b5;
            color: white;
            border-radius: 50%;
            font-weight: 700;
            font-size: 12px;
        }
        .step-content { flex: 1; min-width: 0; }
        .step-content strong {
            font-size: 12px;
            display: block;
            margin-bottom: 5px;
        }
        .step-content p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
            margin: 0;
        }
        .contact-alert {
            background: #f0f3ff;
            border-radius: 14px;
            padding: 16px;
            margin-top: 15px;
            font-size: 11px;
            color: #586b9b;
            line-height: 1.7;
        }
        .contact-alert p { margin: 8px 0 0; }
        @media (max-width: 600px) {
            .contact-grid { grid-template-columns: 1fr; }
            .contact-card { padding: 17px; }
            .phone-display strong { font-size: 20px; }
        }
        /* WARNING */
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
            line-height: 1.7;
        }
        .warning-box strong {
            color: #bc4141;
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
            width: min(650px,calc(100% - 32px));
            min-height: 68px;
            padding: 7px;
            border: 1px solid var(--border);
            border-radius: 50px;
            background: rgba(255,255,255,.98);
            box-shadow: 0 12px 35px rgba(35,55,100,.14);
        }
        .nav-item-custom {
            flex: 1 1 0;
            min-width: 0;
            min-height: 52px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 4px;
            text-align: center;
            padding: 5px 3px;
            color: #7c879c;
            border-radius: 35px;
            font-size: 10px;
            white-space: nowrap;
            transition: background .2s,color .2s;
        }
        .nav-item-custom i {
            display: block;
            font-size: 19px;
        }
        .nav-item-custom.active {
            background: #edf2ff;
            color: var(--primary);
            font-weight: 800;
        }
        .nav-item-custom:active {
            transform: none;
        }
        /* RESPONSIVE */
        @media(max-width:991px) {
            .page-wrap {
                padding: 14px;
            }
            .app-shell {
                padding: 24px 22px 120px;
            }
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
        @media(max-width:600px) {
            .page-wrap {
                padding: 0;
            }
            .app-shell {
                min-height: 100vh;
                border-radius: 0;
                padding: 17px 16px 125px;
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
                max-width: 85%;
            }
            .hero-desc {
                font-size: 12px;
                max-width: 85%;
                margin-bottom: 17px;
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
            .panel {
                padding: 16px;
            }
            .panel-heading h3 {
                font-size: 14px;
            }
            .bottom-nav {
                bottom: 9px;
                width: calc(100% - 20px);
                padding: 6px;
                min-height: 62px;
            }
            .nav-item-custom {
                font-size: 9px;
                padding: 5px 2px;
                min-height: 48px;
            }
            .nav-item-custom i {
                font-size: 17px;
            }
        }
        @media(max-width:350px) {
            .user-name {
                max-width: 65px;
            }
            .campus-badge {
                font-size: 8px;
            }
            .nav-item-custom {
                font-size: 8px;
            }
            .nav-item-custom i {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
@php
    $user = auth()->user();
    $emergencyPhone = config('serkomu.emergency_phone');
    $getStatusClass = function ($status) {
        return match ($status) {
            'Menunggu' => 'status-waiting',
            'Diproses' => 'status-processing',
            'Selesai' => 'status-completed',
            'Dibatalkan' => 'status-cancelled',
            default => 'status-default',
        };
    };
@endphp
<div class="page-wrap">
<main class="app-shell">
    <!-- HEADER -->
    <header class="topbar">
        <div class="brand">
            <div class="brand-logo">
                <i class="bi bi-plus-lg"></i>
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
                <button type="submit" class="menu-btn" aria-label="Logout">
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
                <a href="{{ route('mahasiswa.klinik') }}"
                   class="service-card primary-soft">
                    <div class="service-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="service-content">
                        <div class="service-title">
                            Daftar Kunjungan
                        </div>
                        <span class="mini-badge">
                            Pendaftaran Klinik
                        </span>
                        <p class="service-desc" style="margin-top:6px">
                            Daftar dari rumah atau kos sebelum datang ke klinik.
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
                        <div class="service-title">
                            Buat Laporan
                        </div>
                        <p class="service-desc">
                            Laporkan insiden kampus secara cepat dan terarah.
                        </p>
                    </div>
                    <div class="service-arrow">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
            </section>
            <!-- SMALL SERVICES -->
            <section class="service-grid-small">
                <a href="{{ route('mahasiswa.status') }}"
                   class="small-card">
                    <div class="small-icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div class="small-title">Cek Status</div>
                    <div class="small-desc">
                        Pantau progres laporan
                    </div>
                </a>
                <a href="#kontak-darurat"
                   class="small-card">
                    <div class="small-icon">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <div class="small-title">Kontak Bantuan</div>
                    <div class="small-desc">
                        Informasi bantuan darurat
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
                <div class="info-card">
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
                </div>
            </section>
        </div>
        <!-- RIGHT COLUMN -->
        <div class="column">
            <!-- KUNJUNGAN MENDATANG -->
            <section class="panel">
                <div class="panel-heading">
                    <h3>Kunjungan Mendatang</h3>
                    <a href="{{ route('mahasiswa.klinik') }}"
                       class="view-all">
                        Lihat semua
                    </a>
                </div>
                @forelse($kunjunganMendatang as $kunjungan)
                    <div class="visit-item">
                        <div class="visit-row">
                            <strong>{{ $kunjungan->poli }}</strong>
                            <span class="status-pill {{ $getStatusClass($kunjungan->status) }}">
                                {{ $kunjungan->status }}
                            </span>
                        </div>
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($kunjungan->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p>
                            <i class="bi bi-clock"></i>
                            {{ \Carbon\Carbon::parse($kunjungan->jam)->format('H:i') }} WIB
                        </p>
                        <p>
                            Kode:
                            <strong>{{ $kunjungan->booking_code }}</strong>
                        </p>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-calendar-check"></i>
                        <p>
                            Belum ada jadwal terdaftar.<br>
                            Silakan daftar kunjungan terlebih dahulu.
                        </p>
                    </div>
                @endforelse
                <a href="{{ route('mahasiswa.klinik') }}"
                   class="panel-action">
                    Daftar Sekarang
                </a>
                <div class="status-legend">
                    <div class="legend-item">
                        <span class="legend-dot" style="background:#dca42f"></span>
                        Menunggu
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot" style="background:#397bd2"></span>
                        Diproses
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot" style="background:#38a36b"></span>
                        Selesai
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot" style="background:#cf5555"></span>
                        Dibatalkan
                    </div>
                </div>
            </section>
            <!-- RIWAYAT KUNJUNGAN -->
            <section class="panel">
                <div class="panel-heading">
                    <h3>Riwayat Kunjungan Klinik</h3>
                    <a href="{{ route('mahasiswa.klinik.riwayat') }}"
                       class="view-all">
                        Riwayat kunjungan
                    </a>
                </div>
                @forelse($riwayatKlinik as $kunjungan)
                    <div class="visit-item">
                        <div class="visit-row">
                            <strong>{{ $kunjungan->poli }}</strong>
                            <span class="status-pill {{ $getStatusClass($kunjungan->status) }}">
                                {{ $kunjungan->status }}
                            </span>
                        </div>
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($kunjungan->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p>
                            <i class="bi bi-clock"></i>
                            {{ \Carbon\Carbon::parse($kunjungan->jam)->format('H:i') }} WIB
                        </p>
                        <p>
                            Kode:
                            <strong>{{ $kunjungan->booking_code }}</strong>
                        </p>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-calendar2-check"></i>
                        <p>
                            Belum ada riwayat kunjungan.<br>
                            Riwayat akan muncul setelah kunjungan selesai
                            atau dibatalkan.
                        </p>
                    </div>
                @endforelse
                <div class="status-legend">
                    <div class="legend-item">
                        <span class="legend-dot" style="background:#38a36b"></span>
                        Selesai
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot" style="background:#cf5555"></span>
                        Dibatalkan
                    </div>
                </div>
            </section>
            <!-- RIWAYAT LAPORAN DARURAT -->
            <section class="panel" id="riwayat-laporan">
                <div class="panel-heading">
                    <h3>Riwayat Laporan Darurat</h3>
                    <a href="{{ route('mahasiswa.status') }}"
                       class="view-all">
                        Cek status
                    </a>
                </div>
                @forelse($laporanSaya as $item)
                    <div class="visit-item">
                        <div class="visit-row">
                            <strong>
                                {{ $item->incident_type }}
                            </strong>
                            <span class="status-pill {{ $getStatusClass($item->status) }}">
                                {{ $item->status }}
                            </span>
                        </div>
                        <p>
                            <i class="bi bi-geo-alt"></i>
                            {{ $item->location }}
                        </p>
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            {{ $item->incident_time?->translatedFormat('d F Y, H:i') ?? '-' }}
                        </p>
                        <!-- KODE PELACAKAN -->
                        <div class="tracking-box">
                            <span class="tracking-label">
                                KODE PELACAKAN LAPORAN
                            </span>
                            <span class="tracking-value">
                                {{ $item->tracking_code ?: 'Kode belum tersedia' }}
                            </span>
                        </div>
                        <!-- DESKRIPSI -->
                        <div class="report-description">
                            <strong>
                                <i class="bi bi-chat-left-text"></i>
                                Ringkasan Kejadian
                            </strong>
                            <p>
                                {{ $item->description }}
                            </p>
                        </div>
                        <!-- TINDAK LANJUT -->
                        <div class="follow-up">
                            <strong>
                                <i class="bi bi-clipboard-check"></i>
                                Catatan Tindak Lanjut
                            </strong>
                            <p>
                                {{ $item->follow_up ?: 'Belum ada catatan tindak lanjut dari petugas.' }}
                            </p>
                        </div>
                        <a href="{{ route('mahasiswa.status') }}"
                           class="panel-action">
                            Periksa Perkembangan Laporan
                            <i class="bi bi-arrow-right"></i>
                        </a>
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
            <!-- KONTAK BANTUAN M4 DAN M5 -->
            <section class="contact-section" id="kontak-darurat">
                <div class="section-head">
                    <div>
                        <div class="section-overline">Pusat Bantuan</div>
                        <h2 class="section-title">Kontak & Panduan Bantuan</h2>
                    </div>
                </div>
                <div class="contact-grid">
                    <!-- M4: KONTAK BANTUAN DARURAT -->
                    <div class="contact-card">
                        <div class="contact-header">
                            <i class="bi bi-shield-plus"></i>
                            <h3>Panggilan Bantuan Darurat</h3>
                        </div>
                        <div class="contact-label">
                            <i class="bi bi-alarm"></i>
                            Layanan Siaga 24 Jam
                        </div>
                        <h3 style="font-size:18px; margin-bottom:8px;">
                            Posko Bantuan & Siaga Kampus
                        </h3>
                        <p class="contact-note">
                            Kontak darurat untuk mendapatkan bantuan ketika terjadi
                            kondisi mendesak di lingkungan kampus.
                        </p>
                        <div class="phone-display">
                            <i class="bi bi-telephone-inbound"></i>
                            <small>NOMOR SIAGA DARURAT</small>
                            @if($emergencyPhone)
                                <strong>{{ $emergencyPhone }}</strong>
                            @else
                                <strong>Belum tersedia</strong>
                            @endif
                        </div>
                        @if($emergencyPhone)
                            <a href="tel:{{ $emergencyPhone }}" class="contact-call">
                                <i class="bi bi-telephone-fill"></i>
                                Telepon Sekarang
                            </a>
                        @else
                            <div class="contact-alert">
                                <i class="bi bi-info-circle"></i>
                                Nomor darurat belum dikonfigurasi. Silakan hubungi
                                pihak kampus untuk memperoleh nomor resmi yang dapat
                                dihubungi.
                            </div>
                        @endif
                        <p class="contact-note" style="text-align:center;">
                            Panggilan menggunakan layanan telepon operator dan
                            dapat dikenakan biaya.
                        </p>
                        <hr class="contact-divider">
                        <strong style="font-size:13px;">
                            <i class="bi bi-question-circle" style="color:var(--primary);"></i>
                            Kapan Menghubungi Nomor Ini?
                        </strong>
                        <div class="contact-note">
                            <p><i class="bi bi-check-circle" style="color:#32845b;"></i>
                                Situasi darurat medis langsung atau kecelakaan fisik.</p>
                            <p><i class="bi bi-check-circle" style="color:#32845b;"></i>
                                Ancaman keselamatan jiwa dan membutuhkan bantuan segera.</p>
                            <p><i class="bi bi-check-circle" style="color:#32845b;"></i>
                                Evakuasi darurat atau gangguan keamanan kritis.</p>
                        </div>
                        <a href="{{ route('emergency-reports.create') }}" class="panel-action">
                            <i class="bi bi-pencil-square"></i>
                            Buat Laporan Insiden Online
                        </a>
                    </div>
                    <!-- M5: PANDUAN MEMINTA BANTUAN -->
                    <div class="contact-card">
                        <div class="contact-header">
                            <i class="bi bi-clipboard-check"></i>
                            <h3>Panduan Meminta Bantuan</h3>
                        </div>
                        <div style="background:#edf1ff; padding:18px; border-radius:15px; margin-bottom:20px;">
                            <h3 style="font-size:17px; margin:0 0 8px;">
                                Langkah Mudah Meminta Bantuan
                            </h3>
                            <p class="contact-note" style="margin:0;">
                                Ikuti panduan ini agar penanganan berlangsung cepat
                                dan tepat.
                            </p>
                        </div>
                        <div class="contact-step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <strong>Cari Kontak Layanan</strong>
                                <p>Pilih layanan kesehatan atau keamanan sesuai dengan situasi yang dihadapi.</p>
                            </div>
                        </div>
                        <div class="contact-step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <strong>Sampaikan Lokasi Spesifik</strong>
                                <p>Berikan nama gedung, lantai, dan nomor ruangan secara jelas.</p>
                            </div>
                        </div>
                        <div class="contact-step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <strong>Jelaskan Kondisi Singkat</strong>
                                <p>Ceritakan kondisi darurat atau keluhan yang sedang dihadapi.</p>
                            </div>
                        </div>
                        <div class="contact-step">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <strong>Ikuti Instruksi Petugas</strong>
                                <p>Tetap tenang dan tunggu konfirmasi pendampingan dari petugas.</p>
                            </div>
                        </div>
                        <div class="contact-alert">
                            <strong style="font-size:13px;">
                                <i class="bi bi-headset"></i>
                                Perlu Bantuan Cepat Sekarang?
                            </strong>
                            <p>
                                Hubungi layanan bantuan darurat kampus untuk
                                mendapatkan penanganan lebih lanjut.
                            </p>
                            @if($emergencyPhone)
                                <a href="tel:{{ $emergencyPhone }}" class="contact-call">
                                    <i class="bi bi-telephone-fill"></i>
                                    Telepon Bantuan Darurat
                                </a>
                            @else
                                <p>Nomor telepon darurat belum tersedia.</p>
                            @endif
                        </div>
                        <p class="contact-note">
                            <i class="bi bi-info-circle"></i>
                            Panduan ini bersifat informatif dan bukan pengganti
                            penanganan medis profesional.
                        </p>
                    </div>
                </div>
            </section>
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
    <a href="{{ route('mahasiswa.klinik') }}"
       class="nav-item-custom">
        <i class="bi bi-hospital"></i>
        Klinik
    </a>
    <a href="#kontak-darurat"
       class="nav-item-custom">
        <i class="bi bi-person"></i>
        Profil
    </a>
</nav>
</body>
</html>