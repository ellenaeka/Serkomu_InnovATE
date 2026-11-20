
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Klinik - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fd;
            color: #263653;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            min-height: 100vh;
            margin: 0 auto;
            padding: 30px 45px 100px;
            background: #f9faff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .brand {
            color: #2865b5;
            font-size: 20px;
            font-weight: 800;
        }

        .brand small {
            display: block;
            color: #8792a8;
            font-size: 10px;
            font-weight: normal;
        }

        .profile {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #1766b5;
            color: white;
            display: grid;
            place-items: center;
        }

        .greeting {
            margin-bottom: 20px;
        }

        .greeting h2 {
            font-size: 21px;
            margin: 12px 0 6px;
        }

        .greeting p {
            color: #7b879b;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }

        .connected {
            font-size: 10px;
            color: #426bb0;
            background: #edf3ff;
            padding: 7px 10px;
            border-radius: 20px;
            display: inline-block;
        }

        .booking-card {
            background: linear-gradient(135deg, white, #eaf1ff);
            border-radius: 18px;
            padding: 17px;
            box-shadow: 0 5px 18px rgba(40,70,130,.08);
            margin-bottom: 15px;
        }

        .booking-icon {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: #1766b5;
            color: white;
            font-size: 20px;
        }

        .booking-content {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 15px;
        }

        .tag {
            display: inline-block;
            background: #dce8ff;
            color: #315b9c;
            padding: 4px 7px;
            border-radius: 5px;
            font-size: 9px;
            font-weight: bold;
        }

        .booking-content h3 {
            font-size: 14px;
            margin: 5px 0;
        }

        .booking-content p {
            font-size: 10px;
            line-height: 1.5;
            color: #7c879b;
            margin: 0;
        }

        .primary-btn {
            display: block;
            width: 100%;
            border: none;
            background: #176dbd;
            color: white;
            padding: 12px;
            border-radius: 9px;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 3px 7px #b6d1f3;
        }

        .service-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 22px;
        }

        .service-box {
            background: white;
            padding: 12px 9px;
            border-radius: 12px;
            display: flex;
            gap: 9px;
            align-items: center;
        }

        .service-box i {
            font-size: 19px;
            color: #286cc1;
        }

        .service-box strong {
            font-size: 10px;
            display: block;
        }

        .service-box small {
            font-size: 9px;
            display: block;
            margin-top: 4px;
        }

        .green {
            color: #16875a;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .section-title h3 {
            font-size: 14px;
            margin: 0;
        }

        .section-title small {
            font-size: 9px;
            color: #8792a5;
        }

        .visit-card {
            background: white;
            padding: 14px;
            border-radius: 14px;
            margin-bottom: 13px;
            box-shadow: 0 3px 12px rgba(40,60,100,.04);
        }

        .visit-status {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 13px;
        }

        .status-pill {
            background: #dce8ff;
            color: #315b9c;
            border-radius: 20px;
            padding: 7px 10px;
            font-size: 9px;
        }

        .visit-card h4 {
            font-size: 12px;
            margin: 8px 0;
        }

        .visit-card p {
            font-size: 10px;
            color: #7d879a;
            margin: 5px 0;
        }

        .visit-detail {
            background: #f3f6fc;
            border-radius: 9px;
            padding: 10px;
            margin-top: 10px;
        }

        .visit-detail p {
            line-height: 1.6;
        }

        .booking-code {
            background: #edf3ff;
            padding: 9px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            font-size: 9px;
            border-radius: 7px;
        }

        .booking-code strong {
            color: #2865b5;
        }

        .visit-actions {
            display: flex;
            gap: 8px;
            margin-top: 13px;
        }

        .visit-actions a {
            flex: 1;
            text-align: center;
            padding: 10px 5px;
            border-radius: 7px;
            font-size: 10px;
            text-decoration: none;
            background: #e4f1ff;
            color: #1766b5;
        }

        .history-card {
            background: white;
            padding: 13px;
            border-radius: 13px;
            margin-bottom: 9px;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .history-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #edf3ff;
            display: grid;
            place-items: center;
            color: #2865b5;
        }

        .history-content {
            flex: 1;
        }

        .history-content strong {
            font-size: 11px;
        }

        .history-content p {
            font-size: 10px;
            color: #7d879a;
            margin: 5px 0;
        }

        .history-content small {
            font-size: 9px;
            color: #16875a;
        }

        .history-link {
            display: block;
            text-align: center;
            padding: 11px;
            color: #1766b5;
            border: 1px solid #cce4ff;
            text-decoration: none;
            font-size: 11px;
            margin-top: 10px;
        }

        .notice {
            background: #eef3ff;
            color: #6d7890;
            padding: 13px;
            border-radius: 12px;
            font-size: 10px;
            line-height: 1.6;
            margin-top: 17px;
        }

        .bottom-nav {
            position: fixed;
            z-index: 1000;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: min(650px, calc(100% - 40px));
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 12px;
            border-radius: 40px;
            box-shadow: 0 5px 25px rgba(30,50,100,.13);
        }

        .bottom-nav a {
            flex: 1;
            text-align: center;
            text-decoration: none;
            color: #8290a4;
            font-size: 9px;
        }

        .bottom-nav i {
            display: block;
            font-size: 17px;
            margin-bottom: 4px;
        }

        .bottom-nav .active {
            color: #1766b5;
            font-weight: bold;
        }

        @media(min-width: 600px) {
            .container {
                margin-top: 20px;
                margin-bottom: 20px;
                border-radius: 20px;
                box-shadow: 0 5px 25px rgba(30,50,100,.06);
            }
        }
        @media (min-width: 768px) {

            .container {
                padding: 35px 55px 120px;
            }

            .header {
                margin-bottom: 30px;
            }

            .greeting h2 {
                font-size: 30px;
            }

            .greeting p {
                font-size: 14px;
            }

            .booking-card {
                padding: 30px;
                border-radius: 22px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 25px;
            }

            .booking-content {
                margin-bottom: 0;
            }

            .primary-btn {
                white-space: nowrap;
            }

            .service-info {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .visit-card {
                padding: 25px;
            }

            .section-title h3 {
                font-size: 19px;
            }

        }

        @media (max-width: 767px) {
            .container {
                padding: 18px 15px 105px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <header class="header">
        <div class="brand">
            serkomu.
            <small>Telkom University</small>
        </div>

        <div class="profile">
            <i class="bi bi-person-fill"></i>
        </div>
    </header>

    <div class="connected">
        <i class="bi bi-circle-fill" style="font-size:6px"></i>
        Akun SOS Terhubung • {{ auth()->user()->name }}
    </div>

    <section class="greeting">
        <h2>Halo, {{ auth()->user()->name }}! 👋</h2>
        <p>Kelola jadwal dan riwayat kunjungan klinikmu dengan mudah.</p>
    </section>

    <section class="booking-card">

        <div class="booking-content">
            <div class="booking-icon">
                <i class="bi bi-briefcase-medical"></i>
            </div>

            <div>
                <span class="tag">LAYANAN KAMPUS</span>
                <h3>Daftar Kunjungan Klinik</h3>
                <p>Pilih layanan kesehatan dan jadwalkan kunjunganmu.</p>
            </div>
        </div>

        <a href="{{ route('mahasiswa.klinik.create') }}" class="primary-btn">
            <i class="bi bi-plus-circle"></i>
            Daftar Kunjungan Baru
        </a>

    </section>

    <section class="service-info">

        <div class="service-box">
            <i class="bi bi-clock"></i>
            <div>
                <strong>Jam Layanan</strong>
                <small>08.00 - 16.00</small>
            </div>
        </div>

        <div class="service-box">
            <i class="bi bi-asterisk green"></i>
            <div>
                <strong>UGD Siaga</strong>
                <small class="green">24 Jam Aktif</small>
            </div>
        </div>

    </section>

    <section>
        <div class="section-title">
            <h3>Kunjungan Mendatang</h3>
            <small>Update otomatis</small>
        </div>

        <div class="visit-card">
            <div style="text-align:center;padding:15px;color:#8290a4">
                <i class="bi bi-calendar-check" style="font-size:30px"></i>
                <p>Belum ada kunjungan terdaftar.</p>
            </div>
        </div>
    </section>

    <section style="margin-top:22px">

        <div class="section-title">
            <h3>Riwayat Kunjungan</h3>
            <small>2 kunjungan terakhir</small>
        </div>

        <div class="visit-card" style="text-align:center;color:#8290a4">
            <i class="bi bi-calendar2-check" style="font-size:28px"></i>
            <p>Belum ada riwayat kunjungan.</p>
        </div>

        <a href="#" class="history-link">
            Lihat Semua Riwayat <i class="bi bi-arrow-right"></i>
        </a>

    </section>

    <div class="notice">
        <i class="bi bi-info-circle"></i>
        Fitur pendaftaran klinik masih dalam tahap pengembangan.
        Informasi jadwal dan layanan akan disesuaikan dengan data resmi klinik.
    </div>

</div>

<nav class="bottom-nav">

    <a href="{{ route('mahasiswa.dashboard') }}">
        <i class="bi bi-house"></i>
        Beranda
    </a>

    <a href="{{ route('emergency-reports.create') }}">
        <i class="bi bi-list-check"></i>
        Lapor
    </a>

    <a href="{{ route('mahasiswa.klinik') }}" class="active">
        <i class="bi bi-hospital"></i>
        Klinik
    </a>

    <a href="{{ route('mahasiswa.status') }}">
        <i class="bi bi-clipboard-check"></i>
        Status
    </a>

    <a href="#">
        <i class="bi bi-person"></i>
        Akun
    </a>

</nav>

</body>
</html>
