<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;

Route::get('/', function () {
    return view('fasilitas');
})->name('fasilitas');

Route::get('/fasilitas', function () {
    return view('fasilitas');
})->name('fasilitas');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Pengguna — reservasi
Route::get('/riwayat-reservasi', function () {
    return view('riwayat-reservasi');
});

// Pengguna — laporan
Route::get('/laporan', function () {
    return view('laporan');
});

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


Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');