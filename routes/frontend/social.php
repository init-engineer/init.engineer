<?php

use App\Http\Controllers\Frontend\Social\CardsController;

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

        // These routes require the user to be logged in
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/create', [CardsController::class, 'create'])->name('create');
        });
    });
});
