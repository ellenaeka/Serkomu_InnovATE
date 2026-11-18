<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - SerKoMu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1764b1;
            --primary-dark: #16477f;
            --text: #253452;
            --muted: #8490a8;
            --border: #e5eaf4;
            --danger: #d74747;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f5f7fd;
            font-family: Arial, sans-serif;
            color: var(--text);
        }

        .page-container {
            width: min(1100px, calc(100% - 48px));
            margin: 35px auto;
        }

        /* HEADER */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 13px;
            background: #e7efff;
            display: grid;
            place-items: center;
        }

        .brand-icon svg {
            width: 28px;
            height: 28px;
        }

        .brand-name {
            font-size: 23px;
            font-weight: 800;
            color: #27569a;
            line-height: 1;
        }

        .brand-subtitle {
            font-size: 10px;
            color: var(--muted);
            margin-top: 5px;
            letter-spacing: .7px;
        }

        .back-link {
            text-decoration: none;
            color: #5268a9;
            font-size: 14px;
            font-weight: 600;
        }

        /* MAIN CARD */

        .report-card {
            background: white;
            border: 1px solid #edf0f7;
            border-radius: 24px;
            padding: 35px 42px;
            box-shadow: 0 12px 40px rgba(43, 63, 110, .07);
        }

        .page-title {
            font-size: 27px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .page-description {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .required-note {
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 24px;
        }

        .required-mark {
            color: var(--danger);
            font-weight: 800;
            margin-left: 3px;
        }

        /* STEP INDICATOR */

        .step-indicator {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 32px;
        }

        .step-item {
            padding: 13px 10px;
            border-radius: 12px;
            background: #f2f4fa;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
            font-weight: 600;
            transition: .2s;
        }

        .step-item.active {
            background: #e6efff;
            color: var(--primary);
        }

        .step-item.completed {
            background: #e9f6ee;
            color: #29804d;
        }

        /* FORM STEPS */

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn .25s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .section-description {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* FORM INPUT */

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: #34466d;
            margin-bottom: 9px;
        }

        .form-control,
        .form-select {
            min-height: 49px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: #fafbff;
            font-size: 13px;
            padding: 12px 14px;
            color: var(--text);
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(23, 100, 177, .10);
            background: white;
        }

        .form-hint {
            font-size: 11px;
            color: var(--muted);
            margin-top: 7px;
        }

        /* INFORMATION BOX */

        .info-box {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 15px;
            background: #eef4ff;
            border-radius: 13px;
            color: #52688e;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 20px;
        }

        /* BUTTONS */

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 11px;
            padding: 14px 22px;
            font-size: 13px;
            font-weight: 700;
            flex: 1;
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            color: white;
        }

        .btn-secondary-custom {
            background: white;
            color: #60708e;
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 14px 22px;
            font-size: 13px;
            font-weight: 600;
            flex: 1;
        }

        .btn-emergency {
            display: block;
            text-align: center;
            text-decoration: none;
            background: #fff8f8;
            border: 1px solid #f2d6d6;
            color: #c84b4b;
            border-radius: 30px;
            padding: 12px;
            font-size: 12px;
            font-weight: 700;
            margin-top: 14px;
        }

        .btn-emergency:hover {
            background: #fff0f0;
            color: #a83232;
        }

        /* REVIEW */

        .review-card {
            background: #f7f9ff;
            border: 1px solid #e9edf8;
            border-radius: 14px;
            padding: 19px;
            margin-bottom: 18px;
        }

        .review-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .review-row {
            padding: 11px 0;
            border-top: 1px solid #e8edf6;
        }

        .review-label {
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 5px;
        }

        .review-value {
            font-size: 13px;
            font-weight: 600;
            color: #34466d;
            overflow-wrap: anywhere;
            white-space: pre-wrap;
        }

        .confirmation {
            background: #f7f9ff;
            border: 1px solid var(--border);
            padding: 16px;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.6;
        }

        .confirmation input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            flex-shrink: 0;
        }

        .warning-box {
            background: #fff5f5;
            border: 1px solid #f5dede;
            color: #a34d4d;
            padding: 15px;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 15px;
        }

        .footer {
            text-align: center;
            color: #9aa4b8;
            font-size: 11px;
            margin-top: 25px;
        }

        /* RESPONSIVE */

        @media (max-width: 768px) {
            .page-container {
                width: calc(100% - 28px);
                margin: 18px auto;
            }

            .report-card {
                padding: 25px 20px;
                border-radius: 19px;
            }

            .page-title {
                font-size: 23px;
            }

            .page-description {
                font-size: 13px;
            }

            .step-indicator {
                gap: 6px;
            }

            .step-item {
                padding: 11px 5px;
                font-size: 10px;
            }

            .button-group {
                flex-direction: column-reverse;
            }

            .button-group button {
                width: 100%;
            }
        }

        @media (max-width: 400px) {
            .brand-name {
                font-size: 20px;
            }

            .back-link {
                font-size: 12px;
            }

            .report-card {
                padding: 22px 16px;
            }
        }
    </style>
