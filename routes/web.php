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
    return view('welcome');
});

Auth::routes();

//Route::resource('user', 'UserController');
Route::resource('contract', 'ContractController')->middleware('auth');
Route::resource('company', 'CompanyController')->middleware('auth');
Route::resource('categories', 'ContractCategoryController')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users.index')->middleware('auth');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users', 'UserController@store')->name('users.store');
Route::get('/users/edit/{user}', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware('auth');
Route::put('/users/update/{user}', 'UserController@update')->name('users.update')->middleware('auth');
Route::delete('/users/delete/{user}', 'UserController@destroy')->name('users.delete')->middleware('auth');
