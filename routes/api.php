<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'public'
], function () {
    require __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'api.php';
});

Route::group([
    'prefix' => 'admin'
], function () {
    require __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'api.php';
});
