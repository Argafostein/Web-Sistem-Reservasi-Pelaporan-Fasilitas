<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Facility;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PetugasLaporanController;
use App\Http\Controllers\PetugasReservasiController;

Route::get('/', [FacilityController::class, 'index'])
    ->name('fasilitas');

Route::get('/fasilitas', [FacilityController::class, 'index']);

// Pengguna - Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Pengguna - Registrasi
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

//logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {

    // RESERVASI
    Route::get('/reservasi', [ReservationController::class, 'create'])
        ->name('reservasi');

    Route::post('/reservasi', [ReservationController::class, 'store'])
        ->name('reservasi.store');

    Route::get('/riwayat-reservasi', [ReservationController::class, 'history'])
        ->name('riwayat-reservasi');

    Route::post('/riwayat-reservasi/{id}/cancel', [ReservationController::class, 'cancel'])
    ->name('reservasi.cancel');

    // LAPORAN
    Route::get('/laporan', [ReportController::class, 'create'])
        ->name('lapor');

    Route::post('/laporan', [ReportController::class, 'store'])
        ->name('lapor.store');

    Route::get('/riwayat-laporan', [ReportController::class, 'history'])
        ->name('riwayat-laporan');

    Route::get('/laporan/{report}', [ReportController::class, 'show'])
        ->name('lapor.show');
});

// Petugas

Route::middleware(['auth', 'petugas'])
    ->prefix('petugas')
    ->group(function () {

        Route::get('/dashboard', [PetugasController::class, 'dashboard'])
            ->name('petugas.dashboard');

        // Riwayat reservasi
        Route::get('/petugas/riwayat/reservasi', [ PetugasReservasiController::class, 'history' ])
            ->name('petugas.riwayat.reservasi');

        // Riwayat laporan
        Route::get('/petugas/riwayat/laporan', [ PetugasLaporanController::class, 'history' ])
            ->name('petugas.riwayat.laporan');

        Route::post('/reservasi/{reservation}/approve', [PetugasReservasiController::class, 'approveReservation'])
            ->name('petugas.reservasi.approve');

        Route::post('/reservasi/{reservation}/reject', [PetugasReservasiController::class, 'rejectReservation'])
            ->name('petugas.reservasi.reject');

        Route::post('/reservasi/{reservation}/cancel', [PetugasReservasiController::class, 'cancelReservation'])
            ->name('petugas.reservasi.cancel');
            
        Route::get('/petugas/antrian/reservasi', [ PetugasReservasiController::class, 'antrianReservasi' ])
            ->name('petugas.antrian.reservasi');
        
        Route::get('/petugas/antrian/laporan', [ PetugasLaporanController::class, 'antrianLaporan'])
            ->name('petugas.antrian.laporan');
        
        Route::patch('/petugas/laporan/{report}/status',[PetugasLaporanController::class, 'updateReportStatus'])
            ->name('petugas.laporan.update-status');

        Route::patch( '/petugas/laporan/{report}/selesai', [PetugasLaporanController::class, 'markResolved'] )
            ->name('petugas.laporan.selesai');

        // Pengelolaan fasilitas
        Route::get('/fasilitas', [PetugasController::class, 'fasilitas'])
            ->name('petugas.fasilitas');

        Route::patch( '/fasilitas/{facility}/mulai-perbaikan', [PetugasController::class, 'mulaiPerbaikan'] )
            ->name('petugas.fasilitas.mulai-perbaikan'); 

        Route::patch( '/fasilitas/{facility}/selesaikan-perbaikan', [PetugasController::class, 'selesaikanPerbaikan'])
            ->name('petugas.fasilitas.selesaikan-perbaikan');

        Route::post(
        '/fasilitas/{facility}/ubah-status',
        [PetugasController::class, 'ubahStatusFasilitas']
    )->name('petugas.fasilitas.ubah-status');
    });