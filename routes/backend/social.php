<?php

use App\Http\Controllers\Backend\Social\Cards\CardsController;
use App\Http\Controllers\Backend\Social\Cards\CardsStatusController;

// All route names are prefixed with 'admin.social'.
Route::group([
    'prefix' => 'social',
    'as' => 'social.',
    'namespace' => 'Social',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // All route names are prefixed with 'admin.social.cards'.
    Route::group([
        'prefix' => 'cards',
        'as' => 'cards.',
        'namespace' => 'Cards',
    ], function () {
        // Social Cards Status
        Route::get('deactivated', [CardsStatusController::class, 'getDeactivated'])->name('deactivated');
        Route::get('deleted', [CardsStatusController::class, 'getDeleted'])->name('deleted');

        // Social Cards List
        Route::get('/', [CardsController::class, 'index'])->name('index');

        // Specific Social Cards
        Route::group(['prefix' => '/{cards}'], function () {
            // Social Cards
            Route::get('/', [CardsController::class, 'show'])->name('show');
            Route::delete('/', [CardsController::class, 'destroy'])->name('destroy');

            // Deleted
            Route::delete('banned', [CardsStatusController::class, 'banned'])->name('banned');
            Route::delete('delete', [CardsStatusController::class, 'delete'])->name('delete-permanently');
            Route::delete('restore', [CardsStatusController::class, 'restore'])->name('restore');
        });
    });
});
