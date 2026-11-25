<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - SerKoMu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 20px;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #263238;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        .panel {
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px #0000000d;
            margin-bottom: 20px;
        }

        h1 {
            margin-top: 0;
            font-size: 27px;
        }

        h2 {
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 20px;
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
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .diproses {
            background: #cfe8ff;
            color: #075985;
        }

        .selesai {
            background: #d1fae5;
            color: #065f46;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #344054;
        }

        select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d0d5dd;
            border-radius: 7px;
            font-size: 15px;
            font-family: Arial, sans-serif;
            margin-bottom: 18px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        select:focus, textarea:focus {
            outline: none;
            border-color: #176b87;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #176b87;
            color: white;
        }

        .btn-primary:hover {
            background: #12546c;
        }

        .btn-back {
            background: #667085;
            color: white;
        }

        .alert {
            padding: 14px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .tracking {
            color: #176b87;
            font-weight: bold;
            font-size: 17px;
        }

        .form-note {
            color: #667085;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 18px;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px 10px;
            }

            .panel {
                padding: 20px;
            }

            h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- DETAIL LAPORAN --}}
    <div class="panel">

        <h1>Detail Laporan Darurat</h1>

        <div class="field">
            <strong>Nomor Laporan</strong>
            {{ $laporan->id }}
        </div>

        <div class="field">
            <strong>Kode Pelacakan</strong>
            <span class="tracking">
                {{ $laporan->tracking_code ?? 'Belum tersedia' }}
            </span>
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
            {{ $laporan->incident_time?->format('d-m-Y H:i') ?? '-' }}
        </div>

        <div class="field">
            <strong>Kronologi Kejadian</strong>
            <div class="description">{{ $laporan->description }}</div>
        </div>

        <div class="field">
            <strong>Status Laporan Saat Ini</strong>

            <span class="status
                {{ $laporan->status === 'Selesai' ? 'selesai' :
                   ($laporan->status === 'Diproses' ? 'diproses' : 'menunggu') }}">
                {{ $laporan->status }}
            </span>
        </div>

        <div class="field">
            <strong>Catatan Tindak Lanjut Sebelumnya</strong>

            <div class="description">
                {{ $laporan->follow_up ?: 'Belum ada catatan tindak lanjut.' }}
            </div>
        </div>

    </div>


    {{-- FORM PEMBARUAN LAPORAN --}}
    <div class="panel">

        <h2>Kelola Tindak Lanjut Laporan</h2>

        <form
            action="{{ route('petugas.laporan.update', $laporan->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            {{-- PILIH STATUS --}}
            <label for="status">Status Laporan</label>

            <select name="status" id="status" required>

                <option value="Menunggu"
                    {{ old('status', $laporan->status) === 'Menunggu' ? 'selected' : '' }}>
                    Menunggu
                </option>

                <option value="Diproses"
                    {{ old('status', $laporan->status) === 'Diproses' ? 'selected' : '' }}>
                    Diproses
                </option>

                <option value="Selesai"
                    {{ old('status', $laporan->status) === 'Selesai' ? 'selected' : '' }}>
                    Selesai
                </option>

            </select>

            {{-- CATATAN TINDAK LANJUT --}}
            <label for="follow_up">Catatan Tindak Lanjut Petugas</label>

            <textarea
                name="follow_up"
                id="follow_up"
                maxlength="5000"
                placeholder="Tuliskan tindakan atau perkembangan penanganan laporan..."
            >{{ old('follow_up', $laporan->follow_up) }}</textarea>

            <p class="form-note">
                Catatan ini akan ditampilkan kepada mahasiswa pada riwayat laporan.
            </p>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

        </form>

    </div>


    {{-- TOMBOL KEMBALI --}}
    <a
        href="{{ route('petugas.laporan.index') }}"
        class="btn btn-back"
    >
        Kembali ke Daftar Laporan
    </a>

</div>

</body>
</html>
