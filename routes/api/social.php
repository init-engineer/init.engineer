<?php

use App\Domains\Social\Http\Controllers\Api\Cards\BlockadeController;
use App\Domains\Social\Http\Controllers\Api\Cards\CommentsController;
use App\Domains\Social\Http\Controllers\Api\Cards\LinksController;
use App\Domains\Social\Http\Controllers\Api\Cards\PublishController;
use App\Domains\Social\Http\Controllers\Api\Cards\ReviewController;

/**
 * All route names are prefixed with 'api.social'.
 *
 * 主要文章功能
 */
Route::group([
    'prefix' => 'social',
    'as' => 'social.',
    'namespace' => 'Social',
], function () {
    /**
     * All route names are prefixed with 'api.social.cards'.
     *
     * 投稿相關的功能
     */
    Route::group([
        'prefix' => 'cards',
        'as' => 'cards.',
        'namespace' => 'Cards',
    ], function () {
        /**
         * 文章投稿
         */
        Route::group([
            'prefix' => 'publish',
            'as' => 'publish.',
            'middleware' => [
                'auth',
            ],
        ], function () {
            /**
             * 文字投稿
             */
            Route::post('/article', [PublishController::class, 'article'])->name('article');

            /**
             * 圖片投稿
             */
            Route::post('/picture', [PublishController::class, 'picture'])->name('picture');
        });

        /**
         * 文章資訊
         */
        Route::group(['prefix' => '{card}'], function () {
            /**
             * 獲得社群連結資訊
             */
            Route::get('/links', [LinksController::class, 'index'])->name('links');

            /**
             * 獲得留言資訊
             */
            Route::get('/comments', [CommentsController::class, 'index'])->name('comments');

            /**
             * 一般使用者可以進行的細部動作
             */
            Route::group([
                'middleware' => [
                    'auth',
                ],
            ], function () {
                /**
                 * 進行留言
                 */
                Route::post('/comments', [CommentsController::class, 'store'])->name('store');

                /**
                 * 獲得投票結果
                 */
                Route::get('/voted', [ReviewController::class, 'haveVoted'])->name('voted');

                /**
                 * 進行投票
                 */
                Route::get('/voting/{status}', [ReviewController::class, 'voting'])->name('voting');
            });

            /**
             * 管理員可以進行的細部動作
             */
            Route::group([
                'middleware' => [
                    'admin',
                ],
            ], function () {
                /**
                 * 指定文章發佈到社群平台
                 */
                Route::get('/publish', [PublishController::class, 'publish'])->name('publish');

                /**
                 * 封鎖指定文章
                 */
                Route::post('/blockade', [BlockadeController::class, 'cards'])->name('blockade');
            });
        });
    });

    /**
     * All route names are prefixed with 'api.social.comments'.
     *
     * 文章留言相關的功能
     */
    Route::group([
        'prefix' => 'comments',
        'as' => 'comments.',
        'namespace' => 'Comments',
    ], function () {
        /**
         * 文章留言資訊
         */
        Route::group(['prefix' => '{comment}'], function () {
            /**
             * 管理員可以進行的細部動作
             */
            Route::group([
                'middleware' => [
                    'admin',
                ],
            ], function () {
                /**
                 * 封鎖指定留言
                 */
                Route::post('/blockade', [BlockadeController::class, 'comment'])->name('blockade');
            });
        });
    });
});
