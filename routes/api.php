<?php

use App\Http\Controllers\Api\V1\AdvertisementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProvinceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('/otp', [AuthController::class, 'otp']);
    Route::post('/resend-otp', [AuthController::class, 'resend_otp']);

    Route::get('/advertisements/show', [AdvertisementController::class, 'show']);
    Route::get('/provinces', [ProvinceController::class, 'index']);
    Route::get('/provinces/show', [ProvinceController::class, 'show']);
});

// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);


Route::group(['prefix' => 'v1'], function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/popular_category', [CategoryController::class, 'popular_category']);
        Route::post('/category/create', [CategoryController::class, 'store']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);

        // Ads
        Route::get('/advertisements', [AdvertisementController::class, 'index']);
        Route::get('/advertisements/{id}', [AdvertisementController::class, 'show']);
        Route::get('/advertisements/images/{id}', [AdvertisementController::class, 'images']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
