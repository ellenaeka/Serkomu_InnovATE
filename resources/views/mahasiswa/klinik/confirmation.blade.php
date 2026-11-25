<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 25px 15px 60px;
            font-family: Arial, sans-serif;
            background: #f5f6fc;
            color: #263454;
        }

        .container {
            max-width: 700px;
            margin: auto;
        }

        .brand {
            color: #5265b5;
            font-size: 23px;
            font-weight: bold;
            margin: 0 0 25px;
        }

        .card {
            background: white;
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 8px 25px rgba(40,60,110,.07);
        }

        .steps {
            display: flex;
            align-items: center;
            margin-bottom: 35px;
            gap: 8px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            color: #9aa4b8;
            white-space: nowrap;
        }

        .step-number {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #edf0f7;
            display: grid;
            place-items: center;
            font-weight: bold;
        }

        .step.active { color: #5265b5; font-weight: bold; }
        .step.active .step-number { background: #5265b5; color: white; }
        .step.done { color: #16875a; }
        .step.done .step-number { background: #e4f5eb; }

        .line {
            height: 2px;
            flex: 1;
            background: #e0e5ef;
        }

        h2 { margin: 0 0 10px; font-size: 24px; }

        .desc {
            color: #8792a8;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .alert {
            padding: 13px;
            border-radius: 10px;
            font-size: 12px;
            margin-bottom: 20px;
            background: #fff5e5;
            color: #98621c;
            line-height: 1.6;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 24px 0 12px;
        }

        .info-box {
            border: 1px solid #e2e7f1;
            border-radius: 13px;
            padding: 16px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 12px;
        }

        .info-row:last-child { border: 0; }

        .info-row span { color: #8994aa; }

        .info-row strong {
            text-align: right;
            max-width: 60%;
        }

        .complaint {
            padding: 15px;
            background: #f5f6fc;
            border-radius: 11px;
            font-size: 13px;
            line-height: 1.6;
            min-height: 48px;
        }

        .agreement {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 25px;
            padding: 15px;
            background: #f5f6fc;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.6;
        }

        .agreement input {
            margin-top: 3px;
            accent-color: #5265b5;
            width: 16px;
            height: 16px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 22px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border: 0;
            border-radius: 11px;
            text-align: center;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-primary { background: #5265b5; color: white; }
        .btn-secondary { background: #f0f2f8; color: #5265b5; }

        .error {
            color: #bc4141;
            font-size: 12px;
            margin-top: 8px;
        }

        @media(max-width:480px) {
            .card { padding: 19px; }
            .step { font-size: 9px; gap: 5px; }
            .step-number { width: 24px; height: 24px; }
            h2 { font-size: 21px; }
            .buttons { flex-direction: column; }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="brand">
        <i class="bi bi-heart-pulse-fill"></i> serkomu.
    </div>

    <main class="card">

        <div class="steps">
            <div class="step done">
                <div class="step-number"><i class="bi bi-check-lg"></i></div>
                Pilih Jadwal
            </div>

            <div class="line"></div>

            <div class="step active">
                <div class="step-number">2</div>
                Konfirmasi
            </div>

            <div class="line"></div>

            <div class="step">
                <div class="step-number">3</div>
                Bukti
            </div>
        </div>

        <h2>Konfirmasi Pendaftaran</h2>

        <p class="desc">
            Periksa kembali informasi pendaftaran kunjungan klinik
            sebelum melanjutkan proses konfirmasi.
        </p>

        <div class="alert">
            <i class="bi bi-info-circle-fill"></i>
            Pastikan seluruh informasi sudah benar.
            Setelah dikonfirmasi, pendaftaran akan dicatat
            ke dalam sistem SerKoMu.
        </div>

        <div class="section-title">
            <i class="bi bi-person-badge"></i>
            Data Mahasiswa
        </div>

        <div class="info-box">

            <div class="info-row">
                <span>Nama Mahasiswa</span>
                <strong>{{ $mahasiswa->name }}</strong>
            </div>

            <div class="info-row">
                <span>Email</span>
                <strong>{{ $mahasiswa->email }}</strong>
            </div>

            <div class="info-row">
                <span>Status Akun</span>
                <strong style="color:#16875a">
                    <i class="bi bi-patch-check-fill"></i>
                    Terverifikasi
                </strong>
            </div>

        </div>

        <div class="section-title">
            <i class="bi bi-calendar-check"></i>
            Ringkasan Kunjungan
        </div>

        <div class="info-box">

            <div class="info-row">
                <span>Layanan Klinik</span>
                <strong>{{ $draft['poli'] }}</strong>
            </div>

            <div class="info-row">
                <span>Tanggal Kunjungan</span>
                <strong>
                    {{ \Carbon\Carbon::parse($draft['tanggal'])->translatedFormat('l, d F Y') }}
                </strong>
            </div>

            <div class="info-row">
                <span>Jam Kedatangan</span>
                <strong>
                    {{ $draft['jam'] }} WIB
                </strong>
            </div>

            <div class="info-row">
                <span>Status Pendaftaran</span>
                <strong style="color:#5265b5">
                    Menunggu Konfirmasi
                </strong>
            </div>

        </div>

        <div class="section-title">
            <i class="bi bi-chat-left-text"></i>
            Informasi Keluhan
        </div>

        <div class="complaint">
            {{ $draft['keluhan'] ?: 'Tidak ada keluhan tambahan.' }}
        </div>

        <form action="{{ route('mahasiswa.klinik.confirm') }}"
              method="POST">

            @csrf

            <label class="agreement">
                <input type="checkbox"
                       name="persetujuan"
                       value="1"
                       required>

                <span>
                    Saya memastikan data pendaftaran sudah benar
                    dan siap hadir sesuai jadwal kunjungan yang
                    telah dipilih.
                </span>
            </label>

            @error('persetujuan')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="buttons">

                <a href="{{ route('mahasiswa.klinik.create') }}"
                   class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Ubah Jadwal
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Konfirmasi Pendaftaran
                </button>

            </div>

        </form>

    </main>

</div>

</body>
</html>
