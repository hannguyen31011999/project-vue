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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Login
Route::group(['middleware' => 'JwtCheckLogin'], function () {
    Route::get('/user','frontend\api\ApiLoginController@getAll');
});



Route::get('/logout','frontend\api\ApiLoginController@Logout');

Route::post('/login','frontend\api\ApiLoginController@Login');

