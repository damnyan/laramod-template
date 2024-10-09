<?php

use Illuminate\Support\Facades\Route;
use Modules\ACL\Enums\AdministratorPermission;
use Modules\Administrator\Http\Controllers\Mng\RoleController;

Route::group(['prefix' => 'administrator/{administrator}/sync_roles'], function () {
    Route::put('/', [RoleController::class, 'syncRoles'])
        ->middleware('permission:' . AdministratorPermission::ADMIN_MNG->value)
        ->name('administrator.role.sync');
});
