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
        Route::get('/view/{id}','ApiProvinceController@viewDistrict');
    });

    // district
    Route::group(['prefix'=>'district'],function(){
        Route::get('/list','ApiDistrictController@index');
        Route::post('/create','ApiDistrictController@store');
        Route::get('/edit/{id}','ApiDistrictController@edit');
        Route::post('/update/{id}','ApiDistrictController@update');
        Route::delete('/delete/{id}','ApiDistrictController@destroy');
        Route::get('/seach','ApiDistrictController@seach');
        Route::get('/view/{id}','ApiDistrictController@viewListWard');
    });

    // ward
    Route::group(['prefix'=>'ward'],function(){
        Route::get('/list','ApiWardController@index');
        Route::get('/change/district/{id}','ApiWardController@changeDistrict');
        Route::post('/create','ApiWardController@store');
        Route::get('/edit/{id}','ApiWardController@edit');
        Route::post('/update/{id}','ApiWardController@update');
        Route::delete('/delete/{id}','ApiWardController@destroy');
        Route::get('/seach','ApiWardController@seach');
    });

    // post
    Route::group(['prefix'=>'post'],function(){
        Route::get('/list','ApiPostController@index');
        Route::post('/create','ApiPostController@store');
        Route::get('/edit/{id}','ApiPostController@edit');
        Route::post('/update/{id}','ApiPostController@update');
        Route::delete('/delete/{id}','ApiPostController@destroy');
        Route::get('/seach','ApiPostController@seach');
    });
});

// api user
Route::group(['namespace'=>'frontend\api'],function(){
    // home
    Route::group(['prefix'=>'home'],function(){
        // categories
        Route::get('/categories/list','ApiHomeController@getListCategories');
        // province list
        Route::get('/province/list','ApiHomeController@getListProvince');
        // post
        Route::get('/post/list','ApiHomeController@getListPost');
        // list product
        Route::get('/product/list','ApiHomeController@getListProduct');
    });
    
    // list post
    Route::get('/post/list','ApiPostController@index');
    // post detail
    Route::get('/post/detail/{url}','ApiPostController@getPostDetail');


    // register
    Route::post('/register','ApiHomeController@registerUser');
    // login
    Route::post('/login','ApiHomeController@loginUser');
    // logout user
    Route::get('/logout','ApiHomeController@logoutUser');
    // get user
    Route::get('/user','ApiHomeController@getUserLogin');


    // create product
    Route::get('/product','ApiCreateProductController@getList');
    // range time 1 and time 2
    Route::get('/product/range','ApiCreateProductController@rangeTime');

    // create checkout
    Route::post('/checkout/create','ApiCheckoutController@createOrder');
    // response checkout
    Route::get('/dang-tin-rao-ban','ApiCheckoutController@returnResult');
    

    // product
    // list by categories
    Route::get('/product/list/{url}','ApiListProductController@index');
    // product detail
    Route::get('/product/detail/{url}','ApiProductDetailController@index');

    // seach
    // seach order
    Route::get('/seach/order/{id}','ApiSeachController@seachOrder');
});