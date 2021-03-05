<?php

namespace App\Http\Controllers;

use Exception;
use App\Bahamut;
use Illuminate\Http\Request;
use Shared\Log\Error;

class CurrencyController extends Controller
{
    private $system;

    function __construct(Bahamut $bhm)
    {
        $this->system = $bhm;
    }

    // [HttpGet, route('currency')]
    public function currency(Request $request)
    {
        try {
            throw new Exception('Trigger an Error to be Logged');
            $currencies = $this->system->getCurrency();

            return view('currency.index', compact('currencies'));
        } catch (Exception $ex) {
            if (Error::Log($request->ip(), 'CurrencyController@currency', $ex)) {
                return ['success' => 'true'];
            } else {
                return ['success' => 'false'];
            }
        }
    }
}
