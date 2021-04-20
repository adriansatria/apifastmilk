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

// AUTH AS CUSTOMERS
Route::post('/customers/login', [\App\Http\Controllers\API\AuthUserController::class, 'login']);
Route::post('/customers/register', [\App\Http\Controllers\API\AuthUserController::class, 'register']);

// AUTH AS SALES
Route::post('/sales/login', [\App\Http\Controllers\API\AuthSalesController::class, 'login']);

// AUTH AS ADMIN


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// CUSTOMERS ROUTE
// Route::apiResource('/customers', \App\Http\Controllers\UsersController::class);
Route::get('/customers', [\App\Http\Controllers\UsersController::class, 'index']);
Route::get('/customers/detail', [\App\Http\Controllers\UsersController::class, 'showWithForeignKey']);
Route::post('/customers/post', [\App\Http\Controllers\UsersController::class, 'store']);
Route::put('/customers/update/{id}', [\App\Http\Controllers\UsersController::class, 'update']);
Route::delete('/customers/delete/{id}', [\App\Http\Controllers\UsersController::class, 'destroy']);

// PRODUCTS ROUTE
Route::apiResource('/products', \App\Http\Controllers\ProductsController::class);

// CATEGORIES ROUTE
Route::apiResource('/categories', \App\Http\Controllers\CategoryController::class);

// SALES ROUTE
Route::apiResource('/sales', \App\Http\Controllers\SalesController::class);

// PESANAN ROUTE
Route::apiResource('/pesanan', \App\Http\Controllers\PesananController::class);