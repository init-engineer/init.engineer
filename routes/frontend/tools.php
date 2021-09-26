<?php

use App\Http\Controllers\Frontend\ToolsController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Tools Controllers
 * All route names are prefixed with 'frontend.tools.'.
 */
Route::group([
    // 'prefix' => 'tools',
    'as' => 'tools.',
    'namespace' => 'Tools',
], function () {
    Route::get('fortunes', [ToolsController::class, 'fortunes'])
        ->name('fortunes')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Fortunes'), route('frontend.tools.fortunes'));
        });

    Route::get('animal/kohlrabi', [ToolsController::class, 'kohlrabi'])
        ->name('kohlrabi')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Kohlrabi'), route('frontend.tools.kohlrabi'));
        });
});
