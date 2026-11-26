@extends('layouts.bantuan')

@section('title', 'Panduan Bantuan')

@section('styles')
    .guide-hero {
        display: flex; gap: 16px; align-items: center;
        background: linear-gradient(135deg, #eef2fb 0%, #f7f9fe 100%);
        border-color: #dfe6f6;
    }
    .guide-hero .gi {
        flex: 0 0 52px; height: 52px; border-radius: var(--radius-sm);
        background: var(--primary); color: #fff;
        display: flex; align-items: center; justify-content: center; font-size: 24px;
    }
    .guide-hero h2 { font-size: 19px; margin: 0 0 4px; line-height: 1.3; }
    .guide-hero p { margin: 0; color: var(--muted); font-size: 13.5px; }

    .steps { list-style: none; margin: 0; padding: 0; position: relative; }
    .steps::before {
        content: ""; position: absolute; left: 15px; top: 20px; bottom: 20px;
        width: 2px; background: var(--border);
    }
    .step { position: relative; display: flex; gap: 14px; align-items: flex-start; padding: 12px 0; }
    .step-num {
        position: relative; z-index: 1;
        flex: 0 0 32px; height: 32px; border-radius: 50%;
        background: var(--primary); color: #fff; font-weight: 700; font-size: 14px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 0 0 4px #fff;
    }
    .step-body { flex: 1; min-width: 0; }
    .step-body h3 { font-size: 15px; margin: 4px 0 2px; }
    .step-body p { margin: 0; color: var(--muted); font-size: 13.5px; }
    .step-icon {
        flex: 0 0 40px; height: 40px; border-radius: 12px;
        background: var(--primary-soft); color: var(--primary);
        display: flex; align-items: center; justify-content: center; font-size: 18px;
    }

    .quick { border-color: #f1d9d5; background: #fffaf9; }
    .quick h3 { display: flex; align-items: center; gap: 8px; margin: 0 0 6px; font-size: 16px; }
    .quick h3 i { color: var(--danger); }
    .quick p { margin: 0 0 16px; color: var(--muted); font-size: 13.5px; }
@endsection

@section('content')
    <section class="card guide-hero">
        <span class="gi"><i class="bi bi-clipboard2-check" aria-hidden="true"></i></span>
        <div>
            <h2>Langkah Mudah Meminta Bantuan</h2>
            <p>Ikuti alur ini agar penanganan berlangsung cepat dan tepat.</p>
        </div>
    </section>

    <section class="card" aria-label="Langkah meminta bantuan">
        <ol class="steps">
            <li class="step">
                <span class="step-num">1</span>
                <div class="step-body">
                    <h3>Cari Kontak Layanan</h3>
                    <p>Pilih layanan kesehatan atau keamanan sesuai situasi.</p>
                </div>
                <span class="step-icon"><i class="bi bi-telephone" aria-hidden="true"></i></span>
            </li>
            <li class="step">
                <span class="step-num">2</span>
                <div class="step-body">
                    <h3>Sampaikan Lokasi Spesifik</h3>
                    <p>Berikan nama gedung, lantai, dan nomor ruangan secara jelas.</p>
                </div>
                <span class="step-icon"><i class="bi bi-geo-alt" aria-hidden="true"></i></span>
            </li>
            <li class="step">
                <span class="step-num">3</span>
                <div class="step-body">
                    <h3>Jelaskan Kondisi Singkat</h3>
                    <p>Ceritakan kondisi darurat atau keluhan yang dihadapi.</p>
                </div>
                <span class="step-icon"><i class="bi bi-chat-left-text" aria-hidden="true"></i></span>
            </li>
            <li class="step">
                <span class="step-num">4</span>
                <div class="step-body">
                    <h3>Ikuti Instruksi Petugas</h3>
                    <p>Tetap tenang dan tunggu konfirmasi pendampingan di tempat.</p>
                </div>
                <span class="step-icon"><i class="bi bi-person-check" aria-hidden="true"></i></span>
            </li>
        </ol>
    </section>

    <section class="card quick" aria-labelledby="bantuan-cepat">
        <h3 id="bantuan-cepat"><i class="bi bi-headset" aria-hidden="true"></i> Perlu Bantuan Cepat Sekarang?</h3>
        <p>Hubungi pusat kendali terpadu universitas yang selalu siaga 24 jam.</p>
        <a href="{{ route('kontak-darurat') }}" class="btn btn--danger">
            <i class="bi bi-telephone-fill" aria-hidden="true"></i> Telepon Bantuan Darurat
        </a>
    </section>

    <p class="footnote">
        <i class="bi bi-info-circle" aria-hidden="true"></i>
        <span>Panduan ini bersifat informatif, bukan pengganti penanganan medis profesional.</span>
    </p>
@endsection