</head>

<body>

<div class="page-container">

    <!-- HEADER -->
    <header class="page-header">

        <div class="brand">

            <div class="brand-icon">
                <svg viewBox="0 0 32 32" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3H20V12H29V20H20V29H12V20H3V12H12V3Z"
                          fill="#2872CE"/>
                </svg>
            </div>

            <div>
                <div class="brand-name">serkomu.</div>
                <div class="brand-subtitle">
                    STUDENT HEALTH ASSISTANCE
                </div>
            </div>

        </div>

        <a href="{{ route('mahasiswa.dashboard') }}"
           class="back-link">
            ← Kembali
        </a>

    </header>


    <!-- MAIN FORM -->
    <main class="report-card">

        <h1 class="page-title">Buat Laporan</h1>

        <p class="page-description">
            Sampaikan kondisi atau kejadian yang membutuhkan bantuan.
            Lengkapi seluruh informasi berikut agar petugas dapat
            memberikan penanganan dengan tepat.
        </p>

        <p class="required-note">
            <span class="required-mark">*</span>
            Semua kolom bertanda bintang wajib diisi.
        </p>


        <!-- NOTIFICATION -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data laporan:</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- STEP INDICATOR -->
        <div class="step-indicator">

            <div class="step-item active" data-indicator="0">
                1. Data Kejadian
            </div>

            <div class="step-item" data-indicator="1">
                2. Detail Laporan
            </div>

            <div class="step-item" data-indicator="2">
                3. Tinjau Laporan
            </div>

        </div>


        <form action="{{ route('emergency-reports.store') }}"
              method="POST"
              id="reportForm"
              novalidate>

            @csrf


            <!-- ================================== -->
            <!-- LANGKAH 1: DATA KEJADIAN -->
            <!-- ================================== -->

            <section class="form-step active" data-step="0">

                <h2 class="section-title">
                    Laporkan Kejadian
                </h2>

                <p class="section-description">
                    Catat informasi awal mengenai jenis kejadian,
                    lokasi, dan waktu agar petugas dapat memahami
                    kondisi yang membutuhkan bantuan.
                </p>


                <!-- JENIS KEJADIAN -->
                <div class="mb-4">

                    <label class="form-label">
                        Jenis Kejadian
                        <span class="required-mark">*</span>
                    </label>

                    <select name="incident_type"
                            class="form-select"
                            required>

                        <option value="">Pilih jenis kejadian</option>

                        <option value="Bantuan Medis"
                            @selected(old('incident_type') == 'Bantuan Medis')>
                            Bantuan Medis
                        </option>

                        <option value="Kecelakaan"
                            @selected(old('incident_type') == 'Kecelakaan')>
                            Kecelakaan
                        </option>

                        <option value="Keamanan"
                            @selected(old('incident_type') == 'Keamanan')>
                            Keamanan
                        </option>

                        <option value="Kehilangan"
                            @selected(old('incident_type') == 'Kehilangan')>
                            Kehilangan
                        </option>

                        <option value="Lainnya"
                            @selected(old('incident_type') == 'Lainnya')>
                            Lainnya
                        </option>

                    </select>

                </div>


                <!-- KATEGORI LOKASI -->
                <div class="mb-4">

                    <label class="form-label">
                        Kategori Lokasi
                        <span class="required-mark">*</span>
                    </label>

                    <select name="location_category"
                            class="form-select"
                            required>

                        <option value="">Pilih kategori lokasi</option>

                        <option value="Gedung Perkuliahan"
                            @selected(old('location_category') == 'Gedung Perkuliahan')>
                            Gedung Perkuliahan
                        </option>

                        <option value="Asrama"
                            @selected(old('location_category') == 'Asrama')>
                            Asrama
                        </option>

                        <option value="Area Parkir"
                            @selected(old('location_category') == 'Area Parkir')>
                            Area Parkir
                        </option>

                        <option value="Fasilitas Kampus"
                            @selected(old('location_category') == 'Fasilitas Kampus')>
                            Fasilitas Kampus
                        </option>

                        <option value="Area Luar Kampus"
                            @selected(old('location_category') == 'Area Luar Kampus')>
                            Area Luar Kampus
                        </option>

                        <option value="Lainnya"
                            @selected(old('location_category') == 'Lainnya')>
                            Lainnya
                        </option>

                    </select>

                </div>


                <!-- LOKASI KEJADIAN -->
                <div class="mb-4">

                    <label class="form-label">
                        Lokasi Kejadian
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        type="text"
                        name="location"
                        class="form-control"
                        placeholder="Contoh: Gedung Kuliah TULT"
                        value="{{ old('location') }}"
                        maxlength="255"
                        required
                    >

                </div>


                <!-- DETAIL LOKASI -->
                <div class="mb-4">

                    <label class="form-label">
                        Detail Lokasi
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        type="text"
                        name="detail_location"
                        class="form-control"
                        placeholder="Contoh: Lantai 3, Ruang A-315"
                        value="{{ old('detail_location') }}"
                        maxlength="255"
                        required
                    >

                    <div class="form-hint">
                        Tuliskan lantai, nomor ruangan, blok,
                        atau titik lokasi yang lebih spesifik.
                    </div>

                </div>


                <!-- WAKTU KEJADIAN -->
                <div class="mb-4">

                    <label class="form-label">
                        Waktu Kejadian
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        type="datetime-local"
                        name="incident_time"
                        class="form-control"
                        value="{{ old('incident_time') }}"
                        required
                    >

                </div>


                <div class="info-box">

                    <span>ⓘ</span>

                    <span>
                        Pastikan lokasi dan waktu kejadian sudah benar.
                        Informasi ini membantu petugas menemukan lokasi
                        kejadian dengan lebih mudah.
                    </span>

                </div>


                <div class="button-group">

                    <button type="button"
                            class="btn-primary-custom"
                            onclick="nextStep()">

                        Lanjutkan ke Detail →

                    </button>

                </div>


                <a href="#"
                   class="btn-emergency"
                   onclick="showEmergencyNotice(event)">

                    ☎ Telepon Bantuan Darurat

                </a>

            </section>



            <!-- ================================== -->
            <!-- LANGKAH 2: DETAIL LAPORAN -->
            <!-- ================================== -->

            <section class="form-step" data-step="1">

                <h2 class="section-title">
                    Detail Pelaporan
                </h2>

                <p class="section-description">
                    Lengkapi identitas dan informasi kontak agar
                    petugas dapat menghubungi pelapor jika diperlukan.
                </p>


                <!-- NAMA PELAPOR -->
                <div class="mb-4">

                    <label class="form-label">
                        Nama Pelapor
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        type="text"
                        name="reporter_name"
                        class="form-control"
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('reporter_name', auth()->user()->name) }}"
                        maxlength="100"
                        required
                    >

                </div>


                <!-- NOMOR WHATSAPP -->
                <div class="mb-4">

                    <label class="form-label">
                        Nomor Kontak WhatsApp
                        <span class="required-mark">*</span>
                    </label>

                    <input
                        type="tel"
                        name="reporter_phone"
                        class="form-control"
                        placeholder="Contoh: 081234567890"
                        value="{{ old('reporter_phone') }}"
                        pattern="[0-9+\- ]{9,20}"
                        maxlength="20"
                        required
                    >

                    <div class="form-hint">
                        Gunakan nomor WhatsApp aktif yang dapat dihubungi.
                    </div>

                </div>


                <!-- DESKRIPSI -->
                <div class="mb-4">

                    <label class="form-label">
                        Ringkasan Kejadian
                        <span class="required-mark">*</span>
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        maxlength="5000"
                        placeholder="Jelaskan kondisi atau kejadian secara singkat dan jelas..."
                        required
                    >{{ old('description') }}</textarea>

                    <div class="form-hint d-flex justify-content-between">

                        <span>
                            Maksimal 300 kata.
                        </span>

                        <span>
                            <strong id="wordCount">0</strong>/300 kata
                        </span>

                    </div>

                </div>


                <div class="info-box">

                    <span>ⓘ</span>

                    <span>
                        Jelaskan kejadian sesuai kondisi sebenarnya.
                        Hindari informasi yang tidak berkaitan dengan
                        penanganan laporan.
                    </span>

                </div>


                <div class="button-group">

                    <button type="button"
                            class="btn-secondary-custom"
                            onclick="previousStep()">

                        ← Kembali

                    </button>

                    <button type="button"
                            class="btn-primary-custom"
                            onclick="nextStep()">

                        Lanjutkan ke Tinjau →

                    </button>

                </div>


                <a href="#"
                   class="btn-emergency"
                   onclick="showEmergencyNotice(event)">

                    ☎ Butuh bantuan segera? Telepon Bantuan Darurat

                </a>

            </section>



            <!-- ================================== -->
            <!-- LANGKAH 3: TINJAU LAPORAN -->
            <!-- ================================== -->

            <section class="form-step" data-step="2">

                <h2 class="section-title">
                    Periksa Kembali Laporan
                </h2>

                <p class="section-description">
                    Pastikan seluruh informasi telah sesuai sebelum
                    laporan diteruskan kepada petugas.
                </p>


                <div class="review-card">

                    <div class="review-heading">
                        Ringkasan Laporan

                        <span style="color:#1764b1;font-size:11px;">
                            ✓ Data Pelapor
                        </span>
                    </div>


                    <div class="review-row">
                        <div class="review-label">
                            Jenis Kejadian
                        </div>

                        <div class="review-value" id="reviewIncident">-</div>
                    </div>


                    <div class="review-row">
                        <div class="review-label">
                            Kategori Lokasi
                        </div>

                        <div class="review-value" id="reviewCategory">-</div>
                    </div>


                    <div class="review-row">
                        <div class="review-label">
                            Lokasi Kejadian
                        </div>

                        <div class="review-value" id="reviewLocation">-</div>
                    </div>


                    <div class="review-row">
                        <div class="review-label">
                            Detail Lokasi
                        </div>

                        <div class="review-value" id="reviewDetail">-</div>
                    </div>


                    <div class="review-row">
                        <div class="review-label">
                            Waktu Kejadian
                        </div>

                        <div class="review-value" id="reviewTime">-</div>
                    </div>


                    <div class="review-row">
                        <div class="review-label">
                            Nama Pelapor
                        </div>

                        <div class="review-value" id="reviewName">-</div>
                    </div>


                    <div class="review-row">
                        <div class="review-label">
                            Nomor Kontak
                        </div>

                        <div class="review-value" id="reviewPhone">-</div>
                    </div>


                    <div class="review-row">
                        <div class="review-label">
                            Keterangan Kejadian
                        </div>

                        <div class="review-value" id="reviewDescription">-</div>
                    </div>

                </div>


                <!-- PERSETUJUAN -->
                <div class="confirmation mb-3">

                    <label class="d-flex gap-2 align-items-start">

                        <input
                            type="checkbox"
                            name="confirmation"
                            value="1"
                            id="confirmation"
                            required
                        >

                        <span>
                            Saya menyatakan bahwa informasi yang saya
                            berikan benar dan sesuai dengan kondisi
                            sebenarnya.
                            <span class="required-mark">*</span>
                        </span>

                    </label>

                </div>


                <!-- PERINGATAN -->
                <div class="warning-box">

                    <strong>⚠ Pemberitahuan Penting</strong>

                    <br>

                    Pengiriman laporan tidak berarti bantuan medis
                    otomatis diberikan seketika. Untuk kondisi
                    darurat kritis, segera hubungi layanan bantuan
                    langsung.

                </div>


                <div class="button-group">

                    <button type="button"
                            class="btn-secondary-custom"
                            onclick="previousStep()">

                        ← Kembali

                    </button>

                    <button type="submit"
                            class="btn-primary-custom">

                        ➤ Kirim Laporan

                    </button>

                </div>


                <a href="#"
                   class="btn-emergency"
                   onclick="showEmergencyNotice(event)">

                    ☎ Butuh bantuan segera? Telepon Bantuan Darurat

                </a>

            </section>

        </form>

    </main>


    <footer class="footer">
        SerKoMu © 2026 — Student Health Assistance
    </footer>

