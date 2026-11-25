@extends('mahasiswa.klinik.layout')

@section('title', 'Daftar Kunjungan Klinik | SerKoMu')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    .booking-container {
        max-width: 850px;
        margin: 25px auto;
        padding: 0 15px 110px;
        color: #263454;
    }

    .booking-card {
        background: white;
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 8px 30px rgba(40,60,110,.07);
    }

    .booking-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        padding: 10px 14px;
        border: 1px solid #dfe5f3;
        border-radius: 10px;
        color: #5969b8;
        background: #f7f8fd;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .booking-back:hover {
        background: #eef1ff;
        border-color: #bfc9ef;
    }

    .booking-title {
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .booking-desc {
        font-size: 13px;
        color: #8994aa;
        line-height: 1.7;
        margin-bottom: 25px;
    }

    .booking-section {
        margin-top: 27px;
    }

    .booking-section-title {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .booking-section-title i {
        color: #5969b8;
        margin-right: 7px;
    }

    .poli-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .poli-option {
        position: relative;
        border: 1px solid #e1e6f1;
        border-radius: 15px;
        padding: 18px;
        cursor: pointer;
        transition: .2s;
        display: flex;
        gap: 13px;
        align-items: center;
    }

    .poli-option:hover {
        border-color: #5969b8;
    }

    .poli-option.selected {
        border: 2px solid #5969b8;
        background: #f2f4ff;
        padding: 17px;
    }

    .poli-option input {
        position: absolute;
        opacity: 0;
    }

    .poli-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 12px;
        background: #f0f2ff;
        display: grid;
        place-items: center;
        color: #5969b8;
        font-size: 19px;
    }

    .poli-name {
        display: block;
        font-size: 13px;
        font-weight: 700;
    }

    .poli-description {
        display: block;
        font-size: 11px;
        color: #8994aa;
        margin-top: 5px;
    }

    .poli-duration {
        font-size: 10px;
        color: #5969b8;
        background: #e9edff;
        padding: 5px 8px;
        border-radius: 6px;
        display: inline-block;
        margin-top: 8px;
    }

    .poli-check {
        margin-left: auto;
        color: #5969b8;
        display: none;
    }

    .poli-option.selected .poli-check {
        display: block;
    }

    .date-input {
        width: 100%;
        border: 1px solid #e1e6f1;
        border-radius: 12px;
        padding: 15px;
        font-size: 13px;
        color: #263454;
        outline: none;
    }

    .date-input:focus {
        border-color: #5969b8;
    }

    .time-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 11px;
    }

    .time-option {
        border: 1px solid #e1e6f1;
        border-radius: 13px;
        padding: 15px 8px;
        text-align: center;
        cursor: pointer;
        transition: .2s;
        background: white;
        position: relative;
    }

    .time-option:hover:not(.disabled) {
        border-color: #5969b8;
    }

    .time-option.selected {
        border: 2px solid #5969b8;
        background: #f0f2ff;
        padding: 14px 7px;
    }

    .time-option.disabled {
        background: #f0f1f4;
        border-color: #e5e7eb;
        color: #a5aaba;
        cursor: not-allowed;
        opacity: .75;
        pointer-events: none;
    }

    .time-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .time-label {
        font-size: 13px;
        font-weight: 700;
    }

    .time-status {
        font-size: 10px;
        color: #8994aa;
        margin-top: 7px;
    }

    .time-option.selected .time-status {
        color: #5969b8;
    }

    .time-option.disabled .time-status {
        color: #bc5555;
    }

    .capacity-info {
        background: #f0f5ff;
        border: 1px solid #e1e9ff;
        border-radius: 13px;
        padding: 15px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-top: 17px;
    }

    .capacity-info i {
        color: #5969b8;
        font-size: 17px;
    }

    .capacity-info strong {
        font-size: 12px;
        color: #5265b5;
    }

    .capacity-info p {
        font-size: 11px;
        color: #8994aa;
        line-height: 1.6;
        margin: 5px 0 0;
    }

    .complaint-input {
        width: 100%;
        border: 1px solid #e1e6f1;
        border-radius: 12px;
        padding: 14px;
        font-family: inherit;
        font-size: 13px;
        resize: vertical;
        min-height: 100px;
        outline: none;
    }

    .complaint-input:focus {
        border-color: #5969b8;
    }

    .booking-submit {
        width: 100%;
        border: 0;
        border-radius: 12px;
        background: #5969b8;
        color: white;
        padding: 16px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 25px;
    }

    .booking-submit:hover:not(:disabled) {
        background: #4656a5;
    }

    .booking-submit:disabled {
        background: #a9b0d3;
        cursor: not-allowed;
    }

    .booking-error {
        font-size: 12px;
        color: #c34b4b;
        margin-top: 7px;
    }

    .booking-loading,
    .empty-slots {
        text-align: center;
        padding: 25px;
        background: #f7f8fc;
        border-radius: 12px;
        color: #8994aa;
        font-size: 12px;
        grid-column: 1 / -1;
    }

    .toast-popup {
        position: fixed;
        top: 25px;
        right: 25px;
        z-index: 99999;
        background: white;
        border-radius: 13px;
        padding: 16px 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,.15);
        display: flex;
        gap: 12px;
        align-items: center;
        max-width: 360px;
        transform: translateX(130%);
        transition: .3s;
    }

    .toast-popup.show {
        transform: translateX(0);
    }

    .toast-popup i {
        font-size: 21px;
        color: #c34b4b;
    }

    .toast-popup.success i {
        color: #16875a;
    }

    .toast-message {
        font-size: 12px;
        line-height: 1.5;
        color: #263454;
    }

    @media(max-width:600px) {
        .booking-card {
            padding: 19px;
        }

        .poli-grid {
            grid-template-columns: 1fr;
        }

        .time-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .booking-title {
            font-size: 21px;
        }

        .toast-popup {
            left: 15px;
            right: 15px;
            max-width: none;
            top: 15px;
        }
    }
