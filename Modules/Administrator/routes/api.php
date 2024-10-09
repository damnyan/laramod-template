<?php

use Illuminate\Support\Facades\Route;

Route::group(
    attributes: [
        'prefix' => 'mng',
        'as' => 'mng.',
    ],
    routes: function () {
        require 'mng/routes.php';
    },
);
