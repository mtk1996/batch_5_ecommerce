<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

//test
Route::get('/', 'PageController@home');
Route::get('/products', 'PageController@allProduct');

Route::get('/test', function () {
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