</style>

<div class="booking-container">
    <div class="booking-card">

        <a href="{{ route('mahasiswa.klinik') }}" class="booking-back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Halaman Klinik
        </a>

        <h1 class="booking-title">Daftar Kunjungan Klinik</h1>

        <p class="booking-desc">
            Silakan pilih layanan klinik, tanggal, dan sesi kedatangan
            yang tersedia untuk melakukan pendaftaran.
        </p>

        <form id="appointmentForm"
              method="POST"
              action="{{ route('mahasiswa.klinik.store') }}">

            @csrf

            <div class="booking-section">
                <div class="booking-section-title">
                    <i class="bi bi-hospital"></i>
                    Pilih Layanan Klinik
                </div>

                <div class="poli-grid">

                    <label class="poli-option selected">
                        <input type="radio"
                               name="poli"
                               value="Poli Umum"
                               {{ old('poli', 'Poli Umum') == 'Poli Umum' ? 'checked' : '' }}>

                        <span class="poli-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </span>

                        <span>
                            <span class="poli-name">Poli Umum</span>
                            <span class="poli-description">
                                Pemeriksaan kesehatan umum
                            </span>
                            <span class="poli-duration">
                                10 menit / pasien
                            </span>
                        </span>

                        <i class="bi bi-check-circle-fill poli-check"></i>
                    </label>

                    <label class="poli-option">
                        <input type="radio"
                               name="poli"
                               value="Poli Gigi"
                               {{ old('poli') == 'Poli Gigi' ? 'checked' : '' }}>

                        <span class="poli-icon">
                            <i class="bi bi-emoji-smile"></i>
                        </span>

                        <span>
                            <span class="poli-name">Poli Gigi</span>
                            <span class="poli-description">
                                Pemeriksaan dan perawatan gigi
                            </span>
                            <span class="poli-duration">
                                30 menit / pasien
                            </span>
                        </span>

                        <i class="bi bi-check-circle-fill poli-check"></i>
                    </label>

                    <label class="poli-option">
                        <input type="radio"
                               name="poli"
                               value="Konseling/Mental"
                               {{ old('poli') == 'Konseling/Mental' ? 'checked' : '' }}>

                        <span class="poli-icon">
                            <i class="bi bi-chat-heart"></i>
                        </span>

                        <span>
                            <span class="poli-name">Konseling / Mental</span>
                            <span class="poli-description">
                                Layanan konseling dan psikologis
                            </span>
                            <span class="poli-duration">
                                60 menit / pasien
                            </span>
                        </span>

                        <i class="bi bi-check-circle-fill poli-check"></i>
                    </label>

                </div>

                @error('poli')
                    <div class="booking-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="booking-section">
                <div class="booking-section-title">
                    <i class="bi bi-calendar3"></i>
                    Pilih Tanggal Kunjungan
                </div>

                <input type="date"
                       name="tanggal"
                       id="tanggal"
                       class="date-input"
                       min="{{ now('Asia/Jakarta')->toDateString() }}"
                       value="{{ old('tanggal', now('Asia/Jakarta')->toDateString()) }}"
                       required>

                @error('tanggal')
                    <div class="booking-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="booking-section">
                <div class="booking-section-title">
                    <i class="bi bi-clock"></i>
                    Pilih Sesi Jam Kedatangan

                    <span style="float:right;font-size:11px;color:#8994aa;font-weight:400">
                        WIB
                    </span>
                </div>

                <div id="timeInfo"
                     style="font-size:12px;color:#8994aa;margin-bottom:13px">
                    Memeriksa ketersediaan jadwal...
                </div>

                <div id="timeGrid" class="time-grid">
                    <div class="booking-loading">
                        Memuat jadwal...
                    </div>
                </div>

                <input type="hidden"
                       name="jam"
                       id="selectedTime"
                       value="{{ old('jam') }}"
                       required>

                @error('jam')
                    <div class="booking-error">{{ $message }}</div>
                @enderror

                <div class="capacity-info">
                    <i class="bi bi-people-fill"></i>

                    <div>
                        <strong>Kapasitas Antrean Klinik</strong>
                        <p>
                            Setiap sesi memiliki kapasitas pelayanan tertentu.
                            Apabila suatu sesi telah mencapai kapasitasnya,
                            sesi tersebut tidak dapat dipilih kembali.
                            Silakan pilih jadwal lain yang masih tersedia.
                        </p>
                    </div>
                </div>
            </div>

            <div class="booking-section">
                <div class="booking-section-title">
                    <i class="bi bi-chat-left-text"></i>
                    Keluhan Kesehatan
                </div>

                <textarea name="keluhan"
                          class="complaint-input"
                          placeholder="Tuliskan keluhan kesehatan yang ingin diperiksa (opsional)..."
                          maxlength="1000">{{ old('keluhan') }}</textarea>

                @error('keluhan')
                    <div class="booking-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                    id="submitButton"
                    class="booking-submit"
                    disabled>
                <i class="bi bi-arrow-right-circle"></i>
                Lanjutkan Konfirmasi
            </button>

        </form>
    </div>
