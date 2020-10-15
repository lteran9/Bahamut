<?php

namespace App\Http\Controllers;

use App\Bahamut;
use App\Product;
use Illuminate\Http\Request;
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
    public function history($id, Request $request)
    {
        $fromdate = $request->session()->get('from_date');

        return view('products.history', compact('id', 'fromdate'));
    }

    // [HttpGet, route('products.order-book')]
    public function orderBook($id)
    {
        $product = $id;
        $orders = $this->system->getProductBook($id);
        //return compact('orders');
        return view('products.order-book', compact('product', 'orders'));
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
            $end = $request->input('from-date') . 'T23:59:59';
            $history = $this->system->getTradeHistory($product, $start, $end, $granularity);

            $closingPrices = $history->map(function ($record) {
                return (object) [
                    'time' => date('Y-m-d\TH:i:s\Z', $record[0]),
                    'price' => $record[4]
                ];
            });

            $candles = $history->map(function ($record) {
                return (object) [
                    'time' => date('Y-m-d\TH:i:s\Z', $record[0]),
                    'low' => $record[1],
                    'high' => $record[2],
                    'open' => $record[3],
                    'close' => $record[4],
                    'volume' => $record[5]
                ];
            });

            $request->session()->put('from_date', $request->input('from-date'));

            return view('products._result', compact('history', 'closingPrices', 'candles'));
        }

        return ['Error' => 'Missing a parameter'];
    }
}
