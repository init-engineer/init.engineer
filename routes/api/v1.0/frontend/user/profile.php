<?php

use App\Http\Controllers\Api\Frontend\User\ProfileController;

/**
 * All route names are prefixed with 'api.frontend'.
 */
Route::group([
    'prefix' => 'frontend',
    'as' => 'frontend.',
    'namespace' => 'Frontend',
], function () {
    /**
     * All route names are prefixed with 'api.frontend.user'.
     */
    Route::group([
        'prefix' => 'user',
        'as' => 'user.',
        'namespace' => 'User',
    ], function () {
        /**
         * All route names are prefixed with 'api.frontend.user.profile'.
         */
        Route::group([
            'prefix' => 'profile',
            'as' => 'profile.',
            'namespace' => 'Profile',
            'middleware' => 'auth:api',
        ], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
        });
    });
});
