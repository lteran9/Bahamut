<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductHistory;
use App\ProductTrades;
use Illuminate\Http\Request;
use Coinbase\Pro\Client as HttpClient;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
   private $coinbaseAPI;

   function __construct(HttpClient $client)
   {
      $this->coinbaseAPI = $client;
   }

   // [HttpGet, route('products')]
   public function list()
   {
      $coinbaseProducts = new \Coinbase\Pro\MarketData\Products\Products($this->coinbaseAPI);
      $coinbaseProducts = $coinbaseProducts->get();
      //return compact('coinbaseProducts');
      if (isset($coinbaseProducts) && count($coinbaseProducts) > 0) {
         foreach ($coinbaseProducts as $product) {
            $dbProduct = Product::find($product->id);

            if (!isset($dbProduct)) {
               Product::create([
                  'id' => $product->id,
                  'base_currency' => $product->base_currency,
                  'quote_currency' => $product->quote_currency,
                  'base_min_size' => $product->base_min_size,
                  'base_max_size' => $product->base_max_size,
                  'quote_increment' => $product->quote_increment,
                  'base_increment' => $product->base_increment,
                  'display_name' => $product->display_name,
                  'min_market_funds' => $product->min_market_funds,
                  'max_market_funds' => $product->max_market_funds
               ]);
            }
         }
      }

      $products = Product::all();
      //return compact('coinbaseProducts');
      return view('products.list', compact('products'));
   }

   // [HttpGet, route('products.history')]
   public function history($id)
   {
      return view('products.history', compact('id'));
   }

   // [HttpGet, route('products.stats')]
   public function stats($id)
   {
      if (strlen($id) > 0) {
         $stats24hour = new \Coinbase\Pro\MarketData\Products\Stats($this->coinbaseAPI);

         $stats24hour->product_id = $id;

         $stats = $stats24hour->get();
         $product = $id;

         return view('products.stats', compact('stats', 'product'));
      }

      return redirect()->route('products');
   }

   // [HttpPost, route('products.history.search')]
   public function getHistory(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'id' => 'required',
         'from-date' => 'required',
         'to-date' => 'required',
         'time-period' => 'required'
      ]);

      if ($validator->fails()) {
         return back()->withErrors($validator->errors())->withInput();
      }

      $id = $request->input('id');
      if (strlen($id) > 0) {
         $coinbaseTradeHistory = new \Coinbase\Pro\MarketData\Products\History($this->coinbaseAPI);

         $granularity = ctype_digit($request->input('time-period')) ? intval($request->input('time-period')) * 60 : 3600;

         $coinbaseTradeHistory->product_id = $id;
         $coinbaseTradeHistory->start = $request->input('from-date') . 'T00:00:00';
         $coinbaseTradeHistory->end = $request->input('to-date') . 'T23:59:59';
         $coinbaseTradeHistory->granularity = $granularity;

         $history = $coinbaseTradeHistory->get();

         return view('products.history', compact('history', 'id'));
      }

      return redirect()->route('products.history', ['id' => $id]);
   }
}
