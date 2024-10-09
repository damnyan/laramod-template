<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'mng/acl',
    'as' => 'mng.acl.',
    'middleware' => [
        'auth:administrator',
    ],
], function () {
    include 'role.php';
    include 'permission.php';
});
