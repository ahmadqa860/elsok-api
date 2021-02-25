<?php

use Illuminate\Auth\TokenGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function () {

    Route::group(['middleware' => 'ShopOwnerRole'], function () {
        Route::resource('shop/my-products', 'api\ShopProductsController');
        Route::resource('shop/my-shop', 'api\ShopController');
        Route::resource('shop/landing-page', 'api\LandingPageController');
    });

    Route::resource('user/profile', 'api\ProfileController');

    Route::post('owner/register', 'api\shopOwnerController@register');

    Route::resource('seller', 'api\SellerController');
    Route::resource('seller-products', 'api\SellerProductsController');
});

Route::get('shop/products', 'api\ProductsController@getProducts');
Route::get('shop/products/{id}', 'api\ProductsController@getProductDetails');
Route::get('shop/productContact/{id}','api\ProductsController@getProductContactDetails');
Route::get('categories','api\CategoriesController@getCategories');
Route::get('shop/{categoryUrl}', 'api\CategoriesController@getCategoryProducts');
