<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/7/2024
 * @time: 3:44 PM
 */

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('users.')
    ->group(function() {
        Route::get('/users', [UserController::class, 'index'])->name('index');

        Route::get('/users/{user}', [UserController::class, 'show'])
            ->name('show')
            ->whereNumber('user');

        Route::post('/users',  [UserController::class, 'store'])
            ->name('store');

        Route::patch('/users/{user}', [UserController::class, 'update'])
            ->name('update')
            ->whereNumber('user');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('destroy')
            ->whereNumber('user');
    });

