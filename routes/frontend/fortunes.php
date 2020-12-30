<?php

use App\Http\Controllers\Frontend\Fortunes\FortunesController;

/*
 * Fortunes Controllers
 * All route names are prefixed with 'frontend.fortunes.'.
 */
Route::group([
    'prefix' => 'fortunes',
    'as' => 'fortunes.',
    'namespace' => 'Fortunes',
], function () {
    Route::get('/', [FortunesController::class, 'index'])->name('index');
});
