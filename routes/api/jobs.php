<?php

use App\Domains\Companie\Http\Controllers\Api\JobsController;

/**
 * All route names are prefixed with 'api.jobs'.
 */
Route::group([
    'prefix' => 'jobs',
    'as' => 'jobs.',
    'namespace' => 'Jobs',
], function () {
    Route::post('/', [JobsController::class, 'store'])->name('store');
});
