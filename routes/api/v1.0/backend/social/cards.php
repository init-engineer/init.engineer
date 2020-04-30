<?php

use App\Http\Controllers\Api\Backend\Social\CardsController;

/**
 * All route names are prefixed with 'api.backend'.
 */
Route::group([
    'prefix' => 'backend',
    'as' => 'backend.',
    'namespace' => 'Backend',
], function () {
    /**
     * All route names are prefixed with 'api.backend.social'.
     */
    Route::group([
        'prefix' => 'social',
        'as' => 'social.',
        'namespace' => 'Social',
    ], function () {
        /**
         * All route names are prefixed with 'api.backend.social.cards'.
         */
        Route::group([
            'prefix' => 'cards/token',
            'as' => 'cards.',
            'namespace' => 'Cards',
            'middleware' => ['auth:token', 'role:'.config('access.users.admin_role')],
        ], function () {
            Route::post('/publish', [CardsController::class, 'store'])->name('store');
        });
        Route::group([
            'prefix' => 'cards/api',
            'as' => 'cards.',
            'namespace' => 'Cards',
            'middleware' => ['auth:api', 'role:'.config('access.users.admin_role')],
        ], function () {
            Route::post('/publish', [CardsController::class, 'store'])->name('store');
        });
    });
});
