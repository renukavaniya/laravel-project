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
Route::get('/mail',[AdminController::class,'website']);
Route::get('/mail',[AdminController::class,'website']);
//Route::get('approve_book',[AdminController::class,'website']);
Route::post('admin/auth',[AdminController::class,'auth']);
Route::get('admin/logout', [AdminController::class,'logout']);
Route::post('admin/update_password',[AdminController::class,'update_password']);
Route::post('store',[BookController::class,'store']);
Route::post('update/{id}', [BookController::class, 'update']);
Route::any('approve_book',[AdminController::class,'approve_book']);

Route::group(['middleware'=>['AuthCheck1']], function(){


Route::get('admin/dashboard',[AdminController::class,'dashboard'])->middleware('is_admin');


Route::get('admin/changepassword',[AdminController::class,'changepassword']);
Route::get('admin/request_book',[AdminController::class,'request_book']);
Route::get('admin/borrow_book',[AdminController::class,'borrow_book']);
Route::get('admin/approve_form/{id}/{id2}',[AdminController::class,'approve_form']);
Route::get('admin/return_book',[AdminController::class,'return_book']);
Route::get('admin/export-excel',[AdminController::class,'exportToExcel']);
Route::any('admin/export-excel/{id}',[AdminController::class,'exportToExcel']);
Route::any('admin/excel/{id}',[AdminController::class,'excel'])->name('export_excel.excel');
Route::any('admin/excel_bydate/',[AdminController::class,'excel_bydate'])->name('export_excel_bydate.excel');
Route::any('import.file',[AdminController::class,'importForm'])->name('import.file');
//Route::get('/addbook',[BookController::class,'index']);
Route::get('admin/addbook',[BookController::class,'index']);

//Route::get('admin/dashboard', [BookController::class, 'show']);
Route::get('deletebook/{id}', [BookController::class, 'destroy']);
Route::get('edit/{id}', [BookController::class, 'edit']);

Route::get('/search',[BookController::class,'search']);
Route::get('admin/booklist',[BookController::class,'booklist']);
Route::get('admin/booklist', [BookController::class, 'show']);
Route::get('admin/userprofile',[BookController::class,'userprofile']);
Route::get('admin/userprofile', [BookController::class, 'showuser']);
});
Route::post('user/login',[UserController::class,'login']);
Route::post('/updateuserprofile/{id}', [UserController::class, 'updateuserprofile']);


Route::get('/user',[UserController::class,'index']);
Route::get('/register',[UserController::class,'register']);

Route::group(['middleware'=>['AuthCheck']], function(){

//Route::get('/userdashboard',[UserController::class,'userdashboard']);
Route::get('/userdashboard',[BookController::class,'showbook']);
Route::get('/edituserprofile/{id}',[UserController::class,'edituserprofile']);

Route::get('/changeuserpassword',[UserController::class,'changeuserpassword']);
Route::post('/updateuserpassword',[UserController::class,'updateuserpassword']);
Route::get('/showbooks',[BookController::class,'showbook']);
Route::get('/singlebook/{id}',[BookController::class,'singlebook']);
Route::post('/add_to_cart',[BookController::class,'addToCart']);
Route::get('addcart/{id}',[BookController::class,'addcart']);
Route::get('/carts',[BookController::class,'cart']);
Route::get('/cartlist',[BookController::class,'cartList']);
Route::get('/delete_cart/{id}',[BookController::class,'deleteCart']);
Route::get('/deletecart/{id}',[BookController::class,'removeCart']);
Route::post('/borrownow',[BookController::class,'borrownow']);
Route::get('/borrowedbooks',[BookController::class,'borrowedbooks']);
Route::get('/borrowedbooks/pdf',[BookController::class, 'pdf']);
Route::any('admin/returnbook/{id}/{id1}',[AdminController::class,'returnbook']);
});

Route::post('storeuser',[UserController::class,'storeuser']);
Route::get('delete/{id}', [UserController::class, 'deleteuser']);
Route::get('edituser/{id}', [UserController::class, 'edituser']);
Route::post('updateuser/{id}', [UserController::class, 'updateuser']);
Route::get('user/logout', [UserController::class,'logout']);
//Route::post('admin/auth',[AdminController::class,'auth']);
