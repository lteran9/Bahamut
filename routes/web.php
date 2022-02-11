<?php

use App\Bahamut;
use App\Mail\CoinReport;
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

Route::get('/', 'HomeController@home')->name('home');

Route::get('/currency', 'CurrencyController@currency')->name('currency');

Route::get('/exchange', 'ExchangeController@index')->name('exchange');
Route::get('/exchange/{coin}', 'ExchangeController@coin')->name('exchange.coin');

Route::post('/exchange/orders', 'ExchangeController@orders')->name('exchange.orders');

Route::get('/products', 'ProductController@list')->name('products');
Route::get('/products/{id}/history', 'ProductController@history')->name('products.history');
Route::get('/products/{id}/book', 'ProductController@orderBook')->name('products.order-book');
Route::get('/products/{id}/stats', 'ProductController@stats')->name('products.stats');
Route::get('/products/email', 'ProductController@email')->name('products.mail');

Route::post('/products/history/search', 'ProductController@getHistory')->name('products.history.search');

Route::get('/portfolios', 'PortfolioController@list')->name('portfolios');
// Using RegEx to validate id is a UUID
Route::get('/portfolios/add/{id}', 'PortfolioController@add')->where('id', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}')->name('portfolios.add');
Route::get('/portfolios/edit/{id}', 'PortfolioController@edit')->where('id', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}')->name('portfolios.edit');
Route::get('/portfolios/{id}/accounts', 'PortfolioController@accounts')->where('id', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}')->name('portfolios.accounts');

Route::post('/portfolios/create', 'PortfolioController@create')->name('portfolios.create');
Route::post('/portfolios/update', 'PortfolioController@update')->name('portfolios.update');
Route::post('/portfolios/sync', 'PortfolioController@synchronize')->name('portfolios.sync');
