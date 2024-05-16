<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\CityController;
use App\Http\Controllers\Public\SchoolController;
use App\Http\Controllers\Public\GroupController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Public\ContactUsController;
use App\Http\Controllers\Public\OrderController;
use App\Http\Controllers\Public\PartnerController;
use App\Http\Controllers\Public\RecruitmentController;
use App\Http\Controllers\Public\ReturnRequestController;
use App\Http\Controllers\Public\ShippingTypeController;
use App\Models\File;

Route::get('/shipping-types', [ShippingTypeController::class, 'index']);
Route::get('/cities', [CityController::class, 'index']);
Route::get('/schools/{city?}', [SchoolController::class, 'index']);
Route::get('/groups/{school?}', [GroupController::class, 'index']);
Route::get('/articles/{group?}', [ArticleController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('order/{tracking_number}', [OrderController::class, 'show']);
Route::get('categories', [CategoryController::class, 'index']);

Route::post('/contact-us', [ContactUsController::class, 'store']);
Route::post('/recruitment', [RecruitmentController::class, 'store']);
Route::post('/partner', [PartnerController::class, 'store']);
Route::post('/return-request', [ReturnRequestController::class, 'store']);

Route::get('files/{id}', function ($id) {
    $file = File::findOrFail($id);
    
    return response()->file(storage_path('app/' . $file->path));
})->name('files');