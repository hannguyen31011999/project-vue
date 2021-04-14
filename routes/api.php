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


Route::group(['middleware' => 'auth.jwt','namespace'=>'backend\api','prefix'=>'admin'], function () {
    Route::get('/user','ApiLoginController@getUserLogin');
    Route::get('/logout','ApiLoginController@logout');

    // categories api
    Route::group(['prefix'=>'categories'],function(){
        Route::get('/list','ApiCategoriesController@index');
        Route::post('/create','ApiCategoriesController@store');
        Route::get('/edit/{id}','ApiCategoriesController@edit');
        Route::post('/update/{id}','ApiCategoriesController@update');
        Route::delete('/delete/{id}','ApiCategoriesController@destroy');
        Route::get('/seach','ApiCategoriesController@seach');
    });
    
    // typeproduct api
    Route::group(['prefix'=>'type'],function(){
        Route::get('/list','ApiTypeProductController@index');
        Route::post('/create','ApiTypeProductController@store');
        Route::get('/edit/{id}','ApiTypeProductController@edit');
        Route::post('/update/{id}','ApiTypeProductController@update');
        Route::delete('/delete/{id}','ApiTypeProductController@destroy');
        Route::get('/seach','ApiTypeProductController@seach');
    });
});

Route::post('/admin/login','backend\api\ApiLoginController@login');