</div>

<div id="toastPopup"
     class="toast-popup"
     role="alert"
     aria-live="assertive">

    <i id="toastIcon" class="bi bi-exclamation-circle-fill"></i>

    <div id="toastMessage" class="toast-message"></div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('appointmentForm');
    const poliInputs = document.querySelectorAll('input[name="poli"]');
    const tanggalInput = document.getElementById('tanggal');
    const timeGrid = document.getElementById('timeGrid');
    const timeInfo = document.getElementById('timeInfo');
    const selectedTime = document.getElementById('selectedTime');
    const submitButton = document.getElementById('submitButton');

    const availabilityUrl = @json(route('mahasiswa.klinik.availability'));
    const oldJam = @json(old('jam'));

    const durations = {
        'Poli Umum': 10,
        'Poli Gigi': 30,
        'Konseling/Mental': 60
    };

    let currentSlots = {};
    let loading = false;
    let requestNumber = 0;
    let toastTimeout = null;

    function showToast(message, success = false) {
        const toast = document.getElementById('toastPopup');
        const icon = document.getElementById('toastIcon');

        document.getElementById('toastMessage').textContent = message;

        toast.classList.toggle('success', success);

        icon.className = success
            ? 'bi bi-check-circle-fill'
            : 'bi bi-exclamation-circle-fill';

        toast.classList.add('show');

        clearTimeout(toastTimeout);

        toastTimeout = setTimeout(() => {
            toast.classList.remove('show');
        }, 3500);
    }

    function getSelectedPoli() {
        return document.querySelector(
            'input[name="poli"]:checked'
        )?.value || '';
    }

    function getWibTime() {
        const parts = new Intl.DateTimeFormat('en-CA', {
            timeZone: 'Asia/Jakarta',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            hourCycle: 'h23'
        }).formatToParts(new Date());

        const result = {};

        parts.forEach(part => {
            result[part.type] = part.value;
        });

        return {
            date: `${result.year}-${result.month}-${result.day}`,
            time: `${result.hour}:${result.minute}`
        };
    }

    function generateTimeSlots(poli) {
        const duration = durations[poli];

        if (!duration) return [];

        const slots = [];

        for (
            let minutes = 8 * 60;
            minutes + duration <= 16 * 60;
            minutes += duration
        ) {
            const hour = String(Math.floor(minutes / 60)).padStart(2, '0');
            const minute = String(minutes % 60).padStart(2, '0');

            slots.push(`${hour}:${minute}`);
        }

        return slots;
    }

    function showEmpty(message) {
        timeGrid.innerHTML = '';

        const element = document.createElement('div');
        element.className = 'empty-slots';
        element.textContent = message;

        timeGrid.appendChild(element);
    }

    function updateSubmitButton() {
        const slot = currentSlots[selectedTime.value];

        submitButton.disabled =
            loading ||
            !selectedTime.value ||
            !slot ||
            !slot.available;
    }

    function renderSlots(timeSlots) {
        timeGrid.innerHTML = '';

        let availableCount = 0;

        timeSlots.forEach(jam => {
            const slot = currentSlots[jam];

            if (!slot) return;

            const available = slot.available;

            if (available) availableCount++;

            const label = document.createElement('label');

            label.className = 'time-option' +
                (available ? '' : ' disabled');

            const input = document.createElement('input');

            input.type = 'radio';
            input.name = 'time_selection';
            input.value = jam;
            input.disabled = !available;

            const timeLabel = document.createElement('div');

            timeLabel.className = 'time-label';
            timeLabel.textContent = jam.replace(':', '.');

            const status = document.createElement('div');

            status.className = 'time-status';

            if (slot.already_booked) {
                status.textContent = 'Sudah terdaftar';
            } else if (slot.full) {
                status.textContent = 'Sesi sudah terisi';
            } else if (!available) {
                status.textContent = 'Tidak tersedia';
            } else {
                status.textContent = 'Pilih sesi';
            }

            label.append(input, timeLabel, status);

            if (jam === oldJam && available) {
                input.checked = true;
                label.classList.add('selected');
                selectedTime.value = jam;
            }

            input.addEventListener('change', function () {
                document.querySelectorAll('.time-option')
                    .forEach(option => {
                        option.classList.remove('selected');
                    });

                label.classList.add('selected');
                selectedTime.value = jam;

                updateSubmitButton();
            });

            timeGrid.appendChild(label);
        });

        if (availableCount === 0) {
            showEmpty(
                'Tidak ada jadwal yang tersedia. Silakan pilih tanggal lain.'
            );

            timeInfo.textContent =
                'Seluruh sesi pada tanggal ini tidak tersedia.';
        } else {
            timeInfo.textContent =
                `${availableCount} sesi masih tersedia untuk dipilih.`;
        }

        updateSubmitButton();
    }

    async function loadSlots() {
        const poli = getSelectedPoli();
        const tanggal = tanggalInput.value;

        const currentRequest = ++requestNumber;

        selectedTime.value = '';
        currentSlots = {};

        loading = false;
        updateSubmitButton();

        if (!poli || !tanggal) {
            showEmpty('Pilih poli dan tanggal terlebih dahulu.');
            timeInfo.textContent = 'Pilih poli dan tanggal kunjungan.';
            return;
        }

        const now = getWibTime();

        if (tanggal < now.date) {
            showEmpty('Tanggal kunjungan tidak boleh sebelum hari ini.');
            timeInfo.textContent = 'Silakan pilih tanggal yang valid.';
            showToast('Tanggal kunjungan sudah terlewat.');
            return;
        }

        loading = true;
        updateSubmitButton();

        timeGrid.innerHTML = `
            <div class="booking-loading">
                <i class="bi bi-arrow-repeat"></i>
                Memeriksa ketersediaan jadwal...
            </div>
        `;

        timeInfo.textContent =
            'Memeriksa jadwal berdasarkan layanan yang dipilih.';

        try {
            const url = new URL(availabilityUrl, window.location.origin);

            url.searchParams.set('poli', poli);
            url.searchParams.set('tanggal', tanggal);

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal memeriksa jadwal.');
            }

            const data = await response.json();

            if (currentRequest !== requestNumber) return;

            if (!data.success) {
                throw new Error(data.message || 'Jadwal tidak dapat dimuat.');
            }

            const availability = data.slots || {};
            const currentTime = getWibTime();
            const timeSlots = generateTimeSlots(poli);

            timeSlots.forEach(jam => {
                const slot = availability[jam] ||
                    availability[jam + ':00'];

                if (!slot) {
                    currentSlots[jam] = {
                        available: false,
                        full: false,
                        already_booked: false
                    };
                    return;
                }

                const pastTime =
                    tanggal === currentTime.date &&
                    jam <= currentTime.time;

                currentSlots[jam] = {
                    ...slot,
                    available:
                        slot.available === true &&
                        !slot.full &&
                        !slot.already_booked &&
                        !pastTime
                };
            });

            renderSlots(timeSlots);

        } catch (error) {
            if (currentRequest !== requestNumber) return;

            showEmpty('Tidak dapat memuat jadwal. Silakan coba kembali.');

            timeInfo.textContent =
                'Terjadi kesalahan saat memuat jadwal.';

            showToast(error.message);

        } finally {
            if (currentRequest === requestNumber) {
                loading = false;
                updateSubmitButton();
            }
        }
    }

    poliInputs.forEach(input => {
        input.addEventListener('change', function () {
            document.querySelectorAll('.poli-option')
                .forEach(option => {
                    option.classList.remove('selected');
                });

            input.closest('.poli-option').classList.add('selected');

            loadSlots();
        });

        if (input.checked) {
            input.closest('.poli-option').classList.add('selected');
        }
    });

    tanggalInput.addEventListener('change', function () {
        const today = getWibTime().date;

        if (this.value && this.value < today) {
            this.value = '';
            selectedTime.value = '';

            loadSlots();

            showToast('Tanggal kunjungan tidak boleh sebelum hari ini.');
            return;
        }

        loadSlots();
    });

    form.addEventListener('submit', function (event) {
        const selected = currentSlots[selectedTime.value];

        if (
            loading ||
            !selectedTime.value ||
            !selected ||
            !selected.available
        ) {
            event.preventDefault();

            showToast(
                'Silakan pilih sesi kunjungan yang masih tersedia.'
            );

            updateSubmitButton();
            return;
        }

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }

        submitButton.disabled = true;

        submitButton.innerHTML = `
            <i class="bi bi-arrow-repeat"></i>
            Memproses pendaftaran...
        `;
    });

    loadSlots();
});
</script>
