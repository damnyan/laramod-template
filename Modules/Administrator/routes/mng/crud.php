<?php

use Illuminate\Support\Facades\Route;
use Modules\ACL\Enums\AdministratorPermission;
use Modules\Administrator\Http\Controllers\Mng\CrudController;

Route::apiResource(name: 'administrator', controller: CrudController::class)
    ->middleware(
        permission(AdministratorPermission::ADMIN_MNG)
    );
