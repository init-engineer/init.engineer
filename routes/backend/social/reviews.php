<?php

use App\Domains\Social\Models\Reviews;
use Tabuna\Breadcrumbs\Trail;

/**
 * All route names are prefixed with 'admin.social'.
 * 主要服務
 */
Route::group([
    'prefix' => 'social',
    'as' => 'social.',
    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    /**
     * All route names are prefixed with 'admin.social.reviews'.
     * Reviews 群眾審核
     */
    Route::group([
        'prefix' => 'reviews',
        'as' => 'reviews.',
    ], function () {
        Route::group([
            'middleware' => 'role:' . config('boilerplate.access.role.social_admin'),
        ], function () {
            Route::get('deleted', [DeletedReviewsController::class, 'index'])
                ->name('deleted')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.reviews.index')
                        ->push(__('Deleted Reviews'), route('admin.social.reviews.deleted'));
                });

            Route::get('create', [ReviewsController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.reviews.index')
                        ->push(__('Create Reviews'), route('admin.social.reviews.create'));
                });

            Route::post('/', [ReviewsController::class, 'store'])->name('store');

            Route::group(['prefix' => '{reviews}'], function () {
                Route::get('edit', [ReviewsController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Reviews $reviews) {
                        $trail->parent('admin.social.reviews.show', $reviews)
                            ->push(__('Edit'), route('admin.social.reviews.edit', $reviews));
                    });

                Route::patch('/', [ReviewsController::class, 'update'])->name('update');
                Route::delete('/', [ReviewsController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => '{deletedReviews}'], function () {
                Route::patch('restore', [DeletedReviewsController::class, 'update'])->name('restore');
                Route::delete('permanently-delete', [DeletedReviewsController::class, 'destroy'])->name('permanently-delete');
            });
        });

        Route::group([
            'middleware' => 'permission:admin.social.reviews.list|admin.social.reviews.deactivate|admin.social.reviews.reactivate|admin.social.reviews.impersonate',
        ], function () {
            Route::get('deactivated', [DeactivatedReviewsController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:admin.social.reviews.reactivate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.reviews.index')
                        ->push(__('Deactivated Reviews'), route('admin.social.reviews.deactivated'));
                });

            Route::get('/', [ReviewsController::class, 'index'])
                ->name('index')
                ->middleware('permission:admin.social.reviews.list|admin.social.reviews.deactivate|admin.social.reviews.impersonate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Reviews Management'), route('admin.social.reviews.index'));
                });

            Route::group(['prefix' => '{reviews}'], function () {
                Route::get('/', [ReviewsController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:admin.social.reviews.list')
                    ->breadcrumbs(function (Trail $trail, Reviews $reviews) {
                        $trail->parent('admin.social.reviews.index')
                            ->push($reviews->id, route('admin.social.reviews.show', $reviews));
                    });

                Route::patch('mark/{status}', [DeactivatedReviewsController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:admin.social.reviews.deactivate|admin.social.reviews.reactivate');
            });
        });
    });
});
