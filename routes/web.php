<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AddProductImageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PersonalAccountController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GetAllProductsController;
use App\Http\Controllers\GetUsersController;
use App\Http\Controllers\IndexRoutesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProductsController;
use App\Http\Controllers\UserProductsListController;
use App\Http\Controllers\ViewsStatisticTableController;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', [\App\Http\Controllers\Test::class, 'index']);

Route::get('/home', [IndexRoutesController::class, 'index'])->middleware('auth')->name('home');
Route::get('/', [IndexRoutesController::class, 'registration']);
Route::get('/login', [IndexRoutesController::class, 'login'])->name('login');
Route::get('/users_products', [IndexRoutesController::class, 'userProducts']);

Route::post('/reg_form/registration', [RegisterController::class, "store"]);

Route::post('/login/log', [LoginController::class, 'auth']);
Route::get('/logout', [LogoutController::class, 'logout']);

Route::post('/get_user', [UserController::class, 'get']);

Route::get('/users/all', [GetUsersController::class, 'get']);
Route::get('/users/{id}/delete', [UserController::class, 'destroy']);
Route::get('/users/edit_user', [UserController::class, 'show']);
Route::get('/users/products_list', [UserProductsController::class, 'index']);
Route::get('/users/products/', [UserProductsController::class, 'show']);
Route::get('/users/products/edit', [UserProductsController::class, 'edit']);
Route::get('/users/products/{id}/delete', [UserProductsController::class, 'destroy']);
Route::post('/users/products/delete_img', [AddProductImageController::class, 'destroy']);

Route::get('/personal_account', [PersonalAccountController::class, 'show']);

Route::get('/products_list', [GetAllProductsController::class, 'get']);

Route::get('/view_statistic', [ViewsStatisticTableController::class, 'index']);

Route::resource('add_product', AddProductController::class);
Route::resource('add_image', AddProductImageController::class);
Route::resource('users', UserController::class);
Route::resource('users_products', UserProductsListController::class);


