<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bukti Pendaftaran - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f6fc;
            color: #263454;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 650px;
            margin: auto;
            padding: 25px 15px 60px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            color: #5265b5;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 27px;
            box-shadow: 0 8px 25px rgba(40,60,110,.07);
        }

        .success {
            text-align: center;
            margin-bottom: 25px;
        }

        .success-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #e5f7ec;
            color: #16875a;
            display: grid;
            place-items: center;
            margin: auto auto 15px;
            font-size: 32px;
        }

        h2 {
            font-size: 23px;
            margin: 0 0 10px;
        }

        .success p {
            color: #8994aa;
            font-size: 12px;
            line-height: 1.6;
        }

        .steps {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            font-size: 11px;
            color: #5265b5;
            gap: 8px;
        }

        .ticket {
            border: 1px solid #e3e8f2;
            border-radius: 15px;
            padding: 20px;
        }

        .queue {
            background: #eef2ff;
            border-radius: 14px;
            text-align: center;
            padding: 20px;
        }

        .queue span {
            color: #7885a0;
            font-size: 11px;
        }

        .queue h1 {
            color: #5265b5;
            font-size: 38px;
            margin: 10px 0;
        }

        .status {
            background: #fff2d9;
            color: #a8751c;
            display: inline-block;
            border-radius: 20px;
            padding: 7px 13px;
            font-size: 10px;
        }

        .status.cancelled {
            background: #fff0f0;
            color: #bc4141;
        }

        .status.done {
            background: #e7f6ed;
            color: #237344;
        }

        .detail {
            margin-top: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 12px;
        }

        .detail-row span {
            color: #8994aa;
        }

        .detail-row strong {
            text-align: right;
            max-width: 60%;
            overflow-wrap: anywhere;
        }

        .qr {
            text-align: center;
            border-top: 1px dashed #dce2ed;
            margin-top: 20px;
            padding-top: 22px;
        }

        .qr h3 {
            font-size: 15px;
        }

        .qr p {
            color: #8994aa;
            font-size: 11px;
            line-height: 1.5;
        }

        #qrcode {
            display: flex;
            justify-content: center;
            margin: 20px auto;
            min-height: 180px;
        }

        .code {
            background: #eef2ff;
            color: #5265b5;
            padding: 13px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
            overflow-wrap: anywhere;
        }

        .notice {
            background: #edf2ff;
            border-radius: 12px;
            padding: 15px;
            color: #687692;
            font-size: 11px;
            line-height: 1.7;
            margin-top: 18px;
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            padding: 14px;
            border: none;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .primary {
            background: #5265b5;
            color: white;
        }

        .secondary {
            background: #eef2ff;
            color: #5265b5;
        }

        @media print {
            body {
                background: white;
            }

            .container {
                padding: 0;
            }

            .actions,
            .notice {
                display: none;
            }

            .card {
                box-shadow: none;
            }
        }

        @media(max-width:450px) {
            .card {
                padding: 17px;
            }

            .actions {
                grid-template-columns: 1fr;
            }

            .steps {
                font-size: 9px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="brand">
        <i class="bi bi-heart-pulse-fill"></i> serkomu.
    </div>

    <div class="steps">
        <span>
            <i class="bi bi-check-circle-fill"></i>
            1. Pilih Jadwal
        </span>

        <span>
            <i class="bi bi-check-circle-fill"></i>
            2. Konfirmasi
        </span>

        <strong>
            <i class="bi bi-check-circle-fill"></i>
            3. Bukti
        </strong>
    </div>

    <main class="card">

        <section class="success">

            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>

            <h2>Bukti Pendaftaran</h2>

            <p>
                Pendaftaran kunjungan klinik berhasil disimpan.
                Simpan bukti ini untuk keperluan verifikasi
                saat tiba di klinik.
            </p>

        </section>

        <section class="ticket">

            <div class="queue">

                <span>NOMOR ANTREAN SIMULASI</span>

                <h1>{{ $nomorAntrean }}</h1>

                <span class="status
                    {{ $appointment->status === 'Dibatalkan' ? 'cancelled' : ($appointment->status === 'Selesai' ? 'done' : '') }}">
                    {{ $appointment->status }}
                </span>

            </div>

            <div class="detail">

                <div class="detail-row">
                    <span>Nama Mahasiswa</span>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>

                <div class="detail-row">
                    <span>Layanan Klinik</span>
                    <strong>{{ $appointment->poli }}</strong>
                </div>

                <div class="detail-row">
                    <span>Tanggal Kunjungan</span>
                    <strong>
                        {{ \Carbon\Carbon::parse($appointment->tanggal)->translatedFormat('d F Y') }}
                    </strong>
                </div>

                <div class="detail-row">
                    <span>Jam Kedatangan</span>
                    <strong>
                        {{ \Carbon\Carbon::parse($appointment->jam)->format('H:i') }} WIB
                    </strong>
                </div>

                <div class="detail-row">
                    <span>Estimasi Dipanggil</span>
                    <strong>{{ $estimasiPanggil }}</strong>
                </div>

                <div class="detail-row">
                    <span>Durasi Pemeriksaan</span>
                    <strong>{{ $durasiMenit }} menit</strong>
                </div>

                <div class="detail-row">
                    <span>Lokasi Klinik</span>
                    <strong>{{ $lokasiKlinik }}</strong>
                </div>

                <div class="detail-row">
                    <span>Keluhan</span>
                    <strong>
                        {{ $appointment->keluhan ?: 'Tidak ada keluhan tambahan' }}
                    </strong>
                </div>

                @if($appointment->status === 'Dibatalkan' && $appointment->cancellation_reason)
                    <div class="detail-row">
                        <span>Alasan Pembatalan</span>
                        <strong>{{ $appointment->cancellation_reason }}</strong>
                    </div>
                @endif

            </div>

            <div class="qr">

                <h3>QR Code Pendaftaran</h3>

                <p>
                    Tunjukkan QR Code ini kepada petugas
                    untuk verifikasi kode pendaftaran.
                </p>

                <div id="qrcode"></div>

                <p>KODE REGISTRASI</p>

                <div class="code">
                    {{ $appointment->booking_code }}
                </div>

            </div>

        </section>

        <div class="notice">

            <i class="bi bi-info-circle"></i>

            @if($appointment->status === 'Dibatalkan')

                Kunjungan ini telah dibatalkan. Bukti tetap
                tersedia sebagai catatan riwayat pendaftaran.

            @else

                Harap datang 10 menit sebelum jadwal kunjungan.
                Bawa Kartu Tanda Mahasiswa untuk keperluan verifikasi.

            @endif

        </div>

        <div class="actions">

            <a href="{{ route('mahasiswa.klinik') }}"
               class="btn secondary">

                <i class="bi bi-house"></i>
                Dashboard Klinik

            </a>

            <button onclick="window.print()"
                    class="btn primary">

                <i class="bi bi-download"></i>
                Simpan Bukti

            </button>

        </div>

    </main>

</div>

<script>
    const bookingCode = @json($appointment->booking_code);

    const qrContainer = document.getElementById('qrcode');

    if (typeof QRCode !== 'undefined') {

        new QRCode(qrContainer, {
            text: bookingCode,
            width: 180,
            height: 180,
            colorDark: '#263454',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.H
        });

    } else {

        qrContainer.innerHTML =
            '<p>QR Code gagal dimuat. Silakan periksa koneksi internet.</p>';

    }
</script>

</body>
</html>
