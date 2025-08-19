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
                Route::post('', \App\Http\Controllers\Memos\CreateController::class)->name('create');
            });
    });

/**********************************************************************
 * ルーティング
 ***********************************************************************/
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
