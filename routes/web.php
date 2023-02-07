<?php

use App\Http\Controllers\Auth\AddProductController;
use App\Http\Controllers\Auth\AddProductImageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PersonalAccountController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CategoriesNavController;
use App\Http\Controllers\GetAllProductsController;
use App\Http\Controllers\GetCategoriesController;
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
Route::get('/test/show', [\App\Http\Controllers\Test::class, 'show']);
Route::get('/fill_all_categories', [CategoriesNavController::class, 'fill']);


Route::get('/home', [IndexRoutesController::class, 'index'])->name('home');
Route::get('/registration', [IndexRoutesController::class, 'registration']);
Route::get('/login', [IndexRoutesController::class, 'login'])->name('login');
Route::get('/users_products', [IndexRoutesController::class, 'userProducts'])->middleware('auth');

Route::post('/reg_form/registration', [RegisterController::class, "store"]);

Route::post('/login/log', [LoginController::class, 'auth']);
Route::get('/logout', [LogoutController::class, 'logout'])->middleware(['auth', 'verified']);

Route::post('/get_user', [UserController::class, 'get']);

Route::get('/users/all', [GetUsersController::class, 'get']);
Route::get('/users/{id}/delete', [UserController::class, 'destroy']);
Route::get('/users/edit_user', [UserController::class, 'show']);
Route::get('/users/products_list', [UserProductsController::class, 'index']);
Route::get('/users/products/', [UserProductsController::class, 'show']);
Route::get('/users/products/edit', [UserProductsController::class, 'edit'])->middleware(['auth', 'verified']);
Route::get('/users/products/{id}/delete', [UserProductsController::class, 'destroy'])->middleware(['auth', 'verified']);
Route::post('/users/products/delete_img', [AddProductImageController::class, 'destroy'])->middleware(['auth', 'verified']);

Route::get('/personal_account', [PersonalAccountController::class, 'show'])->middleware(['auth', 'verified']);

Route::get('/products_list', [GetAllProductsController::class, 'get']);

Route::get('/view_statistic', [ViewsStatisticTableController::class, 'index']);

Route::resource('add_product', AddProductController::class)->middleware(['auth', 'verified']);
Route::resource('add_image', AddProductImageController::class)->middleware(['auth', 'verified']);
Route::resource('users', UserController::class);
Route::resource('users_products', UserProductsListController::class);

Route::get('/{category}', [CategoriesNavController::class, 'showByCategory']);
Route::get('/{category}/{subcategory}', [CategoriesNavController::class, 'showBySubcategory']);
Route::post('/get_by_category', [CategoriesNavController::class, 'get']);
Route::post('/get_categories', [GetCategoriesController::class, 'get']);
Route::post('/get_subcategories', [GetCategoriesController::class, 'getSub']);


Route::get('/email/verify', [VerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
