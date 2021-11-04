<?php

use App\Domains\Social\Http\Controllers\Backend\Cards\CardsController;
use App\Domains\Social\Http\Controllers\Backend\Cards\DeactivatedCardsController;
use App\Domains\Social\Http\Controllers\Backend\Cards\DeletedCardsController;
use App\Domains\Social\Models\Cards;
use Illuminate\Support\Str;
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
     * All route names are prefixed with 'admin.social.cards'.
     * Cards 文章
     */
    Route::group([
        'prefix' => 'cards',
        'as' => 'cards.',
    ], function () {
        Route::group([
            'middleware' => 'role:' . config('boilerplate.access.role.social_admin'),
        ], function () {
            Route::get('deleted', [DeletedCardsController::class, 'index'])
                ->name('deleted')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.cards.index')
                        ->push(__('Deleted Cards'), route('admin.social.cards.deleted'));
                });

            Route::get('create', [CardsController::class, 'create'])
                ->name('create')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.cards.index')
                        ->push(__('Create Cards'), route('admin.social.cards.create'));
                });

            Route::post('/', [CardsController::class, 'store'])->name('store');

            Route::group(['prefix' => '{cards}'], function () {
                Route::get('edit', [CardsController::class, 'edit'])
                    ->name('edit')
                    ->breadcrumbs(function (Trail $trail, Cards $cards) {
                        $trail->parent('admin.social.cards.show', $cards)
                            ->push(__('Edit'), route('admin.social.cards.edit', $cards));
                    });

                Route::patch('/platform', [CardsController::class, 'platform'])->name('platform');
                Route::patch('/notification', [CardsController::class, 'notification'])->name('notification');
                Route::patch('/', [CardsController::class, 'update'])->name('update');
                Route::delete('/', [CardsController::class, 'destroy'])->name('destroy');
            });

            Route::group(['prefix' => '{deletedCards}'], function () {
                Route::patch('restore', [DeletedCardsController::class, 'update'])->name('restore');
                Route::delete('permanently-delete', [DeletedCardsController::class, 'destroy'])->name('permanently-delete');
            });
        });

        Route::group([
            'middleware' => 'permission:admin.social.cards.list|admin.social.cards.deactivate|admin.social.cards.reactivate|admin.social.cards.impersonate',
        ], function () {
            Route::get('deactivated', [DeactivatedCardsController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:admin.social.cards.reactivate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.cards.index')
                        ->push(__('Deactivated Cards'), route('admin.social.cards.deactivated'));
                });

            Route::get('/', [CardsController::class, 'index'])
                ->name('index')
                ->middleware('permission:admin.social.cards.list|admin.social.cards.deactivate|admin.social.cards.impersonate')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Cards Management'), route('admin.social.cards.index'));
                });

            Route::group(['prefix' => '{cards}'], function () {
                Route::get('/', [CardsController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:admin.social.cards.list')
                    ->breadcrumbs(function (Trail $trail, Cards $cards) {
                        $trail->parent('admin.social.cards.index')
                            ->push(Str::limit($cards->content, 24, '...'), route('admin.social.cards.show', $cards));
                    });

                Route::patch('mark/{status}', [DeactivatedCardsController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:admin.social.cards.deactivate|admin.social.cards.reactivate');
            });
        });
    });
});
