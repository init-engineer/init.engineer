<?php

use App\Domains\Social\Http\Controllers\Api\Cards\CommentsController;
use App\Domains\Social\Http\Controllers\Api\Cards\LinksController;
use App\Domains\Social\Http\Controllers\Api\Cards\PublishController;
use App\Domains\Social\Http\Controllers\Api\Cards\ReviewController;

/**
 * All route names are prefixed with 'api.social'.
 */
Route::group([
    'prefix' => 'social',
    'as' => 'social.',
    'namespace' => 'Social',
], function () {
    /**
     * All route names are prefixed with 'api.social.cards'.
     */
    Route::group([
        'prefix' => 'cards',
        'as' => 'cards.',
        'namespace' => 'Cards',
    ], function () {
        Route::group([
            'prefix' => 'publish',
            'as' => 'publish.',
            'middleware' => [
                'auth',
            ],
        ], function () {
            Route::post('/article', [PublishController::class, 'article'])->name('article');
            Route::post('/picture', [PublishController::class, 'picture'])->name('picture');
        });

        Route::group(['prefix' => '{card}'], function () {
            Route::get('/links', [LinksController::class, 'index'])->name('links');
            Route::get('/comments', [CommentsController::class, 'index'])->name('comments');
            Route::group([
                'middleware' => [
                    'auth',
                ],
            ], function () {
                Route::post('/comments', [CommentsController::class, 'store'])->name('store');
                Route::get('/voted', [ReviewController::class, 'haveVoted'])->name('voted');
                Route::get('/voting/{status}', [ReviewController::class, 'voting'])->name('voting');
            });
        });
    });
});
