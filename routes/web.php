<?php

use App\Http\Controllers\Auth\Admin\AttributesController;
use App\Http\Controllers\Auth\Admin\CategoriesController;
use App\Http\Controllers\Auth\Admin\ProductsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ShoppingCartController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\IndexRoutesController;
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
    Route::get('/home', 'index')->name('home')->middleware('redirectTo');
    Route::get('/registration', 'registration');
    Route::get('/login', 'login')->name('login');
    Route::get('/users_products', 'userProducts')->middleware('auth');
    Route::get('/admin', 'adminPanel');
});

Route::controller(CategoriesController::class)->group(function() {
    Route::get('/get_all_categories_with_pagination', 'getAllCategoriesWithPagination');
    Route::get('/get_all_categories', 'getAllCategories');
    Route::get('/get_subcategories_by_parent_category_name', 'getSubcategoriesByParentCategoryName');
    Route::get('/admin/create_category', 'createCategory');
    Route::get('/admin/edit_category', 'editCategory');
    Route::post('/admin/delete_category', 'deleteCategory');
    Route::get('/admin/search_category', 'searchCategory');
    Route::get('/products/{category}', 'showByCategory');
    Route::get('/products/{category}/{subcategory}', 'showBySubcategory');
});

Route::controller(AttributesController::class)->group(function() {
    Route::get('/admin/create_attribute', 'createAttribute');
    Route::get('/admin/get_attributes_by_subcategory', 'getAttributesBySubcategoryId');
    Route::post('/admin/store_product_attrs_values', 'storeAttributesValues');
    Route::get('/admin/get_converted_attributes', 'getConvertedAttributesValues');
    Route::post('/admin/delete_attribute', 'deleteAttribute');
    Route::get('/admin/get_magnitude_values', 'getMagnitudeValues');
});


Route::controller(ProductsController::class)->group(function() {
    Route::get('/admin/products', 'show');
    Route::get('/admin/get_product_by_id', 'getProductById');
    Route::get('/admin/create_product', 'storeProduct');
    Route::post('/admin/store_product_images', 'storeProductImages');
    Route::get('/admin/search_product_by_subcategory', 'searchProductBySubcategory');
    Route::post('/admin/delete_product', 'deleteProduct');
    Route::get('/get_all_products_by_subcategory_id', 'getAllProductBySubcategoryIdWithPaginate');
    Route::get('/get_all_products_by_category_name', 'getAllProductsByCategoryName');
    Route::get('/get_all_products_by_subcategory_name', 'getAllProductBySubcategoryNameWithPaginate');
    Route::get('/about_product/{id}', 'showAboutProduct');
    Route::get('/search_product', 'searchProduct');
    Route::get('/add_product_to_shopping_cart', 'addProductToShoppingCart');
    Route::get('/get_user_products_from_shopping_cart', 'getAuthUserProductsFromShoppingCart');
});

Route::controller(ShoppingCartController::class)->group(function() {
    Route::get('/shopping_cart', 'show');
    Route::get('/buy_product', 'storeToShoppingCart');
    Route::post('/update_product_quantity', 'updateProductQuantity');
    Route::get('/get_user_shopping_cart', 'getUserShoppingCart');
    Route::get('/get_number_of_products_in_shopping_cart', 'getNumberOfProductsInShoppingCart');
    Route::post('/delete_from_shopping_cart', 'deleteFromShoppingCart');
    Route::get('/checkout', 'checkout')->middleware('auth.checkout');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/get_user', 'get');
    Route::post('/delete_user', 'destroy');
    Route::get('/edit_user', 'edit');
});

Route::controller(VerificationController::class)->group(function (){
    Route::get('/email/verify', [VerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
});

Route::post('/reg_form/registration', [RegisterController::class, "store"]);
Route::post('/login/log', [LoginController::class, 'auth']);
Route::get('/logout', [LogoutController::class, 'logout'])->middleware(['auth', 'verified']);



