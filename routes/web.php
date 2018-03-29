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

Route::get('/', 'PostController@index')->name('home');

Route::get('/profile', 'ProfileController@profile')->name('profile');

Route::post('/profile', 'ProfileController@update_profile')->name('update_profile');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);

Auth::routes();
Route::get('/logout','Auth\LoginController@logout');
Route::get('/users/confirmation/{token}', ['uses' => 'Auth\RegisterController@confirmation','as' => 'confirmation']);








