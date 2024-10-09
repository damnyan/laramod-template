<?php

use Illuminate\Support\Facades\Route;
use Modules\ACL\Http\Controllers\PermissionController;

Route::get('permission', [PermissionController::class, 'index'])
    ->name('permission.index');
