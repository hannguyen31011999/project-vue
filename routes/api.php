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


Route::group(['middleware' => 'auth.jwt','namespace'=>'backend\api'], function () {
    Route::get('/admin/user','ApiLoginController@getUserLogin');
    Route::get('/admin/logout','ApiLoginController@logout');

    // categories api
    Route::get('admin/categories/list','ApiCategoriesController@index');
    Route::post('admin/categories/create','ApiCategoriesController@store');
});

Route::post('/admin/login','backend\api\ApiLoginController@login');