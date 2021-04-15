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


// login admin
Route::post('/admin/login','backend\api\ApiLoginController@login');

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

    // user
    Route::group(['prefix'=>'user'],function(){
        Route::get('/list','ApiUserController@index');
        Route::get('/edit/{id}','ApiUserController@edit');
        Route::post('/update/{id}','ApiUserController@update');
        Route::get('/seach','ApiUserController@seach');
    });

    // province
    Route::group(['prefix'=>'province'],function(){
        Route::get('/list','ApiProvinceController@index');
        Route::post('/create','ApiProvinceController@store');
        Route::get('/edit/{id}','ApiProvinceController@edit');
        Route::post('/update/{id}','ApiProvinceController@update');
        Route::delete('/delete/{id}','ApiProvinceController@destroy');
        Route::get('/seach','ApiProvinceController@seach');
    });

    // district
    Route::group(['prefix'=>'district'],function(){
        Route::get('/list','ApiDistrictController@index');
        Route::post('/create','ApiDistrictController@store');
        Route::get('/edit/{id}','ApiDistrictController@edit');
        Route::post('/update/{id}','ApiDistrictController@update');
        Route::delete('/delete/{id}','ApiDistrictController@destroy');
        Route::get('/seach','ApiDistrictController@seach');
    });

    // ward
    Route::group(['prefix'=>'ward'],function(){
        Route::get('/list','ApiWardController@index');
        Route::post('/create','ApiWardController@store');
        Route::get('/edit/{id}','ApiWardController@edit');
        Route::post('/update/{id}','ApiWardController@update');
        Route::delete('/delete/{id}','ApiWardController@destroy');
        Route::get('/seach','ApiWardController@seach');
    });
});

// api user
Route::group(['namespace'=>'frontend\api'],function(){
    // categories
    Route::get('/categories','ApiHomeController@getCategories');
    // register
    Route::post('/register','ApiHomeController@registerUser');
    // login
    Route::post('/login','ApiHomeController@loginUser');
    // get user
    Route::get('/user','ApiHomeController@getUserLogin');
    // logout user
    Route::get('/logout','ApiHomeController@logoutUser');
});