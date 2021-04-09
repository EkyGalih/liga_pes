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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('register', 'Auth\RegisterController@create')->name('resgiter');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('ubah_skor/{id}', 'Admin\AdminController@edit')->name('admin.ubah_skor');
    Route::post('update/{id}', 'Admin\AdminController@update')->name('admin.update');
    Route::get('statistik/{id}', 'Admin\AdminController@show')->name('admin.statistik');
    Route::get('create', 'Admin\AdminController@create')->name('admin.tambah_player');
    Route::post('store', 'Admin\AdminController@store')->name('admin.store');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user']], function () {
    Route::get('/', 'User\UserController@index')->name('player');
});
