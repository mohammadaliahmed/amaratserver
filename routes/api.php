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


Route::post('register', [\App\Http\Controllers\AppController::class,'Register']);
Route::post('login', [\App\Http\Controllers\AppController::class,'Login']);
Route::post('placeOrder', [\App\Http\Controllers\AppController::class,'PlaceOrder']);
Route::post('addSite', [\App\Http\Controllers\AppController::class,'AddSite']);
Route::post('editSite', [\App\Http\Controllers\AppController::class,'EditSite']);
Route::get('products', [\App\Http\Controllers\AppController::class,'ListProducts']);
Route::get('myOrders/{id}', [\App\Http\Controllers\AppController::class,'MyOrders']);
Route::get('orderItems/{id}', [\App\Http\Controllers\AppController::class,'OrderItems']);
Route::get('git status/{id}', [\App\Http\Controllers\AppController::class,'GetCustomer']);
