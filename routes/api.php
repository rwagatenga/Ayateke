<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->namespace('API')->group(function () {
  // Login
  Route::post('/login','AuthController@postLogin');
<<<<<<< HEAD
  // Register
  Route::post('/register','AuthController@postRegister');
  // Protected with APIToken Middleware
  Route::middleware('APIToken')->group(function () {
    //Find
  Route::post('/check', 'ReportController@check');
  //Rolover
  Route::post('/rolove', 'ReportController@reports');
  //report
  Route::post('/simple', 'ReportController@roloreport');
    // Logout
    Route::post('/logout','AuthController@postLogout');
=======
  Route::get('/test', 'AuthController@test');
  // Register
  Route::post('/register','AuthController@postRegister');
  //Find
  Route::post('/add', 'AuthController@add');
  //Rolover
    Route::post('/rolove', 'AuthController@reports');
    //report
    Route::get('/view', 'AuthController@view');
  // Protected with APIToken Middleware
  Route::middleware('APIToken')->group(function () {
    // Logout
    Route::post('/logout','AuthController@postLogout');
    //Rolover
    //Route::post('/rolove', 'AuthController@reports');
>>>>>>> aa659fe1537f4faa13cb03b5d947c812ed3c169e
  });
});