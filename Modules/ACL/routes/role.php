<?php

use Illuminate\Support\Facades\Route;
use Modules\ACL\Enums\AdministratorPermission;
use Modules\ACL\Http\Controllers\RoleController;

Route::apiResource('role', RoleController::class)
    ->middleware(
        permission(AdministratorPermission::ROLE_MNG)
    );
