<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Facility;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    $facilities = Facility::limit(10)->get();

    return view('fasilitas', compact('facilities'));
})->name('fasilitas');

Route::get('/fasilitas', function () {
    $facilities = Facility::limit(10)->get();

    return view('fasilitas', compact('facilities'));
})->name('fasilitas');

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

    Route::get('/reservasi', [ReservationController::class, 'create'])
        ->name('reservasi');

    Route::post('/reservasi', [ReservationController::class, 'store'])
        ->name('reservasi.store');

    Route::get('/riwayat-reservasi', [ReservationController::class, 'history'])
        ->name('riwayat-reservasi');

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
Route::get('/dashboard-petugas', function () {
    return view('dashboard-petugas');
});

Route::get('/antrian-reservasi', function () {
    return view('antrian-reservasi');
});

Route::get('/antrian-laporan', function () {
    return view('antrian-laporan');
});