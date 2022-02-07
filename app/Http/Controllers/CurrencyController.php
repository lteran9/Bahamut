<?php

namespace App\Http\Controllers;

use Exception;
use App\Bahamut;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * @var \App\Bahamut
     */
    private $api;

    function __construct(Bahamut $bhm)
    {
        $this->api = $bhm;
    }

    // [HttpGet, route('currency')]
    public function currency(Request $request)
    {
        try {
            $currencies = $this->api->getCurrency();

            return view('currency.index', compact('currencies'));
        } catch (Exception $ex) {
            // Log Exception
        }
    }
}
