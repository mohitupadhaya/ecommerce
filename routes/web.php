<?php

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
    return view('shop');
});
Auth::routes();
//for front page
Route::get('/','IndexController@index');
Route::get('/home', 'HomeController@index')->name('home');

// for category url
Route::get('/products/{url}','ProductsController@products');

// for product detail page
Route::get('/product/{id}','ProductsController@product');


//for admin
Route::match(['get','post'],'/admin','AdminController@login');
Route::get('/admin/dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logout');

// for Categories

Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
Route::get('/admin/view-category','CategoryController@viewCategory');
Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
Route::get('admin/delete-category/{id}','CategoryController@deleteCategory');

// for Products

Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
Route::get('/admin/view-product','ProductsController@viewProduct');
Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
Route::get('/admin/delete-product/{id}','ProductsController@deletetProduct');

// for Products Attributes
Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');
// for edit attributes
Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttributes');
// for multiple image upload for products
Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImage');
//delete product image
Route::get('/admin/delete-image/{id}','ProductsController@deleteImage');
Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttributes');

// get product attribute price
Route::get('/product-price','ProductsController@productPrice');
// Add to Cart
Route::match(['get','post'],'/add-cart','ProductsController@addtoCart');
// for Cart page
Route::get('/cart','ProductsController@Cart');
// for product delete from cart
Route::get('/cart/delete-product/{id}','ProductsController@cartDeleteproduct');
// for update product quantity
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateProductquantity');
// for coupon code functionality
Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');