<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('users/pending', [Admin\UserController::class, 'pending'])
            ->name('users.pending');
        Route::patch('users/{user}/approve', [Admin\UserController::class, 'approve'])
            ->name('users.approve');
        Route::patch('users/{user}/reject', [Admin\UserController::class, 'reject'])
            ->name('users.reject');
        Route::resource('users', Admin\UserController::class)
            ->only(['index', 'create', 'store']);
        Route::patch('facilities/{facility}/toggle', [Admin\FacilityController::class, 'toggle'])
            ->name('facilities.toggle');
        Route::resource('facilities', Admin\FacilityController::class)
            ->except(['show', 'destroy']);
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
