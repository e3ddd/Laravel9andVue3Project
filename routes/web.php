<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AddProductImageController;
use App\Http\Controllers\GetAllProducts;
use App\Http\Controllers\GetProductImages;
use App\Http\Controllers\GetUsersController;
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

Route::get('/', function () {
    return view('index');
});

Route::name('index.')->group(function (){
    Route::get("/reg_form", function(){
        return view('Registration/item');
    })->name('registration');
    Route::get("/users_products", function(){
        return view('usersProducts');
    })->name('users.products');
});


Route::post('/reg_form/registration', [RegisterController::class, "store"]);

Route::get('/users/search_email', [SearchUserController::class, 'search']);
Route::get('/users/all', [GetUsersController::class, 'get']);
Route::get('/users/{id}/delete', [UserController::class, 'destroy']);
Route::get('/users/edit_user', [UserController::class, 'show']);
Route::get('/users/products_list', [UserProductsController::class, 'index']);
Route::get('/users/products/', [UserProductsController::class, 'show']);
Route::get('/users/products/edit', [UserProductsController::class, 'edit']);
Route::get('/users/products/{id}/delete', [UserProductsController::class, 'destroy']);
Route::get('/users/products/all_images', [GetProductImages::class, 'get']);
Route::post('/users/products/delete_img', [AddProductImageController::class, 'destroy']);

Route::get('/products_list', [GetAllProducts::class, 'get']);

Route::get('/view_statistic', [ViewsStatisticTableController::class, 'index']);

Route::resource('add_product', AddProductController::class);
Route::resource('add_image', AddProductImageController::class);
Route::resource('users', UserController::class);
Route::resource('users_products', UserProductsListController::class);

