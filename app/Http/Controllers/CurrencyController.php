<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Bahamut;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private $system;

    function __construct(Bahamut $bhm)
    {
        $this->system = $bhm;
    }

    // [HttpGet, route('currency')]
    public function currency()
    {
        try {
            $currencies = $this->system->getCurrency();

            return view('currency.index', compact('currencies'));
        } catch (Exception $ex) {
            // Log Error
        }

        return abort(500);
    }
}
