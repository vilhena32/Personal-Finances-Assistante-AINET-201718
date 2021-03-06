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
Route::get('/users{name?}{type?}{status?}','UserController@filter')->name('users.search')->middleware('auth');
Route::get('/users{name?}','UserController@filterAuth')->name('users.search.auth')->middleware('auth');
Route::patch('/users/{user}/block','UserController@block')->name('block')->middleware('admin');
Route::patch('/users/{user}/unblock','UserController@unblock')->name('unblock')->middleware('admin');
Route::patch('/users/{user}/promote','UserController@promote')->name('assignAdmin')->middleware('admin');
Route::patch('/users/{user}/demote','UserController@demote')->name('removeAdmin')->middleware('admin');

Route::get('/me/profile','UserController@edit')->name('showEdit')->middleware('auth');
Route::put('/me/profile','UserController@store')->name('editUser')->middleware('auth');
Route::get('/show/{user}', 'UserController@show')->name('showUser')->middleware('auth');
Route::get('/me/show/', 'UserController@myProfile')->name('showProfile'); 



//Profiles

Route::get('/profiles', 'AssociateMemberController@listUsers')->name('associates')->middleware('auth');
Route::get('/me/associates', 'AssociateMemberController@myAssociates')->name('my.associates')->middleware('auth'); //myAssociateOf
Route::get('/me/associate-of', 'AssociateMemberController@myAssociateOf')->name('my.associatedOf')->middleware('auth');

//Accounts
Route::get('/account', 'AccountController@create')->name('create.account')->middleware('auth');
Route::post('/account', 'AccountController@store')->name('store.account')->middleware('auth');

Route::get('/account/{account}', 'AccountController@edit')->name('accounts.edit')->middleware('auth');
Route::put('/account/{account}', 'AccountController@update')->name('accounts.update')->middleware('auth', 'account_exists', 'account_belongs_to_user');

Route::get('/accounts/{user}', 'AccountController@index')->name('accounts')->middleware('auth');
Route::get('/accounts/{user}/closed', 'AccountController@listClosedAccounts')->name('accounts.closed')->middleware('auth');
Route::get('/accounts/{user}/opened', 'AccountController@listOpenAccounts')->name('accounts.open')->middleware('auth');
Route::delete('/account/{account}', 'AccountController@destroy')->name('accounts.delete')->middleware('auth');
Route::patch('/account/{account}/close', 'AccountController@closeAccount')->name('close.account')->middleware('auth');
Route::patch('/account/{account}/reopen', 'AccountController@reopenAccount')->name('reopen.account')->middleware('auth');

//US19
//Movements
Route::get('/movements/{account}', 'MovementController@index')->name('list.movements')->middleware('auth');
Route::get('/movements/{account}/create', 'MovementController@create')->name('create.movements')->middleware('auth');
Route::post('/movements/{account}/create', 'MovementController@store')->name('store.movements')->middleware('auth');
Route::get('/movement/{movement}/show', 'MovementController@show')->name('show.movements')->middleware('auth');
Route::get('/movement/{movement}', 'MovementController@edit')->name('edit.movements')->middleware('auth');
Route::put('/movement/{movement}', 'MovementController@update')->name('update.movements')->middleware('auth');
Route::delete('/movement/{movement}', 'MovementController@destroy')->name('delete.movements')->middleware('auth');

Route::get('/account/{account}/startBalance', 'AccountController@updateStartAmount')->name('change.startbalance')->middleware('auth');
Route::patch('/account/{account}/startBalance', 'AccountController@storeStartAmount')->name('update.startbalance')->middleware('auth');


Route::get('document/{document}/download','DocumentController@downloadDoc')->name('doc.download')->middleware('auth');
//CHARTS(EM TESTES!)
Route::get('/charts/{account}', 'ChartController@index')->name('chart.index')->middleware('auth');
Route::get('/dashboard/{user}', 'ChartController@myDash')->name('dash')->middleware('auth');
//Route::get('/me/associates', 'UserController@destroy')->name('users.destroy');

//Documents
Route::get('/documents/{document}', 'DocumentController@show')->name('show.doc')->middleware('auth');

Route::get('/document/{movement}', 'DocumentController@create')->name('create.doc')->middleware('auth');
Route::post('/document/{movement}', 'DocumentController@store')->name('store.doc')->middleware('auth');

Route::delete('/document/{document}', 'DocumentController@delete')->name('delete.doc')->middleware('auth');
