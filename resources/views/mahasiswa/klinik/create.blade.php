
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kunjungan Klinik - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 25px 15px 100px;
            font-family: Arial, sans-serif;
            background: #f4f6fc;
            color: #263454;
        }

        .container {
            max-width: 650px;
            margin: auto;
        }

        .brand {
            color: #4264b5;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 22px;
            box-shadow: 0 8px 25px rgba(40,60,110,.07);
        }

        .icon {
            width: 55px;
            height: 55px;
            border-radius: 16px;
            background: #edf2ff;
            color: #4264b5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            margin-bottom: 18px;
        }

        h2 { margin: 0 0 10px; }

        .desc {
            color: #7d89a2;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin: 18px 0 9px;
        }

        input, select, textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #dfe5f1;
            border-radius: 11px;
            font-size: 13px;
            background: white;
        }

        .submit-btn {
            width: 100%;
            margin-top: 25px;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: #4264b5;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .back {
            display: inline-block;
            margin-top: 22px;
            color: #4264b5;
            font-size: 13px;
            text-decoration: none;
        }

        .error {
            color: #bc4141;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="brand">
        <i class="bi bi-heart-pulse-fill"></i> serkomu.
    </div>

    <div class="card">

        <div class="icon">
            <i class="bi bi-calendar-plus"></i>
        </div>

        <h2>Daftar Kunjungan Klinik</h2>

        <p class="desc">
            Silakan lengkapi formulir berikut untuk mengajukan
            jadwal kunjungan klinik Telkom University.
        </p>

        <form action="#" method="POST">
            @csrf

            <label>Nama Mahasiswa</label>
            <input type="text"
                   value="{{ auth()->user()->name }}"
                   readonly>

            <label>Pilih Poli</label>
            <select name="poli" required>
                <option value="">Pilih layanan klinik</option>
                <option value="Poli Umum">Poli Umum</option>
                <option value="Poli Gigi">Poli Gigi</option>
            </select>

            <label>Tanggal Kunjungan</label>
            <input type="date" name="tanggal" required
                   min="{{ date('Y-m-d') }}">

            <label>Jam Kunjungan</label>
            <select name="jam" required>
                <option value="">Pilih jam kunjungan</option>
                <option value="08:00">08.00 WIB</option>
                <option value="09:00">09.00 WIB</option>
                <option value="10:00">10.00 WIB</option>
                <option value="11:00">11.00 WIB</option>
                <option value="13:00">13.00 WIB</option>
                <option value="14:00">14.00 WIB</option>
                <option value="15:00">15.00 WIB</option>
            </select>

            <label>Keluhan</label>
            <textarea name="keluhan" rows="4"
                      placeholder="Tuliskan keluhan kesehatan kamu..."></textarea>

            <button type="submit" class="submit-btn">
                <i class="bi bi-check-circle"></i>
                Konfirmasi Pendaftaran
            </button>
        </form>

        <a href="{{ route('mahasiswa.klinik') }}" class="back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Klinik
        </a>

    </div>
</div>

</body>
</html>