<?php

use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return file_get_contents(base_path('index.html'));
});

Route::get('/yoga', function () {
    return 'Halaman Yoga Berhasil!';
});

Route::prefix('api')->group(function () {
    Route::get('/facilities', [FacilityController::class, 'index']);
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::post('/reservations/{code}/cancel', [ReservationController::class, 'cancel']);
});