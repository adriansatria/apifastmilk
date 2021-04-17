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
Route::post('/login', [\App\Http\Controllers\API\AuthUserController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\API\AuthUserController::class, 'register']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/customers', \App\Http\Controllers\UsersController::class);
Route::get('/customersdetail', [\App\Http\Controllers\UsersController::class, 'showWithForeignKey']);
Route::apiResource('/products', \App\Http\Controllers\ProductsController::class);
Route::apiResource('/categories', \App\Http\Controllers\CategoryController::class);