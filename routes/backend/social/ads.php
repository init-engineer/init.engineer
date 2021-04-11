<?php

use App\Domains\Social\Http\Controllers\Backend\Ads\AdsController;
use App\Domains\Social\Http\Controllers\Backend\Ads\DeactivatedAdsController;
use App\Domains\Social\Http\Controllers\Backend\Ads\DeletedAdsController;
use App\Domains\Social\Models\Ads;
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
     * All route names are prefixed with 'admin.social.ads'.
     * Ads 廣告服務
     */
    Route::group([
        'prefix' => 'ads',
        'as' => 'ads.',
    ], function () {
        Route::group([
            'middleware' => 'role:' . config('boilerplate.access.role.social_admin'),
        ], function () {
            Route::get('deleted', [DeletedAdsController::class, 'index'])
                ->name('deleted')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.ads.index')
                        ->push(__('Deleted Ads'), route('admin.social.ads.deleted'));
                });

            Route::get('create', [AdsController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.ads.index')
                        ->push(__('Create Ads'), route('admin.social.ads.create'));
                });

            Route::post('/', [AdsController::class, 'store'])->name('store');

            Route::group(['prefix' => '{ads}'], function () {
                Route::get('edit', [AdsController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Ads $ads) {
                        $trail->parent('admin.social.ads.show', $ads)
                            ->push(__('Edit'), route('admin.social.ads.edit', $ads));
                    });

                Route::patch('/', [AdsController::class, 'update'])->name('update');
                Route::delete('/', [AdsController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => '{deletedAds}'], function () {
                Route::patch('restore', [DeletedAdsController::class, 'update'])->name('restore');
                Route::delete('permanently-delete', [DeletedAdsController::class, 'destroy'])->name('permanently-delete');
            });
        });

        Route::group([
            'middleware' => 'permission:admin.social.ads.list|admin.social.ads.deactivate|admin.social.ads.reactivate|admin.social.ads.impersonate',
        ], function () {
            Route::get('deactivated', [DeactivatedAdsController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:admin.social.ads.reactivate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.ads.index')
                        ->push(__('Deactivated Ads'), route('admin.social.ads.deactivated'));
                });

            Route::get('/', [AdsController::class, 'index'])
                ->name('index')
                ->middleware('permission:admin.social.ads.list|admin.social.ads.deactivate|admin.social.ads.impersonate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Ads Management'), route('admin.social.ads.index'));
                });

            Route::group(['prefix' => '{ads}'], function () {
                Route::get('/', [AdsController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:admin.social.ads.list')
                    ->breadcrumbs(function (Trail $trail, Ads $ads) {
                        $trail->parent('admin.social.ads.index')
                            ->push($ads->name, route('admin.social.ads.show', $ads));
                    });

                Route::patch('mark/{status}', [DeactivatedAdsController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:admin.social.ads.deactivate|admin.social.ads.reactivate');
            });
        });
    });
});
