<?php

use Illuminate\Support\Facades\Route;
use Modules\Administrator\Http\Controllers\Mng\My\PasswordController;

Route::put('password', [PasswordController::class, 'update'])
    ->name('password.update');

