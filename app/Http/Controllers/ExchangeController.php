<?php

namespace App\Http\Controllers;

use Exception;
use App\Bahamut;
use App\Models\Order;
use Shared\Log\Error;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\CoinbaseTicker;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
{
    /**
     * @var App\Bahamut
     */
    private $api;

    public function __construct(Bahamut $bhm)
    {
        $this->api = $bhm;
    }

    // [HttpGet, route('exchange')]
    public function index(Request $request)
    {
        try {
            $favorites = Product::where('rank', '>', 0)->orderBy('rank', 'desc')->orderBy('id')->get();

            foreach($favorites as $fav) {
                $fav['price'] = $this->api->getPrice($fav->id);
                $fav['size'] = $this->api->getHoldingSize($fav->id);
            }

            return view('exchange.index', compact('favorites'));
        } catch (Exception $ex) {
            Error::Log($request->ip(), 'ExchangeController@index', $ex);
        }

        return view('exchange.index');
    }

    // [HttpGet, route('exchange.coin')]
    public function coin($coin, Request $request)
    {
        try {
            $orders = Order::where('product_id', '=', $coin)->orderBy('id', 'desc')->get();

            $purchased = $orders->where('side', '=', 'buy')->sum('size');
            $sold = $orders->where('side', '=', 'sell')->sum('size');
            $balance = $purchased - $sold;

            //return compact('balance');
            return view('exchange.coin', compact('coin', 'orders', 'balance'));
        } catch (Exception $ex) {
            Error::Log($request->ip(), 'ExchangeController@coin', $ex);
        }

        return view('exchange.coin');
    }

    // [HttpPost, route('exchange/tick')]
    public function tick(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'trade_id' => 'required',
                'epoch' => 'required',
                'product_id' => 'required',
                'size' => 'required',
                'price' => 'required',
                'side' => 'required',
                'sequence' => 'required'
            ]);

            if (!$validator->fails()) {
                CoinbaseTicker::create([
                    'trade_id' => $request->input('trade_id'),
                    'epoch' => $request->input('epoch'),
                    'timestamp' => date('Y-m-d H:i:s', strtotime($request->input('epoch'))),
                    'product_id' => $request->input('product_id'),
                    'size' => $request->input('size'),
                    'price' => $request->input('price'),
                    'side' => $request->input('side'),
                    'sequence' => $request->input('sequence')
                ]);
            }
        } catch (Exception $ex) {
            Error::Log($request->ip(), 'ExchangeController@tick', $ex);
        }
    }

    // [HttpPost, route('exchange.orders')]
    public function orders(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'side' => 'required',
                'amount' => 'required|gt:0',
                'product' => 'required'
            ]);

            if ($validator->fails()) {
                if ($request->input('side', 'buy') == 'buy') {
                    return back()->withErrors($validator->errors(), 'buy')->withInput();
                } else {
                    return back()->withErrors($validator->errors(), 'sell')->withInput();
                }
            }

            $price = $this->api->getPrice($request->input('product'));
            $size = $request->input('amount') / $price;

            if ($price > 0 && $size > 0) {
                $this->api->placeOrder($request->input('product'), $request->input('side'), $size, $price);

                return redirect()->route('exchange.coin', ['coin' => $request->input('product')]);
            }

            throw new Exception('Unable to complete coin purhcase: ' . $request->input('product'));
        } catch (Exception $ex) {
            Error::Log($request->ip(), 'ExchangeController@orders', $ex);
        }

        return back()->withErrors(['' => 'Unable to complete purchase.'], $request->input('side', 'buy'));
    }
}
