<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Candidates\CandidateController;
use App\Http\Controllers\Companies\JobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Public\Applications\ApplicationController;
use App\Http\Controllers\Public\Jobs\JobController as PublicJobController;
use App\Http\Controllers\Applications\ApplicationController as CompanyApplicationController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticateController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');

    Route::post('/register', [RegisterController::class, 'store']);
    Route::post('/login', [AuthenticateController::class, 'authenticate']);
});

Route::middleware('auth')->post('/logout', [LogoutController::class, 'destroy'])
    ->name('logout');

Route::middleware(['auth', 'company'])
    ->prefix('company')
    ->name('company.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('role:admin,recruiter')
            ->name('dashboard');

        Route::resource('jobs', JobController::class)
            ->middleware('role:admin,recruiter');

        Route::resource('candidates', CandidateController::class)
            ->middleware('role:admin,recruiter');

        Route::patch(
            '/applications/{application}/stage',
            [CompanyApplicationController::class, 'updateStage']
        )->name('applications.updateStage');
    });


Route::prefix('{company:slug}')
    ->scopeBindings()
    ->group(function () {

        Route::get('/careers', [PublicJobController::class, 'index'])
            ->name('public.jobs.index');

        Route::get('/jobs/{job:slug}', [PublicJobController::class, 'show'])
            ->name('public.jobs.show');

        Route::get('/jobs/{job:slug}/apply', [ApplicationController::class, 'create'])
            ->name('public.jobs.apply');

        Route::post('/jobs/{job:slug}/apply', [ApplicationController::class, 'store'])
            ->name('public.jobs.apply.store');
    });
