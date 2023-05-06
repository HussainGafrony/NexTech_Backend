<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//USER
Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);
Route::post('update', [UserController::class, 'update']);
//Address
Route::post('address', [AddressController::class, 'index']);
Route::post('update', [AddressController::class, 'update']);
Route::post('store', [AddressController::class, 'store']);

//Products
Route::get('products', [ProductsController::class, 'index']);