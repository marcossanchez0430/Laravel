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

Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'products.index'
]);
Route::get('/browse', [
    'uses' => 'ProductController@getBrowse',
    'as' => 'products.browse'
]);
Route::get('/add-to-cart/{id}', [
    'uses' => 'ProductController@getAddToCart',
    'as' =>'products.addToCart'
]);
Route::get('/reduce/{id}', [
    'uses' => 'ProductController@getReduceByOne',
    'as' => 'products.reduceByOne'
]);
Route::get('/remove/{id}', [
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'products.remove'
]);
Route::get('/shopping-cart', [
    'uses' => 'ProductController@getCart',
    'as' =>'products.shoppingCart'
]);
Route::get('/checkout', [
    'uses' => 'ProductController@getCheckout',
    'as' =>'checkout',
    'middleware' => 'auth'
]);
Route::post('/checkout', [
    'uses' => 'ProductController@postCheckout',
    'as' =>'checkout',
    'middleware' => 'auth'
]);
Route::get('/profiles/{name}', [
    'uses' => 'ProductController@getProfiles',
    'as' =>'profiles'
]);
Route::get('/food', [
    'uses' => 'ProductController@getFood',
    'as' => 'food'
]);
Route::get('/clothes', [
    'uses' => 'ProductController@getClothes',
    'as' => 'clothes'
]);
Route::get('/entertainment', [
    'uses' => 'ProductController@getEntertainment',
    'as' => 'entertainment'
]);
Route::get('/etc', [
    'uses' => 'ProductController@getEtc',
    'as' => 'etc'
]);


Route::group(['prefix' =>'user'], function() {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);
        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);

        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);
        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);
    });
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', [
            'uses' => 'UserController@getProfile',
            'as' => 'user.profile'
        ]);
        Route::get('/recommend', [
            'uses' => 'UserController@getRecommend',
            'as' =>'user.recommend'
        ]);
        Route::post('/recommend', [
            'uses' => 'UserController@postRecommend',
            'as' =>'user.recommend'
        ]);

        Route::get('/logout', [
            'uses' => 'UserController@getLogout',
            'as' => 'user.logout'
        ]);
    });
});


