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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Site\HomeController@index');

Route::prefix('/painel')->group(function(){
    Route::get('/', 'Admin\HomeController@index')->name('painel');

    Route::get('/login', 'Admin\Auth\LoginController@index')->name('login');
    Route::post('/login', 'Admin\Auth\LoginController@logar');

    Route::get('/register', 'Admin\Auth\RegisterController@index')->name('register');
    Route::post('/register', 'Admin\Auth\RegisterController@register');
    
    Route::get('/logout', 'Admin\Auth\LoginController@logout');
    Route::post('/logout', 'Admin\Auth\LoginController@logout');

    //Route::get('admin/dashboard', 'Admin\HomeController@index')->name('dashboard');

    Route::get('/users', 'Admin\UserController@index')->name('users');
    Route::get('/cadaster/user', 'Admin\UserController@create')->name('cadaster_user');
    Route::post('/cadaster/user', 'Admin\UserController@store');

    Route::get('/user/edit/{id}', 'Admin\UserController@edit')->name('edit');
    Route::post('/user/edit/{id}', 'Admin\UserController@update');

    Route::get('/user/delete/{id}', 'Admin\UserController@destroy')->name('delete');

    Route::get('/settings', 'Admin\UserController@settings')->name('settings');
});