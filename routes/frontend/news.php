<?php

use App\Http\Controllers\Frontend\News\NewsController;

/*
 * News Controllers
 * All route names are prefixed with 'frontend.news.'.
 */
Route::group([
    'prefix' => 'news',
    'as' => 'news.',
    'namespace' => 'News',
], function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{url}', [NewsController::class, 'show'])->name('show');
});
