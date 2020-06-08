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

Route::get('/exchange', 'ExchangeController@index')->name('exchange');

Route::post('/exchange/tick', 'ExchangeController@tick')->name('exchange.tick');

Route::get('/products', 'ProductController@list')->name('products');
Route::get('/products/history/{id}', 'ProductController@history')->name('products.history');
Route::get('/products/{id}/stats', 'ProductController@stats')->name('products.stats');

Route::post('/products/history/search', 'ProductController@getHistory')->name('products.history.search');

Route::get('/profiles', 'ProfileController@list')->name('profiles');
