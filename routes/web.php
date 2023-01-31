<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

//test
Route::get('/', 'PageController@home');

Route::get('/products', 'PageController@allProduct');
Route::get('/product/{slug}', 'PageController@productDetail');
Route::get('/profile', 'ProfileController@showProfile');

// api route
Route::group(['prefix' => 'api'], function () {
    Route::post('/add-to-cart', 'CartController@addToCart');
    Route::get('/product-review/{product_slug}', 'ProductController@review');

    Route::post('/make-review', 'ProductController@makeReview');

    Route::get('/cart', 'ProfileController@cart');
    Route::post('/remove-cart', 'ProfileController@removeCart');
    Route::post('/cart-qty/add', 'ProfileController@addCartQty');

    Route::post('/make-order', 'ProfileController@makeOrder');
    Route::get('/order', 'OrderController@all');

    Route::post('/change-password', 'ProfileController@changePassword');
});


//auth
Route::get('/login', 'AuthController@showLogin');
Route::post('/login', 'AuthController@login');
Route::get('/register', 'AuthController@showRegister');
Route::post('/register', 'AuthController@register');
Route::get('/logout', 'AuthController@logout');

Route::get('/test', function () {
    return Brand::paginate(2);
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

        Route::get('/order', 'OrderController@index');
        Route::get('/order-status', 'OrderController@changeStatus');
    });
});

Route::get('/lang/{language}', function ($language) { //mm en
    session()->put('language', $language);

    $lang = $language == 'mm' ? 'မြန်မာ' : 'English';
    return redirect()->back()->with('success', 'Language Switch To ' . $lang);
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
