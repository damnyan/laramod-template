<?php

use Illuminate\Support\Facades\Route;

Route::group(
    attributes: [
        'prefix' => 'my',
        'as' => 'my.',
    ],
    routes: function () {
        require 'profile.php';
        require 'password.php';
    }
);

