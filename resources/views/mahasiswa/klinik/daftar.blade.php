<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kunjungan Klinik - Serkomu</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f7ff;
            color: #183153;
            padding: 25px 15px;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 5px 25px rgba(0,0,0,.06);
        }

        h2 {
            margin-top: 0;
        }

        p {
            color: #718096;
            font-size: 14px;
        }

        label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
            font-size: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #dce4f2;
            border-radius: 9px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            background: #176bb7;
            border: none;
            color: white;
            border-radius: 9px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #105594;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #176bb7;
            text-decoration: none;
        }

        .success {
            background: #e7f8ee;
            color: #167343;
            padding: 15px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Daftar Kunjungan Klinik</h2>
    <p>Silakan isi formulir untuk melakukan pendaftaran kunjungan klinik kampus.</p>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mahasiswa.klinik.store') }}" method="POST">
        @csrf

        <label>Jenis Poli</label>
        <select name="clinic_type" required>
            <option value="">Pilih Poli</option>
            <option value="Poli Umum">Poli Umum</option>
            <option value="Poli Gigi">Poli Gigi</option>
        </select>

        <label>Tanggal Kunjungan</label>
        <input
            type="date"
            name="appointment_date"
            min="{{ date('Y-m-d') }}"
            required
        >

        <label>Jam Kunjungan</label>
        <input
            type="time"
            name="appointment_time"
            required
        >

        <label>Keluhan</label>
        <textarea
            name="complaint"
            rows="4"
            placeholder="Ceritakan keluhan kesehatan kamu..."
            required
        ></textarea>

        <button type="submit">
            Daftar Kunjungan
        </button>
    </form>

    <a href="{{ route('mahasiswa.klinik') }}" class="back">
        ← Kembali ke Klinik
    </a>

</div>

</body>
</html>
