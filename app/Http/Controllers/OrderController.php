<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    // [HttpPost, route('order.place')]
    public function place(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'price' => 'required',
                'size' => 'required',
                'side' => 'required',
                'product' => 'required',
                '' => ''
            ]);

            Order::create([]);
        } catch (Exception $ex) {
            // Log Exception
        }

        return [
            'success' => 'Order placed successfully.'
        ];
    }

    public function example()
    {
        return view('example');
    }
}
