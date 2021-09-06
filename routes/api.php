<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\UserController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
//Route::get('user/{id}',[UserController::class,'renuka']);
Route::post('storeuser', [UserController::class,'storeuser']);
Route::post('login', [UserController::class,'login']);
Route::get('editprofile/{id}', [UserController::class,'editprofile']);
Route::put('updateprofile/{id}', [UserController::class,'updateprofile']);
Route::get('showbook', [BookController::class,'showbook']);
Route::get('singlebook/{id}', [BookController::class,'singlebook']);
Route::post('addToCart', [BookController::class,'addToCart']);
Route::get('cartList', [BookController::class,'cartList']);
Route::delete('deleteCart/{id}', [BookController::class,'deleteCart']);
Route::post('borrownow', [BookController::class,'borrownow']);
Route::put('update_password', [UserController::class,'update_password']);
