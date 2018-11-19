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

Route::get('/posts/vue-laravel-realtime-charts', 'SocketController@index')->name('socket');

Route::get('/socket-chart', 'SocketController@newEvent');

Route::get('/ip-calculator', 'IpCalculateController@index')->name('ipcalc');
Route::get('/ip-calculate', 'IpCalculateController@netData'); 

Route::group(['midleware' => 'auth'], function() { 
    Route::get('/chat', ['uses' => 'ChatController@index', 'as' => 'chat', 'https' => false]);
    Route::get('/send-message', ['uses' => 'ChatController@sendMessage', 'https' => false]);
    Route::get('/send-private-message', ['uses' => 'ChatController@sendPrivateMessage', 'https' => false]);
    Route::get('/get-db-data', ['uses' => 'ChatController@getDBData', 'https' => false]);
    Route::get('/profile', 'ProfileController@profile')->name('profile');
    Route::post('/profile', 'ProfileController@update_profile')->name('update_profile');
});
Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);

Route::get('/send/email', 'PostController@mail');
Route::get('/api/search', 'SearchController@search');
Route::get('/api/username', 'SearchController@username');

Auth::routes();
Route::get('/logout','Auth\LoginController@logout');
Route::get('/users/confirmation/{token}', ['uses' => 'Auth\RegisterController@confirmation','as' => 'confirmation']);








