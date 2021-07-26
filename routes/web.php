<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/addbook', function () {
    return view('admin.addbook');
});

Route::get('/admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth']);
Route::get('admin/dashboard',[AdminController::class,'dashboard'])->middleware('is_admin');
Route::get('admin/logout', [AdminController::class,'logout']);
Route::get('admin/changepassword',[AdminController::class,'changepassword']);
Route::post('admin/update_password',[AdminController::class,'update_password']);

//Route::get('/addbook',[BookController::class,'index']);
Route::get('admin/addbook',[BookController::class,'index']);
Route::post('store',[BookController::class,'store']);
//Route::get('admin/dashboard', [BookController::class, 'show']);
Route::get('deletebook/{id}', [BookController::class, 'destroy']);
Route::get('edit/{id}', [BookController::class, 'edit']);
Route::post('update/{id}', [BookController::class, 'update']);
Route::get('/search',[BookController::class,'search']);
Route::get('admin/booklist',[BookController::class,'booklist']);
Route::get('admin/booklist', [BookController::class, 'show']);
Route::get('admin/userprofile',[BookController::class,'userprofile']);
Route::get('admin/userprofile', [BookController::class, 'showuser']);
Route::get('/user',[UserController::class,'index']);
Route::post('user/login',[UserController::class,'login']);
Route::get('/register',[UserController::class,'register']);
Route::post('storeuser',[UserController::class,'storeuser']);
Route::get('delete/{id}', [UserController::class, 'deleteuser']);
Route::get('edituser/{id}', [UserController::class, 'edituser']);
Route::post('updateuser/{id}', [UserController::class, 'updateuser']);
Route::get('user/logout', [UserController::class,'logout']);
//Route::post('admin/auth',[AdminController::class,'auth']);
