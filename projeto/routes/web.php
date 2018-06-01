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
Route::get('/me/password','UserController@changePassword')->middleware('auth');
Route::patch('/me/password','UserController@updatePassword')->name('users.updatePassword')->middleware('auth');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('users.logout')->middleware('auth');
Route::get('/users{name?}','UserController@listUsers')->name('listUsers')->middleware('auth');
Route::patch('/users/{user}/block','UserController@block')->name('block')->middleware('admin');
Route::patch('/users/{user}/unblock','UserController@unblock')->name('unblock')->middleware('admin');
Route::patch('/users/{user}/promote','UserController@assignAdmin')->name('assignAdmin')->middleware('admin');
Route::patch('/users/{user}/demote','UserController@removeAdmin')->name('removeAdmin')->middleware('admin');
Route::post('/search{request?}','UserController@filter')->name('users.search')->middleware('admin');
//Route::post('/search{request?}','UserController@filter')->name('users.searchPublic');
Route::get('/me/profile','UserController@edit')->name('showEdit')->middleware('auth');
Route::put('/me/profile','UserController@store')->name('editUser')->middleware('auth');
Route::get('/show/{user}', 'UserController@show')->name('showUser')->middleware('auth');
Route::get('/me/show', 'UserController@showProfile')->name('showProfile'); //Esta é para o Querido! 



//Profiles
Route::get('/profiles', 'AssociateMembersController@profiles')->name('profiles');

Route::get('/profiles', 'UserController@showPublicProfile')->name('publicProfile');

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
