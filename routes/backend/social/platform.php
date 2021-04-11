<?php

use App\Domains\Social\Http\Controllers\Backend\Platform\PlatformController;
use App\Domains\Social\Http\Controllers\Backend\Platform\DeactivatedPlatformController;
use App\Domains\Social\Http\Controllers\Backend\Platform\DeletedPlatformController;
use App\Domains\Social\Models\Platform;
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
     * All route names are prefixed with 'admin.social.platform'.
     * Platform 社群平台
     */
    Route::group([
        'prefix' => 'platform',
        'as' => 'platform.',
    ], function () {
        Route::group([
            'middleware' => 'role:' . config('boilerplate.access.role.social_admin'),
        ], function () {
            Route::get('deleted', [DeletedPlatformController::class, 'index'])
                ->name('deleted')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.platform.index')
                        ->push(__('Deleted Platform'), route('admin.social.platform.deleted'));
                });

            Route::get('create', [PlatformController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.platform.index')
                        ->push(__('Create Platform'), route('admin.social.platform.create'));
                });

            Route::post('/', [PlatformController::class, 'store'])->name('store');

            Route::group(['prefix' => '{platform}'], function () {
                Route::get('edit', [PlatformController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Platform $platform) {
                        $trail->parent('admin.social.platform.show', $platform)
                            ->push(__('Edit'), route('admin.social.platform.edit', $platform));
                    });

                Route::patch('/', [PlatformController::class, 'update'])->name('update');
                Route::delete('/', [PlatformController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => '{deletedPlatform}'], function () {
                Route::patch('restore', [DeletedPlatformController::class, 'update'])->name('restore');
                Route::delete('permanently-delete', [DeletedPlatformController::class, 'destroy'])->name('permanently-delete');
            });
        });

        Route::group([
            'middleware' => 'permission:admin.social.platform.list|admin.social.platform.deactivate|admin.social.platform.reactivate|admin.social.platform.impersonate',
        ], function () {
            Route::get('deactivated', [DeactivatedPlatformController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:admin.social.platform.reactivate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.platform.index')
                        ->push(__('Deactivated Platform'), route('admin.social.platform.deactivated'));
                });

            Route::get('/', [PlatformController::class, 'index'])
                ->name('index')
                ->middleware('permission:admin.social.platform.list|admin.social.platform.deactivate|admin.social.platform.impersonate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Platform Management'), route('admin.social.platform.index'));
                });

            Route::group(['prefix' => '{platform}'], function () {
                Route::get('/', [PlatformController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:admin.social.platform.list')
                    ->breadcrumbs(function (Trail $trail, Platform $platform) {
                        $trail->parent('admin.social.platform.index')
                            ->push($platform->name, route('admin.social.platform.show', $platform));
                    });

                Route::patch('mark/{status}', [DeactivatedPlatformController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:admin.social.platform.deactivate|admin.social.platform.reactivate');
            });
        });
    });
});
