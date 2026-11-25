@extends('mahasiswa.klinik.layout')

@section('title', 'Batalkan Kunjungan | SerKoMu')

@section('content')

<style>
    .cancel-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .cancel-icon {
        width: 65px;
        height: 65px;
        margin: auto;
        border-radius: 20px;
        background: #fff0ef;
        color: #c34b4b;
        display: grid;
        place-items: center;
        font-size: 28px;
    }

    .cancel-header h1 {
        margin-top: 18px;
    }

    .cancel-muted {
        color: #8994aa;
        font-size: 12px;
        line-height: 1.7;
    }

    .cancel-alert {
        padding: 13px;
        border-radius: 10px;
        background: #fff0f0;
        color: #bc4141;
        font-size: 12px;
        margin-bottom: 20px;
        line-height: 1.7;
    }

    .cancel-section-title {
        font-size: 14px;
        font-weight: bold;
        margin: 24px 0 12px;
    }

    .cancel-info-box {
        background: white;
        border: 1px solid #e2e6f1;
        border-radius: 13px;
        padding: 16px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #edf0f5;
        font-size: 12px;
    }

    .summary-row:last-child {
        border-bottom: 0;
    }

    .summary-row span {
        color: #8994aa;
    }

    .summary-row strong {
        text-align: right;
        max-width: 60%;
        overflow-wrap: anywhere;
    }

    .reason-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        border: 1px solid #e2e6f1;
        border-radius: 13px;
        margin: 10px 0;
        font-size: 12px;
        cursor: pointer;
        transition: .2s;
    }

    .reason-option:hover {
        background: #f5f6ff;
        border-color: #8998d7;
    }

    .reason-option:has(input:checked) {
        background: #f0f3ff;
        border-color: #5265b5;
        color: #5265b5;
    }

    .reason-option input {
        width: 17px;
        height: 17px;
        accent-color: #5265b5;
        flex-shrink: 0;
    }

    .cancel-note {
        background: #f2f4ff;
        border: 1px solid #e1e6ff;
        border-radius: 12px;
        padding: 15px;
        color: #687692;
        font-size: 11px;
        line-height: 1.7;
        margin-top: 20px;
    }

    .cancel-submit {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 11px;
        background: #fff0ef;
        color: #bc4b4b;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 17px;
        transition: .2s;
    }

    .cancel-submit:hover {
        background: #ffe2df;
    }

    .cancel-submit:disabled {
        opacity: .6;
        cursor: not-allowed;
    }

    .cancel-back {
        display: block;
        width: 100%;
        padding: 14px;
        border-radius: 11px;
        background: #f0f2fa;
        color: #5969b8;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        margin-top: 11px;
    }

    .cancel-back:hover {
        background: #e7eafd;
    }

    .cancel-error {
        color: #bc4141;
        font-size: 11px;
        margin-top: 8px;
    }

    /* MODAL KONFIRMASI */

    .modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 5000;
        background: rgba(28, 38, 65, .45);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: .25s;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .confirm-modal {
        width: 100%;
        max-width: 400px;
        background: white;
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 15px 50px rgba(20, 30, 60, .2);
        transform: translateY(15px) scale(.97);
        transition: .25s;
    }

    .modal-overlay.active .confirm-modal {
        transform: translateY(0) scale(1);
    }

    .modal-icon {
        width: 62px;
        height: 62px;
        margin: 0 auto 16px;
        border-radius: 18px;
        background: #fff0ef;
        color: #bc4b4b;
        display: grid;
        place-items: center;
        font-size: 27px;
    }

    .confirm-modal h3 {
        font-size: 18px;
        margin: 0 0 10px;
        color: #263454;
    }

    .confirm-modal p {
        font-size: 12px;
        color: #8994aa;
        line-height: 1.7;
        margin-bottom: 22px;
    }

    .modal-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .modal-btn {
        border: none;
        padding: 13px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: bold;
        cursor: pointer;
    }

    .modal-btn.back {
        background: #f0f2fa;
        color: #5969b8;
    }

    .modal-btn.confirm {
        background: #bc4b4b;
        color: white;
    }

    .modal-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
    }

    /* NOTIFIKASI APLIKASI */

    .app-toast {
        position: fixed;
        z-index: 6000;
        top: 20px;
        right: 20px;
        width: calc(100% - 40px);
        max-width: 360px;
        background: white;
        border-radius: 13px;
        padding: 15px;
        box-shadow: 0 10px 35px rgba(30, 45, 90, .18);
        border-left: 4px solid #bc4141;
        display: flex;
        gap: 12px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-15px);
        transition: .25s;
    }

    .app-toast.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .app-toast i {
        color: #bc4141;
        font-size: 20px;
    }

    .app-toast strong {
        display: block;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .app-toast span {
        font-size: 11px;
        color: #78849b;
        line-height: 1.5;
    }

    @media (max-width: 480px) {
        .confirm-modal {
            padding: 20px;
        }

        .modal-actions {
            grid-template-columns: 1fr;
        }

        .app-toast {
            top: 12px;
            right: 12px;
            width: calc(100% - 24px);
        }
    }
</style>

<div class="main-card">

    <div class="cancel-header">

        <div class="cancel-icon">
            <i class="bi bi-calendar-x"></i>
        </div>

        <h1>Batalkan Kunjungan</h1>

        <p class="cancel-muted">
            Pastikan kembali sebelum membatalkan jadwal kunjungan klinik kamu.
        </p>

    </div>

    <div class="cancel-alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        Yakin ingin membatalkan kunjungan ini?
        Pembatalan tidak dapat dikembalikan secara otomatis.
    </div>

    <div class="cancel-section-title">
        <i class="bi bi-calendar-check"></i>
        Ringkasan Kunjungan
    </div>

    <div class="cancel-info-box">

        <div class="summary-row">
            <span>Layanan Klinik</span>
            <strong>{{ $appointment->poli }}</strong>
        </div>

        <div class="summary-row">
            <span>Kode Registrasi</span>
            <strong>{{ $appointment->booking_code }}</strong>
        </div>

        <div class="summary-row">
            <span>Nomor Antrean</span>
            <strong>
                A-{{ str_pad($appointment->queue_number, 2, '0', STR_PAD_LEFT) }}
            </strong>
        </div>

        <div class="summary-row">
            <span>Tanggal</span>
            <strong>
                {{ \Carbon\Carbon::parse($appointment->tanggal)->format('d/m/Y') }}
            </strong>
        </div>

        <div class="summary-row">
            <span>Jam Mulai</span>
            <strong>
                {{ \Carbon\Carbon::parse($appointment->jam)->format('H:i') }} WIB
            </strong>
        </div>

        <div class="summary-row">
            <span>Estimasi Dipanggil</span>
            <strong>
                {{ $appointment->estimated_call_time
                    ? \Carbon\Carbon::parse($appointment->estimated_call_time)->format('H:i') . ' WIB'
                    : '-'
                }}
            </strong>
        </div>

        <div class="summary-row">
            <span>Status</span>
            <strong style="color:#5969b8;">
                {{ $appointment->status }}
            </strong>
        </div>

    </div>

    <!-- FORM PEMBATALAN -->

    <form
        id="cancelForm"
        method="POST"
        action="{{ route('mahasiswa.klinik.cancel', $appointment->id) }}"
    >

        @csrf

        <div class="cancel-section-title">
            <i class="bi bi-chat-square-text"></i>
            Alasan Pembatalan
        </div>

        <p class="cancel-muted">
            Pilih alasan pembatalan agar petugas dapat mengetahui informasi perubahan jadwal.
        </p>

        @foreach([
            'Jadwal tidak sesuai',
            'Kondisi sudah membaik',
            'Memilih layanan lain',
            'Alasan lainnya'
        ] as $alasan)

            <label class="reason-option">

                <input
                    type="radio"
                    name="cancellation_reason"
                    value="{{ $alasan }}"
                    {{ old('cancellation_reason') == $alasan ? 'checked' : '' }}
                    required
                >

                <span>{{ $alasan }}</span>

            </label>

        @endforeach

        @error('cancellation_reason')
            <div class="cancel-error">
                {{ $message }}
            </div>
        @enderror

        <div class="cancel-note">
            <i class="bi bi-info-circle"></i>
            Setelah pembatalan berhasil, status kunjungan akan berubah menjadi Dibatalkan.
            Nomor antrean yang sudah diterbitkan tidak akan digunakan kembali.
        </div>

        <button
            type="button"
            class="cancel-submit"
            id="openCancelModal"
        >
            <i class="bi bi-x-circle"></i>
            Ya, Batalkan Kunjungan
        </button>

        <a
            href="{{ route('mahasiswa.klinik') }}"
            class="cancel-back"
        >
            <i class="bi bi-arrow-left"></i>
            Kembali, Jangan Batalkan
        </a>

    </form>

</div>

<!-- MODAL KONFIRMASI -->

<div class="modal-overlay" id="cancelModal">

    <div class="confirm-modal">

        <div class="modal-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>

        <h3>Konfirmasi Pembatalan</h3>

        <p>
            Apakah kamu yakin ingin membatalkan kunjungan klinik ini?
            Jadwal yang sudah dibatalkan tidak dapat dipulihkan secara otomatis.
        </p>

        <div class="modal-actions">

            <button
                type="button"
                class="modal-btn back"
                id="closeCancelModal"
            >
                Tidak, Kembali
            </button>

            <button
                type="button"
                class="modal-btn confirm"
                id="confirmCancel"
            >
                Ya, Batalkan
            </button>

        </div>

    </div>

</div>

<!-- NOTIFIKASI -->

<div class="app-toast" id="appToast">

    <i class="bi bi-exclamation-circle-fill"></i>

    <div>
        <strong>Perhatian</strong>
        <span id="toastText"></span>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const cancelModal = document.getElementById('cancelModal');
    const openModal = document.getElementById('openCancelModal');
    const closeModal = document.getElementById('closeCancelModal');
    const confirmCancel = document.getElementById('confirmCancel');
    const cancelForm = document.getElementById('cancelForm');

    const toast = document.getElementById('appToast');
    const toastText = document.getElementById('toastText');

    let toastTimer = null;

    // Menampilkan notifikasi aplikasi.
    function showToast(message) {

        if (!toast || !toastText) {
            alert(message);
            return;
        }

        toastText.textContent = message;
        toast.classList.add('show');

        clearTimeout(toastTimer);

        toastTimer = setTimeout(function () {
            toast.classList.remove('show');
        }, 3500);
    }

    // Mengambil alasan pembatalan yang dipilih.
    function getSelectedReason() {

        return cancelForm.querySelector(
            'input[name="cancellation_reason"]:checked'
        );

    }

    // Membuka modal konfirmasi.
    function openCancelConfirmation() {

        const selectedReason = getSelectedReason();

        if (!selectedReason) {
            showToast('Silakan pilih alasan pembatalan terlebih dahulu.');
            return;
        }

        cancelModal.classList.add('active');
        document.body.style.overflow = 'hidden';

    }

    // Menutup modal konfirmasi.
    function closeCancelConfirmation() {

        cancelModal.classList.remove('active');
        document.body.style.overflow = '';

    }

    // Tombol pembatalan utama.
    openModal.addEventListener('click', function () {
        openCancelConfirmation();
    });

    // Tombol kembali pada modal.
    closeModal.addEventListener('click', function () {
        closeCancelConfirmation();
    });

    // Menutup modal jika area luar diklik.
    cancelModal.addEventListener('click', function (event) {

        if (event.target === cancelModal) {
            closeCancelConfirmation();
        }

    });

    // Menutup modal dengan tombol Escape.
    document.addEventListener('keydown', function (event) {

        if (
            event.key === 'Escape' &&
            cancelModal.classList.contains('active')
        ) {
            closeCancelConfirmation();
        }

    });

    // Konfirmasi pembatalan.
    confirmCancel.addEventListener('click', function () {

        const selectedReason = getSelectedReason();

        if (!selectedReason) {

            closeCancelConfirmation();

            showToast('Silakan pilih alasan pembatalan terlebih dahulu.');

            return;
        }

        if (!cancelForm.checkValidity()) {

            closeCancelConfirmation();

            cancelForm.reportValidity();

            return;
        }

        confirmCancel.disabled = true;

        confirmCancel.innerHTML =
            '<i class="bi bi-hourglass-split"></i> Memproses...';

        // Mengirim form POST ke Laravel.
        cancelForm.requestSubmit();

    });

    // Menampilkan pesan validasi Laravel.
    const validationError = @json($errors->first());

    if (validationError) {
        showToast(validationError);
    }

});
</script>

@endsection
