<?php

use App\Http\Controllers\Frontend\Leaderboard\LeaderboardController;

/*
 * Leaderboard Controllers
 * All route names are prefixed with 'frontend.leaderboard.'.
 */
Route::group([
    'prefix' => 'leaderboard',
    'as' => 'leaderboard.',
    'namespace' => 'Leaderboard',
], function () {
    Route::group([
        'prefix' => '2019',
        'as' => '2019.',
    ], function () {
        Route::get('/YuuChien', [LeaderboardController::class, 'show2019YuuChien'])->name('show.yuu-chien');
        Route::get('/FizzyElt', [LeaderboardController::class, 'show2019FizzyElt'])->name('show.fizzy-elt');
        Route::get('/DongGuaLemon', [LeaderboardController::class, 'show2019DongGuaLemon'])->name('show.dong-gua-lemon');
    });
});
