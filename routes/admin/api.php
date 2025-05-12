<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CitiesController;
use Illuminate\Support\Facades\Route;

// Admin Authentication Routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

// Protected Admin Dashboard Routes
Route::group([
    'middleware' => ['api', 'auth:api'],
    'prefix' => 'dashboard'
], function () {
    Route::apiResource('cities', CitiesController::class);
});
