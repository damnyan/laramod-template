<?php

use Illuminate\Support\Facades\Route;
use Modules\Administrator\Http\Controllers\Mng\AuthController;

Route::group(
    attributes: [
        'prefix' => 'auth',
        'as' => 'auth.',
    ],
    routes: function () {
        Route::post(uri: 'login', action: [AuthController::class, 'login'])
            ->name('login');

        Route::post(uri: 'logout', action: [AuthController::class, 'logout'])
            ->name('logout');
    }
);
