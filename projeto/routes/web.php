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

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/', 'UserController@register')->name('register');

Route::get('/me/password','UserController@changePassword');
Route::patch('/me/password','UserController@updatePassword')->name('users.updatePassword');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('users.logout');

Route::get('/users','UserController@listUsers')->name('listUsers')->middleware('auth');

Route::patch('/users/{user}/block','UserController@block')->name('block')->middleware('admin');
Route::patch('/users/{user}/unblock','UserController@unblock')->name('unblock')->middleware('admin');
Route::patch('/users/{user}/promote','UserController@assignAdmin')->name('assignAdmin')->middleware('admin');
Route::patch('/users/{user}/demote','UserController@removeAdmin')->name('removeAdmin')->middleware('admin');


//Route::get('/s','UserController@listUsers')->name('listUsers')->middleware('admin');
Route::post('/search','UserController@filter')->name('users.search');

//Route::get('/registeruser', 'UserController@create')->name('users.create');
//Route::post('/register', 'UserController@store')->name('users.store');

//Route::post('/login', 'UserController@create')->name('users.create');

//Route::get('/users', 'UserController@store')->name('users.store');

//Route::get('/users', 'UserController@search')->name('users.search');

//Route::patch('users/{user}/block', 'UserController@search_block')->name('users.search_block');
//Route::patch('users/{user}/unblock', 'UserController@search_block')->name('users.search_block');
//Route::patch('users/{user}/promote', 'UserController@search_block')->name('users.search_block');
//Route::patch('users/{user}/demote', 'UserController@search_block')->name('users.search_block');

//Route::patch('/me/password', 'UserController@changePassword')->name('users.editPassword');

Route::get('/me/profile', 'UserController@showProfile')->name('showProfile');

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



//Route::get('/home', 'HomeController@index');
