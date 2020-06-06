<?php

namespace App\Http\Controllers;

use App\CoinbaseTicker;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
{
    // [HttpGet, route('exchange')]
    public function index()
    {
        return view('exchange.feed.index');
    }

    // [HttpPost, route('exchange/tick')]
    public function tick(Request $request) 
    {
        try {
            $validator = Validator::make($request->all(), [
                'trade_id' => 'required',
                'epoch' => 'required',
                'date' => 'required',
                'time' => 'required',
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
                    'timestamp' => date('Y-m-d H:i:s', strtotime($request->input('date') . ' ' . $request->input('time'))),
                    'product_id' => $request->input('product_id'),
                    'size' => $request->input('size'),
                    'price' => $request->input('price'),
                    'side' => $request->input('side'),
                    'sequence' => $request->input('sequence')
                ]);
            }
        } catch (Exception $ex) {
            return [
                'error' => $ex->getMessage()
            ];
        }
    }
}
