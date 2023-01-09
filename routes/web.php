<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AddProductImageController;
use App\Http\Controllers\GetAllProductsController;
use App\Http\Controllers\GetProductImages;
use App\Http\Controllers\GetUsersController;
use App\Http\Controllers\IndexRoutesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchUserController;
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

Route::get('/', [IndexRoutesController::class, 'index']);
Route::get('/reg_form', [IndexRoutesController::class, 'registration']);
Route::get('/users_products', [IndexRoutesController::class, 'userProducts']);


Route::post('/reg_form/registration', [RegisterController::class, "store"]);

Route::get('/users/all', [GetUsersController::class, 'get']);
Route::get('/users/{id}/delete', [UserController::class, 'destroy']);
Route::get('/users/edit_user', [UserController::class, 'show']);
Route::get('/users/products_list', [UserProductsController::class, 'index']);
Route::get('/users/products/', [UserProductsController::class, 'show']);
Route::get('/users/products/edit', [UserProductsController::class, 'edit']);
Route::get('/users/products/{id}/delete', [UserProductsController::class, 'destroy']);
Route::post('/users/products/delete_img', [AddProductImageController::class, 'destroy']);

Route::get('/products_list', [GetAllProductsController::class, 'get']);

Route::get('/view_statistic', [ViewsStatisticTableController::class, 'index']);

Route::resource('add_product', AddProductController::class);
Route::resource('add_image', AddProductImageController::class);
Route::resource('users', UserController::class);
Route::resource('users_products', UserProductsListController::class);

