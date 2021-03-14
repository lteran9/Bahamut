<?php

use App\Http\Controllers\ExchangeController;
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

Route::get('/currency', 'CurrencyController@currency')->name('currency');

Route::get('/examples', 'OrderController@example');

Route::get('/exchange', 'ExchangeController@index')->name('exchange');
Route::get('/exchange/{coin}', 'ExchangeController@coin')->name('exchange.coin');

Route::post('/exchange/tick', 'ExchangeController@tick')->name('exchange.tick');
Route::post('/exchange/orders', 'ExchangeController@orders')->name('exchange.orders');

Route::get('/products', 'ProductController@list')->name('products');
Route::get('/products/history/{id}', 'ProductController@history')->name('products.history');
Route::get('/products/book/{id}', 'ProductController@orderBook')->name('products.order-book');
Route::get('/products/{id}/stats', 'ProductController@stats')->name('products.stats');
Route::get('/products/email', 'ProductController@email')->name('products.mail');

Route::post('/products/history/search', 'ProductController@getHistory')->name('products.history.search');

Route::get('/portfolios', 'PortfolioController@list')->name('portfolios');
Route::get('/portfolios/add', 'PortfolioController@add')->name('portfolios.add');
Route::get('/portfolios/edit/{id}', 'PortfolioController@edit')->name('portfolios.edit');
Route::get('/portfolios/{id}/accounts', 'PortfolioController@accounts')->where('id', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}')->name('portfolios.accounts');

Route::post('/portfolios/create', 'PortfolioController@create')->name('portfolios.create');
Route::post('/portfolios/update', 'PortfolioController@update')->name('portfolios.update');
Route::post('/portfolios/sync', 'PortfolioController@synchronize')->name('portfolios.sync');
