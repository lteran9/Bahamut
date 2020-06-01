<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/exchange', function() {
    return view('exchange.feed.index');
});

Route::get('/products', 'ProductController@list')->name('products');
Route::get('/products/history/{id}', 'ProductController@history')->name('products.history');

Route::post('/products/history/search', 'ProductController@getHistory')->name('products.history.search');

Route::get('/profiles', 'ProfileController@list')->name('profiles');
