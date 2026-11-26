@extends('layouts.bantuan')

@section('title', 'Panggilan Bantuan Darurat')

@php
    $emergencyPhone = trim((string) config('serkomu.emergency_phone'));
    $emergencyTel = preg_replace('/[^0-9+]/', '', $emergencyPhone);
    $hasPhone = $emergencyTel !== '';
    $displayPhone = $hasPhone ? $emergencyPhone : '08xx-xxxx-xxxx';
@endphp

@section('styles')
    /* ================= LAYAR A: HALAMAN KONTAK ================= */
    .hero { text-align: center; padding: 4px 4px 20px; }
    .hero h2 { font-size: 26px; line-height: 1.25; margin: 14px 0 8px; font-weight: 800; letter-spacing: -.01em; }
    .hero p { margin: 0 auto; max-width: 420px; color: var(--muted); font-size: 14.5px; }

    .number-card { text-align: center; padding: 28px 24px 22px; }
    .number-icon {
        width: 64px; height: 64px; margin: 0 auto 14px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%; background: var(--danger-soft); color: var(--danger); font-size: 27px;
    }
    .number-label { font-size: 12px; font-weight: 700; letter-spacing: .14em; color: var(--muted); }
    .number-value {
        font-size: 32px; font-weight: 800; letter-spacing: .01em; line-height: 1.2;
        margin: 6px 0 12px; color: #1f2a48; word-break: break-word;
    }
    .demo-chip {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 12px; border-radius: 999px;
        background: #f5f7fc; border: 1px solid var(--border);
        color: var(--muted); font-size: 12.5px; font-weight: 600;
    }
    .number-card .btn { margin-top: 18px; }
    .btn--brick {
        background: linear-gradient(135deg, #b84a42, #9c3a33); color: #fff;
        box-shadow: 0 10px 22px rgba(168, 61, 56, .24);
    }
    .btn--brick:hover { background: linear-gradient(135deg, #a8433b, #8c332d); }
    .dial-link {
        display: inline-flex; align-items: center; gap: 6px; min-height: 44px;
        margin-top: 6px; padding: 0 10px; border-radius: 12px;
        font-size: 13.5px; font-weight: 700; color: var(--primary); text-decoration: none;
    }
    .dial-link:hover { background: var(--primary-soft); }
    .number-card .note { margin: 12px auto 0; max-width: 360px; }

    .when h3 { display: flex; align-items: center; gap: 8px; font-size: 16px; margin: 0 0 14px; }
    .when h3 i { color: var(--primary); }
    .when ul { list-style: none; margin: 0; padding: 0; display: grid; gap: 12px; }
    .when li { display: flex; gap: 12px; align-items: flex-start; font-size: 14px; }
    .when li i {
        flex: 0 0 24px; height: 24px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--success-soft); color: var(--success); font-size: 13px;
    }

    .report-box {
        margin-top: 16px; padding: 18px 20px; text-align: center;
        background: var(--primary-soft); border: 1px solid #dfe6f6; border-radius: var(--radius-md);
    }
    .report-box small { display: block; color: var(--muted); font-size: 13px; }
    .report-box a {
        display: inline-flex; align-items: center; gap: 8px; min-height: 44px;
        padding: 0 12px; border-radius: 12px;
        color: var(--primary); font-weight: 700; font-size: 14.5px; text-decoration: none;
    }
    .report-box a:hover { background: #e3e9f8; }
    .page-footnote { text-align: center; margin-top: 18px; font-size: 12px; color: var(--muted); }

    /* ================= LAYAR B: SIMULASI PANGGILAN ================= */
    .call-overlay {
        position: fixed; inset: 0; z-index: 2000;
        display: flex; align-items: center; justify-content: center;
        padding: 20px; background: rgba(8, 14, 32, .62);
        -webkit-backdrop-filter: blur(4px); backdrop-filter: blur(4px);
    }
    .call-overlay[hidden] { display: none; }
    .call-screen {
        position: relative; width: 100%; max-width: 420px; max-height: calc(100vh - 40px);
        overflow-y: auto; overscroll-behavior: contain;
        padding: 26px 22px 28px; border-radius: var(--radius-lg);
        background: radial-gradient(120% 70% at 50% 0%, #1d2d5c 0%, rgba(29,45,92,0) 60%),
                    linear-gradient(180deg, #16254f 0%, #0f1b3d 100%);
        color: #fff; text-align: center;
        box-shadow: 0 30px 70px rgba(4, 8, 24, .5);
    }
    .call-screen :focus-visible { outline: 3px solid rgba(255,255,255,.7); outline-offset: 3px; }
    .call-pill {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 6px 12px; border-radius: 999px; background: rgba(255,255,255,.1);
        font-size: 11.5px; font-weight: 700; letter-spacing: .08em;
    }
    .call-pill .dot { width: 6px; height: 6px; border-radius: 50%; background: #fff; }
    .call-screen h2 { margin: 12px 0 4px; font-size: 23px; font-weight: 800; letter-spacing: -.01em; }
    .call-sub { margin: 0; font-size: 14px; color: rgba(255,255,255,.78); }

    .call-avatar {
        position: relative; width: 92px; height: 92px; margin: 22px auto 16px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%; border: 3px solid rgba(120,150,230,.75);
        background: rgba(255,255,255,.06); font-size: 34px;
    }
    .call-avatar::after {
        content: ""; position: absolute; inset: -9px; border-radius: 50%;
        border: 2px solid rgba(120,150,230,.35); animation: callPulse 1.8s ease-out infinite;
    }
    .call-badge {
        position: absolute; right: -2px; bottom: 2px;
        width: 26px; height: 26px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background: #38a36b; border: 3px solid #16254f; font-size: 14px;
    }
    @keyframes callPulse { from { transform: scale(.92); opacity: .9; } to { transform: scale(1.18); opacity: 0; } }

    .call-number {
        font-family: "Courier New", Courier, monospace; font-weight: 700;
        font-size: 22px; letter-spacing: .14em; word-break: break-word;
    }
    .call-chip {
        display: inline-flex; align-items: center; gap: 6px; margin-top: 8px;
        padding: 5px 12px; border-radius: 999px;
        background: rgba(242, 191, 72, .14); color: #f5cf73;
        font-size: 12px; font-weight: 600;
    }
    .call-status {
        display: inline-flex; align-items: center; gap: 10px; margin-top: 14px;
        padding: 9px 16px; border-radius: 999px; background: rgba(255,255,255,.07);
        font-size: 14px; font-weight: 600; color: #6fd39b;
    }
    .call-status .status-dot { width: 9px; height: 9px; border-radius: 50%; background: #38c172; }
    .call-status.is-connecting { color: #f5cf73; }
    .call-status.is-connecting .status-dot { background: #f2bf48; animation: blink 1s ease-in-out infinite; }
    .call-status .sep { width: 2px; height: 14px; background: rgba(255,255,255,.25); }
    .call-status .timer { font-family: "Courier New", Courier, monospace; font-weight: 700; color: #fff; }
    .call-status.is-connecting .sep,
    .call-status.is-connecting .timer { display: none; }
    @keyframes blink { 50% { opacity: .35; } }

    .call-panel {
        margin-top: 18px; padding: 18px 12px 14px;
        border-radius: var(--radius-md); background: rgba(255,255,255,.06);
    }
    .call-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px 6px; }
    .call-ctl {
        display: flex; flex-direction: column; align-items: center; gap: 7px;
        background: none; border: 0; color: #fff; font: inherit; font-size: 13px; cursor: pointer;
        padding: 0; border-radius: 14px;
    }
    .call-ctl .ctl-icon {
        width: 56px; height: 56px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background: rgba(255,255,255,.12); font-size: 21px;
        transition: background .15s, color .15s;
    }
    .call-ctl:hover .ctl-icon { background: rgba(255,255,255,.2); }
    .call-ctl[aria-pressed="true"] .ctl-icon { background: #fff; color: #16254f; }

    .call-grid[hidden], .keypad[hidden] { display: none; }
    .keypad-display {
        min-height: 34px; margin-bottom: 10px;
        font-family: "Courier New", Courier, monospace; font-size: 22px; font-weight: 700; letter-spacing: .12em;
        overflow-wrap: anywhere;
    }
    .keypad-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; justify-items: center; }
    .keypad-grid button {
        width: 56px; height: 56px; border-radius: 50%; border: 0;
        background: rgba(255,255,255,.12); color: #fff; font: inherit; font-size: 21px; font-weight: 700; cursor: pointer;
    }
    .keypad-grid button:hover { background: rgba(255,255,255,.22); }
    .keypad-close {
        display: inline-flex; align-items: center; gap: 6px; min-height: 44px; margin-top: 10px;
        padding: 0 16px; border: 0; border-radius: 999px; background: rgba(255,255,255,.1);
        color: #fff; font: inherit; font-size: 13px; font-weight: 600; cursor: pointer;
    }

    .call-info {
        display: flex; gap: 10px; align-items: flex-start; text-align: left;
        margin-top: 16px; padding: 14px 16px; border-radius: var(--radius-sm);
        background: rgba(255,255,255,.06); font-size: 13px; line-height: 1.55; color: rgba(255,255,255,.88);
    }
    .call-info i { font-size: 16px; margin-top: 1px; }

    .call-end-wrap { display: flex; flex-direction: column; align-items: center; gap: 8px; margin-top: 22px; }
    .call-end {
        width: 68px; height: 68px; border-radius: 50%; border: 0; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        background: #d64545; color: #fff; font-size: 26px;
        box-shadow: 0 10px 24px rgba(214, 69, 69, .4);
    }
    .call-end:hover { background: #c23a3a; }
    .call-end i { transform: rotate(135deg); }
    .call-end-label { font-size: 14.5px; font-weight: 700; }

    .call-toast {
        position: absolute; left: 50%; bottom: 18px; transform: translateX(-50%) translateY(8px);
        padding: 9px 16px; border-radius: 999px; background: #fff; color: #16254f;
        font-size: 13px; font-weight: 700; white-space: nowrap;
        opacity: 0; pointer-events: none; transition: opacity .2s, transform .2s;
    }
    .call-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

    @media (max-width: 480px) {
        .number-value { font-size: 28px; }
        .call-overlay { padding: 0; }
        .call-screen { max-width: none; height: 100%; max-height: none; border-radius: 0; padding: 22px 18px 26px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .call-avatar::after { animation: none; display: none; }
        .call-status.is-connecting .status-dot { animation: none; }
        .call-toast, .call-ctl .ctl-icon { transition: none; }
    }
@endsection

@section('content')
    <section class="hero">
        <span class="chip chip--danger"><i class="bi bi-alarm" aria-hidden="true"></i> Layanan Siaga 24 Jam</span>
        <h2>Posko Bantuan &amp; Siaga Kampus</h2>
        <p>Kontak darurat respon cepat untuk situasi mendesak di lingkungan kampus.</p>
    </section>

    <section class="card number-card" aria-labelledby="nomor-siaga">
        <div class="number-icon"><i class="bi bi-telephone-inbound" aria-hidden="true"></i></div>
        <div class="number-label" id="nomor-siaga">NOMOR SIAGA DARURAT</div>
        <div class="number-value">{{ $displayPhone }}</div>

        @unless($hasPhone)
            <span class="demo-chip"><i class="bi bi-shield-exclamation" aria-hidden="true"></i> Nomor Demo / Perlu Verifikasi Nomor Resmi</span>
        @endunless

        <button type="button" class="btn btn--brick" id="openCall" aria-haspopup="dialog" aria-controls="callOverlay">
            <i class="bi bi-telephone-fill" aria-hidden="true"></i> Telepon Sekarang
        </button>

        @if($hasPhone)
            <a href="tel:{{ $emergencyTel }}" class="dial-link">
                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Buka aplikasi telepon
            </a>
        @endif

        <p class="note">Panggilan menggunakan layanan telepon operator dan dapat dikenakan biaya.</p>
    </section>

    <section class="card when" aria-labelledby="kapan-menghubungi">
        <h3 id="kapan-menghubungi"><i class="bi bi-question-circle" aria-hidden="true"></i> Kapan Menghubungi Nomor Ini?</h3>
        <ul>
            <li><i class="bi bi-check-lg" aria-hidden="true"></i><span>Situasi darurat medis langsung atau kecelakaan fisik.</span></li>
            <li><i class="bi bi-check-lg" aria-hidden="true"></i><span>Ancaman keselamatan jiwa dan butuh bantuan posko segera di lokasi.</span></li>
            <li><i class="bi bi-check-lg" aria-hidden="true"></i><span>Evakuasi darurat atau gangguan keamanan kritis.</span></li>
        </ul>
    </section>

    <section class="report-box">
        <small>Bukan situasi darurat mendesak?</small>
        @auth
            <a href="{{ route('emergency-reports.create') }}">
                <i class="bi bi-pencil-square" aria-hidden="true"></i> Buat laporan insiden online
            </a>
        @else
            <a href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Masuk untuk membuat laporan
            </a>
        @endauth
    </section>

    <p class="page-footnote">Capstone Prototype — Membuka dialer perangkat untuk konfirmasi pengguna.</p>

    {{-- ================= LAYAR B: SIMULASI PANGGILAN (tanpa request ke server) ================= --}}
    <div class="call-overlay" id="callOverlay" hidden>
        <div class="call-screen" role="dialog" aria-modal="true" aria-labelledby="callTitle" aria-describedby="callNumberNote">
            <span class="call-pill"><span class="dot" aria-hidden="true"></span> BANTUAN DARURAT KAMPUS</span>
            <h2 id="callTitle">Posko Bantuan &amp; Siaga Kampus</h2>
            <p class="call-sub">Layanan Bantuan Darurat SerKomU</p>

            <div class="call-avatar" aria-hidden="true">
                <i class="bi bi-shield-plus"></i>
                <span class="call-badge"><i class="bi bi-check"></i></span>
            </div>

            <div class="call-number">{{ $displayPhone }}</div>
            <span class="call-chip" id="callNumberNote"><i class="bi bi-info-circle" aria-hidden="true"></i> Nomor simulasi — belum terverifikasi</span>

            <div>
                <div class="call-status is-connecting" id="callStatus" role="status" aria-live="polite">
                    <span class="status-dot" aria-hidden="true"></span>
                    <span id="callStatusText">Menghubungkan…</span>
                    <span class="sep" aria-hidden="true"></span>
                    <span class="timer" id="callTimer" aria-label="Durasi panggilan">00:00</span>
                </div>
            </div>

            <div class="call-panel">
                <div class="call-grid" id="callGrid">
                    <button type="button" class="call-ctl" data-toggle="mute" aria-pressed="false" aria-label="Bisukan mikrofon">
                        <span class="ctl-icon"><i class="bi bi-mic-fill" aria-hidden="true"></i></span>Bisukan
                    </button>
                    <button type="button" class="call-ctl" id="openKeypad" aria-label="Buka keypad" aria-controls="callKeypad" aria-expanded="false">
                        <span class="ctl-icon"><i class="bi bi-grid-3x3-gap-fill" aria-hidden="true"></i></span>Keypad
                    </button>
                    <button type="button" class="call-ctl" data-toggle="speaker" data-default="true" aria-pressed="true" aria-label="Speaker">
                        <span class="ctl-icon"><i class="bi bi-volume-up-fill" aria-hidden="true"></i></span>Speaker
                    </button>
                    <button type="button" class="call-ctl" data-sim aria-label="Tambah panggilan">
                        <span class="ctl-icon"><i class="bi bi-telephone-plus" aria-hidden="true"></i></span>Tambah
                    </button>
                    <button type="button" class="call-ctl" data-toggle="hold" aria-pressed="false" aria-label="Tahan panggilan">
                        <span class="ctl-icon"><i class="bi bi-pause-fill" aria-hidden="true"></i></span>Tahan
                    </button>
                    <button type="button" class="call-ctl" data-sim aria-label="Kontak">
                        <span class="ctl-icon"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>Kontak
                    </button>
                </div>

                <div class="keypad" id="callKeypad" hidden>
                    <div class="keypad-display" id="keypadDisplay" aria-live="polite"></div>
                    <div class="keypad-grid">
                        @foreach(['1','2','3','4','5','6','7','8','9','*','0','#'] as $key)
                            <button type="button" data-key="{{ $key }}" aria-label="Tombol {{ $key }}">{{ $key }}</button>
                        @endforeach
                    </div>
                    <button type="button" class="keypad-close" id="closeKeypad">
                        <i class="bi bi-chevron-down" aria-hidden="true"></i> Sembunyikan keypad
                    </button>
                </div>
            </div>

            <div class="call-info">
                <i class="bi bi-shield-check" aria-hidden="true"></i>
                <span>Jika panggilan terputus, gunakan kontak bantuan resmi yang tersedia atau layanan darurat sesuai kondisi.</span>
            </div>

            <div class="call-end-wrap">
                <button type="button" class="call-end" id="endCall" aria-label="Akhiri panggilan">
                    <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                </button>
                <span class="call-end-label" aria-hidden="true">Akhiri Panggilan</span>
            </div>

            <div class="call-toast" id="callToast" role="status" aria-live="polite"></div>
        </div>
    </div>

    <script>
    (function () {
        const overlay  = document.getElementById('callOverlay');
        const screen   = overlay.querySelector('.call-screen');
        const openBtn  = document.getElementById('openCall');
        const endBtn   = document.getElementById('endCall');
        const statusEl = document.getElementById('callStatus');
        const statusTx = document.getElementById('callStatusText');
        const timerEl  = document.getElementById('callTimer');
        const grid     = document.getElementById('callGrid');
        const keypad   = document.getElementById('callKeypad');
        const keyBtn   = document.getElementById('openKeypad');
        const keyDisp  = document.getElementById('keypadDisplay');
        const toast    = document.getElementById('callToast');

        let connectTimeout = null, tickInterval = null, toastTimeout = null, seconds = 0;

        const pad = n => String(n).padStart(2, '0');
        const renderTimer = () => { timerEl.textContent = pad(Math.floor(seconds / 60)) + ':' + pad(seconds % 60); };

        function resetState() {
            clearTimeout(connectTimeout); clearInterval(tickInterval); clearTimeout(toastTimeout);
            connectTimeout = tickInterval = toastTimeout = null;
            seconds = 0; renderTimer();
            statusEl.classList.add('is-connecting');
            statusTx.textContent = 'Menghubungkan…';
            overlay.querySelectorAll('[data-toggle]').forEach(b =>
                b.setAttribute('aria-pressed', b.dataset.default === 'true' ? 'true' : 'false'));
            toggleKeypad(false); keyDisp.textContent = '';
            toast.classList.remove('show'); toast.textContent = '';
        }

        function openCall() {
            resetState();
            overlay.hidden = false;
            document.documentElement.style.overflow = 'hidden';
            screen.scrollTop = 0;
            endBtn.focus();
            connectTimeout = setTimeout(() => {
                statusEl.classList.remove('is-connecting');
                statusTx.textContent = 'Panggilan Terhubung';
                tickInterval = setInterval(() => { seconds++; renderTimer(); }, 1000);
            }, 1500);
        }

        function closeCall() {
            if (overlay.hidden) return;
            resetState();
            overlay.hidden = true;
            document.documentElement.style.overflow = '';
            openBtn.focus();
        }

        function toggleKeypad(show) {
            keypad.hidden = !show; grid.hidden = show;
            keyBtn.setAttribute('aria-expanded', show ? 'true' : 'false');
            if (show) keypad.querySelector('[data-key]').focus();
        }

        function showToast(msg) {
            clearTimeout(toastTimeout);
            toast.textContent = msg; toast.classList.add('show');
            toastTimeout = setTimeout(() => toast.classList.remove('show'), 2000);
        }

        openBtn.addEventListener('click', openCall);
        endBtn.addEventListener('click', closeCall);
        overlay.addEventListener('click', e => { if (e.target === overlay) closeCall(); });

        overlay.querySelectorAll('[data-toggle]').forEach(b => b.addEventListener('click', () =>
            b.setAttribute('aria-pressed', b.getAttribute('aria-pressed') === 'true' ? 'false' : 'true')));
        overlay.querySelectorAll('[data-sim]').forEach(b => b.addEventListener('click', () => showToast('Fitur ini hanya simulasi')));
        keyBtn.addEventListener('click', () => toggleKeypad(true));
        document.getElementById('closeKeypad').addEventListener('click', () => { toggleKeypad(false); keyBtn.focus(); });
        keypad.querySelectorAll('[data-key]').forEach(b => b.addEventListener('click', () => {
            keyDisp.textContent = (keyDisp.textContent + b.dataset.key).slice(-16);
        }));

        // Esc menutup, Tab dikunci di dalam dialog (focus trap)
        document.addEventListener('keydown', e => {
            if (overlay.hidden) return;
            if (e.key === 'Escape') { e.preventDefault(); closeCall(); return; }
            if (e.key !== 'Tab') return;
            const items = [...screen.querySelectorAll('button, a[href], [tabindex]:not([tabindex="-1"])')]
                .filter(el => !el.disabled && el.offsetParent !== null);
            if (!items.length) return;
            const first = items[0], last = items[items.length - 1];
            if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
            else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
            else if (!screen.contains(document.activeElement)) { e.preventDefault(); first.focus(); }
        });
    })();
    </script>
@endsection