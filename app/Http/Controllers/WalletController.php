<?php

namespace App\Http\Controllers;

use Exception;
use Shared\Log\Error;
use App\Models\Wallet;
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

            $wallet = Wallet::where('id', $request->input('id'))->first();
            if (isset($wallet)) {
                $wallet->balance = $wallet->balance + $request->input('amount');
                $wallet->save();
            } else {
                return ['wallet' => 'not set'];
            }
        } catch (Exception $ex) {
            Error::Log($request->ip(), 'WalletController@list', $ex);
        }

        return redirect()->route('portfolios.find', ['id' => $request->input('portfolio-id')]);
    }
}
