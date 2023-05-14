<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
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
Route::get('product', [ProductsController::class, 'index']);
Route::post('productS', [ProductsController::class, 'store']);
Route::post('productU', [ProductsController::class, 'update']);
Route::post('product', [ProductsController::class, 'destroy']);
Route::get('search/{word}', [ProductsController::class, 'search']);
//Category
Route::get('category', [CategoryController::class, 'index']);
Route::post('categoryS', [CategoryController::class, 'store']);
Route::post('categoryU', [CategoryController::class, 'update']);
Route::post('category', [CategoryController::class, 'destroy']);
//Order
Route::post('order', [OrderController::class, 'index']);
Route::post('orderS', [OrderController::class, 'store']);
Route::post('orderU', [OrderController::class, 'update']);
Route::post('orderD', [OrderController::class, 'destroy']);
Route::post('delete_orderDetails', [OrderController::class, 'delete_OrderDetailsID']);

