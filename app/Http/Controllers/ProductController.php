<?php

namespace App\Http\Controllers;

use App\Bahamut;
use App\Product;
use App\ProductHistory;
use App\ProductTrades;
use Illuminate\Http\Request;
use Coinbase\Pro\Client as HttpClient;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
   private $system;

   function __construct(Bahamut $bhm)
   {
      $this->system = $bhm;
   }

   // [HttpGet, route('products')]
   public function list()
   {
      $coins = $this->system->getCoins();

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
         $product = $id;
         $stats = $this->system->getStats($id);

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
         $product = $id;
         $granularity = $request->input('time-period');

         $adjStart = \DateTime::createFromFormat('Y-m-d', $request->input('from-date'));
         if (intval($granularity) != '1' || intval($granularity) != '5') {
            $adjStart->sub(new \DateInterval('P1D'));
         }

         $start = $adjStart->format('Y-m-d') . 'T00:00:00';
         $end = $request->input('to-date') . 'T23:59:59';
         $history = $this->system->getTradeHistory($product, $start, $end, $granularity);

         $closingPrices = $history->map(function ($record) {
            return (object) [
               'time' => date('Y-m-d\TH:i:s\Z', $record[0]),
               'price' => $record[4]
            ];
         });

         return view('products._result', compact('history', 'closingPrices'));
      }

      return ['Error' => 'Missing a parameter'];
   }
}
