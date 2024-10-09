<?php

use Illuminate\Support\Facades\Route;
use Modules\Administrator\Http\Controllers\Mng\My\ProfileController;

Route::get('profile', [ProfileController::class, 'show'])
    ->name('profile.show');

Route::put('profile', [ProfileController::class, 'update'])
    ->name('profile.update');

