<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmergencyReportController;
use App\Http\Controllers\ClinicAppointmentController;


// ==========================================
// HALAMAN LOGIN
// ==========================================

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');


// ==========================================
// HALAMAN UTAMA
// ==========================================

Route::get('/', function () {
    return redirect()->route('login');
});


// ==========================================
// ROUTE KHUSUS PENGGUNA YANG SUDAH LOGIN
// ==========================================

Route::middleware(['auth'])->group(function () {

    // --------------------------------------
    // DASHBOARD MAHASISWA
    // --------------------------------------

    Route::get('/mahasiswa/dashboard', function () {

        if (auth()->user()->role !== 'mahasiswa') {
            abort(403, 'Akses hanya untuk mahasiswa.');
        }

        $laporanSaya = \App\Models\EmergencyReport::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view('mahasiswa.dashboard', compact('laporanSaya'));

    })->name('mahasiswa.dashboard');

    // DASHBOARD KLINIK MAHASISWA
    Route::get('/mahasiswa/klinik', function () {

        if (auth()->user()->role !== 'mahasiswa') {
            abort(403);
        }

        return view('mahasiswa.klinik');

    })->name('mahasiswa.klinik');

    // HALAMAN RIWAYAT KUNJUNGAN KLINIK
    Route::get('/mahasiswa/klinik/riwayat', [
        ClinicAppointmentController::class,
        'history'
    ])->name('mahasiswa.klinik.riwayat');


    // PENDAFTARAN KUNJUNGAN KLINIK MAHASISWA

    Route::get('/mahasiswa/klinik/daftar', [
        ClinicAppointmentController::class,
        'create'
    ])->name('mahasiswa.klinik.create');

    Route::post('/mahasiswa/klinik/daftar', [
        ClinicAppointmentController::class,
        'store'
    ])->name('mahasiswa.klinik.store');



    // --------------------------------------
    // DASHBOARD PETUGAS
    // --------------------------------------

    Route::get('/petugas/dashboard', function () {

        if (auth()->user()->role !== 'petugas') {
            abort(403, 'Akses hanya untuk petugas.');
        }

        $totalLaporan = \App\Models\EmergencyReport::count();

        $laporanMenunggu = \App\Models\EmergencyReport::where(
            'status',
            'Menunggu'
        )->count();

        return view('petugas.dashboard', compact(
            'totalLaporan',
            'laporanMenunggu'
        ));

    })->name('petugas.dashboard');

     // DASHBOARD DAFTAR LAPORAN PETUGAS
    Route::get('/petugas/laporan', [
        EmergencyReportController::class,
        'index'
    ])->name('petugas.laporan.index');

    // CEK STATUS LAPORAN MAHASISWA
    Route::get('/mahasiswa/status-laporan', [
        EmergencyReportController::class,
        'statusForm'
    ])->name('mahasiswa.status');

    Route::post('/mahasiswa/status-laporan', [
        EmergencyReportController::class,
        'track'
    ])->name('mahasiswa.status.track');

    // Menampilkan detail laporan untuk petugas
    Route::get('/petugas/laporan/{id}', [
        EmergencyReportController::class,
        'show'
    ])->name('petugas.laporan.show');

    // Memperbarui status dan tindak lanjut laporan
    Route::put('/petugas/laporan/{id}', [
        EmergencyReportController::class,
        'update'
    ])->name('petugas.laporan.update');


    // --------------------------------------
    // LAPORAN DARURAT MAHASISWA
    // --------------------------------------

    // Menampilkan halaman formulir laporan
    Route::get('/laporan-darurat', [EmergencyReportController::class, 'create'])
        ->name('emergency-reports.create');

    // Menyimpan laporan ke database
    Route::post('/laporan-darurat', [EmergencyReportController::class, 'store'])
        ->name('emergency-reports.store');


    // --------------------------------------
    // LOGOUT
    // --------------------------------------

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

});
 