<?php

namespace App\Http\Controllers;

use Exception;
use App\Bahamut;
use App\Models\CoinbaseTicker;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
{
    /**
     * @var \App\Bahamut
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
            // Log Exception
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
            // Log Exception
        }

        return view('exchange.coin');
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
            // Log Exception
        }

        return back()->withErrors(['' => 'Unable to complete purchase.'], $request->input('side', 'buy'));
    }
}
