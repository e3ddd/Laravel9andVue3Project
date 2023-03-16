<?php

use App\Http\Controllers\Auth\AddProductController;
use App\Http\Controllers\Auth\AddProductImageController;
use App\Http\Controllers\Auth\Admin\CategoriesAndAttributesController;
use App\Http\Controllers\Auth\Admin\ProductsController;
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

Route::controller(IndexRoutesController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/registration', 'registration');
    Route::get('/login', 'login')->name('login');
    Route::get('/users_products', 'userProducts')->middleware('auth');
});

Route::controller(CategoriesAndAttributesController::class)->group(function() {
    Route::get('/admin', 'show');
    Route::get('/admin/create_category', 'createCategory');
    Route::get('/admin/edit_category', 'editCategory');
    Route::post('/admin/delete_category', 'deleteCategory');
    Route::get('/admin/search_category', 'searchCategory');
    Route::get('/admin/create_attribute', 'createAttribute');
    Route::get('/admin/get_attributes_by_subcategory', 'getAttributesBySubcategoryId');
    Route::get('/admin/get_converted_attributes', 'getConvertedAttributesValues');
    Route::post('/admin/delete_attribute', 'deleteAttribute');
    Route::get('/admin/get_magnitude_values', 'getMagnitudeValues');
});

Route::controller(ProductsController::class)->group(function() {
    Route::get('/admin/products', 'show');
    Route::get('/admin/get_product_by_id', 'getProductById');
    Route::get('/admin/get_products_by_subcategory', 'getProductBySubcategoryPaginate');
    Route::get('/admin/create_product', 'storeProduct');
    Route::post('/admin/store_product_images', 'storeProductImages');
    Route::post('/admin/store_product_attrs_values', 'storeAttributesValues');
    Route::get('/admin/search_product', 'searchProduct');
    Route::post('/admin/delete_product', 'deleteProduct');
    Route::get('/admin/get_all_products_by_category', 'getAllProductsByCategory');
    Route::get('/admin/get_all_products_by_subcategory', 'getAllProductsBySubcategory');
});

Route::controller(CategoriesNavController::class)->group(function (){
    Route::get('/products/{category}', 'showByCategory');
    Route::get('/products/{category}/{subcategory}', 'showBySubcategory');
});

Route::controller(GetCategoriesController::class)->group(function (){
    Route::get('/get_categories', 'get');
    Route::get('/get_all_categories',  'getAll');
    Route::get('/get_subcategories', 'getSubcategoriesBuyCategoryId');
});

Route::controller(VerificationController::class)->group(function (){
    Route::get('/email/verify', [VerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
});



Route::post('/reg_form/registration', [RegisterController::class, "store"]);
Route::post('/login/log', [LoginController::class, 'auth']);
Route::get('/logout', [LogoutController::class, 'logout'])->middleware(['auth', 'verified']);

Route::post('/get_user', [UserController::class, 'get']);

Route::get('/users/all', [GetUsersController::class, 'get']);
Route::get('/users/{id}/delete', [UserController::class, 'destroy']);
Route::get('/users/edit_user', [UserController::class, 'show']);
Route::post('/users/products/delete_img', [AddProductImageController::class, 'destroy'])->middleware(['auth', 'verified']);

Route::get('/personal_account', [PersonalAccountController::class, 'show'])->middleware(['auth', 'verified']);

Route::get('/products_list', [GetAllProductsController::class, 'get']);

Route::get('/view_statistic', [ViewsStatisticTableController::class, 'index']);

Route::resource('users', UserController::class);
//Route::resource('users_products', UserProductsListController::class);

