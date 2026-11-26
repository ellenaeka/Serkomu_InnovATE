@php
    $isMahasiswa = auth()->check() && (auth()->user()->role ?? null) === 'mahasiswa';
    $backUrl = $isMahasiswa ? route('mahasiswa.dashboard') : route('login');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SerKoMu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #4264b5;
            --primary-soft: #eef2fb;
            --text: #263454;
            --muted: #5f6b85;
            --border: #e8ecf6;
            --bg: #f5f7fc;
            --danger: #b4473a;
            --danger-dark: #9c3a2f;
            --danger-soft: #fbefed;
            --success: #2f8a5b;
            --success-soft: #e9f6ef;
            --radius-sm: 14px;
            --radius-md: 20px;
            --radius-lg: 26px;
            --shadow-sm: 0 2px 8px rgba(38, 52, 84, .05);
            --shadow-md: 0 10px 28px rgba(38, 52, 84, .08);
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.55;
            -webkit-font-smoothing: antialiased;
        }
        a { color: var(--primary); }
        :focus-visible { outline: 3px solid rgba(66, 100, 181, .45); outline-offset: 3px; border-radius: 10px; }

        .page {
            max-width: 640px;
            margin: 0 auto;
            padding: 20px 18px {{ $isMahasiswa ? '128px' : '40px' }};
        }

        .appbar {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 22px;
        }
        .icon-btn {
            width: 44px; height: 44px; flex: 0 0 44px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 50%;
            background: #fff; border: 1px solid var(--border);
            color: var(--text); text-decoration: none; font-size: 18px;
            box-shadow: var(--shadow-sm);
            transition: background .15s, border-color .15s;
        }
        .icon-btn:hover { background: var(--primary-soft); border-color: #d7def1; }
        .appbar h1 { font-size: 18px; margin: 0; font-weight: 700; flex: 1; }
        .appbar-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            background: var(--primary); color: #fff;
            display: inline-flex; align-items: center; justify-content: center; font-size: 17px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            padding: 24px;
        }
        .card + .card, .section + .section { margin-top: 16px; }

        .chip {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 12px; border-radius: 999px;
            font-size: 12.5px; font-weight: 700;
        }
        .chip--danger { background: var(--danger-soft); color: var(--danger); }
        .chip--muted  { background: var(--primary-soft); color: var(--muted); font-weight: 600; }

        .btn {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            width: 100%; min-height: 52px; padding: 14px 20px;
            border: 0; border-radius: var(--radius-sm);
            font: inherit; font-weight: 700; font-size: 15.5px;
            text-decoration: none; cursor: pointer;
            transition: transform .12s, box-shadow .15s, background .15s;
        }
        .btn:active { transform: translateY(1px); }
        .btn--danger { background: var(--danger); color: #fff; box-shadow: 0 8px 20px rgba(180, 71, 58, .25); }
        .btn--danger:hover { background: var(--danger-dark); }
        .btn--soft { background: var(--primary-soft); color: var(--primary); }
        .btn--soft:hover { background: #e3e9f8; }

        .note { font-size: 12.5px; color: var(--muted); }
        .footnote {
            display: flex; gap: 8px; align-items: flex-start;
            margin-top: 22px; font-size: 12px; color: var(--muted);
        }

        .guest-back {
            display: flex; justify-content: center; margin-top: 22px;
        }
        .guest-back a {
            display: inline-flex; align-items: center; gap: 8px; min-height: 44px;
            padding: 0 18px; border-radius: 999px; background: #fff;
            border: 1px solid var(--border); font-weight: 700; font-size: 14px; text-decoration: none;
        }

        .bottom-nav {
            position: fixed; left: 50%; bottom: 16px; transform: translateX(-50%);
            width: min(560px, calc(100% - 24px));
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 4px;
            padding: 7px; background: rgba(255, 255, 255, .96);
            border: 1px solid var(--border); border-radius: 50px;
            box-shadow: 0 14px 36px rgba(38, 52, 84, .14);
            backdrop-filter: blur(10px); z-index: 50;
        }
        .bottom-nav a {
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 3px;
            min-height: 52px; border-radius: 35px;
            color: var(--muted); text-decoration: none; font-size: 12.5px;
        }
        .bottom-nav a i { font-size: 20px; }
        .bottom-nav a:hover { background: var(--bg); color: var(--text); }

        @yield('styles')

        @media (max-width: 380px) {
            .page { padding-left: 14px; padding-right: 14px; }
            .card { padding: 20px 18px; }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="appbar">
            <a href="{{ $backUrl }}" class="icon-btn" aria-label="Kembali">
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
            </a>
            <h1>@yield('title')</h1>
            @if($isMahasiswa)
                <a href="{{ route('mahasiswa.akun') }}" class="appbar-avatar" aria-label="Profil saya">
                    <i class="bi bi-person-fill" aria-hidden="true"></i>
                </a>
            @endif
        </header>

        @yield('content')

        @unless($isMahasiswa)
            <div class="guest-back">
                <a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Kembali ke halaman masuk</a>
            </div>
        @endunless
    </main>

    @if($isMahasiswa)
        <nav class="bottom-nav" aria-label="Navigasi utama">
            <a href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house" aria-hidden="true"></i>Beranda</a>
            <a href="{{ route('emergency-reports.create') }}"><i class="bi bi-megaphone" aria-hidden="true"></i>Lapor</a>
            <a href="{{ route('mahasiswa.klinik') }}"><i class="bi bi-hospital" aria-hidden="true"></i>Klinik</a>
            <a href="{{ route('mahasiswa.akun') }}"><i class="bi bi-person" aria-hidden="true"></i>Profil</a>
        </nav>
    @endif
</body>
</html>