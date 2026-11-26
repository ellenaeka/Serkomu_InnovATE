<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - SerKoMu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        :root {
            --bg: #f4f6fb;
            --primary: #4264b5;
            --text: #263454;
            --muted: #5f6b85;
            --border: #e8ecf6;
            --radius-sm: 14px;
            --radius-md: 20px;
            --radius-lg: 26px;
            --shadow: 0 6px 20px rgba(40,60,110,.06);
            --shadow-hover: 0 12px 28px rgba(40,60,110,.11);
            --st-wait-bg: #fff3d6;  --st-wait: #8a5800;
            --st-proc-bg: #e5efff;  --st-proc: #285db5;
            --st-done-bg: #e3f5e9;  --st-done: #1f6b3e;
            --st-cancel-bg: #ffe8e8; --st-cancel: #b03a3a;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--text);
            background: var(--bg);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; }
        a:focus-visible, button:focus-visible {
            outline: 3px solid rgba(66,100,181,.45);
            outline-offset: 3px;
        }
        .sr-only { position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0; }
        .page-wrap { width: 100%; min-height: 100vh; padding: 24px; }
        .app-shell {
            width: 100%;
            max-width: 1400px;
            min-height: calc(100vh - 48px);
            margin: auto;
            padding: 28px 36px 120px;
            background: #f9faff;
            border-radius: var(--radius-lg);
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
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .user-pill {
            display: flex; align-items: center; gap: 10px;
            padding: 7px 16px 7px 8px;
            border: 1px solid var(--border);
            border-radius: 50px;
            background: white;
            cursor: pointer;
            transition: background .2s, box-shadow .2s, transform .2s;
        }
        .user-pill:hover { background: #f0f5ff; box-shadow: var(--shadow); }
        .user-avatar {
            width: 40px; height: 40px;
            flex-shrink: 0;
            border-radius: 50%;
            display: grid; place-items: center;
            background: var(--primary);
            color: white; font-size: 13px; font-weight: 700;
        }
        .user-name {
            font-size: 12px; font-weight: 700;
            max-width: 180px;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .user-status { font-size: 11px; color: #1f6b3e; margin-top: 3px; }
        .menu-btn {
            border: 0;
            background: #eef3ff;
            border-radius: 50%;
            width: 44px; height: 44px;
            color: var(--text);
            font-size: 20px;
            cursor: pointer;
            display: grid; place-items: center;
            transition: background .2s;
        }
        .menu-btn:hover { background: #e0e9ff; }

        /* HERO */
        .hero-card {
            position: relative;
            overflow: hidden;
            padding: 30px 36px;
            border-radius: var(--radius-lg);
            background: linear-gradient(120deg,#f0f5ff,#fff);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            margin-bottom: 24px;
        }
        .hero-card::after {
            content: "";
            position: absolute;
            right: -70px; top: -90px;
            width: 360px; height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(71,125,224,.13), transparent 68%);
            pointer-events: none;
        }
        .hero-card > * { position: relative; z-index: 1; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 8px 14px;
            border-radius: 30px;
            background: #e7efff;
            color: #3c527f;
            font-size: 12px; font-weight: 700;
            margin-bottom: 18px;
        }
        .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--primary); }
        .hero-title {
            font-size: clamp(26px,3vw,36px);
            line-height: 1.2;
            font-weight: 800;
            max-width: 750px;
            margin: 0 0 12px;
            color: #202d4b;
        }
        .accent { color: #477de0; }
        .hero-desc {
            max-width: 620px;
            color: var(--muted);
            font-size: 14.5px;
            line-height: 1.65;
            margin: 0 0 20px;
        }
        .btn-emergency {
            display: flex; align-items: center; gap: 14px;
            width: 100%; max-width: 520px;
            padding: 15px 20px;
            min-height: 68px;
            color: white;
            background: linear-gradient(135deg,#b84a42,#9c3a33);
            border: 2px solid rgba(255,255,255,.25);
            border-radius: var(--radius-md);
            box-shadow: 0 10px 22px rgba(168,61,56,.22);
            transition: transform .2s, box-shadow .2s;
        }
        .btn-emergency:hover { transform: translateY(-2px); box-shadow: 0 14px 28px rgba(188,65,65,.32); }
        .emergency-icon {
            width: 44px; height: 44px;
            flex-shrink: 0;
            border-radius: 13px;
            background: rgba(255,255,255,.16);
            display: grid; place-items: center;
            font-size: 21px;
        }
        .emergency-title { font-size: 14px; font-weight: 800; display: block; }
        .emergency-desc { display: block; font-size: 12px; margin-top: 4px; opacity: .92; }

        /* DASHBOARD GRID */
        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0,1.45fr) minmax(320px,1fr);
            gap: 24px;
            align-items: start;
        }
        .column { min-width: 0; display: flex; flex-direction: column; gap: 22px; }
        .col-block { min-width: 0; }
        .section-head {
            display: flex; align-items: center; justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }
        .section-overline {
            color: var(--muted);
            font-size: 11px; font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .section-title { font-size: 17px; font-weight: 800; margin: 0; }
        .campus-badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11px; color: var(--primary); font-weight: 700;
            white-space: nowrap;
        }

        /* SERVICES */
        .service-list, .service-grid-small {
            display: grid;
            grid-template-columns: repeat(2,minmax(0,1fr));
            gap: 14px;
        }
        .service-card {
            display: flex; align-items: center; gap: 14px;
            min-height: 108px;
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            background: white;
            box-shadow: var(--shadow);
            transition: transform .2s, box-shadow .2s;
        }
        .service-card:hover, .small-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }
        .service-card.primary-soft { background: #f0f5ff; }
        .service-icon, .small-icon {
            flex-shrink: 0;
            display: grid; place-items: center;
            border-radius: var(--radius-sm);
            background: #eaf0ff;
            color: var(--primary);
        }
        .service-icon { width: 48px; height: 48px; font-size: 22px; }
        .service-content { flex: 1; min-width: 0; }
        .service-title, .small-title { font-size: 14px; font-weight: 800; margin-bottom: 5px; }
        .service-desc, .small-desc {
            font-size: 12px;
            line-height: 1.5;
            color: var(--muted);
            margin: 0;
        }
        .mini-badge {
            display: inline-block;
            background: #dce9ff;
            color: #2f5aa8;
            padding: 4px 9px;
            border-radius: 20px;
            font-size: 11px; font-weight: 700;
        }
        .service-arrow {
            width: 34px; height: 34px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #edf2ff;
            color: var(--primary);
            display: grid; place-items: center;
        }
        .service-grid-small { margin-top: 14px; }
        .small-card {
            display: grid;
            grid-template-columns: auto minmax(0,1fr);
            column-gap: 14px;
            align-items: center;
            align-content: center;
            min-height: 88px;
            padding: 16px 18px;
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow);
            transition: transform .2s, box-shadow .2s;
        }
        .small-icon { width: 44px; height: 44px; font-size: 20px; grid-row: span 2; }
        .small-title { align-self: end; }
        .small-desc { align-self: start; }

        /* INFORMATION */
        .info-section { margin-top: 22px; }
        .info-card {
            display: flex; align-items: center; justify-content: space-between;
            gap: 12px;
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 15px 18px;
            margin-bottom: 10px;
            box-shadow: var(--shadow);
        }
        .info-title { font-size: 13px; font-weight: 800; margin-bottom: 5px; }
        .info-desc { color: var(--muted); font-size: 12px; margin: 0; line-height: 1.5; }
        .info-icon { color: #5779db; margin-right: 5px; }
        .info-badge {
            background: #eaf6ef;
            color: #1f6b3e;
            font-size: 11px; font-weight: 700;
            padding: 6px 11px;
            border-radius: 20px;
            white-space: nowrap;
        }

        /* PANELS */
        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 20px;
            margin: 0;
            box-shadow: var(--shadow);
            min-width: 0;
        }
        .panel-heading {
            display: flex; align-items: center; justify-content: space-between;
            gap: 10px;
            margin-bottom: 14px;
        }
        .panel-heading h3 { font-size: 15px; font-weight: 800; margin: 0; }
        .panel-heading h3 small { font-weight: 700; color: var(--muted); font-size: 12px; margin-left: 4px; }
        .view-all { color: var(--primary); font-size: 12.5px; font-weight: 700; white-space: nowrap; padding: 6px 0; }
        .view-all:hover { text-decoration: underline; }
        .visit-item {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            margin-bottom: 8px;
            background: #fff;
        }
        .visit-item:last-child { margin-bottom: 0; }
        .visit-meta {
            display: flex; flex-wrap: wrap; align-items: center;
            gap: 6px 14px;
            margin-top: 6px;
            font-size: 12.5px;
            color: var(--muted);
        }
        .visit-meta > span { display: inline-flex; align-items: center; gap: 5px; min-width: 0; overflow-wrap: anywhere; }
        .visit-meta i { color: #6d82bd; }
        .code-chip {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 9px;
            border-radius: 999px;
            background: #f0f4ff;
            color: #2f4f96;
            font-size: 11.5px; font-weight: 700;
            letter-spacing: .2px;
        }
        .code-chip small { font-weight: 600; color: var(--muted); font-size: 11px; }
        .visit-row {
            display: flex; justify-content: space-between; align-items: center;
            gap: 8px; flex-wrap: wrap;
        }
        .visit-item strong { font-size: 13px; }
        .panel-list {
            max-height: 440px;
            overflow-y: auto;
            margin: 0 -6px;
            padding: 0 6px 2px;
            scrollbar-width: thin;
            scrollbar-color: #cfd8ee transparent;
            overscroll-behavior: contain;
        }
        .panel-list:focus-visible { outline: 3px solid rgba(66,100,181,.35); outline-offset: 2px; border-radius: var(--radius-sm); }

        /* STATUS COLORS */
        .status-pill {
            display: inline-block;
            border-radius: 25px;
            padding: 5px 10px;
            font-size: 11px; font-weight: 700;
            white-space: nowrap;
        }
        .status-waiting { background: var(--st-wait-bg); color: var(--st-wait); }
        .status-processing { background: var(--st-proc-bg); color: var(--st-proc); }
        .status-completed { background: var(--st-done-bg); color: var(--st-done); }
        .status-cancelled { background: var(--st-cancel-bg); color: var(--st-cancel); }
        .status-default { background: #edf0f5; color: #4f5d75; }

        /* TRACKING CODE */
        .tracking-box {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 4px 10px;
            margin-top: 10px;
            padding: 8px 12px;
            background: #f0f5ff;
            border: 1px solid #e0eaff;
            border-radius: 12px;
        }
        .tracking-label {
            color: var(--muted);
            font-size: 10.5px; font-weight: 700;
            letter-spacing: .5px;
        }
        .tracking-value { color: #2f4f96; font-size: 13px; font-weight: 800; overflow-wrap: anywhere; }
        .report-description {
            margin-top: 8px;
            padding: 9px 12px;
            border-radius: 12px;
            background: #f8f9fc;
        }
        .report-description strong,
        .follow-up strong {
            display: flex; align-items: center; gap: 6px;
            font-size: 11.5px;
            margin-bottom: 3px;
        }
        .report-description strong { color: #4f5d75; }
        .report-description p,
        .follow-up p {
            margin: 0;
            font-size: 12.5px;
            line-height: 1.55;
            overflow-wrap: anywhere;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .report-description p { color: #44526d; }
        .follow-up {
            margin-top: 8px;
            padding: 9px 12px;
            background: #edf4ff;
            border-radius: 12px;
            border-left: 3px solid #477de0;
        }
        .follow-up strong { color: #2f4f96; }
        .follow-up p { color: #44526d; }
        .report-link {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            min-height: 44px;
            margin-top: 8px;
            border-radius: 12px;
            color: var(--primary);
            font-size: 12.5px; font-weight: 800;
            transition: background .2s;
        }
        .report-link:hover { background: #f0f4ff; }
        .panel-action {
            display: block;
            width: 100%;
            min-height: 44px;
            padding: 12px;
            text-align: center;
            background: #edf1ff;
            color: var(--primary);
            border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 800;
            margin-top: 14px;
            transition: background .2s;
        }
        .panel-action:hover { background: #dfe8ff; }

        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 18px 12px; color: var(--muted); }
        .empty-state i { font-size: 30px; color: #9aa9d4; display: block; margin-bottom: 10px; }
        .empty-state p { font-size: 13px; line-height: 1.65; margin: 0; }

        /* LEGEND STATUS */
        .status-legend {
            display: flex; flex-wrap: wrap; gap: 6px 12px;
            padding-top: 12px;
            margin-top: 14px;
            border-top: 1px solid var(--border);
        }
        .legend-item { display: flex; align-items: center; gap: 5px; font-size: 11.5px; color: var(--muted); }
        .legend-dot { width: 8px; height: 8px; border-radius: 50%; }

        /* BANTUAN SIAGA (ringkas) */
        .sos-row { display: flex; align-items: center; gap: 14px; }
        .sos-icon {
            width: 46px; height: 46px; flex-shrink: 0;
            border-radius: var(--radius-sm);
            background: #fbefed; color: #a33d31;
            display: grid; place-items: center; font-size: 20px;
        }
        .sos-label { font-size: 12px; color: var(--muted); }
        .sos-number { font-size: 17px; font-weight: 800; color: #202d4b; overflow-wrap: anywhere; }
        .sos-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 14px; }
        .sos-btn {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            min-height: 46px; padding: 10px 12px;
            border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 800; text-align: center;
            transition: background .2s;
        }
        .sos-btn--danger { background: #a94339; color: #fff; }
        .sos-btn--danger:hover { background: #913a31; }
        .sos-btn--soft { background: #edf1ff; color: var(--primary); }
        .sos-btn--soft:hover { background: #dfe8ff; }

        /* BOTTOM NAVIGATION */
        .bottom-nav {
            position: fixed;
            z-index: 1000;
            bottom: calc(16px + env(safe-area-inset-bottom, 0px));
            left: 50%;
            transform: translateX(-50%);
            display: flex; justify-content: space-around; align-items: center;
            width: min(650px, calc(100% - 32px));
            min-height: 68px;
            padding: 7px;
            border: 1px solid var(--border);
            border-radius: 50px;
            background: rgba(255,255,255,.96);
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            box-shadow: 0 12px 35px rgba(35,55,100,.14);
        }
        .nav-item-custom {
            flex: 1 1 0;
            min-width: 0;
            min-height: 52px;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            gap: 4px;
            text-align: center;
            padding: 5px 3px;
            color: var(--muted);
            border-radius: 35px;
            font-size: 11.5px;
            white-space: nowrap;
            transition: background .2s, color .2s;
        }
        .nav-item-custom:hover { background: #f3f6ff; color: var(--primary); }
        .nav-item-custom i { display: block; font-size: 19px; }
        .nav-item-custom.active { background: #edf2ff; color: var(--primary); font-weight: 800; }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            * { transition: none !important; }
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .page-wrap { padding: 14px; }
            .app-shell { padding: 24px 22px 120px; }
            .dashboard-grid { grid-template-columns: 1fr; gap: 20px; }
            .column { display: contents; }
            .block-services { order: 1; }
            .block-upcoming { order: 2; }
            .block-history  { order: 3; }
            .block-reports  { order: 4; }
            .block-help     { order: 5; }
            .panel-list { max-height: 480px; }
        }
        @media (max-width: 600px) {
            .page-wrap { padding: 0; }
            .app-shell {
                min-height: 100vh;
                border-radius: 0;
                padding: 17px 16px 125px;
                box-shadow: none;
            }
            .topbar { margin-bottom: 20px; gap: 10px; }
            .topbar-right { gap: 8px; }
            .user-pill { padding: 5px 10px 5px 5px; gap: 7px; }
            .user-avatar { width: 32px; height: 32px; font-size: 11px; }
            .user-name { font-size: 11px; max-width: 90px; }
            .user-status { font-size: 10.5px; }
            .menu-btn { width: 44px; height: 44px; font-size: 18px; }
            .hero-card { padding: 22px 18px; border-radius: 23px; margin-bottom: 23px; }
            .hero-card::after { width: 220px; height: 220px; right: -60px; top: -70px; }
            .hero-badge { font-size: 11px; padding: 7px 11px; margin-bottom: 14px; }
            .hero-title { font-size: 25px; }
            .hero-desc { font-size: 13px; margin-bottom: 18px; }
            .btn-emergency { padding: 14px 16px; }
            .emergency-icon { width: 38px; height: 38px; font-size: 17px; }
            .emergency-title { font-size: 13px; }
            .emergency-desc { font-size: 11px; }
            .dashboard-grid { gap: 16px; }
            .section-head { margin-bottom: 12px; }
            .section-title { font-size: 16px; }
            .campus-badge { font-size: 10px; }
            .service-list { grid-template-columns: 1fr; gap: 11px; }
            .service-card { min-height: 95px; padding: 14px; }
            .service-icon { width: 45px; height: 45px; font-size: 20px; }
            .service-grid-small { gap: 10px; }
            .small-card {
                display: block;
                min-height: 0;
                padding: 14px;
            }
            .small-icon { width: 42px; height: 42px; font-size: 20px; margin-bottom: 10px; }
            .panel { padding: 16px; }
            .panel-heading h3 { font-size: 14px; }
            .sos-actions { grid-template-columns: 1fr; }
            .bottom-nav {
                bottom: calc(9px + env(safe-area-inset-bottom, 0px));
                width: calc(100% - 20px);
                padding: 6px;
                min-height: 62px;
            }
            .nav-item-custom { font-size: 11px; padding: 5px 2px; min-height: 48px; }
            .nav-item-custom i { font-size: 18px; }
        }
        @media (max-width: 350px) {
            .user-name { max-width: 65px; }
            .nav-item-custom { font-size: 10px; }
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
        <x-brand-logo :href="route('mahasiswa.dashboard')" />
        <div class="topbar-right">
            <a href="{{ route('mahasiswa.akun') }}" class="user-pill" aria-label="Buka profil saya" title="Profil saya">
                <div class="user-avatar">
                    {{ $initials }}
                </div>
                <div>
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-status">Mahasiswa Aktif</div>
                </div>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="menu-btn" aria-label="Keluar dari akun" title="Keluar">
                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
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
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $emergencyPhone) }}" class="btn-emergency">
        @else
            <a href="{{ route('kontak-darurat') }}" class="btn-emergency">
        @endif
                <div class="emergency-icon">
                    <i class="bi bi-telephone-fill" aria-hidden="true"></i>
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
          <div class="col-block block-services">
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
                <a href="{{ route('kontak-darurat') }}"
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
                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                </div>
            </section>
          </div>
            <!-- RIWAYAT LAPORAN DARURAT -->
            <section class="panel block-reports" id="riwayat-laporan" aria-labelledby="judul-riwayat-laporan">
                <div class="panel-heading">
                    <h3 id="judul-riwayat-laporan">Riwayat Laporan Darurat <small>({{ $laporanSaya->count() }})</small></h3>
                    <a href="{{ route('mahasiswa.status') }}"
                       class="view-all">
                        Cek status
                    </a>
                </div>
                <div class="panel-list" tabindex="0" aria-label="Daftar laporan darurat">
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
                        <div class="visit-meta">
                            <span>
                                <i class="bi bi-geo-alt" aria-hidden="true"></i>
                                {{ $item->location }}
                            </span>
                            <span>
                                <i class="bi bi-calendar-event" aria-hidden="true"></i>
                                {{ $item->incident_time?->translatedFormat('d F Y, H:i') ?? '-' }}
                            </span>
                        </div>
                        <!-- KODE PELACAKAN -->
                        <div class="tracking-box">
                            <span class="tracking-label">
                                KODE PELACAKAN
                            </span>
                            <span class="tracking-value">
                                {{ $item->tracking_code ?: 'Kode belum tersedia' }}
                            </span>
                        </div>
                        <!-- DESKRIPSI -->
                        <div class="report-description">
                            <strong>
                                <i class="bi bi-chat-left-text" aria-hidden="true"></i>
                                Ringkasan Kejadian
                            </strong>
                            <p title="{{ $item->description }}">
                                {{ $item->description }}
                            </p>
                        </div>
                        <!-- TINDAK LANJUT -->
                        <div class="follow-up">
                            <strong>
                                <i class="bi bi-clipboard-check" aria-hidden="true"></i>
                                Catatan Tindak Lanjut
                            </strong>
                            <p>
                                {{ $item->follow_up ?: 'Belum ada catatan tindak lanjut dari petugas.' }}
                            </p>
                        </div>
                        <a href="{{ route('mahasiswa.status') }}"
                           class="report-link">
                            Periksa Perkembangan Laporan
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
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
                </div>
            </section>
        </div>
        <!-- RIGHT COLUMN -->
        <div class="column">
            <!-- KUNJUNGAN MENDATANG -->
            <section class="panel block-upcoming">
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
                        <div class="visit-meta">
                            <span>
                                <i class="bi bi-calendar-event" aria-hidden="true"></i>
                                {{ \Carbon\Carbon::parse($kunjungan->tanggal)->translatedFormat('d F Y') }}
                            </span>
                            <span>
                                <i class="bi bi-clock" aria-hidden="true"></i>
                                {{ \Carbon\Carbon::parse($kunjungan->jam)->format('H:i') }} WIB
                            </span>
                            <span class="code-chip">
                                <small>Kode</small>
                                {{ $kunjungan->booking_code }}
                            </span>
                        </div>
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
            <section class="panel block-history">
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
                        <div class="visit-meta">
                            <span>
                                <i class="bi bi-calendar-event" aria-hidden="true"></i>
                                {{ \Carbon\Carbon::parse($kunjungan->tanggal)->translatedFormat('d F Y') }}
                            </span>
                            <span>
                                <i class="bi bi-clock" aria-hidden="true"></i>
                                {{ \Carbon\Carbon::parse($kunjungan->jam)->format('H:i') }} WIB
                            </span>
                            <span class="code-chip">
                                <small>Kode</small>
                                {{ $kunjungan->booking_code }}
                            </span>
                        </div>
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
            <!-- KONTAK & PANDUAN BANTUAN (RINGKAS) -->
            <section class="panel block-help" id="bantuan-siaga" aria-labelledby="judul-bantuan">
                <div class="panel-heading">
                    <h3 id="judul-bantuan">Butuh Bantuan Segera?</h3>
                    <a href="{{ route('kontak-darurat') }}" class="view-all">Detail kontak</a>
                </div>
                <div class="sos-row">
                    <div class="sos-icon"><i class="bi bi-telephone-inbound" aria-hidden="true"></i></div>
                    <div>
                        <div class="sos-label">Nomor Siaga Darurat · 24 Jam</div>
                        <div class="sos-number">{{ $emergencyPhone ?: 'Belum tersedia' }}</div>
                    </div>
                </div>
                <div class="sos-actions">
                    @if($emergencyPhone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $emergencyPhone) }}" class="sos-btn sos-btn--danger">
                            <i class="bi bi-telephone-fill" aria-hidden="true"></i> Telepon Sekarang
                        </a>
                    @else
                        <a href="{{ route('kontak-darurat') }}" class="sos-btn sos-btn--danger">
                            <i class="bi bi-shield-plus" aria-hidden="true"></i> Kontak Darurat
                        </a>
                    @endif
                    <a href="{{ route('panduan-bantuan') }}" class="sos-btn sos-btn--soft">
                        <i class="bi bi-journal-text" aria-hidden="true"></i> Lihat Panduan Bantuan
                    </a>
                </div>
            </section>
        </div>
    </div>
    <footer style="text-align:center;margin-top:28px;font-size:12px;color:#5f6b85">
        SerKoMu © 2026 — Student Health Assistance
    </footer>
</main>
</div>
<!-- BOTTOM NAVIGATION -->
<nav class="bottom-nav" aria-label="Navigasi utama">
    <a href="{{ route('mahasiswa.dashboard') }}"
       class="nav-item-custom active" aria-current="page">
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
    <a href="{{ route('mahasiswa.akun') }}"
       class="nav-item-custom">
        <i class="bi bi-person"></i>
        Profil
    </a>
</nav>
</body>
</html>