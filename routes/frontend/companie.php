<?php

use App\Domains\Companie\Http\Controllers\Frontend\CompanieController;
use App\Domains\Companie\Http\Controllers\Frontend\DeactivatedCompanieController;
use App\Domains\Companie\Http\Controllers\Frontend\JobsController;
use App\Domains\Companie\Models\CompanieJobs;
use App\Domains\Companie\Models\Companies;
use Tabuna\Breadcrumbs\Trail;

/*
 * Companie Controllers
 * All route names are prefixed with 'frontend.companie.'.
 */
Route::group([
    'prefix' => 'companie',
    'as' => 'companie.',
    'namespace' => 'Companie',
], function () {
    Route::group([
        'middleware' => 'auth',
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

        Route::group([
            'prefix' => '{companie}',
        ], function () {
            Route::get('edit', [CompanieController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Companies $companie) {
                    $trail->parent('frontend.companie.show', $companie)
                        ->push(__('Edit'), route('frontend.companie.edit', $companie));
                });

            Route::patch('mark/{status}', [DeactivatedCompanieController::class, 'update'])
                ->name('mark')
                ->where(['status' => '[0,1]']);

            Route::delete('/', [CompanieController::class, 'destroy'])->name('destroy');

            Route::group([
                'prefix' => 'jobs',
                'as' => 'jobs.',
                'namespace' => 'Jobs',
            ], function () {
                Route::get('/', [JobsController::class, 'list'])
                    ->name('index')
                    ->breadcrumbs(function (Trail $trail, Companies $companie) {
                        $trail->parent('frontend.companie.show', $companie)
                            ->push(__('Companie Jobs'), route('frontend.companie.jobs.index', $companie));
                    });

                Route::get('/create', [JobsController::class, 'create'])
                    ->name('create')
                    ->breadcrumbs(function (Trail $trail, Companies $companie) {
                        $trail->parent('frontend.companie.jobs.index', $companie)
                            ->push(__('Companie Jobs Create'), route('frontend.companie.jobs.create', $companie));
                    });

                Route::group([
                    'prefix' => '{job}',
                ], function () {
                    Route::get('edit', [JobsController::class, 'edit'])
                        ->name('edit')
                        ->breadcrumbs(function (Trail $trail, Companies $companie, CompanieJobs $job) {
                            $trail->parent('frontend.jobs.show', $job)
                                ->push(__('Edit'), route('frontend.companie.jobs.edit', $companie, $job));
                        });

                    // Route::patch('mark/{status}', [DeactivatedJobController::class, 'update'])
                    //     ->name('mark')
                    //     ->where(['status' => '[0,1]']);

                    Route::delete('/', [JobsController::class, 'destroy'])->name('destroy');
                });
            });
        });
    });

    Route::group([
        'prefix' => '{companie}',
    ], function () {
        Route::get('/', [CompanieController::class, 'show'])
            ->name('show')
            ->breadcrumbs(function (Trail $trail, Companies $companie) {
                $trail->parent('frontend.jobs.index')
                    ->push($companie->name, route('frontend.companie.show', $companie));
            });
    });
});
