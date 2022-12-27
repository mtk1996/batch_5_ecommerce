<?php

use Illuminate\Support\Facades\Route;

//test
Route::get('/', function () {
    return view('home');
});
Route::get('/test', function () {
    return view('welcome');
});
Route::group(['namespace' => 'Admin', 'prefix' => "admin"], function () {
    Route::get('/login', 'AuthController@login');
    Route::post('/login', 'AuthController@postLogin');
    Route::get('/logout', 'AuthController@logout');

    Route::group(['middleware' => "RedirectIfNotAdminAuth"], function () {
        Route::get('/', 'DashboardController@show');
        Route::resource('/supplier', 'SupplierController');
        Route::resource('/brand', 'BrandController');
        Route::resource('/category', 'CategoryController');
        Route::resource('/product', 'ProductController');
        Route::resource('/product-transaction', 'ProductAddTransactionController');
    });
});
