<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\OAuth\CallbackController;
use App\Http\Controllers\Frontend\OAuth\AuthorizeController;
use App\Http\Controllers\MonitorController;
use Laravel\Passport\Http\Controllers\AuthorizationController;

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/policies', [HomeController::class, 'policies'])->name('policies');
Route::get('/redirect/{value}', [HomeController::class, 'redirect'])->name('redirect');

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
    'middleware' => ['admin'],
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

/**
 * All route names are prefixed with 'frontend.oauth'
 */
Route::group([
    'prefix' => 'oauth',
    'as' => 'oauth.',
    'namespace' => 'OAuth',
    'middleware' => ['admin', 'web', 'auth.apple'],
], function () {
    Route::get('apple/authorize', [AuthorizationController::class, 'authorize']);
});


/**
 * All route names are prefixed with 'frontend.monitor'
 */
Route::group([
    'prefix' => 'monitor',
    'as' => 'monitor.',
    'namespace' => 'Monitor',
    'middleware' => ['admin'],
], function () {
    Route::get('opcache', [MonitorController::class, 'index'])->name('opcache.index');
});
