<?php

use App\Domains\Companie\Http\Controllers\Api\JobsController;

/**
 * All route names are prefixed with 'api.jobs'.
 *
 * 職缺相關功能
 */
Route::group([
    'prefix' => 'jobs',
    'as' => 'jobs.',
    'namespace' => 'Jobs',
], function () {
    Route::post('/', [JobsController::class, 'store'])->name('store');
});
