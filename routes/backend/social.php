<?php

use App\Domains\Social\Http\Controllers\Backend\Ads\AdsController;
use App\Domains\Social\Http\Controllers\Backend\Ads\DeactivatedAdsController;
use App\Domains\Social\Http\Controllers\Backend\Ads\DeletedAdsController;
use App\Domains\Social\Http\Controllers\Backend\Cards\CardsController;
use App\Domains\Social\Http\Controllers\Backend\Cards\DeactivatedCardsController;
use App\Domains\Social\Http\Controllers\Backend\Cards\DeletedCardsController;
use App\Domains\Social\Http\Controllers\Backend\Platform\PlatformController;
use App\Domains\Social\Http\Controllers\Backend\Platform\DeactivatedPlatformController;
use App\Domains\Social\Http\Controllers\Backend\Platform\DeletedPlatformController;
use App\Domains\Social\Models\Ads;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use Tabuna\Breadcrumbs\Trail;

/**
 * All route names are prefixed with 'admin.social'.
 *
 * 主要服務
 */
Route::group([
    'prefix' => 'social',
    'as' => 'social.',
    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    /**
     * All route names are prefixed with 'admin.social.ads'.
     *
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
            'middleware' => 'permission:' . implode('|', [
                'admin.social.ads.list',
                'admin.social.ads.deactivate',
                'admin.social.ads.reactivate',
                'admin.social.ads.impersonate',
            ]),
        ], function () {
            Route::get('deactivated', [DeactivatedAdsController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:' . implode('|', [
                    'admin.social.ads.reactivate',
                ]))
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.ads.index')
                        ->push(__('Deactivated Ads'), route('admin.social.ads.deactivated'));
                });

            Route::get('/', [AdsController::class, 'index'])
                ->name('index')
                ->middleware('permission:' . implode('|', [
                    'admin.social.ads.list',
                    'admin.social.ads.deactivate',
                    'admin.social.ads.impersonate',
                ]))
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Ads Management'), route('admin.social.ads.index'));
                });

            Route::group(['prefix' => '{ads}'], function () {
                Route::get('/', [AdsController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:' . implode('|', [
                        'admin.social.ads.list',
                    ]))
                    ->breadcrumbs(function (Trail $trail, Ads $ads) {
                        $trail->parent('admin.social.ads.index')
                            ->push($ads->name, route('admin.social.ads.show', $ads));
                    });

                Route::patch('mark/{status}', [DeactivatedAdsController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:' . implode('|', [
                        'admin.social.ads.deactivate',
                        'admin.social.ads.reactivate',
                    ]));
            });
        });
    });

    /**
     * All route names are prefixed with 'admin.social.cards'.
     *
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
            'middleware' => 'permission:' . implode('|', [
                'admin.social.cards.list',
                'admin.social.cards.deactivate',
                'admin.social.cards.reactivate',
                'admin.social.cards.impersonate',
            ]),
        ], function () {
            Route::get('deactivated', [DeactivatedCardsController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:' . implode('|', [
                    'admin.social.cards.reactivate',
                ]))
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.cards.index')
                        ->push(__('Deactivated Cards'), route('admin.social.cards.deactivated'));
                });

            Route::get('/', [CardsController::class, 'index'])
                ->name('index')
                ->middleware('permission:' . implode('|', [
                    'admin.social.cards.list',
                    'admin.social.cards.deactivate',
                    'admin.social.cards.impersonate',
                ]))
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Cards Management'), route('admin.social.cards.index'));
                });

            Route::group(['prefix' => '{cards}'], function () {
                Route::get('/', [CardsController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:' . implode('|', [
                        'admin.social.cards.list',
                    ]))
                    ->breadcrumbs(function (Trail $trail, Cards $cards) {
                        $trail->parent('admin.social.cards.index')
                            ->push(Str::limit($cards->content, 24, '...'), route('admin.social.cards.show', $cards));
                    });

                Route::patch('mark/{status}', [DeactivatedCardsController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:' . implode('|', [
                        'admin.social.cards.deactivate',
                        'admin.social.cards.reactivate',
                    ]));
            });
        });
    });

    /**
     * All route names are prefixed with 'admin.social.comments'.
     *
     * Comments 文章留言
     */
    // Route::group([
    //     'prefix' => 'comments',
    //     'as' => 'comments.',
    // ], function () {
    //     Route::group([
    //         'middleware' => 'role:' . config('boilerplate.access.role.social_admin'),
    //     ], function () {
    //         Route::get('deleted', [DeletedCommentsController::class, 'index'])
    //             ->name('deleted')
    //             ->breadcrumbs(function (Trail $trail) {
    //                 $trail->parent('admin.social.comments.index')
    //                     ->push(__('Deleted Comments'), route('admin.social.comments.deleted'));
    //             });

    //         Route::get('create', [CommentsController::class, 'create'])
    //             ->name('create')
    //             ->breadcrumbs(function (Trail $trail) {
    //                 $trail->parent('admin.social.comments.index')
    //                     ->push(__('Create Comments'), route('admin.social.comments.create'));
    //             });

    //         Route::post('/', [CommentsController::class, 'store'])->name('store');

    //         Route::group(['prefix' => '{comments}'], function () {
    //             Route::get('edit', [CommentsController::class, 'edit'])
    //                 ->name('edit')
    //                 ->breadcrumbs(function (Trail $trail, Comments $comments) {
    //                     $trail->parent('admin.social.comments.show', $comments)
    //                         ->push(__('Edit'), route('admin.social.comments.edit', $comments));
    //                 });

    //             Route::patch('/', [CommentsController::class, 'update'])->name('update');
    //             Route::delete('/', [CommentsController::class, 'destroy'])->name('destroy');
    //         });

    //         Route::group(['prefix' => '{deletedComments}'], function () {
    //             Route::patch('restore', [DeletedCommentsController::class, 'update'])->name('restore');
    //             Route::delete('permanently-delete', [DeletedCommentsController::class, 'destroy'])->name('permanently-delete');
    //         });
    //     });

    //     Route::group([
    //         'middleware' => 'permission:' . implode('|', [
    //             'admin.social.comments.list',
    //             'admin.social.comments.deactivate',
    //             'admin.social.comments.reactivate',
    //             'admin.social.comments.impersonate',
    //         ]),
    //     ], function () {
    //         Route::get('deactivated', [DeactivatedCommentsController::class, 'index'])
    //             ->name('deactivated')
    //             ->middleware('permission:' . implode('|', [
    //                 'admin.social.comments.reactivate',
    //             ]))
    //             ->breadcrumbs(function (Trail $trail) {
    //                 $trail->parent('admin.social.comments.index')
    //                     ->push(__('Deactivated Comments'), route('admin.social.comments.deactivated'));
    //             });

    //         Route::get('/', [CommentsController::class, 'index'])
    //             ->name('index')
    //             ->middleware('permission:' . implode('|', [
    //                 'admin.social.comments.list',
    //                 'admin.social.comments.deactivate',
    //                 'admin.social.comments.impersonate',
    //             )))
    //             ->breadcrumbs(function (Trail $trail) {
    //                 $trail->parent('admin.dashboard')
    //                     ->push(__('Comments Management'), route('admin.social.comments.index'));
    //             });

    //         Route::group(['prefix' => '{comments}'], function () {
    //             Route::get('/', [CommentsController::class, 'show'])
    //                 ->name('show')
    //                 ->middleware('permission:' . implode('|', [
    //                     'admin.social.comments.list',
    //                 ]))
    //                 ->breadcrumbs(function (Trail $trail, Comments $comments) {
    //                     $trail->parent('admin.social.comments.index')
    //                         ->push($comments->comment_id, route('admin.social.comments.show', $comments));
    //                 });

    //             Route::patch('mark/{status}', [DeactivatedCommentsController::class, 'update'])
    //                 ->name('mark')
    //                 ->where(['status' => '[0,1]'])
    //                 ->middleware('permission:' . implode('|', [
    //                     'admin.social.comments.deactivate',
    //                     'admin.social.comments.reactivate',
    //                 ]));
    //         });
    //     });
    // });

    /**
     * All route names are prefixed with 'admin.social.platform'.
     *
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
            'middleware' => 'permission:' . implode('|', [
                'admin.social.platform.list',
                'admin.social.platform.deactivate',
                'admin.social.platform.reactivate',
                'admin.social.platform.impersonate',
            ]),
        ], function () {
            Route::get('deactivated', [DeactivatedPlatformController::class, 'index'])
                ->name('deactivated')
                ->middleware('permission:' . implode('|', [
                    'admin.social.platform.reactivate',
                ]))
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.social.platform.index')
                        ->push(__('Deactivated Platform'), route('admin.social.platform.deactivated'));
                });

            Route::get('/', [PlatformController::class, 'index'])
                ->name('index')
                ->middleware('permission:' . implode('|', [
                    'admin.social.platform.list',
                    'admin.social.platform.deactivate',
                    'admin.social.platform.impersonate',
                ]))
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('admin.dashboard')
                        ->push(__('Platform Management'), route('admin.social.platform.index'));
                });

            Route::group(['prefix' => '{platform}'], function () {
                Route::get('/', [PlatformController::class, 'show'])
                    ->name('show')
                    ->middleware('permission:' . implode('|', [
                        'admin.social.platform.list',
                    ]))
                    ->breadcrumbs(function (Trail $trail, Platform $platform) {
                        $trail->parent('admin.social.platform.index')
                            ->push($platform->name, route('admin.social.platform.show', $platform));
                    });

                Route::patch('mark/{status}', [DeactivatedPlatformController::class, 'update'])
                    ->name('mark')
                    ->where(['status' => '[0,1]'])
                    ->middleware('permission:' . implode('|', [
                        'admin.social.platform.deactivate',
                        'admin.social.platform.reactivate',
                    ]));
            });
        });
    });

    /**
     * All route names are prefixed with 'admin.social.reviews'.
     *
     * Reviews 群眾審核
     */
    // Route::group([
    //     'prefix' => 'reviews',
    //     'as' => 'reviews.',
    // ], function () {
    //     Route::group([
    //         'middleware' => 'role:' . config('boilerplate.access.role.social_admin'),
    //     ], function () {
    //         Route::get('deleted', [DeletedReviewsController::class, 'index'])
    //             ->name('deleted')
    //             ->breadcrumbs(function (Trail $trail) {
    //                 $trail->parent('admin.social.reviews.index')
    //                     ->push(__('Deleted Reviews'), route('admin.social.reviews.deleted'));
    //             });

    //         Route::get('create', [ReviewsController::class, 'create'])
    //             ->name('create')
    //             ->breadcrumbs(function (Trail $trail) {
    //                 $trail->parent('admin.social.reviews.index')
    //                     ->push(__('Create Reviews'), route('admin.social.reviews.create'));
    //             });

    //         Route::post('/', [ReviewsController::class, 'store'])->name('store');

    //         Route::group(['prefix' => '{reviews}'], function () {
    //             Route::get('edit', [ReviewsController::class, 'edit'])
    //                 ->name('edit')
    //                 ->breadcrumbs(function (Trail $trail, Reviews $reviews) {
    //                     $trail->parent('admin.social.reviews.show', $reviews)
    //                         ->push(__('Edit'), route('admin.social.reviews.edit', $reviews));
    //                 });

    //             Route::patch('/', [ReviewsController::class, 'update'])->name('update');
    //             Route::delete('/', [ReviewsController::class, 'destroy'])->name('destroy');
    //         });

    //         Route::group(['prefix' => '{deletedReviews}'], function () {
    //             Route::patch('restore', [DeletedReviewsController::class, 'update'])->name('restore');
    //             Route::delete('permanently-delete', [DeletedReviewsController::class, 'destroy'])->name('permanently-delete');
    //         });
    //     });

    //     Route::group([
    //         'middleware' => 'permission:' . implode('|', [
    //             'admin.social.reviews.list',
    //             'admin.social.reviews.deactivate',
    //             'admin.social.reviews.reactivate',
    //             'admin.social.reviews.impersonate',
    //         ]),
    //     ], function () {
    //         Route::get('deactivated', [DeactivatedReviewsController::class, 'index'])
    //             ->name('deactivated')
    //             ->middleware('permission:' . implode('|', [
    //                 'admin.social.reviews.reactivate',
    //             ]))
    //             ->breadcrumbs(function (Trail $trail) {
    //                 $trail->parent('admin.social.reviews.index')
    //                     ->push(__('Deactivated Reviews'), route('admin.social.reviews.deactivated'));
    //             });

    //         Route::get('/', [ReviewsController::class, 'index'])
    //             ->name('index')
    //             ->middleware('permission:' . implode('|', [
    //                 'admin.social.reviews.list',
    //                 'admin.social.reviews.deactivate',
    //                 'admin.social.reviews.impersonate',
    //             ]))
    //             ->breadcrumbs(function (Trail $trail) {
    //                 $trail->parent('admin.dashboard')
    //                     ->push(__('Reviews Management'), route('admin.social.reviews.index'));
    //             });

    //         Route::group(['prefix' => '{reviews}'], function () {
    //             Route::get('/', [ReviewsController::class, 'show'])
    //                 ->name('show')
    //                 ->middleware('permission:' . implode('|', [
    //                     'admin.social.reviews.list',
    //                 ]))
    //                 ->breadcrumbs(function (Trail $trail, Reviews $reviews) {
    //                     $trail->parent('admin.social.reviews.index')
    //                         ->push($reviews->id, route('admin.social.reviews.show', $reviews));
    //                 });

    //             Route::patch('mark/{status}', [DeactivatedReviewsController::class, 'update'])
    //                 ->name('mark')
    //                 ->where(['status' => '[0,1]'])
    //                 ->middleware('permission:' . implode('|', [
    //                     'admin.social.reviews.deactivate',
    //                     'admin.social.reviews.reactivate',
    //                 ]));
    //         });
    //     });
    // });
});
