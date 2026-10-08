<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Facility;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\PetugasController;

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

        Route::post('/reservasi/{reservation}/approve', [PetugasController::class, 'approveReservation'])
            ->name('petugas.reservasi.approve');

        Route::post('/reservasi/{reservation}/reject', [PetugasController::class, 'rejectReservation'])
            ->name('petugas.reservasi.reject');

        Route::post('/reservasi/{reservation}/cancel', [PetugasController::class, 'cancelReservation'])
            ->name('petugas.reservasi.cancel');

    });



Route::get('/dashboard-petugas', function () {
    return view('dashboard-petugas');
});

Route::get('/antrian-reservasi', function () {
    return view('antrian-reservasi');
});

Route::get('/antrian-laporan', function () {
    return view('antrian-laporan');
});