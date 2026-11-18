<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmergencyReportController;


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

        return view('mahasiswa.dashboard');

    })->name('mahasiswa.dashboard');


    // --------------------------------------
    // DASHBOARD PETUGAS
    // --------------------------------------

    Route::get('/petugas/dashboard', function () {

        if (auth()->user()->role !== 'petugas') {
            abort(403, 'Akses hanya untuk petugas.');
        }

        return view('petugas.dashboard');

    })->name('petugas.dashboard');


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
 