<?php

use App\Http\Controllers\Frontend\Animal\AnimalController;

/*
 * Animal Controllers
 * All route names are prefixed with 'frontend.animal.'.
 */
Route::group([
    'prefix' => 'animal',
    'as' => 'animal.',
    'namespace' => 'Animal',
], function () {
    Route::get('/kohlrabi', [AnimalController::class, 'index'])->name('index');
});
