<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/7/2024
 * @time: 4:29 PM
 */

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::name('posts.')
    ->group(function() {
        Route::get('/posts', [PostController::class, 'index'])
            ->name('index');

        Route::get('/posts/{post}', [PostController::class, 'show'])
            ->name('show')
            ->whereNumber('post');

        Route::post('/posts',  [PostController::class, 'store'])
            ->name('store');

        Route::patch('/posts/{post}', [PostController::class, 'update'])
            ->name('update')
            ->whereNumber('post');

        Route::delete('/posts/{post}', [PostController::class, 'destroy'])
            ->name('destroy')
            ->whereNumber('post');
    });
