<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CouponCodeController;
use App\Http\Controllers\Admin\StatisticsController;
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
    // Cities Management
    Route::apiResource('cities', CitiesController::class);

    // Products Management
    Route::apiResource('products', ProductController::class);
    Route::post('products/{id}/toggle-status', [ProductController::class, 'toggleStatus']);

    // Categories Management
    Route::apiResource('categories', CategoryController::class);
    Route::post('categories/{id}/toggle-status', [CategoryController::class, 'toggleStatus']);

    // Orders Management
    Route::apiResource('orders', OrderController::class);

    // Books Management
    Route::apiResource('books', BookController::class);

    // Coupon Codes Management
    Route::apiResource('coupon-codes', CouponCodeController::class);
    Route::post('coupon-codes/{id}/toggle-status', [CouponCodeController::class, 'toggleStatus']);

    // Statistics
    Route::get('statistics/dashboard', [StatisticsController::class, 'dashboard']);
    Route::get('statistics/total-orders', [StatisticsController::class, 'totalOrders']);
    Route::get('statistics/total-visitors', [StatisticsController::class, 'totalVisitors']);
    Route::get('statistics/total-revenue', [StatisticsController::class, 'totalRevenue']);
    Route::get('statistics/users-last-30-minutes', [StatisticsController::class, 'usersLast30Minutes']);
    Route::get('statistics/incomplete-orders', [StatisticsController::class, 'incompleteOrders']);
});
