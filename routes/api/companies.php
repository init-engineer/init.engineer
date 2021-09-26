<?php

use App\Domains\Companie\Http\Controllers\Api\CompaniesController;

/**
 * All route names are prefixed with 'api.companies'.
 */
Route::group([
    'prefix' => 'companies',
    'as' => 'companies.',
    'namespace' => 'Companies',
    'middleware' => [
        'auth',
    ],
], function () {
    Route::post('/', [CompaniesController::class, 'store'])->name('store');
});
