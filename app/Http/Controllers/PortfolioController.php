<?php

namespace App\Http\Controllers;

use App\Bahamut;
use App\Portfolio;
use Illuminate\Http\Request;
use Coinbase\Pro\Client as HttpClient;

class PortfolioController extends Controller
{
   private $system;

   function __construct(Bahamut $bhm)
   {
      $this->system = $bhm;
   }

   // [HttpGet, route('porftolios')]
   public function list(Request $request)
   {
      $portfolios = Portfolio::all();

      return view('portfolios.list', compact('portfolios'));
   }

   // [HttpGet, route('porfolios.add')]
   public function add()
   {
      return view('portfolios.add');
   }

   // [HttpGet, route('porfolios.edit')]
   public function edit($id)
   {
      $portfolio = Portfolio::find($id);

      return view('portfolios.edit', compact('portfolio'));
   }

   // [HttpGet, route('portfolios.find')]
   public function find($id)
   {
      $portfolio = Portfolio::find($id);
      if (isset($portfolio)) {
         return view('portfolios.index', compact('portfolio'));
      }

      return view('portfolios.index');
   }

   // [HttpPost, route('portfolios.create')]
   public function create(Request $request)
   {
      //
   }

   // [HttpPost, route('portfolios.update')]
   public function update(Request $request)
   {
      //
   }
}
