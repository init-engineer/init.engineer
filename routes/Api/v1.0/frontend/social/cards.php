<?php

use App\Http\Controllers\Api\Frontend\Social\CardsController;

/**
 * All route names are prefixed with 'api.frontend'.
 */
Route::group([
    'prefix' => 'frontend',
    'as' => 'frontend.',
    'namespace' => 'Frontend',
], function () {
    /**
     * All route names are prefixed with 'api.frontend.social'.
     */
    Route::group([
        'prefix' => 'social',
        'as' => 'social.',
        'namespace' => 'Social',
    ], function () {
        /**
         * All route names are prefixed with 'api.frontend.social.cards'.
         */
        Route::group([
            'prefix' => 'cards',
            'as' => 'cards.',
            'namespace' => 'Cards',
        ], function () {
            // Cards CRUD
            Route::get('/', [CardsController::class, 'index'])->name('index');
            Route::post('/', [CardsController::class, 'store'])->name('store');

            // Specific Card
            Route::group(['prefix' => '/{id}'], function () {
                Route::get('/', [CardsController::class, 'show'])->name('user.show');
                Route::patch('/', [CardsController::class, 'update'])->name('update');
                Route::delete('/', [CardsController::class, 'destroy'])->name('destroy');
            });
        });
    });
});
