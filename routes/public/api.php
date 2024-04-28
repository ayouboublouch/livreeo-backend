<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\CityController;
use App\Http\Controllers\Public\SchoolController;
use App\Http\Controllers\Public\GroupController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\OrderController;


Route::get('/cities', [CityController::class, 'index']);
Route::get('/schools/{city?}', [SchoolController::class, 'index']);
Route::get('/groups/{school?}', [GroupController::class, 'index']);
Route::get('/articles/{group?}', [ArticleController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('order/{tracking_number}', [OrderController::class, 'show']);





