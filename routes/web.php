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

Route::prefix('config')->group(function () {
	Route::get('/', 'ConfigController@index')->name('config');
});

Route::prefix('report')->group(function () {
	Route::get('/', 'ReportController@index')->name('report');
});

/*-------------------------   Harus diakhir-------------------------------*/
Route::get('{not_found}', 'HomeController@not_found')->name('not_found');
Route::post('{not_found}', 'HomeController@not_found')->name('not_found');
