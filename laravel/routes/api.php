<?php

use Illuminate\Support\Facades\Route;

// メモ
Route::prefix('memos')
    ->as('memos.')
    ->group(function () {
        Route::get('', \App\Http\Controllers\Memos\ListController::class)->name('list');
        Route::post('', \App\Http\Controllers\Memos\CreateController::class)->name('create');
        Route::delete('{id}', \App\Http\Controllers\Memos\DeleteController::class)->name('delete');
    });
