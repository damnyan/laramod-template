<?php

use Illuminate\Support\Facades\Route;

require 'auth.php';

Route::group(
    attributes: [
        'middleware' => 'auth:administrator',
    ],
    routes: function () {
        require 'crud.php';
        require 'role.php';
        require 'my/routes.php';
    },
);
