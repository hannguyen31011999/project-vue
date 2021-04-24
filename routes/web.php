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

Route::get('/index', function () {
    return view('frontend.master');
});

// login
Route::get('/admin/login','backend\ViewController@viewLogin');

// admin
Route::group(['middleware' => 'check.jwt','prefix'=>'admin','namespace'=>'backend'], function () {
    // dashboard
    Route::get('/dashboard','ViewController@viewDashBoard');
    // Categories
    Route::get('/categories','ViewController@viewCategories');
    // TypeProduct
    Route::get('/type','ViewController@viewTypeProduct');
    // User
    Route::get('/user','ViewController@viewUser');
    // Province
    Route::get('/province','ViewController@viewProvince');
    // District
    Route::get('/district','ViewController@viewDistrict');
    // Ward
    Route::get('/ward','ViewController@viewWard');
    // Post
    Route::get('/post','ViewController@viewPost');
});

// user
Route::group(['namespace'=>'frontend'],function(){
    // index
    Route::get('/','ViewFrontendController@viewIndex');
    // post detail
    Route::get('/bai-viet/{url}','ViewFrontendController@viewPostDetail');
    // post
    Route::get('/bai-viet','ViewFrontendController@viewPost');
    // create product
    Route::get('/dang-tin-rao-ban','ViewFrontendController@viewCreateProduct');
    // list product
    Route::get('/{url}','ViewFrontendController@listProduct');
    // detail product
    Route::get('/tin-rao-ban/{url}','ViewFrontendController@detailProduct');
});
