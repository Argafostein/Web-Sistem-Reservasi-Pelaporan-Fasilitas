<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Facility;

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


// Pengguna — reservasi

Route::get('/reservasi', function () {
    return view('reservasi');
});

Route::get('/riwayat-reservasi', function () {
    return view('riwayat-reservasi');
});

// Pengguna — laporan
Route::get('/reservasi', function () {
    return view('reservasi');
})->name('reservasi');

Route::get('/riwayat-laporan', function () {
    return view('riwayat-laporan');
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