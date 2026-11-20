
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - Serkomu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #263238;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0 0 8px;
        }

        .subtitle {
            margin: 0;
            color: #667085;
        }

        .logout button {
            padding: 10px 16px;
            border: 0;
            border-radius: 6px;
            background: #dc3545;
            color: white;
            cursor: pointer;
        }

        .welcome {
            padding: 25px;
            margin-bottom: 25px;
            background: white;
            border-radius: 10px;
        }

        .welcome h2 {
            margin-top: 0;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            flex: 1;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px #0000000d;
        }

        .card p {
            color: #667085;
        }

        .card h2 {
            font-size: 32px;
            margin-bottom: 0;
        }

        .action {
            padding: 25px;
            background: white;
            border-radius: 10px;
        }

        .action a {
            display: inline-block;
            padding: 12px 18px;
            margin-top: 10px;
            border-radius: 6px;
            background: #176b87;
            color: white;
            text-decoration: none;
        }

        @media (max-width: 650px) {
            body {
                padding: 15px;
            }

            .header {
                align-items: flex-start;
            }

            .cards {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div>
            <h1>Dashboard Petugas</h1>
            <p class="subtitle">Sistem Pelaporan Darurat Serkomu</p>
        </div>

        <form class="logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="welcome">
        <h2>Selamat Datang, Petugas!</h2>
        <p>Silakan pantau laporan darurat yang masuk melalui sistem Serkomu.</p>
    </div>

    <div class="cards">
        <div class="card">
            <p>Total Laporan</p>
            <h2>{{ $totalLaporan }}</h2>
        </div>

        <div class="card">
            <p>Laporan Menunggu</p>
            <h2>{{ $laporanMenunggu }}</h2>
        </div>
    </div>

    <div class="action">
        <h2>Kelola Laporan</h2>
        <p>Buka daftar laporan untuk melihat informasi kejadian yang dikirim mahasiswa.</p>

        <a href="{{ route('petugas.laporan.index') }}">
            Lihat Daftar Laporan
        </a>
    </div>

</div>
</body>
</html>
