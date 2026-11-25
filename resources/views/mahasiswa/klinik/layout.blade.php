<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Klinik SerKoMu')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px 15px 115px;
            font-family: Inter, sans-serif;
            background: #f5f6fc;
            color: #293353;
        }

        .page {
            max-width: 720px;
            margin: auto;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            color: #5969b8;
            margin: 0 0 22px 5px;
        }

        .brand i {
            margin-right: 5px;
        }

        .main-card {
            background: #fff;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 10px 35px rgba(45,60,110,.06);
        }

        .steps {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 32px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #9aa3b7;
            font-size: 10px;
            white-space: nowrap;
        }

        .step-number {
            width: 29px;
            height: 29px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #edf0f6;
            font-weight: 700;
        }

        .step.active {
            color: #5969b8;
            font-weight: 700;
        }

        .step.active .step-number {
            background: #5969b8;
            color: white;
        }

        .step.completed .step-number {
            background: #58b58b;
            color: white;
        }

        .step-line {
            height: 2px;
            flex: 1;
            background: #e0e4ef;
        }

        h1 {
            font-size: 23px;
            margin: 0 0 10px;
        }

        h2 {
            font-size: 16px;
        }

        .muted {
            color: #8c96ad;
            font-size: 12px;
            line-height: 1.7;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 700;
            margin: 27px 0 14px;
        }

        .section-title i {
            color: #5969b8;
            font-size: 18px;
        }

        .info-box {
            background: #f3f5ff;
            border: 1px solid #e5e9ff;
            padding: 17px;
            border-radius: 15px;
            margin: 16px 0;
        }

        .verified {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .verified-icon {
            width: 43px;
            height: 43px;
            background: white;
            color: #5969b8;
            border-radius: 13px;
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .verified-text {
            flex: 1;
            min-width: 0;
        }

        .verified-text strong,
        .verified-text small {
            display: block;
        }

        .verified-text strong {
            font-size: 12px;
        }

        .verified-text small {
            font-size: 10px;
            color: #8b95ab;
            margin-top: 5px;
        }

        .status {
            display: inline-block;
            border-radius: 20px;
            padding: 7px 11px;
            font-size: 10px;
            background: #e9f5ec;
            color: #348353;
        }

        .btn {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 15px;
            border-radius: 12px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            margin-top: 12px;
        }

        .btn-primary {
            background: #5969b8;
            color: white;
        }

        .btn-primary:hover {
            background: #4557a3;
        }

        .btn-light {
            background: #f1f3fc;
            color: #5969b8;
        }

        .btn-danger {
            background: #fff0ef;
            color: #c34b4b;
        }

        .btn-white {
            background: white;
            color: #5969b8;
            border: 1px solid #e0e5f3;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin: 18px 0 9px;
        }

        input, select, textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #dfe4f0;
            border-radius: 12px;
            font-family: inherit;
            font-size: 12px;
            color: #293353;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #5969b8;
        }

        .alert {
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 16px;
            font-size: 12px;
            line-height: 1.6;
        }

        .alert-success {
            background: #e8f6ed;
            color: #32784d;
        }

        .alert-danger {
            background: #fff0ef;
            color: #b84646;
        }

        .bottom-nav {
            position: fixed;
            z-index: 100;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: min(650px, calc(100% - 30px));
            padding: 13px 8px;
            background: rgba(255,255,255,.97);
            border-radius: 40px;
            box-shadow: 0 8px 35px rgba(40,50,90,.15);
            display: flex;
            justify-content: space-around;
        }

        .nav-item {
            text-decoration: none;
            color: #8590a9;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            padding: 5px 12px;
        }

        .nav-item i {
            font-size: 18px;
        }

        .nav-item.active {
            color: #5969b8;
            font-weight: 700;
        }

        .appointment-card {
            background: white;
            border-radius: 17px;
            padding: 18px;
            margin-bottom: 14px;
            box-shadow: 0 5px 20px rgba(40,55,100,.04);
        }

        .appointment-details {
            background: #f4f5fb;
            border-radius: 12px;
            padding: 14px;
            margin: 13px 0;
            font-size: 11px;
            line-height: 2.2;
            color: #78849e;
        }

        .booking-code {
            background: #eef1ff;
            padding: 12px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            gap: 8px;
            font-size: 10px;
            overflow-wrap: anywhere;
        }

        .appointment-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .appointment-actions .btn {
            font-size: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 11px;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row span {
            color: #8993aa;
        }

        .summary-row strong {
            text-align: right;
        }

        @media(max-width: 550px) {
            .main-card {
                padding: 21px 17px;
            }

            .step {
                font-size: 9px;
                gap: 4px;
            }

            .step-number {
                width: 25px;
                height: 25px;
            }

            h1 {
                font-size: 20px;
            }

            .appointment-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="page">

    <div class="brand">
        <i class="bi bi-heart-pulse-fill"></i> serkomu.
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data kamu.</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</div>


<nav class="bottom-nav">

    <!-- BERANDA -->
    <a href="{{ route('mahasiswa.dashboard') }}"
       class="nav-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house"></i>
        Beranda
    </a>

    <!-- LAPOR -->
    <a href="{{ route('emergency-reports.create') }}"
       class="nav-item {{ request()->routeIs('emergency-reports.*') ? 'active' : '' }}">
        <i class="bi bi-megaphone"></i>
        Lapor
    </a>

    <!-- KLINIK -->
    <a href="{{ route('mahasiswa.klinik') }}"
       class="nav-item {{ request()->routeIs('mahasiswa.klinik*') ? 'active' : '' }}">
        <i class="bi bi-hospital"></i>
        Klinik
    </a>

    <!-- AKUN -->
    <a href="{{ route('mahasiswa.dashboard') }}"
       class="nav-item">
        <i class="bi bi-person"></i>
        Akun
    </a>

</nav>

@stack('scripts')

</body>
</html>
