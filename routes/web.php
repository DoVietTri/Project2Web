<?php

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
//Admin
Route::get('admin/login', ['as' => 'admin.getLogin', 'uses' => 'UserController@getLoginAdmin']);
Route::post('admin/login',['as' => 'admin.postLogin', 'uses' => 'UserController@postLoginAdmin']);


Route::group(['prefix' => 'admin', 'middleware' => 'adminMiddleware'], function() {
	Route::get('index', 'AdminController@getIndex')->name('admin.index');
	
	Route::group(['prefix' => 'order'], function() {
		Route::get('order', 'AdminController@getOrder')->name('admin.order');
		Route::get('order/delete/{id}', 'AdminController@deleteOrder')->name('admin.order.delete');
		Route::get('order/detail/{id}', 'AdminController@orderDetail')->name('admin.order.orderDetail');
	});


	Route::group(['prefix' => 'category'], function() {
		Route::get('add', ['as' => 'admin.category.getAdd', 'uses' => 'CategoryController@getAdd']);
		Route::post('add', ['as' => 'admin.category.postAdd', 'uses' => 'CategoryController@postAdd']);
		Route::get('list', ['as' => 'admin.category.getList', 'uses' => 'CategoryController@getList']);
		Route::get('delete/{id}', ['as' => 'admin.category.getDelete', 'uses' => 'CategoryController@getDelete']);
		Route::get('edit/{id}', ['as' => 'admin.category.getEdit', 'uses' => 'CategoryController@getEdit']);
		Route::post('edit/{id}', ['as' => 'admin.category.postEdit', 'uses' => 'CategoryController@postEdit']);
	});
	Route::group(['prefix' => 'product'], function() {
		Route::get('add', ['as' => 'admin.product.getAdd', 'uses' => 'ProductController@getAdd']);
		Route::post('add', ['as' => 'admin.product.postAdd', 'uses' => 'ProductController@postAdd']);
		Route::get('list', ['as' => 'admin.product.getList', 'uses' => 'ProductController@getList']);
		Route::get('delete/{id}', ['as' => 'admin.product.getDelete', 'uses' => 'ProductController@getDelete']);
		Route::get('edit/{id}', ['as' => 'admin.product.getEdit', 'uses' => 'ProductController@getEdit']);
		Route::post('edit/{id}', ['as' => 'admin.product.postEdit', 'uses' => 'ProductController@postEdit']);
		Route::get('delImg/{id}', ['as' => 'admin.product.getDelImg', 'uses' => 'ProductController@getDelImg']);
	});
	Route::group(['prefix' => 'slider'], function() {
		Route::get('add', 'SliderController@getAdd')->name('admin.slider.getAdd');
		Route::post('add', 'SliderController@postAdd')->name('admin.slider.postAdd');
		Route::get('list', 'SliderController@getList')->name('admin.slider.getList');
		Route::get('delete/{id}','SliderController@getDelete')->name('admin.slider.getDelete');
		Route::get('edit/{id}', 'SliderController@getEdit')->name('admin.slider.getEdit');
		Route::post('edit/{id}', 'SliderController@postEdit')->name('admin.slider.postEdit');
	});
	Route::group(['prefix' => 'user'], function(){
		Route::get('list', 'UserController@getList')->name('admin.user.getList');
		Route::get('add', 'UserController@getAdd')->name('admin.user.getAdd');
		Route::post('add', 'UserController@postAdd')->name('admin.user.postAdd');
		Route::get('delete/{id}', 'UserController@getDelete')->name('admin.user.getDelete');
		Route::get('edit/{id}', 'UserController@getEdit')->name('admin.user.getEdit');
		Route::post('edit/{id}', 'UserController@postEdit')->name('admin.user.postEdit');
	});
});


//Client
Route::get('login', ['as' => 'client.getLogin', 'uses' => 'UserController@getLogin']);
Route::post('login', ['as' => 'client.postLogin', 'uses' => 'UserController@postLogin']);
Route::get('logout', ['as' => 'client.getLogout', 'uses' => 'UserController@getLogout']);

Route::get('register', ['as' => 'client.getRegister','uses' => 'UserController@getRegister']);
Route::post('register', ['as' => 'client.postRegister', 'uses' => 'UserController@postRegister']);

Route::get('profile', 'UserController@getProfile')->name('client.getProfile');

Route::get('/', 'HomeController@index')->name('index');
Route::get('category/{id}/{alias}', 'HomeController@getCategory')->name('client.Category');
Route::get('product/{id}/{alias}', 'HomeController@getSingle')->name('client.getSingle');
Route::get('search', 'HomeController@getSearch')->name('client.getSearch');
Route::get('mylistorder', 'HomeController@getMyListOrder')->name('client.getMyListOrder');
Route::get('myorderdetail/id', 'HomeController@getMyOrderDetail')->name('client.getMyOrderDetail');


Route::get('addcart/{id}', 'CartController@addCart')->name('client.addCart');
Route::get('cart', 'CartController@getCart')->name('getCart');
Route::get('updatecart/{id}', 'CartController@updateCart')->name('updateCart');
Route::get('deletecart/{id}', 'CartController@deleteCart')->name('deleteCart');
Route::get('checkout', 'CartController@getCheckout')->name('getCheckout');
Route::post('checkout', 'CartController@postCheckout')->name('postCheckout');




