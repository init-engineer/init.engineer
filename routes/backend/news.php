<?php

use App\Http\Controllers\Backend\News\NewsController;
use App\Http\Controllers\Backend\News\NewsStatusController;

// All route names are prefixed with 'admin.news'.
Route::group([
    'prefix' => 'news',
    'as' => 'news.',
    'namespace' => 'News',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // News List
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('deleted', [NewsStatusController::class, 'getDeleted'])->name('deleted');
    Route::get('deactivated', [NewsStatusController::class, 'getDeactivated'])->name('deactivated');

    Route::get('create', [NewsController::class, 'create'])->name('create');
    Route::post('/', [NewsController::class, 'store'])->name('store');

    // Specific News
    Route::group(['prefix' => '/{id}'], function () {
        // News
        Route::get('/', [NewsController::class, 'edit'])->name('edit');
        Route::patch('/', [NewsController::class, 'update'])->name('update');
        Route::delete('/', [NewsController::class, 'destroy'])->name('destroy');

        // Status
        Route::get('mark/{status}', [NewsStatusController::class, 'mark'])->name('mark')->where(['status' => '[0,1]']);

        // Deleted
        Route::delete('delete', [NewsStatusController::class, 'delete'])->name('delete-permanently');
        Route::delete('restore', [NewsStatusController::class, 'restore'])->name('restore');
    });
});
