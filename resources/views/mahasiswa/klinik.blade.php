<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik - SerKoMu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f5f7fd; color: #263653; }
        a { text-decoration: none; }
        .container { max-width: 1100px; min-height: 100vh; margin: auto; padding: 30px 30px 110px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .brand { color: #5265b5; font-size: 22px; font-weight: 800; }
        .brand small { display: block; color: #8792a8; font-size: 10px; font-weight: normal; margin-top: 4px; }
        .profile { width: 40px; height: 40px; border-radius: 50%; background: #5265b5; color: white; display: grid; place-items: center; }
        .connected { display: inline-block; background: #edf3ff; color: #4264b5; padding: 8px 13px; border-radius: 20px; font-size: 11px; }
        .greeting { margin: 20px 0; }
        .greeting h2 { font-size: 25px; margin: 0 0 8px; }
        .greeting p { color: #8290a4; font-size: 13px; line-height: 1.6; }
        .booking-card { background: linear-gradient(135deg, white, #eaf1ff); padding: 23px; border-radius: 18px; display: flex; justify-content: space-between; align-items: center; gap: 20px; margin-bottom: 20px; box-shadow: 0 5px 18px rgba(40,70,130,.06); }
        .booking-content { display: flex; align-items: center; gap: 14px; }
        .booking-icon { width: 50px; height: 50px; flex-shrink: 0; display: grid; place-items: center; background: #5265b5; color: white; border-radius: 13px; font-size: 22px; }
        .tag { font-size: 9px; color: #4264b5; background: #dce8ff; padding: 5px 8px; border-radius: 5px; }
        .booking-content h3 { font-size: 16px; margin: 9px 0 5px; }
        .booking-content p { font-size: 11px; color: #8290a4; margin: 0; }
        .primary-btn { display: inline-block; background: #5265b5; color: white; padding: 14px 20px; border-radius: 10px; font-size: 12px; font-weight: bold; text-align: center; }
        .service-info { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 30px; }
        .service-box { display: flex; gap: 13px; align-items: center; background: white; border-radius: 13px; padding: 16px; }
        .service-box i { color: #5265b5; font-size: 22px; }
        .service-box strong { display: block; font-size: 12px; }
        .service-box small { display: block; font-size: 11px; color: #8290a4; margin-top: 5px; }
        .section-title { display: flex; justify-content: space-between; align-items: center; gap: 10px; margin: 20px 0 15px; }
        .section-title h3 { font-size: 18px; margin: 0; }
        .section-title small { color: #8290a4; font-size: 11px; }
        .visit-card { background: white; padding: 20px; border-radius: 16px; margin-bottom: 15px; box-shadow: 0 4px 15px rgba(40,60,100,.04); }
        .visit-top { display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap; }
        .visit-top h4 { font-size: 14px; margin: 0; }
        .status-pill { padding: 7px 12px; background: #e8efff; color: #4264b5; border-radius: 20px; font-size: 10px; font-weight: bold; }
        .status-cancelled { background: #fff0f0; color: #bc4141; }
        .status-done { background: #e7f6ed; color: #237344; }
        .visit-detail { background: #f5f7fc; border-radius: 11px; padding: 13px 15px; margin-top: 15px; }
        .visit-detail p { display: flex; align-items: flex-start; gap: 9px; font-size: 12px; line-height: 1.6; color: #738098; margin: 7px 0; overflow-wrap: anywhere; }
        .visit-detail i { color: #5265b5; flex-shrink: 0; }
        .booking-code { display: flex; justify-content: space-between; gap: 10px; flex-wrap: wrap; padding: 13px; background: #edf2ff; border-radius: 9px; font-size: 11px; margin-top: 13px; }
        .booking-code strong { color: #4264b5; overflow-wrap: anywhere; }
        .visit-actions { display: flex; gap: 10px; margin-top: 15px; }
        .action-btn { flex: 1; display: inline-block; padding: 11px; border: none; border-radius: 9px; font-size: 11px; font-weight: bold; text-align: center; cursor: pointer; }
        .proof-btn { background: #5265b5; color: white; }
        .cancel-btn { background: #fff0f0; color: #bc4141; }
        .history-btn { display: block; text-align: center; padding: 13px; border: 1px solid #dce4f5; border-radius: 10px; color: #5265b5; font-size: 12px; margin-top: 15px; }
        .empty-state { background: white; padding: 35px 15px; text-align: center; border-radius: 15px; color: #8290a4; }
        .empty-state i { display: block; font-size: 32px; margin-bottom: 10px; }
        .empty-state p { font-size: 12px; }
        .notice { background: #edf2ff; padding: 15px; border-radius: 12px; margin-top: 25px; color: #687692; font-size: 11px; line-height: 1.7; }
        .alert { padding: 13px; border-radius: 10px; margin-bottom: 15px; font-size: 12px; }
        .alert-success { background: #e7f6ed; color: #237344; }
        .alert-danger { background: #fff0f0; color: #bc4141; }
.bottom-nav {
    position: fixed;
    z-index: 1000;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    width: min(650px, calc(100% - 30px));
    background: #ffffff;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 7px;
    border-radius: 40px;
    box-shadow: 0 8px 30px rgba(30, 50, 100, 0.14);
}

.bottom-nav a {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    padding: 10px 5px;
    border-radius: 30px;
    text-align: center;
    text-decoration: none;
    color: #8290a4;
    font-size: 10px;
    font-weight: 500;
    transition: all 0.25s ease;
}

.bottom-nav a i {
    display: block;
    font-size: 19px;
    margin-bottom: 0;
}

.bottom-nav a.active {
    background: #eef0ff;
    color: #5265b5;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(82, 101, 181, 0.12);
}

.bottom-nav a:hover {
    color: #5265b5;
}

        /* TAB KUNJUNGAN */
        .clinic-tabs { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; margin: 28px 0 18px; padding: 6px; background: #e9edfa; border-radius: 13px; }
        .clinic-tab { border: 0; border-radius: 9px; padding: 13px 10px; background: transparent; color: #687692; font-size: 12px; font-weight: 700; cursor: pointer; transition: .2s ease; }
        .clinic-tab.active { background: #5265b5; color: #fff; box-shadow: 0 3px 10px rgba(40,60,130,.14); }
        .clinic-panel[hidden] { display: none !important; }
        .clinic-panel .section-title { margin-top: 18px; }

        @media(max-width:650px) {
            .container { padding: 20px 15px 110px; }
            .greeting h2 { font-size: 22px; }
            .booking-card { display: block; }
            .booking-content { margin-bottom: 18px; }
            .primary-btn { display: block; }
            .visit-actions { flex-direction: column; }
        }
        @media(max-width:400px) {
            .service-info { grid-template-columns: 1fr; }
            .section-title h3 { font-size: 15px; }
            .clinic-tab { font-size: 10px; padding: 12px 5px; }
        }
    </style>
</head>
<body>
<div class="container">
    <header class="header">
        <div class="brand">
            <i class="bi bi-heart-pulse-fill"></i> serkomu.
            <small>Telkom University</small>
        </div>
        <div class="profile">
            <i class="bi bi-person-fill"></i>
        </div>
    </header>

    <div class="connected">
        <i class="bi bi-shield-check"></i>
        Akun terhubung · {{ auth()->user()->name }}
    </div>

    <section class="greeting">
        <h2>Halo, {{ auth()->user()->name }}! 👋</h2>
        <p>Kelola jadwal dan riwayat kunjungan klinikmu dengan mudah melalui SerKoMu.</p>
    </section>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="booking-card">
        <div class="booking-content">
            <div class="booking-icon">
                <i class="bi bi-calendar-plus"></i>
            </div>
            <div>
                <span class="tag">LAYANAN KAMPUS</span>
                <h3>Daftar Kunjungan Klinik</h3>
                <p>Pilih layanan kesehatan dan jadwalkan kunjunganmu.</p>
            </div>
        </div>
        <a href="{{ route('mahasiswa.klinik.create') }}" class="primary-btn">
            <i class="bi bi-plus-circle"></i>
            Daftar Kunjungan Baru
        </a>
    </section>

    <section class="service-info">
        <div class="service-box">
            <i class="bi bi-clock"></i>
            <div>
                <strong>Jam Layanan</strong>
                <small>Senin–Jumat, 08.00–16.00 WIB</small>
            </div>
        </div>
        <div class="service-box">
            <i class="bi bi-geo-alt"></i>
            <div>
                <strong>Lokasi Klinik</strong>
                <small>Gedung Klinik Telkom University</small>
            </div>
        </div>
    </section>

    <!-- TAB KUNJUNGAN -->
    <div class="clinic-tabs" role="tablist" aria-label="Daftar kunjungan klinik">
        <button type="button" class="clinic-tab active" id="tabUpcoming" role="tab" aria-selected="true" aria-controls="panelUpcoming">
            Kunjungan Mendatang ({{ $kunjunganMendatang->count() }})
        </button>
        <button type="button" class="clinic-tab" id="tabHistory" role="tab" aria-selected="false" aria-controls="panelHistory">
            Riwayat Kunjungan <i class="bi bi-arrow-right"></i>
        </button>
    </div>

    <!-- KUNJUNGAN MENDATANG -->
    <section class="clinic-panel" id="panelUpcoming" role="tabpanel" aria-labelledby="tabUpcoming">
        <div class="section-title">
            <h3>Kunjungan Mendatang</h3>
            <small>{{ $kunjunganMendatang->count() }} kunjungan</small>
        </div>

        @forelse($kunjunganMendatang as $kunjungan)
            <article class="visit-card">
                <div class="visit-top">
                    <h4>{{ $kunjungan->poli }}</h4>
                    <span class="status-pill">{{ $kunjungan->status }}</span>
                </div>
                <div class="visit-detail">
                    <p><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($kunjungan->tanggal)->translatedFormat('d F Y') }}</p>
                    <p><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($kunjungan->jam)->format('H:i') }} WIB</p>
                    <p><i class="bi bi-chat-left-text"></i> {{ $kunjungan->keluhan ?: 'Tidak ada keluhan tambahan.' }}</p>
                </div>
                <div class="booking-code">
                    <span>Kode Pendaftaran</span>
                    <strong>{{ $kunjungan->booking_code }}</strong>
                </div>
                <div class="visit-actions">
                    <a href="{{ route('mahasiswa.klinik.bukti', $kunjungan->id) }}" class="action-btn proof-btn">
                        <i class="bi bi-qr-code"></i> Lihat Bukti
                    </a>
                    @if(!in_array($kunjungan->status, ['Selesai', 'Dibatalkan']))
                        <a href="{{ route('mahasiswa.klinik.cancel.form', $kunjungan->id) }}" class="action-btn cancel-btn">
                            <i class="bi bi-x-circle"></i> Batalkan Kunjungan
                        </a>
                    @endif
                </div>
            </article>
        @empty
            <div class="empty-state">
                <i class="bi bi-calendar-check"></i>
                <p>Belum ada kunjungan terdaftar.</p>
                <small>Jadwal kunjunganmu akan muncul di sini.</small>
            </div>
        @endforelse
    </section>

    <!-- RIWAYAT KUNJUNGAN -->
    <section class="clinic-panel" id="panelHistory" role="tabpanel" aria-labelledby="tabHistory" hidden>
        <div class="section-title">
            <h3>Riwayat Kunjungan</h3>
        </div>

        @forelse($riwayatKlinik as $kunjungan)
            <article class="visit-card">
                <div class="visit-top">
                    <h4>{{ $kunjungan->poli }}</h4>
                    <span class="status-pill {{ $kunjungan->status === 'Dibatalkan' ? 'status-cancelled' : 'status-done' }}">
                        {{ $kunjungan->status }}
                    </span>
                </div>
                <div class="visit-detail">
                    <p><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($kunjungan->tanggal)->translatedFormat('d F Y') }}</p>
                    <p><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($kunjungan->jam)->format('H:i') }} WIB</p>
                    @if($kunjungan->status === 'Dibatalkan' && $kunjungan->cancellation_reason)
                        <p><i class="bi bi-info-circle"></i> Alasan: {{ $kunjungan->cancellation_reason }}</p>
                    @endif
                </div>
                <div class="booking-code">
                    <span>Kode Pendaftaran</span>
                    <strong>{{ $kunjungan->booking_code }}</strong>
                </div>
                <a href="{{ route('mahasiswa.klinik.bukti', $kunjungan->id) }}" class="history-btn">
                    <i class="bi bi-eye"></i> Lihat Bukti Pendaftaran
                </a>
            </article>
        @empty
            <div class="empty-state">
                <i class="bi bi-calendar2-check"></i>
                <p>Belum ada riwayat kunjungan.</p>
            </div>
        @endforelse

    </section>

    <div class="notice">
        <i class="bi bi-info-circle"></i>
        Pastikan tanggal dan waktu kunjungan sudah sesuai. Harap datang 10 menit sebelum jadwal dan membawa Kartu Tanda Mahasiswa.
    </div>
</div>

<nav class="bottom-nav">
    <a href="{{ route('mahasiswa.dashboard') }}">
        <i class="bi bi-house"></i>
        <span>Beranda</span>
    </a>

    <a href="{{ route('emergency-reports.create') }}">
        <i class="bi bi-megaphone"></i>
        <span>Lapor</span>
    </a>

    <a href="{{ route('mahasiswa.klinik') }}" class="active">
        <i class="bi bi-hospital"></i>
        <span>Klinik</span>
    </a>

    <a href="{{ route('mahasiswa.dashboard') }}">
        <i class="bi bi-person"></i>
        <span>Profil</span>
    </a>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabUpcoming = document.getElementById('tabUpcoming');
    const tabHistory = document.getElementById('tabHistory');
    const panelUpcoming = document.getElementById('panelUpcoming');
    const panelHistory = document.getElementById('panelHistory');

    if (!tabUpcoming || !tabHistory || !panelUpcoming || !panelHistory) return;

    function showClinicPanel(which) {
        const showUpcoming = which === 'upcoming';

        panelUpcoming.hidden = !showUpcoming;
        panelHistory.hidden = showUpcoming;

        tabUpcoming.classList.toggle('active', showUpcoming);
        tabHistory.classList.toggle('active', !showUpcoming);

        tabUpcoming.setAttribute('aria-selected', showUpcoming ? 'true' : 'false');
        tabHistory.setAttribute('aria-selected', showUpcoming ? 'false' : 'true');
    }

    tabUpcoming.addEventListener('click', function () {
        showClinicPanel('upcoming');
    });

    tabHistory.addEventListener('click', function () {
        showClinicPanel('history');
    });

    showClinicPanel('upcoming');
});
</script>
</body>
</html>
