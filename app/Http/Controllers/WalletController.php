<?php

namespace App\Http\Controllers;

use App\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
   
   // [HttpPost, route('wallet.deposit')]
   public function deposit(Request $request)
   {
      try {
         $validator = Validator::make($request->all(), [
            'id' => 'required',
            'amount' => 'required',
         ]);

         if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
         }

         $wallet = Wallet::find($request->input('id'));
         $wallet = $wallet + $request->input('amount');
         $wallet->save();

         return [
            'success' => 'success'
         ];
      } catch (Exception $ex) {
         //
      }

      return [
         'error' => 'error'
      ];
   }
}
