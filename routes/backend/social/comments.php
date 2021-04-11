<?php

use App\Domains\Social\Models\Comments;
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
     * All route names are prefixed with 'admin.social.comments'.
     * Comments 文章留言
     */
    Route::group([
        'prefix' => 'comments',
        'as' => 'comments.',
    ], function () {
        Route::group([
            'middleware' => 'role:' . config('boilerplate.access.role.social_admin'),
        ], function () {
            Route::get('deleted', [DeletedCommentsController::class, 'index'])
                ->name('deleted')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.comments.index')
                        ->push(__('Deleted Comments'), route('admin.social.comments.deleted'));
                });

            Route::get('create', [CommentsController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.comments.index')
                        ->push(__('Create Comments'), route('admin.social.comments.create'));
                });

            Route::post('/', [CommentsController::class, 'store'])->name('store');

            Route::group(['prefix' => '{comments}'], function () {
                Route::get('edit', [CommentsController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Comments $comments) {
                        $trail->parent('admin.social.comments.show', $comments)
                            ->push(__('Edit'), route('admin.social.comments.edit', $comments));
                    });

                Route::patch('/', [CommentsController::class, 'update'])->name('update');
                Route::delete('/', [CommentsController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => '{deletedComments}'], function () {
                Route::patch('restore', [DeletedCommentsController::class, 'update'])->name('restore');
                Route::delete('permanently-delete', [DeletedCommentsController::class, 'destroy'])->name('permanently-delete');
            });
        });

        Route::group([
            'middleware' => 'permission:admin.social.comments.list|admin.social.comments.deactivate|admin.social.comments.reactivate|admin.social.comments.impersonate',
        ], function () {
            Route::get('deactivated', [DeactivatedCommentsController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:admin.social.comments.reactivate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.comments.index')
                        ->push(__('Deactivated Comments'), route('admin.social.comments.deactivated'));
                });

            Route::get('/', [CommentsController::class, 'index'])
                ->name('index')
                ->middleware('permission:admin.social.comments.list|admin.social.comments.deactivate|admin.social.comments.impersonate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Comments Management'), route('admin.social.comments.index'));
                });

            Route::group(['prefix' => '{comments}'], function () {
                Route::get('/', [CommentsController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:admin.social.comments.list')
                    ->breadcrumbs(function (Trail $trail, Comments $comments) {
                        $trail->parent('admin.social.comments.index')
                            ->push($comments->name, route('admin.social.comments.show', $comments));
                    });

                Route::patch('mark/{status}', [DeactivatedCommentsController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:admin.social.comments.deactivate|admin.social.comments.reactivate');
            });
        });
    });
});
