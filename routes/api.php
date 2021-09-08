<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {   
    Route::post('auth', [App\Http\Controllers\Auth\AuthApiController::class, 'authenticate']);
    Route::get('me', [App\Http\Controllers\Auth\AuthApiController::class, 'getAuthenticatedUser']);

    Route::get('categories', [App\Http\Controllers\Api\v1\CategoryController::class, 'index']);
    Route::get('categories/{id}', [App\Http\Controllers\Api\v1\CategoryController::class, 'show']);
    Route::post('categories', [App\Http\Controllers\Api\v1\CategoryController::class, 'store']);
    Route::put('categories/{id}', [App\Http\Controllers\Api\v1\CategoryController::class, 'update']);
    Route::delete('categories/{id}', [App\Http\Controllers\Api\v1\CategoryController::class, 'delete']);

    Route::get('products', [App\Http\Controllers\Api\v1\ProductController::class, 'index']);
    Route::get('products/{id}', [App\Http\Controllers\Api\v1\ProductController::class, 'show']);
    Route::post('products', [App\Http\Controllers\Api\v1\ProductController::class, 'store']);
    Route::put('products/{id}', [App\Http\Controllers\Api\v1\ProductController::class, 'update']);
    Route::delete('products/{id}', [App\Http\Controllers\Api\v1\ProductController::class, 'delete']);


    Route::get('categories/{id}/products', [App\Http\Controllers\Api\v1\CategoryController::class, 'products']);
});