<?php

use App\Domains\Announcement\Http\Controllers\Backend\AnnouncementController;
use App\Domains\Announcement\Http\Controllers\Backend\DeactivatedAnnouncementController;
// use App\Domains\Announcement\Http\Controllers\Backend\DeletedAnnouncementController;
use App\Domains\Announcement\Models\Announcement;
use Tabuna\Breadcrumbs\Trail;

/**
 * All route names are prefixed with 'admin.announcement'.
 *
 * 公告管理
 */
Route::group([
    'prefix' => 'announcement',
    'as' => 'announcement.',
    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:' . config('boilerplate.access.role.announcement_admin'),
    ], function () {
        // Route::get('deleted', [DeletedAnnouncementController::class, 'index'])
        //     ->name('deleted')
        //     ->breadcrumbs(function (Trail $trail) {
        //         $trail->parent('admin.announcement.index')
        //             ->push(__('Deleted Announcements'), route('admin.announcement.deleted'));
        //     });

        Route::get('create', [AnnouncementController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.announcement.index')
                    ->push(__('Create Announcement'), route('admin.announcement.create'));
            });

        Route::post('/', [AnnouncementController::class, 'store'])->name('store');

        Route::group(['prefix' => '{announcement}'], function () {
            Route::get('edit', [AnnouncementController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Announcement $announcement) {
                    $trail->parent('admin.announcement.index', $announcement)
                        ->push(__('Edit'), route('admin.announcement.edit', $announcement));
                });

            Route::patch('/', [AnnouncementController::class, 'update'])->name('update');
            Route::delete('/', [AnnouncementController::class, 'destroy'])->name('destroy');
        });
    });

    Route::group([
        'middleware' => 'permission:' . implode('|', [
            'admin.announcement.list',
            'admin.announcement.deactivate',
            'admin.announcement.reactivate',
        ]),
    ], function () {
        Route::get('deactivated', [DeactivatedAnnouncementController::class, 'index'])
            ->name('deactivated')
            ->middleware('permission:admin.announcement.reactivate')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.announcement.index')
                    ->push(__('Deactivated Announcements'), route('admin.announcement.deactivated'));
            });

        Route::get('/', [AnnouncementController::class, 'index'])
            ->name('index')
            ->middleware('permission:' . implode('|', [
                'admin.announcement.list',
                'admin.announcement.deactivate',
            ]))
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Announcement Management'), route('admin.announcement.index'));
            });

        Route::group(['prefix' => '{announcement}'], function () {
            Route::patch('mark/{status}', [DeactivatedAnnouncementController::class, 'update'])
                ->name('mark')
                ->where(['status' => '[0,1]'])
                ->middleware('permission:' . implode('|', [
                    'admin.announcement.deactivate',
                    'admin.announcement.reactivate',
                ]));
        });
    });
});