</div>


<!-- JAVASCRIPT -->
<script>

    let currentStep = 0;

    const steps = document.querySelectorAll('.form-step');

    const indicators = document.querySelectorAll('.step-item');

    const form = document.getElementById('reportForm');


    // Menghitung jumlah kata
    const description = document.getElementById('description');

    function countWords(value) {

        const text = value.trim();

        if (!text) {
            return 0;
        }

        return text.split(/\s+/).length;

    }


    function updateWordCount() {

        const words = countWords(description.value);

        document.getElementById('wordCount').textContent = words;

        document.getElementById('wordCount').style.color =
            words > 300 ? '#d74747' : '';

    }


    description.addEventListener('input', updateWordCount);

    updateWordCount();


    // Menampilkan langkah tertentu
    function showStep(step) {

        currentStep = step;

        steps.forEach((item, index) => {

            item.classList.toggle(
                'active',
                index === step
            );

        });


        indicators.forEach((item, index) => {

            item.classList.toggle(
                'active',
                index === step
            );

            item.classList.toggle(
                'completed',
                index < step
            );

        });


        if (step === 2) {
            updateReview();
        }


        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

    }


    // Validasi kolom pada langkah aktif
    function validateCurrentStep() {

        const currentFields = steps[currentStep].querySelectorAll(
            'input:not([type="checkbox"]), select, textarea'
        );


        for (const field of currentFields) {

            if (!field.checkValidity()) {

                field.reportValidity();

                field.focus();

                return false;

            }

        }


        // Validasi maksimal 300 kata
        if (currentStep === 1) {

            const words = countWords(description.value);

            if (words > 300) {

                alert('Ringkasan kejadian maksimal 300 kata.');

                description.focus();

                return false;

            }

        }


        return true;

    }


    // Tombol lanjut
    function nextStep() {

        if (!validateCurrentStep()) {
            return;
        }

        if (currentStep < 2) {

            showStep(currentStep + 1);

        }

    }


    // Tombol kembali
    function previousStep() {

        if (currentStep > 0) {

            showStep(currentStep - 1);

        }

    }


    // Mengambil nilai input
    function getValue(name) {

        const field = form.querySelector(
            '[name="' + name + '"]'
        );

        return field ? field.value.trim() : '';

    }


    // Mengisi ringkasan laporan
    function updateReview() {

        document.getElementById('reviewIncident').textContent =
            getValue('incident_type');

        document.getElementById('reviewCategory').textContent =
            getValue('location_category');

        document.getElementById('reviewLocation').textContent =
            getValue('location');

        document.getElementById('reviewDetail').textContent =
            getValue('detail_location');

        document.getElementById('reviewTime').textContent =
            getValue('incident_time');

        document.getElementById('reviewName').textContent =
            getValue('reporter_name');

        document.getElementById('reviewPhone').textContent =
            getValue('reporter_phone');

        document.getElementById('reviewDescription').textContent =
            getValue('description');

    }


    // Validasi saat mengirim laporan
    form.addEventListener('submit', function(event) {

        if (!validateCurrentStep()) {

            event.preventDefault();

            return;

        }


        const confirmation =
            document.getElementById('confirmation');


        if (!confirmation.checked) {

            event.preventDefault();

            alert('Persetujuan laporan wajib dicentang.');

            confirmation.focus();

            return;

        }

    });


    // Informasi tombol darurat
    function showEmergencyNotice(event) {

        event.preventDefault();

        alert(
            'Silakan gunakan nomor layanan darurat resmi kampus. ' +
            'Nomor bantuan akan dihubungkan setelah dikonfigurasi.'
        );

    }


    // Mempertahankan langkah ketika Laravel mengembalikan error
    @if($errors->any())

        @if(
            $errors->has('reporter_name') ||
            $errors->has('reporter_phone') ||
            $errors->has('description')
        )

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