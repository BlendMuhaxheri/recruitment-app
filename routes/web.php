<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Company\JobController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticateController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');

    Route::post('/register', [RegisterController::class, 'store']);
    Route::post('/login', [AuthenticateController::class, 'authenticate']);
});

Route::middleware('auth')->post('/logout', [LogoutController::class, 'destroy'])
    ->name('logout');

Route::middleware(['auth', 'role:company'])->prefix('company')->name('company.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('jobs', JobController::class);
    });
