<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #5d62b5;
            --primary-dark: #494f9f;
            --text: #293653;
            --muted: #8490a8;
            --border: #e7eaf3;
            --bg: #f5f6fc;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding-bottom: 105px;
            background: var(--bg);
            font-family: Arial, sans-serif;
            color: var(--text);
        }

        .page {
            width: min(1000px, calc(100% - 36px));
            margin: 28px auto 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 13px;
            background: #e8eaff;
            color: var(--primary);
            display: grid;
            place-items: center;
            font-size: 23px;
        }

        .brand-name {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
        }

        .brand-sub {
            font-size: 10px;
            color: var(--muted);
            letter-spacing: .6px;
            margin-top: 5px;
        }

        .back {
            color: var(--primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }

        .heading { margin-bottom: 22px; }

        .heading h1 {
            font-size: 26px;
            font-weight: 800;
            margin: 0 0 7px;
        }

        .heading p {
            font-size: 13px;
            color: var(--muted);
            margin: 0;
            line-height: 1.6;
        }

        .tabs {
            display: flex;
            gap: 7px;
            padding: 6px;
            background: #e9ebf8;
            border-radius: 15px;
            margin-bottom: 22px;
        }

        .tab {
            flex: 1;
            border: 0;
            border-radius: 11px;
            padding: 13px 10px;
            background: transparent;
            color: #697391;
            font-size: 13px;
            font-weight: 700;
        }

        .tab.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 3px 9px #5d62b533;
        }

        .panel {
            display: none;
            background: white;
            border: 1px solid #edf0f7;
            border-radius: 20px;
            padding: 30px 34px;
            box-shadow: 0 9px 30px #2936530b;
        }

        .panel.active { display: block; }

        .panel-title {
            font-size: 20px;
            font-weight: 800;
            margin: 0 0 7px;
        }

        .muted {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.65;
        }

        .required { color: #d74747; }

        .steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 9px;
            margin: 22px 0 27px;
        }

        .step {
            padding: 12px 8px;
            border-radius: 10px;
            background: #f1f3f9;
            color: #8a94aa;
            text-align: center;
            font-size: 11px;
            font-weight: 700;
        }

        .step.active {
            background: #e9eaff;
            color: var(--primary);
        }

        .step.done {
            background: #e9f6ee;
            color: #29804d;
        }

        .form-step { display: none; }
        .form-step.active { display: block; }

        .section-title {
            font-size: 17px;
            font-weight: 800;
            margin: 0 0 6px;
        }

        .section-desc {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 22px;
            line-height: 1.6;
        }

        .form-label {
            font-size: 12px;
            font-weight: 700;
            color: #34466d;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            min-height: 46px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fafbff;
            font-size: 13px;
            padding: 11px 13px;
        }

        textarea.form-control { min-height: 115px; }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px #5d62b51a;
        }

        .hint {
            font-size: 11px;
            color: var(--muted);
            margin-top: 6px;
        }

        .info {
            display: flex;
            gap: 10px;
            padding: 13px;
            background: #eef1ff;
            color: #59678c;
            border-radius: 11px;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 16px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn-main, .btn-light {
            flex: 1;
            border-radius: 10px;
            padding: 13px 17px;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-main {
            border: 0;
            background: var(--primary);
            color: white;
        }

        .btn-main:hover {
            background: var(--primary-dark);
            color: white;
        }

        .btn-light {
            border: 1px solid var(--border);
            background: white;
            color: #66728e;
        }

        .review {
            background: #f8f9fe;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 15px;
            margin: 18px 0;
        }

        .review-row {
            padding: 10px 0;
            border-top: 1px solid var(--border);
        }

        .review-label {
            font-size: 10px;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .review-value {
            font-size: 12px;
            font-weight: 600;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .notice {
            padding: 13px;
            border-radius: 10px;
            background: #fff6f1;
            color: #9b5a37;
            font-size: 11px;
            line-height: 1.6;
        }

        .success {
            padding: 15px;
            border-radius: 12px;
            background: #eaf7ef;
            border: 1px solid #ccebd7;
            color: #237344;
            font-size: 12px;
            margin: 16px 0;
        }

        .code {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: .5px;
            color: #315b9c;
        }

        .history-list {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .history-item {
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 16px;
        }

        .history-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: flex-start;
        }

        .history-code {
            font-size: 13px;
            font-weight: 800;
            color: #315b9c;
        }

        .history-meta {
            font-size: 11px;
            color: var(--muted);
            margin-top: 5px;
        }

        .status {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 10px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .waiting { background: #fff4d6; color: #a66a00; }
        .processing { background: #e5efff; color: #285db5; }
        .completed { background: #e3f5e9; color: #237344; }
        .cancelled { background: #ffe8e8; color: #bc4141; }
        .default { background: #edf0f5; color: #64748b; }

        .detail {
            background: #f8f9fd;
            border-radius: 12px;
            padding: 15px;
            margin-top: 18px;
        }

        .detail h3 {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 9px 0;
            border-bottom: 1px solid #e9edf5;
            font-size: 11px;
        }

        .detail-row:last-child { border: 0; }
        .detail-row span { color: var(--muted); }
        .detail-row strong { text-align: right; overflow-wrap: anywhere; }

        .follow {
            padding: 12px;
            background: #eef2ff;
            border-radius: 10px;
            margin-top: 12px;
            font-size: 11px;
            line-height: 1.6;
        }

        .empty {
            text-align: center;
            padding: 42px 15px;
            color: var(--muted);
        }

        .empty i {
            font-size: 34px;
            color: #8994ad;
            display: block;
            margin-bottom: 12px;
        }

        .footer {
            text-align: center;
            color: #9aa4b8;
            font-size: 10px;
            margin: 25px 0;
        }

        /* Navigasi bawah */
        .bottom-nav-wrap {
            position: fixed;
            z-index: 1000;
            left: 0;
            right: 0;
            bottom: 12px;
            display: flex;
            justify-content: center;
            padding: 0 14px;
            pointer-events: none;
        }

        .bottom-nav {
            width: min(650px, 100%);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            background: rgba(255,255,255,.96);
            border: 1px solid #e9edf5;
            border-radius: 40px;
            box-shadow: 0 8px 30px #29365320;
            padding: 7px;
            pointer-events: auto;
            backdrop-filter: blur(12px);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            min-height: 55px;
            border-radius: 30px;
            color: #7d879f;
            text-decoration: none;
            font-size: 10px;
            font-weight: 600;
        }

        .nav-item i { font-size: 18px; }

        .nav-item.active {
            color: var(--primary);
            background: #eef0ff;
        }

        @media (max-width: 600px) {
            .page {
                width: calc(100% - 24px);
                margin-top: 18px;
            }

            .panel { padding: 22px 17px; }
            .heading h1 { font-size: 22px; }
            .tab { font-size: 11px; padding: 12px 5px; }
            .step { font-size: 9px; padding: 10px 4px; }
            .actions { flex-direction: column-reverse; }
            .history-top { align-items: flex-start; }
            .brand-name { font-size: 20px; }
        }
    </style>
</head>

<body>
@php
    $activeTab = old('active_tab')
        ?? session('active_tab')
        ?? (isset($laporanDicari) && $laporanDicari ? 'track' : (session('tracking_code') ? 'track' : 'create'));

    if (!in_array($activeTab, ['create', 'track', 'history'])) {
        $activeTab = 'create';
    }

    $statusClass = isset($laporanDicari) && $laporanDicari
        ? match($laporanDicari->status) {
            'Menunggu' => 'waiting',
            'Diproses' => 'processing',
            'Selesai' => 'completed',
            'Dibatalkan' => 'cancelled',
            default => 'default',
        }
        : 'default';
@endphp

<div class="page">
    <header class="topbar">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-shield-plus"></i></div>
            <div>
                <div class="brand-name">serkomu.</div>
                <div class="brand-sub">STUDENT HEALTH ASSISTANCE</div>
            </div>
        </div>

        <a href="{{ route('mahasiswa.dashboard') }}" class="back">
            <i class="bi bi-arrow-left"></i> Beranda
        </a>
    </header>

    <section class="heading">
        <h1>Layanan Laporan</h1>
        <p>Sampaikan kejadian yang membutuhkan bantuan dan pantau perkembangan laporan melalui satu halaman.</p>
    </section>

    <div class="tabs" role="tablist" aria-label="Navigasi laporan">
        <button type="button" class="tab {{ $activeTab === 'create' ? 'active' : '' }}" data-tab="create">
            <i class="bi bi-plus-circle"></i> Buat Laporan
        </button>
        <button type="button" class="tab {{ $activeTab === 'track' ? 'active' : '' }}" data-tab="track">
            <i class="bi bi-search"></i> Cari Status
        </button>
        <button type="button" class="tab {{ $activeTab === 'history' ? 'active' : '' }}" data-tab="history">
            <i class="bi bi-clock-history"></i> Riwayat Laporan
        </button>
    </div>

    <!-- PANEL BUAT LAPORAN -->
    <section id="panel-create" class="panel {{ $activeTab === 'create' ? 'active' : '' }}">
        <h2 class="panel-title">Buat Laporan Darurat</h2>
        <p class="muted">
            Lengkapi informasi kejadian agar petugas dapat memahami kondisi dan memberikan penanganan yang tepat.
            Kolom bertanda <span class="required">*</span> wajib diisi.
        </p>

        @if($errors->any() && $activeTab === 'create')
            <div class="alert alert-danger small mt-3">
                <strong>Periksa kembali data laporan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="steps">
            <div class="step active" data-indicator="0">1. Data Kejadian</div>
            <div class="step" data-indicator="1">2. Detail Laporan</div>
            <div class="step" data-indicator="2">3. Tinjau Laporan</div>
        </div>

        <form action="{{ route('emergency-reports.store') }}" method="POST" id="reportForm">
            @csrf

            <div class="form-step active" data-step="0">
                <h3 class="section-title">Laporkan Kejadian</h3>
                <p class="section-desc">Catat jenis kejadian, lokasi, dan waktu terjadinya peristiwa.</p>

                <div class="mb-3">
                    <label class="form-label">Jenis Kejadian <span class="required">*</span></label>
                    <select name="incident_type" class="form-select" required>
                        <option value="">Pilih jenis kejadian</option>
                        @foreach(['Bantuan Medis','Kecelakaan','Keamanan','Kehilangan','Lainnya'] as $jenis)
                            <option value="{{ $jenis }}" @selected(old('incident_type') == $jenis)>{{ $jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori Lokasi <span class="required">*</span></label>
                    <select name="location_category" class="form-select" required>
                        <option value="">Pilih kategori lokasi</option>
                        @foreach(['Gedung Perkuliahan','Asrama','Area Parkir','Fasilitas Kampus','Area Luar Kampus','Lainnya'] as $kategori)
                            <option value="{{ $kategori }}" @selected(old('location_category') == $kategori)>{{ $kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi Kejadian <span class="required">*</span></label>
                    <input type="text" name="location" class="form-control"
                           placeholder="Contoh: Gedung Kuliah TULT"
                           value="{{ old('location') }}" maxlength="255" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Detail Lokasi <span class="required">*</span></label>
                    <input type="text" name="detail_location" class="form-control"
                           placeholder="Contoh: Lantai 3, Ruang A-315"
                           value="{{ old('detail_location') }}" maxlength="255" required>
                    <div class="hint">Tuliskan lantai, nomor ruangan, blok, atau titik lokasi yang lebih spesifik.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Kejadian <span class="required">*</span></label>
                    <input type="datetime-local" name="incident_time" class="form-control"
                           value="{{ old('incident_time') }}" required>
                </div>

                <div class="info">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Pastikan lokasi dan waktu kejadian sudah benar agar petugas dapat menemukan lokasi dengan lebih mudah.</span>
                </div>

                <div class="actions">
                    <button type="button" class="btn-main" onclick="nextStep()">
                        Lanjutkan ke Detail <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="form-step" data-step="1">
                <h3 class="section-title">Detail Pelaporan</h3>
                <p class="section-desc">Lengkapi identitas dan informasi kontak agar petugas dapat menghubungi pelapor jika diperlukan.</p>

                <div class="mb-3">
                    <label class="form-label">Nama Pelapor <span class="required">*</span></label>
                    <input type="text" name="reporter_name" class="form-control"
                           value="{{ old('reporter_name', auth()->user()->name) }}"
                           maxlength="100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Kontak WhatsApp <span class="required">*</span></label>
                    <input type="tel" name="reporter_phone" class="form-control"
                           placeholder="Contoh: 081234567890"
                           value="{{ old('reporter_phone') }}"
                           pattern="[0-9+\- ]{9,20}" maxlength="20" required>
                    <div class="hint">Gunakan nomor WhatsApp aktif yang dapat dihubungi.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ringkasan Kejadian <span class="required">*</span></label>
                    <textarea name="description" id="description" class="form-control"
                              maxlength="5000"
                              placeholder="Jelaskan kondisi atau kejadian secara singkat dan jelas..."
                              required>{{ old('description') }}</textarea>
                    <div class="hint d-flex justify-content-between">
                        <span>Maksimal 300 kata.</span>
                        <span><strong id="wordCount">0</strong>/300 kata</span>
                    </div>
                </div>

                <div class="info">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Jelaskan kejadian sesuai kondisi sebenarnya. Hindari informasi yang tidak berkaitan dengan penanganan laporan.</span>
                </div>

                <div class="actions">
                    <button type="button" class="btn-light" onclick="previousStep()">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </button>
                    <button type="button" class="btn-main" onclick="nextStep()">
                        Lanjutkan ke Tinjau <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="form-step" data-step="2">
                <h3 class="section-title">Periksa Kembali Laporan</h3>
                <p class="section-desc">Pastikan seluruh informasi telah sesuai sebelum laporan diteruskan kepada petugas.</p>

                <div class="review">
                    <div class="fw-bold small mb-2">Ringkasan Laporan</div>
                    @foreach([
                        'incident_type'=>['Jenis Kejadian','reviewIncident'],
                        'location_category'=>['Kategori Lokasi','reviewCategory'],
                        'location'=>['Lokasi Kejadian','reviewLocation'],
                        'detail_location'=>['Detail Lokasi','reviewDetail'],
                        'incident_time'=>['Waktu Kejadian','reviewTime'],
                        'reporter_name'=>['Nama Pelapor','reviewName'],
                        'reporter_phone'=>['Nomor Kontak','reviewPhone'],
                        'description'=>['Keterangan Kejadian','reviewDescription']
                    ] as $field=>$data)
                        <div class="review-row">
                            <div class="review-label">{{ $data[0] }}</div>
                            <div class="review-value" id="{{ $data[1] }}">-</div>
                        </div>
                    @endforeach
                </div>

                <div class="form-check p-3 rounded-3 mb-3" style="background:#f7f8fc;border:1px solid var(--border)">
                    <input class="form-check-input" type="checkbox" name="confirmation"
                           value="1" id="confirmation" required @checked(old('confirmation'))>
                    <label class="form-check-label small" for="confirmation">
                        Saya menyatakan bahwa informasi yang saya berikan benar dan sesuai dengan kondisi sebenarnya.
                        <span class="required">*</span>
                    </label>
                </div>

                <div class="notice">
                    <strong><i class="bi bi-exclamation-triangle-fill"></i> Pemberitahuan Penting</strong><br>
                    Pengiriman laporan tidak berarti bantuan medis otomatis diberikan seketika. Untuk kondisi darurat kritis, segera hubungi layanan bantuan langsung.
                </div>

                <div class="actions">
                    <button type="button" class="btn-light" onclick="previousStep()">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </button>
                    <button type="submit" class="btn-main" id="submitButton">
                        <i class="bi bi-send-fill"></i> Kirim Laporan
                    </button>
                </div>
            </div>
        </form>
    </section>

    <!-- PANEL CARI STATUS -->
    <section id="panel-track" class="panel {{ $activeTab === 'track' ? 'active' : '' }}">
        <h2 class="panel-title">Cari Status Laporan</h2>
        <p class="muted">Masukkan kode pelacakan untuk mengetahui perkembangan penanganan laporan yang telah kamu kirim.</p>

        @if(session('success'))
            <div class="success">
                <div class="fw-bold mb-1">
                    <i class="bi bi-check-circle-fill"></i> Laporan berhasil dikirim
                </div>
                {{ session('success') }}
                @if(session('tracking_code'))
                    <div class="mt-2">
                        Kode pelacakan:
                        <span class="code">{{ session('tracking_code') }}</span>
                    </div>
                    <div class="hint">Simpan kode ini untuk memeriksa perkembangan laporan.</div>
                @endif
            </div>
        @endif

        <form action="{{ route('emergency-reports.track') }}" method="POST" class="mt-3">
            @csrf
            <label for="tracking_code" class="form-label">Kode Pelacakan</label>
            <div class="d-flex gap-2">
                <input type="text" name="tracking_code" id="tracking_code" class="form-control"
                       value="{{ old('tracking_code', session('tracking_code')) }}"
                       placeholder="Contoh: SRK-2026-0001" maxlength="50" required>
                <button type="submit" class="btn-main" style="flex:0 0 auto">Periksa</button>
            </div>
            @error('tracking_code')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </form>

        @if(isset($laporanDicari) && $laporanDicari)
            <div class="detail">
                <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
                    <h3 class="mb-0">Hasil Pelacakan</h3>
                    <span class="status {{ $statusClass }}">{{ $laporanDicari->status }}</span>
                </div>

                <div class="detail-row">
                    <span>Kode Laporan</span>
                    <strong>{{ $laporanDicari->tracking_code }}</strong>
                </div>
                <div class="detail-row">
                    <span>Jenis Kejadian</span>
                    <strong>{{ $laporanDicari->incident_type }}</strong>
                </div>
                <div class="detail-row">
                    <span>Pelapor</span>
                    <strong>{{ $laporanDicari->reporter_name }}</strong>
                </div>
                <div class="detail-row">
                    <span>Kategori Lokasi</span>
                    <strong>{{ $laporanDicari->location_category }}</strong>
                </div>
                <div class="detail-row">
                    <span>Lokasi</span>
                    <strong>{{ $laporanDicari->location }}, {{ $laporanDicari->detail_location }}</strong>
                </div>
                <div class="detail-row">
                    <span>Waktu Kejadian</span>
                    <strong>{{ \Carbon\Carbon::parse($laporanDicari->incident_time)->translatedFormat('d F Y, H:i') }}</strong>
                </div>
                <div class="detail-row">
                    <span>Status</span>
                    <strong>{{ $laporanDicari->status }}</strong>
                </div>

                <div class="mt-3 small fw-bold">Ringkasan Kejadian</div>
                <p class="muted mb-0 mt-1">{{ $laporanDicari->description }}</p>

                <div class="follow">
                    <strong><i class="bi bi-clipboard-check"></i> Informasi Tindak Lanjut</strong><br>
                    {{ $laporanDicari->follow_up ?: 'Belum ada tindak lanjut dari petugas. Silakan periksa kembali secara berkala.' }}
                </div>
            </div>
        @elseif(session('tracking_code'))
            <div class="info">
                <i class="bi bi-info-circle-fill"></i>
                <span>Laporan berhasil dikirim. Masukkan kode pelacakan di atas untuk melihat status terbaru.</span>
            </div>
        @endif
    </section>

    <!-- PANEL RIWAYAT LAPORAN -->
    <section id="panel-history" class="panel {{ $activeTab === 'history' ? 'active' : '' }}">
        <h2 class="panel-title">Riwayat Laporan</h2>
        <p class="muted">Lihat seluruh laporan yang pernah kamu kirim beserta status dan perkembangan penanganannya.</p>

        <div class="history-list">
            @forelse(($laporanSaya ?? collect()) as $item)
                @php
                    $itemStatusClass = match($item->status) {
                        'Menunggu' => 'waiting',
                        'Diproses' => 'processing',
                        'Selesai' => 'completed',
                        'Dibatalkan' => 'cancelled',
                        default => 'default',
                    };
                @endphp

                <article class="history-item">
                    <div class="history-top">
                        <div>
                            <div class="history-code">{{ $item->tracking_code }}</div>
                            <div class="history-meta">
                                {{ $item->incident_type }} ·
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') }}
                            </div>
                        </div>
                        <span class="status {{ $itemStatusClass }}">{{ $item->status }}</span>
                    </div>

                    <div class="history-meta mt-2">
                        {{ $item->location }} · {{ $item->detail_location }}
                    </div>

                    <form action="{{ route('emergency-reports.track') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="tracking_code" value="{{ $item->tracking_code }}">
                        <button type="submit" class="btn-light w-100">
                            Lihat Detail Laporan <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </article>
            @empty
                <div class="empty">
                    <i class="bi bi-clipboard-check"></i>
                    <strong>Belum ada riwayat laporan</strong>
                    <div class="small mt-2">Laporan yang kamu kirim akan muncul di sini.</div>
                </div>
            @endforelse
        </div>

        <div class="info">
            <i class="bi bi-info-circle-fill"></i>
            <span>Status laporan diperbarui oleh petugas sesuai perkembangan penanganan. Simpan kode pelacakan untuk memeriksa laporan kembali.</span>
        </div>
    </section>

    <footer class="footer">SerKoMu © 2026 — Student Health Assistance</footer>
</div>

<!-- NAVBAR BAWAH -->
<nav class="bottom-nav-wrap" aria-label="Navigasi utama">
    <div class="bottom-nav">
        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item">
            <i class="bi bi-house-door"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('emergency-reports.create') }}" class="nav-item active">
            <i class="bi bi-megaphone"></i>
            <span>Lapor</span>
        </a>
        <a href="{{ route('mahasiswa.klinik') }}" class="nav-item">
            <i class="bi bi-hospital"></i>
            <span>Klinik</span>
        </a>
        <a href="{{ route('mahasiswa.dashboard') }}#kontak-bantuan" class="nav-item">
            <i class="bi bi-chat-dots"></i>
            <span>Bantuan</span>
        </a>
    </div>
</nav>

<script>
    /* FORM MULTI STEP */
    let currentStep = 0;

    const steps = document.querySelectorAll('.form-step');
    const indicators = document.querySelectorAll('[data-indicator]');
    const form = document.getElementById('reportForm');
    const description = document.getElementById('description');

    function countWords(value) {
        const text = value.trim();
        return text ? text.split(/\s+/).length : 0;
    }

    function updateWordCount() {
        const words = countWords(description.value);
        document.getElementById('wordCount').textContent = words;
        document.getElementById('wordCount').style.color = words > 300 ? '#d74747' : '';
    }

    description.addEventListener('input', updateWordCount);
    updateWordCount();

    function showStep(step) {
        currentStep = step;

        steps.forEach((item, index) => {
            item.classList.toggle('active', index === step);
        });

        indicators.forEach((item, index) => {
            item.classList.toggle('active', index === step);
            item.classList.toggle('done', index < step);
        });

        if (step === 2) updateReview();

        document.getElementById('panel-create').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    function validateCurrentStep() {
        const fields = steps[currentStep].querySelectorAll(
            'input:not([type="checkbox"]), select, textarea'
        );

        for (const field of fields) {
            if (!field.checkValidity()) {
                field.reportValidity();
                field.focus();
                return false;
            }
        }

        if (currentStep === 1 && countWords(description.value) > 300) {
            alert('Ringkasan kejadian maksimal 300 kata.');
            description.focus();
            return false;
        }

        return true;
    }

    function nextStep() {
        if (validateCurrentStep() && currentStep < 2) {
            showStep(currentStep + 1);
        }
    }

    function previousStep() {
        if (currentStep > 0) showStep(currentStep - 1);
    }

    function getValue(name) {
        const field = form.querySelector('[name="' + name + '"]');
        return field ? field.value.trim() : '';
    }

    function formatIncidentTime(value) {
        if (!value) return '-';

        const date = new Date(value);
        return isNaN(date.getTime())
            ? value
            : date.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
    }

    function updateReview() {
        document.getElementById('reviewIncident').textContent = getValue('incident_type');
        document.getElementById('reviewCategory').textContent = getValue('location_category');
        document.getElementById('reviewLocation').textContent = getValue('location');
        document.getElementById('reviewDetail').textContent = getValue('detail_location');
        document.getElementById('reviewTime').textContent = formatIncidentTime(getValue('incident_time'));
        document.getElementById('reviewName').textContent = getValue('reporter_name');
        document.getElementById('reviewPhone').textContent = getValue('reporter_phone');
        document.getElementById('reviewDescription').textContent = getValue('description');
    }

    form.addEventListener('submit', function(event) {
        if (!validateCurrentStep()) {
            event.preventDefault();
            return;
        }

        const confirmation = document.getElementById('confirmation');

        if (!confirmation.checked) {
            event.preventDefault();
            alert('Persetujuan laporan wajib dicentang.');
            confirmation.focus();
            return;
        }

        if (countWords(description.value) > 300) {
            event.preventDefault();
            alert('Ringkasan kejadian maksimal 300 kata.');
            showStep(1);
            description.focus();
            return;
        }

        const button = document.getElementById('submitButton');
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim laporan...';
    });

    /* NAVIGASI TIGA TAB */
    document.querySelectorAll('[data-tab]').forEach(button => {
        button.addEventListener('click', () => {
            const tab = button.dataset.tab;

            document.querySelectorAll('[data-tab]').forEach(item => {
                item.classList.toggle('active', item === button);
            });

            document.querySelectorAll('.panel').forEach(panel => {
                panel.classList.toggle('active', panel.id === 'panel-' + tab);
            });

            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    /* PERTAHANKAN LANGKAH FORM JIKA VALIDASI GAGAL */
    @if($errors->any() && $activeTab === 'create')
        @if($errors->has('reporter_name') || $errors->has('reporter_phone') || $errors->has('description'))
            showStep(1);
        @elseif($errors->has('confirmation'))
            showStep(2);
        @else
            showStep(0);
        @endif
    @endif
</script>
</body>
</html>