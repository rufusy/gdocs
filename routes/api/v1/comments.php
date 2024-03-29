<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/7/2024
 * @time: 4:32 PM
 */

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::name('comments.')
    ->group(function() {
        Route::get('/comments', [CommentController::class, 'index'])
            ->name('index');

        Route::get('/comments/{comment}', [CommentController::class, 'show'])
            ->name('show')
            ->whereNumber('comment');

        Route::Post('/comments',  [CommentController::class, 'store'])
            ->name('store');

        Route::patch('/comments/{comment}', [CommentController::class, 'update'])
            ->name('update')
            ->whereNumber('comment');

        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
            ->name('destroy')
            ->whereNumber('comment');
    });

