<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
   // localhost/orders/place
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

         Order::create([

         ]);
      } catch (Exception $ex) {
         return [
            'error' => $ex->getMessage()
         ];
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
