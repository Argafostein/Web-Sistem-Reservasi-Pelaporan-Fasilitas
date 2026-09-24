<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/fasilitas', function () {
    return view('fasilitas');
});

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

use App\Http\Controllers\ReservasiController;

Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
