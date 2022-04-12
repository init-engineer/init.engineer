<?php

// use App\Domains\Companie\Http\Controllers\Frontend\JobsController;
// use App\Domains\Companie\Models\CompanieJobs;
// use Tabuna\Breadcrumbs\Trail;

/*
 * Jobs Controllers
 * All route names are prefixed with 'frontend.jobs.'.
 */
// Route::group([
//     'prefix' => 'jobs',
//     'as' => 'jobs.',
//     'namespace' => 'Jobs',
// ], function () {
//     Route::get('/', [JobsController::class, 'index'])
//         ->name('index')
//         ->breadcrumbs(function (Trail $trail) {
//             $trail->parent('frontend.index')
//                 ->push(__('Init.Engineer Jobs'), route('frontend.jobs.index'));
//         });
//     Route::group([
//         'prefix' => '{job}',
//     ], function () {
//         Route::get('/', [JobsController::class, 'show'])
//             ->name('show')
//             ->breadcrumbs(function (Trail $trail, CompanieJobs $job) {
//                 $trail->parent('frontend.jobs.index')
//                     ->push($job->companie()->name . ' - ' . $job->name, route('frontend.jobs.show', $job));
//             });
//     });
// });
