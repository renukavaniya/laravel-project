<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\BorrowController;

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
Route::get('/admin', [AdminsController::class,'index']);
Route::get('/mail', [AdminsController::class,'website']);
Route::get('/mail', [AdminsController::class,'website']);
//Route::get('approve_book',[AdminController::class,'website']);
Route::post('admin/auth', [AdminsController::class,'auth']);
Route::get('admin/logout', [AdminsController::class,'logout']);
Route::post('admin/update_password', [AdminsController::class,'update_password']);
Route::post('store', [BooksController::class,'store']);
Route::post('update/{id}', [BooksController::class, 'update']);
Route::any('approve_book', [AdminsController::class,'approve_book']);

Route::group(['middleware'=>['AuthCheck1']], function () {


    Route::get('admin/dashboard', [AdminsController::class,'dashboard'])->middleware('is_admin');


    Route::get('admin/changepassword', [AdminsController::class,'changepassword']);
    Route::get('admin/request_book', [BorrowController::class,'request_Book']);
    Route::get('admin/borrow_book', [BorrowController::class,'borrow_Book']);
    Route::get('admin/approve_form/{id}/{id2}', [AdminsController::class,'approve_form']);
    Route::get('admin/return_book', [BorrowController::class,'return_Booklist']);
    Route::get('admin/export-excel', [AdminsController::class,'exportToExcel']);
    Route::any('admin/export-excel/{id}', [AdminsController::class,'exportToExcel']);
    Route::any('admin/excel/{id}', [AdminsController::class,'excel'])->name('export_excel.excel');
    Route::any('admin/excel_bydate/', [AdminsController::class,'excel_bydate'])->name('export_excel_bydate.excel');
    Route::any('import.file', [AdminsController::class,'importForm'])->name('import.file');
//Route::get('/addbook',[BookController::class,'index']);
    Route::get('admin/addbook', [BooksController::class,'index']);

//Route::get('admin/dashboard', [BookController::class, 'show']);
    Route::get('deletebook/{id}', [BooksController::class, 'destroy']);
    Route::get('edit/{id}', [BooksController::class, 'edit']);

    Route::get('/search', [BooksController::class,'search']);
    Route::get('admin/booklist', [BooksController::class,'bookList']);
    Route::get('admin/booklist', [BooksController::class, 'show']);
    Route::get('admin/userprofile', [BooksController::class,'userProfile']);
    Route::get('admin/userprofile', [UsersController::class, 'showUser']);
});
Route::post('user/login', [UsersController::class,'login']);
Route::post('/updateuserprofile/{id}', [UsersController::class, 'updateuserprofile']);


Route::get('/user', [UsersController::class,'index']);
Route::get('/register', [UsersController::class,'register']);

Route::group(['middleware'=>['AuthCheck']], function () {

//Route::get('/userdashboard',[UserController::class,'userdashboard']);
    Route::get('/userdashboard', [BooksController::class,'showBook']);
    Route::get('/edituserprofile/{id}', [UsersController::class,'edituserprofile']);

    Route::get('/changeuserpassword', [UsersController::class,'changeuserpassword']);
    Route::post('/updateuserpassword', [UsersController::class,'updateuserpassword']);
    Route::get('/showbooks', [BooksController::class,'showbook']);
    Route::get('/singlebook/{id}', [BooksController::class,'singleBook']);
    Route::post('/add_to_cart', [CartsController::class,'addToCart']);
    Route::get('addcart/{id}', [CartsController::class,'addcart']);
    Route::get('/carts', [CartsController::class,'cart']);
    Route::get('/cartlist', [CartsController::class,'cartList']);
    Route::get('/delete_cart/{id}', [CartsController::class,'deleteCart']);
    Route::get('/deletecart/{id}', [CartsController::class,'removeCart']);
    Route::post('/borrownow', [BorrowController::class,'borrowNow']);
    Route::get('/borrowedbooks', [BorrowController::class,'borrowedBooks']);
    Route::get('/borrowedbooks/pdf', [BorrowController::class, 'pdf']);
    Route::any('admin/returnbook/{id}/{id1}', [BorrowController::class,'updateReturn']);
});

Route::post('storeuser', [UsersController::class,'storeuser']);
Route::get('delete/{id}', [UsersController::class, 'deleteuser']);
Route::get('edituser/{id}', [UsersController::class, 'edituser']);
Route::post('updateuser/{id}', [UsersController::class, 'updateuser']);
Route::get('user/logout', [UsersController::class,'logout']);
//Route::post('admin/auth',[AdminController::class,'auth']);
