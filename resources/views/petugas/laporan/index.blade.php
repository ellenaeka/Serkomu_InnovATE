<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan Darurat</title>

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
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
        }

        .logout button {
            padding: 10px 16px;
            border: 0;
            border-radius: 6px;
            background: #dc3545;
            color: white;
            cursor: pointer;
        }

        .cards {
            display: flex;
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            flex: 1;
            padding: 22px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px #0000000d;
        }

        .card p {
            margin: 0 0 12px;
            color: #667085;
        }

        .card h2 {
            margin: 0;
            font-size: 30px;
        }

        .table-container {
            padding: 22px;
            background: white;
            border-radius: 10px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th, td {
            padding: 13px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #fff3cd;
            color: #856404;
            font-size: 12px;
        }

        .empty {
            padding: 25px;
            text-align: center;
            color: #667085;
        }

        @media (max-width: 650px) {
            body {
                padding: 15px;
            }

            .cards {
                flex-direction: column;
            }

            .header {
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h1>Daftar Laporan Darurat</h1>

        <form class="logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
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

    <div class="table-container">
        <h2>Laporan Masuk</h2>

        @if ($laporan->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pelapor</th>
                        <th>Jenis Kejadian</th>
                        <th>Lokasi</th>
                        <th>Waktu Kejadian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($laporan->currentPage() - 1) * $laporan->perPage() }}</td>
                            <td>{{ $item->reporter_name }}</td>
                            <td>{{ $item->incident_type }}</td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->incident_time->format('d-m-Y H:i') }}</td>
                            <td>
                                <span class="status">
                                    {{ $item->status }}
                                </span>
                            </td>
                            
                            <td>
                                <a href="{{ route('petugas.laporan.show', $item->id) }}">
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                {{ $laporan->links() }}
            </div>
        @else
            <div class="empty">
                Belum ada laporan darurat yang masuk.
            </div>
        @endif
    </div>

</div>

</body>
</html>
