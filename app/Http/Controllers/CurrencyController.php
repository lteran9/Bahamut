<?php

namespace App\Http\Controllers;

use App\Bahamut;
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
       $currencies = $this->system->getCurrency();

       return compact('currencies');
       return view('currency.index', compact('currencies'));
    }
}
