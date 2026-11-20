
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kunjungan Klinik - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7ff;
            font-family: Arial, sans-serif;
            color: #19345b;
        }

        .container {
            max-width: 650px;
            padding-top: 30px;
            padding-bottom: 40px;
        }

        .card-riwayat {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
        }

        .status {
            background: #e8f7ef;
            color: #16834c;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .btn-primary {
            background: #1769b2;
            border: none;
        }

        .info {
            color: #71819a;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="container">

    <h4 class="fw-bold mb-2">Riwayat Kunjungan</h4>

    <p class="info mb-4">
        Berikut daftar riwayat kunjungan klinik kamu.
    </p>

    @forelse($riwayat as $item)

        <div class="card-riwayat">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <strong>{{ $item->poli }}</strong>

                <span class="status">
                    {{ $item->status }}
                </span>
            </div>

            <p class="mb-2">
                <strong>Tanggal:</strong>
                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
            </p>

            <p class="mb-2">
                <strong>Jam:</strong>
                {{ $item->jam }}
            </p>

            <p class="mb-2">
                <strong>Keluhan:</strong>
                {{ $item->keluhan ?? '-' }}
            </p>

            <p class="mb-0 info">
                Kode Booking:
                {{ $item->booking_code ?? '-' }}
            </p>

        </div>

    @empty

        <div class="card-riwayat text-center py-5">
            <h5>Belum Ada Riwayat</h5>

            <p class="info">
                Kamu belum memiliki riwayat kunjungan klinik.
            </p>

            <a href="{{ route('mahasiswa.klinik.create') }}"
               class="btn btn-primary">
                Daftar Kunjungan Baru
            </a>
        </div>

    @endforelse

    <a href="{{ route('mahasiswa.klinik') }}"
       class="btn btn-outline-primary w-100 mt-3">
        ← Kembali ke Klinik
    </a>

</div>

</body>
</html>
