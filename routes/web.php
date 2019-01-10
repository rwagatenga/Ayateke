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

Route::get('/coins', 'CoinController@index');
Route::get('/create', 'CoinController@create');
Route::post('/coin', 'CoinController@store');
//Route::post('login', 'AuthController@login');
Route::get('/public', 'AddController@getPubTap');
Route::post('/public', 'AddController@postPubTap');
Route::get('/private', 'AddController@getPrivTap');
Route::post('/private', 'AddController@postPrivTap');
Route::get('/personal', 'AddController@getPersTap');
Route::post('/personal', 'AddController@postPersTap');
Route::get('/report', 'HomeController@report');
Route::post('/report', 'HomeController@reports');
Route::post('/add', 'HomeController@add');
Route::get('/add/{$id}', 'AddController@addFunction');
Route::get('/confirm', 'HomeController@confirm');
Route::get('/cancel/{id}', 'HomeController@cancel');
<<<<<<< HEAD
Route::get('/view', 'AddController@view');
=======
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
Route::get('/message', function(){
	Nexmo::message()->send([
		'to' => '250781448238',
		'from' => 'Laravel',
		'text' => 'Hello Fred is it working?'
	]);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
