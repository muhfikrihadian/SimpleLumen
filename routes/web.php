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

Auth::routes(['register' => false,'reset' => false,'verify' => false,]);

Route::get('/', 'HomeController@index')->name('home');
Route::resource('roles','RoleController');
Route::post('roles/{id}', 'RoleController@update');
Route::post('roles/{id}/delete', 'RoleController@destroy')->name('rolesDestroy');
Route::resource('users','UserController');
Route::post('users/{id}', 'UserController@update');
Route::post('users/{id}/delete', 'UserController@destroy')->name('usersDestroy');

Route::prefix('config')->group(function () {
	Route::get('/', 'ConfigController@index')->name('config');
});

Route::prefix('report')->group(function () {
	Route::get('/', 'ReportController@index')->name('report');
});

Route::prefix('merchant')->group(function () {
	Route::get('/', 'MerchantController@index')->name('merchant');
	Route::get('create', 'MerchantController@create')->name('createMerchant');
	Route::post('store', 'MerchantController@store')->name('storeMerchant');
	Route::get('{id}/edit', 'MerchantController@edit')->name('editMerchant');
	Route::post('{id}/update', 'MerchantController@update')->name('updateMerchant');
	Route::post('{id}/destroy', 'MerchantController@destroy')->name('destroyMerchant');
});

Route::prefix('terminal')->group(function () {
	Route::get('/', 'TerminalController@index')->name('terminal');
	Route::get('create', 'TerminalController@create')->name('createTerminal');
	Route::post('store', 'TerminalController@store')->name('storeTerminal');
	Route::get('{id}/edit', 'TerminalController@edit')->name('editTerminal');
	Route::post('{id}/update', 'TerminalController@update')->name('updateTerminal');
	Route::post('{id}/destroy', 'TerminalController@destroy')->name('destroyTerminal');
});

Route::prefix('location')->group(function () {
	Route::get('/', 'LocationController@index')->name('location');
	Route::get('create', 'LocationController@create')->name('createLocation');
	Route::post('store', 'LocationController@store')->name('storeLocation');
	Route::get('{id}/edit', 'LocationController@edit')->name('editLocation');
	Route::post('{id}/update', 'LocationController@update')->name('updateLocation');
	Route::post('{id}/destroy', 'LocationController@destroy')->name('destroyLocation');
});

/*-------------------------   Harus diakhir-------------------------------*/
Route::get('{not_found}', 'HomeController@not_found')->name('not_found');
Route::post('{not_found}', 'HomeController@not_found')->name('not_found');
