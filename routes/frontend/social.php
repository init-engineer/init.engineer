<?php

use App\Domains\Social\Http\Controllers\Frontend\Cards\CardsController;
use App\Domains\Social\Models\Cards;
use Tabuna\Breadcrumbs\Trail;

/*
 * Social Controllers
 * All route names are prefixed with 'frontend.social.'.
 */
Route::group([
    // 'prefix' => 'social',
    'as' => 'social.',
    'namespace' => 'Social',
], function () {
    /*
     * Social Cards Controllers
     * All route names are prefixed with 'frontend.social.cards.'.
     */
    Route::group([
        'prefix' => 'cards',
        'as' => 'cards.',
        'namespace' => 'Cards',
    ], function () {
        Route::get('/', [CardsController::class, 'index'])
            ->name('index')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('frontend.index')
                    ->push(__('Init.Engineer Submit'), route('frontend.social.cards.index'));
            });
        Route::get('show/{id}', [CardsController::class, 'show'])
            ->name('show')
            ->breadcrumbs(function (Trail $trail, Cards $id) {
                $trail->parent('frontend.social.cards.index')
                    ->push(__('#:name:nid', ['nid' => base_convert($id->id, 10, 36), 'name' => appName()]), route('frontend.social.cards.show', $id));
            });
        Route::get('create', [CardsController::class, 'redirect']);

        Route::group([
            'middleware' => 'auth',
        ], function () {
            Route::get('/review', [CardsController::class, 'review'])
                ->name('review')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.social.cards.index')
                        ->push(__('Review Submit'), route('frontend.social.cards.review'));
                });

            /*
             * All route names are prefixed with 'frontend.social.cards.publish.'.
             */
            Route::group([
                'prefix' => 'publish',
                'as' => 'publish.',
            ], function () {
                Route::get('article', [CardsController::class, 'article'])
                    ->name('article')
                    ->breadcrumbs(function (Trail $trail) {
                        $trail->parent('frontend.social.cards.index')
                            ->push(__('Publish article'), route('frontend.social.cards.publish.article'));
                    });;
                Route::get('picture', [CardsController::class, 'picture'])
                    ->name('picture')
                    ->breadcrumbs(function (Trail $trail) {
                        $trail->parent('frontend.social.cards.index')
                            ->push(__('Publish picture'), route('frontend.social.cards.publish.picture'));
                    });;
            });
        });
    });
});
