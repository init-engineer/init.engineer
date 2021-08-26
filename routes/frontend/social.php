<?php

use App\Domains\Social\Http\Controllers\Frontend\Cards\CardsController;

/*
 * Social Controllers
 * All route names are prefixed with 'frontend.social.'.
 */
Route::group([
    // 'prefix' => 'social',
    'as' => 'social.',
    'namespace' => 'Social',
], function () {
    /*
     * Social Cards Controllers
     * All route names are prefixed with 'frontend.social.cards.'.
     */
    Route::group([
        'prefix' => 'cards',
        'as' => 'cards.',
        'namespace' => 'Cards',
    ], function () {
        Route::get('/', [CardsController::class, 'index'])->name('index');
        Route::get('/show/{id}', [CardsController::class, 'show'])->name('show');

        Route::group(['middleware' => 'auth'], function () {
            // Authentication
            Route::get('create', [CardsController::class, 'create'])->name('create');
        });
    });
});
