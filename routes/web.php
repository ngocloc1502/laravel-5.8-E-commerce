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

//User
Route::get ('/', 'C_controller@list_products');
Route::get ('/home', 'C_controller@list_products');

Route::get ('/register', 'C_controller@register');
Route::post ('/register', 'C_controller@post_register');

Route::get ('/signin/{checkout?}', 'C_controller@signin'); 
	//? : có giá trị cũng được mà không có cũng đc
Route::post ('/signin/{checkout?}', 'C_controller@post_signin');

Route::get ('/addtocart/{id}', 'C_controller@addtocart');
Route::get ('/delitem/{id}', 'C_controller@delitem');
Route::get ('/cart', 'C_controller@cart');

Route::get ('/checkout', 'C_controller@checkout');
Route::get ('/buy', 'C_controller@buy');

Route::get ('/order', 'C_controller@order');

Route::get ('item/info/{id}', 'C_controller@product');

Route::get ('/collect/{classify?}/{keyword?}', 'C_controller@collections');

//Admin
Route::prefix('admin')->group(function() {
	Route::get ('/', 'Admin_controller@signin');
	Route::post ('/', 'Admin_controller@post_signin');
	Route::get ('/signin', 'Admin_controller@signin');
	Route::post ('/signin', 'Admin_controller@post_signin');

	Route::get ('/sanpham', 'Admin_controller@products');
	Route::get ('/sanpham/suathongso/{id}', 'Admin_controller@updateac');
	Route::post ('/sanpham', 'Admin_controller@insert_item');
	Route::get ('/sanpham/del/{id}', 'Admin_controller@del_item');
	Route::get ('/sanpham/edit/{id}', 'Admin_controller@edit_item');
	Route::post ('/sanpham/edit/{id}', 'Admin_controller@update_item');

	Route::get ('/hangsx', 'Admin_controller@brands');
	Route::get ('/hangsx/del/{id}', 'Admin_controller@del_brand');
	Route::post ('/hangsx', 'Admin_controller@insert_brand');

	Route::get ('/cauhinh', 'Admin_controller@option');
	Route::get ('/cauhinh/del/{id}', 'Admin_controller@del_option');
	Route::post ('/cauhinh', 'Admin_controller@insert_option');

	Route::get ('/linhkien', 'Admin_controller@accessories');
	Route::get ('/linhkien/del/{id}', 'Admin_controller@del_accessories');
	Route::post ('/linhkien', 'Admin_controller@insert_accessories');

	Route::get ('/collections', 'Admin_controller@collections');
	Route::post ('/collections', 'Admin_controller@insert_collection');
});

Route::get ('/test' ,'C_controller@test');