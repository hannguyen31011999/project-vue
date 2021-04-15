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
    Route::get('/province','ViewController@viewWard');
});

// user
Route::group(['namespace'=>'frontend'],function(){
    // index
    Route::get('/','ViewFrontendController@viewIndex');
});
