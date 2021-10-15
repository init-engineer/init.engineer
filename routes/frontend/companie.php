<?php

use App\Domains\Companie\Http\Controllers\Frontend\CompanieController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Companie Controllers
 * All route names are prefixed with 'frontend.companie.'.
 */
Route::group([
    'prefix' => 'companie',
    'as' => 'companie.',
    'namespace' => 'Companie',
    'middleware' => [
        'auth',
    ],
], function () {
    Route::get('/', [CompanieController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.jobs.index')
                ->push(__('Init.Engineer Companie'), route('frontend.companie.index'));
        });

    Route::get('/create', [CompanieController::class, 'create'])
        ->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.companie.index')
                ->push(__('Companie Create'), route('frontend.companie.create'));
        });
});
