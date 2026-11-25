<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kunjungan Klinik - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f7ff;
            font-family: Arial, sans-serif;
            color: #19345b;
        }

        .container-main {
            width: 100%;
            max-width: 750px;
            margin: auto;
            padding: 25px 18px 120px;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 25px;
        }

        .back-btn {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #4264b5;
            border-radius: 50%;
            box-shadow: 0 3px 12px rgba(0,0,0,.05);
            text-decoration: none;
            font-size: 18px;
        }

        .header h1 {
            font-size: 21px;
            font-weight: 800;
            margin: 0 0 5px;
        }

        .header p {
            font-size: 11px;
            color: #8290a6;
            margin: 0;
        }

        .summary-card {
            background: linear-gradient(120deg,#4264b5,#6484d0);
            color: white;
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 22px;
            box-shadow: 0 8px 20px rgba(66,100,181,.17);
        }

        .summary-label {
            font-size: 12px;
            opacity: .85;
        }

        .summary-number {
            font-size: 30px;
            font-weight: 800;
            margin-top: 5px;
        }

        .summary-description {
            font-size: 11px;
            opacity: .85;
            margin-top: 3px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 13px;
        }

        .card-riwayat {
            background: white;
            border: 1px solid #edf0f7;
            border-radius: 17px;
            padding: 19px;
            margin-bottom: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,.045);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 17px;
        }

        .poli-name {
            font-size: 15px;
            font-weight: 800;
            color: #263e69;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
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

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
        }

        .detail-item {
            min-width: 0;
        }

        .detail-label {
            font-size: 10px;
            color: #8994a9;
            margin-bottom: 6px;
        }

        .detail-value {
            font-size: 12px;
            font-weight: 700;
            color: #34486c;
            overflow-wrap: anywhere;
            line-height: 1.5;
        }

        .complaint {
            margin-top: 16px;
            padding: 13px;
            background: #f7f8fc;
            border-radius: 11px;
        }

        .complaint-label {
            font-size: 10px;
            color: #8290a6;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .complaint-value {
            font-size: 12px;
            color: #53617b;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .booking-code {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 14px;
            padding: 12px;
            background: #edf2ff;
            border-radius: 10px;
        }

        .booking-code span {
            font-size: 10px;
            color: #778198;
        }

        .booking-code strong {
            font-size: 12px;
            color: #4264b5;
            overflow-wrap: anywhere;
            text-align: right;
        }

        .status-legend {
            background: white;
            padding: 16px;
            border: 1px solid #edf0f7;
            border-radius: 14px;
            margin-top: 22px;
        }

        .legend-title {
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .legend-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 10px;
            color: #71819a;
        }

        .legend-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .empty-state {
            background: white;
            padding: 45px 20px;
            border-radius: 17px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,.045);
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            display: grid;
            place-items: center;
            background: #edf2ff;
            color: #4264b5;
            border-radius: 50%;
            font-size: 27px;
        }

        .empty-state h3 {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 11px;
            color: #8290a6;
            line-height: 1.7;
        }

        .btn-primary-custom {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            padding: 12px 18px;
            background: #4264b5;
            color: white;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn-back {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 14px;
            margin-top: 22px;
            border: 1px solid #dce5f7;
            border-radius: 12px;
            color: #4264b5;
            background: white;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        /* NAVIGASI BAWAH */

        .bottom-nav {
            position: fixed;
            z-index: 1000;
            bottom: 12px;
            left: 50%;
            transform: translateX(-50%);
            width: min(650px,calc(100% - 24px));
            min-height: 64px;
            padding: 6px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: white;
            border: 1px solid #e7ebf4;
            border-radius: 40px;
            box-shadow: 0 8px 25px rgba(30,50,100,.12);
        }

        .nav-item {
            flex: 1 1 0;
            min-width: 0;
            min-height: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 4px;
            color: #8190a6;
            font-size: 10px;
            border-radius: 30px;
            text-decoration: none;
            white-space: nowrap;
            transition: background .2s,color .2s;
        }

        .nav-item i {
            font-size: 17px;
        }

        .nav-item.active {
            background: #edf2ff;
            color: #4264b5;
            font-weight: 800;
        }

        @media(max-width:450px) {
            .container-main {
                padding: 20px 14px 110px;
            }

            .header h1 {
                font-size: 18px;
            }

            .card-riwayat {
                padding: 16px;
            }

            .nav-item {
                font-size: 9px;
            }

            .nav-item i {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

@php
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

<div class="container-main">

    <!-- HEADER -->

    <header class="header">

        <a href="{{ route('mahasiswa.klinik') }}"
           class="back-btn">

            <i class="bi bi-arrow-left"></i>

        </a>

        <div>
            <h1>Riwayat Kunjungan</h1>
            <p>Daftar seluruh riwayat kunjungan klinik kamu.</p>
        </div>

    </header>

    <!-- RINGKASAN -->

    <section class="summary-card">

        <div class="summary-label">
            Total Riwayat Kunjungan
        </div>

        <div class="summary-number">
            {{ $riwayat->count() }}
        </div>

        <div class="summary-description">
            Data kunjungan yang telah selesai atau dibatalkan.
        </div>

    </section>

    <!-- DAFTAR RIWAYAT -->

    <h2 class="section-title">
        <i class="bi bi-clock-history"></i>
        Daftar Kunjungan
    </h2>

    @forelse($riwayat as $item)

        <article class="card-riwayat">

            <div class="card-top">

                <div class="poli-name">
                    <i class="bi bi-hospital"></i>
                    {{ $item->poli }}
                </div>

                <span class="status {{ $getStatusClass($item->status) }}">
                    {{ $item->status }}
                </span>

            </div>

            <div class="detail-grid">

                <div class="detail-item">

                    <div class="detail-label">
                        <i class="bi bi-calendar-event"></i>
                        Tanggal Kunjungan
                    </div>

                    <div class="detail-value">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </div>

                </div>

                <div class="detail-item">

                    <div class="detail-label">
                        <i class="bi bi-clock"></i>
                        Jam Kunjungan
                    </div>

                    <div class="detail-value">
                        {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }} WIB
                    </div>

                </div>

                <div class="detail-item">

                    <div class="detail-label">
                        <i class="bi bi-person"></i>
                        Nama Mahasiswa
                    </div>

                    <div class="detail-value">
                        {{ auth()->user()->name }}
                    </div>

                </div>

                <div class="detail-item">

                    <div class="detail-label">
                        <i class="bi bi-ticket-perforated"></i>
                        Nomor Antrean
                    </div>

                    <div class="detail-value">
                        {{ $item->queue_number ? 'A-' . str_pad($item->queue_number, 2, '0', STR_PAD_LEFT) : '-' }}
                    </div>

                </div>

            </div>

            <div class="complaint">

                <div class="complaint-label">
                    <i class="bi bi-chat-left-text"></i>
                    Keluhan
                </div>

                <div class="complaint-value">
                    {{ $item->keluhan ?: 'Tidak ada keluhan tambahan.' }}
                </div>

            </div>

            <div class="booking-code">

                <span>Kode Booking</span>

                <strong>
                    {{ $item->booking_code ?? '-' }}
                </strong>

            </div>

        </article>

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-calendar2-check"></i>
            </div>

            <h3>Belum Ada Riwayat</h3>

            <p>
                Kamu belum memiliki riwayat kunjungan klinik.
                Kunjungan yang telah selesai atau dibatalkan
                akan ditampilkan di halaman ini.
            </p>

            <a href="{{ route('mahasiswa.klinik.create') }}"
               class="btn-primary-custom">

                <i class="bi bi-plus-circle"></i>
                Daftar Kunjungan Baru

            </a>

        </div>

    @endforelse

    <!-- KETERANGAN STATUS -->

    <section class="status-legend">

        <div class="legend-title">
            Keterangan Status Kunjungan
        </div>

        <div class="legend-grid">

            <div class="legend-item">
                <span class="legend-dot" style="background:#dca42f"></span>
                Menunggu: menanti penanganan
            </div>

            <div class="legend-item">
                <span class="legend-dot" style="background:#397bd2"></span>
                Diproses: sedang ditangani
            </div>

            <div class="legend-item">
                <span class="legend-dot" style="background:#38a36b"></span>
                Selesai: kunjungan selesai
            </div>

            <div class="legend-item">
                <span class="legend-dot" style="background:#cf5555"></span>
                Dibatalkan: kunjungan dibatalkan
            </div>

        </div>

    </section>

    <!-- KEMBALI -->

    <a href="{{ route('mahasiswa.klinik') }}"
       class="btn-back">

        <i class="bi bi-arrow-left me-2"></i>
        Kembali ke Klinik

    </a>

</div>

<!-- NAVIGASI -->

<nav class="bottom-nav">

    <a href="{{ route('mahasiswa.dashboard') }}"
       class="nav-item">

        <i class="bi bi-house-door"></i>
        Beranda

    </a>

    <a href="{{ route('emergency-reports.create') }}"
       class="nav-item">

        <i class="bi bi-megaphone"></i>
        Lapor

    </a>

    <a href="{{ route('mahasiswa.klinik') }}"
       class="nav-item active">

        <i class="bi bi-hospital"></i>
        Klinik

    </a>

    <a href="{{ route('mahasiswa.status') }}"
       class="nav-item">

        <i class="bi bi-clipboard-check"></i>
        Status

    </a>

    <a href="{{ route('mahasiswa.dashboard') }}#kontak-darurat"
       class="nav-item">

        <i class="bi bi-person"></i>
        Bantuan

    </a>

</nav>

</body>
</html>
