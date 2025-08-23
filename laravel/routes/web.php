<?php

use Illuminate\Support\Facades\Route;

/**********************************************************************
 * API
 **********************************************************************/
Route::prefix('api')
    ->as('api.')
    ->group(function () {
        // メモ
        Route::prefix('memos')
            ->as('memos.')
            ->group(function () {
                Route::get('', \App\Http\Controllers\Memos\ListController::class)->name('list');
                Route::post('', \App\Http\Controllers\Memos\CreateController::class)->name('create');
                Route::delete('{id}', \App\Http\Controllers\Memos\DeleteController::class)->name('delete');
            });
    });

/**********************************************************************
 * ルーティング
 ***********************************************************************/
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
