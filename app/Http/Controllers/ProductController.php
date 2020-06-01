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
        // if (strlen($id) > 0) {
        //     $coinbaseTradeHistory = new \Coinbase\Pro\MarketData\Products\History($this->coinbaseAPI);

        //     $coinbaseTradeHistory->product_id = $id;
        //     $coinbaseTradeHistory->start = '2020-05-31';
        //     $coinbaseTradeHistory->end = '2020-06-01';
        //     $coinbaseTradeHistory->granularity = '300';

        //     $coinbaseTradeHistory = $coinbaseTradeHistory->get();

        //     return compact('coinbaseTradeHistory');
        // }

        return view('products.history', compact('id'));
    }

    // [HttpPost, route('products.history.search')]
    public function getHistory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'from-date' => 'required',
            'to-date' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $id = $request->input('id');
        if (strlen($id) > 0) {
            $coinbaseTradeHistory = new \Coinbase\Pro\MarketData\Products\History($this->coinbaseAPI);

            $coinbaseTradeHistory->product_id = $id;
            $coinbaseTradeHistory->start = $request->input('from-date');
            $coinbaseTradeHistory->end = $request->input('to-date');
            $coinbaseTradeHistory->granularity = '3600';

            $coinbaseTradeHistory = $coinbaseTradeHistory->get();

            foreach ($coinbaseTradeHistory as $trade) {
                $time = $trade[0];
                $low = $trade[1];
                $high = $trade[2];
                $open = $trade[3];
                $close = $trade[4];
                $volume = $trade[5];

                $dbTrade = ProductHistory::where([['time', '=', $time], ['product_id', '=', $id]])->first();
                if (!isset($dbTrade)) {
                    ProductHistory::create([
                        'product_id' => (string)$id,
                        'time' => $time,
                        'low' => $low,
                        'high' => $high,
                        'open' => $open,
                        'close' => $close,
                        'volume' => $volume
                    ]);
                }
            }
        }

        return redirect()->route('products.history', ['id' => $id]);
    }
}
