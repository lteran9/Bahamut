<?php

namespace App\Http\Controllers;

use Exception;
use App\ApiKey;
use App\Bahamut;
use App\Portfolio;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

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
      $portfolios = $this->system->getProfiles();

      return view('portfolios.add', compact('portfolios'));
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
      $wallets = Wallet::all();//$this->system->getAccounts();
      $portfolio = Portfolio::find($id);

      if (isset($portfolio)) {
         return view('portfolios.index', compact('portfolio', 'wallets'));
      }

      return view('portfolios.index');
   }

   // [HttpPost, route('portfolios.create')]
   public function create(Request $request)
   {
      //try {
      $validator = Validator::make($request->all(), [
         'id' => 'required',
         'secret-key' => 'required',
         'public-key' => 'required',
         'passphrase' => 'required',
      ]);

      if ($validator->fails()) {
         return back()->withErrors($validator->errors())->withInput();
      }

      $portfolios = $this->system->getProfiles();
      $selected = $portfolios->where('id', '=', $request->input('id'))->first();

      $dbCheck = Portfolio::find($request->input('id'));
      if (!isset($dbCheck) && isset($selected)) {
         Portfolio::create([
            'id' => $selected->id,
            'name' => $selected->name,
            'active' => $selected->active,
            'is_default' => $selected->is_default,
            'coinbase_created_at' => date('Y-m-d H:i:s', strtotime($selected->created_at))
         ]);

         $api = ApiKey::create([
            'id' => Str::uuid(),
            'secret' => $request->input('secret-key'),
            'public' => $request->input('public-key'),
            'passphrase' => $request->input('passphrase'),
            'portfolio_id' => $selected->id
         ]);

         $this->system->updateAPIKeys($api);

         $accounts = $this->system->getAccounts();

         foreach($accounts as $account) {
            $dbCheck = Wallet::find($account->id);
            if (!isset($dbCheck)) {
               Wallet::create([
                  'id' => $account->id,
                  'name' => $account->name,
                  'currency' => $account->currency,
               ]);
            }
         }
      } else {
         // Add Error
      }
      // } catch (Exception $ex) {
      //    // Add Error
      // }

      return redirect()->route('portfolios');
   }

   // [HttpPost, route('portfolios.update')]
   public function update(Request $request)
   {
      //
   }
}
