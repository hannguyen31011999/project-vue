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
    return view('frontend.master');
});

// login
Route::get('/admin/login','backend\ViewController@viewLogin');

Route::group(['middleware' => 'check.jwt','prefix'=>'admin'], function () {
    // dashboard
    Route::get('/dashboard','backend\ViewController@viewDashBoard');
    // Categories
    Route::get('/categories','backend\ViewController@viewCategories');
    // TypeProduct
    Route::get('/type','backend\ViewController@viewTypeProduct');
});


