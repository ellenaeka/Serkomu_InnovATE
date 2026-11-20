
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Serkomu</title>

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
            max-width: 850px;
            margin: auto;
        }

        .panel {
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px #0000000d;
        }

        h1 {
            margin-top: 0;
        }

        .field {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .field strong {
            display: block;
            margin-bottom: 8px;
            color: #667085;
        }

        .description {
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            background: #fff3cd;
            color: #856404;
            border-radius: 20px;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 17px;
            background: #176b87;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>

<body>
<div class="container">

    <div class="panel">
        <h1>Detail Laporan Darurat</h1>

        <div class="field">
            <strong>Nomor Laporan</strong>
            {{ $laporan->id }}
        </div>

        <div class="field">
            <strong>Nama Pelapor</strong>
            {{ $laporan->reporter_name }}
        </div>

        <div class="field">
            <strong>Nomor WhatsApp</strong>
            {{ $laporan->reporter_phone }}
        </div>

        <div class="field">
            <strong>Jenis Kejadian</strong>
            {{ $laporan->incident_type }}
        </div>

        <div class="field">
            <strong>Kategori Lokasi</strong>
            {{ $laporan->location_category }}
        </div>

        <div class="field">
            <strong>Lokasi Kejadian</strong>
            {{ $laporan->location }}
        </div>

        <div class="field">
            <strong>Detail Lokasi</strong>
            {{ $laporan->detail_location }}
        </div>

        <div class="field">
            <strong>Waktu Kejadian</strong>
            {{ $laporan->incident_time->format('d-m-Y H:i') }}
        </div>

        <div class="field">
            <strong>Kronologi Kejadian</strong>
            <div class="description">{{ $laporan->description }}</div>
        </div>

        <div class="field">
            <strong>Status Laporan</strong>
            <span class="status">{{ $laporan->status }}</span>
        </div>

        <a href="{{ route('petugas.laporan.index') }}" class="back">
            Kembali ke Daftar Laporan
        </a>
    </div>

</div>
</body>
</html>