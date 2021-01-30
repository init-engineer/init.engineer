<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\OAuth\CallbackController;
use App\Http\Controllers\Frontend\OAuth\AuthorizeController;

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/policies', [HomeController::class, 'policies'])->name('policies');

/**
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        // User Dashboard Specific
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Profile Specific
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});

/**
 * All route names are prefixed with 'frontend.testing'
 * 用來測試 OAuth 的 Callback
 */
Route::group([
    'prefix' => 'testing',
    'as' => 'testing.',
    'namespace' => 'Testing',
], function () {
    /**
     * All route names are prefixed with 'frontend.testing.oauth'
     */
    Route::group([
        'prefix' => 'oauth',
        'as' => 'oauth.',
        'namespace' => 'OAuth',
    ], function () {
        Route::get('authorized/{id}', [AuthorizeController::class, 'authorized'])->name('authorized');
        Route::get('callback', [CallbackController::class, 'callback'])->name('callback');
    });
});
