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
    return view('index');
});

Auth::routes();

Route::get('/', 'UserController@index')->name('home');
//Route::get('/', 'UserController@register')->name('register');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/register', 'UserController@register')->name('register');
Route::post('/register', 'UserController@store')->name('register');

//Route::post('/login', 'UserController@create')->name('users.create');

//Route::get('/users', 'UserController@store')->name('users.store');

//Route::get('/users', 'UserController@search')->name('users.search');

//Route::patch('users/{user}/block', 'UserController@search_block')->name('users.search_block');
//Route::patch('users/{user}/unblock', 'UserController@search_block')->name('users.search_block');
//Route::patch('users/{user}/promote', 'UserController@search_block')->name('users.search_block');
//Route::patch('users/{user}/demote', 'UserController@search_block')->name('users.search_block');

//Route::patch('/me/password', 'UserController@edit')->name('users.edit');

//Route::put('/me/profile', 'UserController@update')->name('users.update');

//Route::get('/profiles', 'UserController@destroy')->name('users.destroy');

//Route::get('/me/associates', 'UserController@destroy')->name('users.destroy');

//Route::get('/associate-off', 'UserController@destroy')->name('users.destroy');

//Route::get('/accounts/{users}', 'UserController@destroy')->name('users.destroy');
//Route::get('/accounts/{users}/opened', 'UserController@destroy')->name('users.destroy');
//Route::get('/accounts/{users}/closed', 'UserController@destroy')->name('users.destroy');

//Route::delete('/account/{account}', 'UserController@destroy')->name('users.destroy');
//Route::patch('/account/{account}/close', 'UserController@destroy')->name('users.destroy');

//Route::patch('/accounts/{account}/reopen', 'UserController@destroy')->name('users.destroy');

//Route::post('/account', 'UserController@destroy')->name('users.destroy');

//Route::put('/account/{account}', 'UserController@destroy')->name('users.destroy');

//Route::get('/movements/{account}', 'UserController@destroy')->name('users.destroy');

//Route::get('/movements/{account}/create', 'UserController@destroy')->name('users.destroy');
//Route::post('/movements/{account}/create', 'UserController@destroy')->name('users.destroy');
//Route::get('/movement/{movement}', 'UserController@destroy')->name('users.destroy');
//Route::put('/movement/{movement}', 'UserController@destroy')->name('users.destroy');
//Route::delete('/movement/{movement}', 'UserController@destroy')->name('users.destroy');

//Route::post('/documents/{movement}', 'UserController@destroy')->name('users.destroy');

//Route::delete('/document/{document}', 'UserController@destroy')->name('users.destroy');
//Route::get('/document/{document}', 'UserController@destroy')->name('users.destroy');

//Route::get('/dashboard/{user}', 'UserController@destroy')->name('users.destroy');

//Route::get('/me/associates', 'UserController@destroy')->name('users.destroy');

//Route::delete('/me/associates/{user}', 'UserController@destroy')->name('users.destroy');
//Route::get('/home', 'HomeController@index');

Auth::routes();


//Route::get('/home', 'HomeController@index');
