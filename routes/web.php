<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Mahasiswa\ProfileController;

use App\Http\Controllers\EmergencyReportController;
use App\Http\Controllers\ClinicAppointmentController;

use App\Models\EmergencyReport;
use App\Models\ClinicAppointment;


// =====================================================
// HALAMAN LOGIN
// =====================================================

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');


// =====================================================
// REGISTER MAHASISWA
// =====================================================

Route::get('/register', [RegisterController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->middleware(['guest', 'throttle:6,1'])
    ->name('register.process');

// =====================================================
// HALAMAN BANTUAN PUBLIK (tanpa login)
// =====================================================

Route::view('/kontak-darurat', 'mahasiswa.kontak-darurat')
    ->name('kontak-darurat');

Route::view('/panduan-bantuan', 'mahasiswa.panduan-bantuan')
    ->name('panduan-bantuan');


// =====================================================
// HALAMAN UTAMA
// =====================================================

Route::get('/', function () {
    return redirect()->route('login');
});


// =====================================================
// ROUTE PENGGUNA LOGIN
// =====================================================

Route::middleware(['auth'])->group(function () {


    // =================================================
    // DASHBOARD MAHASISWA
    // =================================================

    Route::get('/mahasiswa/dashboard', function () {

        abort_unless(auth()->user()->role === 'mahasiswa', 403);

        $laporanSaya = EmergencyReport::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        $totalKunjungan = ClinicAppointment::where(
            'user_id',
            auth()->id()
        )
            ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
            ->count();

        $kunjunganMendatang = ClinicAppointment::where(
            'user_id',
            auth()->id()
        )
            ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->limit(3)
            ->get();

        $riwayatKlinik = ClinicAppointment::where(
            'user_id',
            auth()->id()
        )
            ->whereIn('status', ['Selesai', 'Dibatalkan'])
            ->orderByDesc('tanggal')
            ->orderByDesc('jam')
            ->limit(3)
            ->get();

        return view('mahasiswa.dashboard', compact(
            'laporanSaya',
            'totalKunjungan',
            'kunjunganMendatang',
            'riwayatKlinik'
        ));

    })->name('mahasiswa.dashboard');


        // =================================================
    // AKUN MAHASISWA
    // =================================================

    Route::get('/mahasiswa/akun', [ProfileController::class, 'index'])
        ->name('mahasiswa.akun');

    Route::put('/mahasiswa/akun', [ProfileController::class, 'update'])
        ->name('mahasiswa.akun.update');

    Route::get('/mahasiswa/akun/password', [ProfileController::class, 'passwordForm'])
        ->name('mahasiswa.akun.password.form');

    Route::put('/mahasiswa/akun/password', [ProfileController::class, 'updatePassword'])
        ->name('mahasiswa.akun.password');

    // =================================================
    // KLINIK MAHASISWA
    // =================================================

    // Halaman utama klinik

    Route::get('/mahasiswa/klinik', [
        ClinicAppointmentController::class,
        'index'
    ])->name('mahasiswa.klinik');


    // Pendaftaran kunjungan

    Route::get('/mahasiswa/klinik/daftar', [
        ClinicAppointmentController::class,
        'create'
    ])->name('mahasiswa.klinik.create');

    Route::post('/mahasiswa/klinik/daftar', [
        ClinicAppointmentController::class,
        'store'
    ])->name('mahasiswa.klinik.store');


    // Cek ketersediaan jadwal

    Route::get('/mahasiswa/klinik/availability', [
        ClinicAppointmentController::class,
        'availability'
    ])->name('mahasiswa.klinik.availability');


    // Konfirmasi pendaftaran

    Route::get('/mahasiswa/klinik/konfirmasi', [
        ClinicAppointmentController::class,
        'confirmation'
    ])->name('mahasiswa.klinik.confirmation');

    Route::post('/mahasiswa/klinik/konfirmasi', [
        ClinicAppointmentController::class,
        'confirm'
    ])->name('mahasiswa.klinik.confirm');


    // Bukti pendaftaran

    Route::get('/mahasiswa/klinik/bukti/{id}', [
        ClinicAppointmentController::class,
        'proof'
    ])->whereNumber('id')
      ->name('mahasiswa.klinik.bukti');


    // Pembatalan kunjungan

    Route::get('/mahasiswa/klinik/{id}/batalkan', [
        ClinicAppointmentController::class,
        'cancelForm'
    ])->whereNumber('id')
      ->name('mahasiswa.klinik.cancel.form');

    Route::post('/mahasiswa/klinik/batal/{id}', [
        ClinicAppointmentController::class,
        'cancel'
    ])->whereNumber('id')
      ->name('mahasiswa.klinik.cancel');


    // Riwayat kunjungan

    Route::get('/mahasiswa/klinik/riwayat', [
        ClinicAppointmentController::class,
        'history'
    ])->name('mahasiswa.klinik.riwayat');


    // =================================================
    // SISTEM LAPOR MAHASISWA
    // =================================================

    // Halaman utama laporan

    Route::get('/laporan-darurat', [
        EmergencyReportController::class,
        'create'
    ])->name('emergency-reports.create');


    // Mengirim laporan darurat

    Route::post('/laporan-darurat', [
        EmergencyReportController::class,
        'store'
    ])->name('emergency-reports.store');


    // Mencari status laporan

    Route::post('/laporan-darurat/track', [
        EmergencyReportController::class,
        'track'
    ])->name('emergency-reports.track');


    // Kompatibilitas halaman status lama

    Route::get('/mahasiswa/status-laporan', [
        EmergencyReportController::class,
        'statusForm'
    ])->name('mahasiswa.status');

    Route::post('/mahasiswa/status-laporan', [
        EmergencyReportController::class,
        'track'
    ])->name('mahasiswa.status.track');


    // =================================================
    // DASHBOARD PETUGAS
    // =================================================

    Route::get('/petugas/dashboard', function () {

        abort_unless(auth()->user()->role === 'petugas', 403);

        $totalLaporan = EmergencyReport::count();

        $laporanMenunggu = EmergencyReport::where(
            'status',
            'Menunggu'
        )->count();

        return view('petugas.dashboard', compact(
            'totalLaporan',
            'laporanMenunggu'
        ));

    })->name('petugas.dashboard');


    // =================================================
    // DAFTAR LAPORAN PETUGAS
    // =================================================

    Route::get('/petugas/laporan', [
        EmergencyReportController::class,
        'index'
    ])->name('petugas.laporan.index');


    // Detail laporan

    Route::get('/petugas/laporan/{id}', [
        EmergencyReportController::class,
        'show'
    ])->whereNumber('id')
      ->name('petugas.laporan.show');


    // Update status laporan

    Route::put('/petugas/laporan/{id}', [
        EmergencyReportController::class,
        'update'
    ])->whereNumber('id')
      ->name('petugas.laporan.update');


    // =================================================
    // LOGOUT
    // =================================================

    Route::post('/logout', [
        LoginController::class,
        'logout'
    ])->name('logout');

});
