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
    return view('auth.login');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'product'],function(){
	Route::get('','ProductController@index');
	Route::get('get_all_products','ProductController@get_all_products');
	Route::post('add_product','ProductController@created_product');
	Route::post('update_product','ProductController@update_product');
	Route::delete('deleteProduct/{id}','ProductController@deleteProduct');

});

Route::group(['prefix' => 'inventory'],function(){
	Route::get('','InventoryController@index');
	Route::get('get_all_products','InventoryController@get_all_products');
	Route::post('update','InventoryController@update');
	Route::post('AddToProd','InventoryController@AddToProd');
});

Route::group(['prefix' => 'orders'],function(){
	Route::get('invoices','OrderController@indexInvoices');
	Route::post('RemoveInInventory','OrderController@RemoveInInventory');
});

Route::group(['prefix' => 'client'],function(){

	Route::get('','ClientController@index');
	Route::get('get_all_clients','ClientController@get_all_clients');
	
	Route::post('add_client','ClientController@created_client');
	Route::post('update_client','ClientController@update_client');
	Route::delete('delete_client/{id}','ClientController@delete_client');
});
