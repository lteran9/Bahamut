<?php

namespace App\Http\Controllers;

use Exception;
use App\Bahamut;
use App\Models\ApiKey;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    /**
     * @var \App\Bahamut
     */
    private $api;

    function __construct(Bahamut $bhm)
    {
        $this->api = $bhm;
    }

    // [HttpGet, route('porftolios')]
    public function list(Request $request)
    {
        try {
            // Load trading portfolios
            $portfolios = Portfolio::all();

            return view('portfolios.list', compact('portfolios'));
        } catch (Exception $ex) {
            // Log Exception
        }

        return view('portfolios.list');
    }

    // [HttpGet, route('porfolios.add')]
    public function add(Request $request)
    {
        try {
            $localPortfolios = Portfolio::all()->pluck('id');
            $coinbasePortfolios = $this->api->getProfiles();

            $coinbasePortfolios = $coinbasePortfolios->filter(function ($value, $key) use ($localPortfolios) {
                return $localPortfolios->contains($value->id) == false;
            })->all();

            return view('portfolios.add', compact('coinbasePortfolios'));
        } catch (Exception $ex) {
            // Log Exception
        }

        return view('portfolios.add');
    }

    // [HttpGet, route('porfolios.edit')]
    public function edit($id, Request $request)
    {
        try {
            $portfolio = Portfolio::find($id);

            return view('portfolios.edit', compact('portfolio'));
        } catch (Exception $ex) {
            // Log Exception
        }

        return view('portfolios.edit');
    }

    // [HttpGet, route('portfolios.accounts')]
    public function accounts($id, Request $request)
    {
        try {
            $portfolio = Portfolio::find($id);
            if (isset($portfolio)) {
                $api = ApiKey::where('portfolio_id', '=', $portfolio->id)->first();
                $this->api->updateApiKeys($api);

                $accounts = $this->api->getAccounts();

                return view('portfolios.accounts', compact('portfolio', 'accounts'));
            }
        } catch (Exception $ex) {
            // Log Exception
        }

        return view('portfolios.accounts');
    }

    // [HttpPost, route('portfolios.create')]
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'passphrase' => 'required|max:256',
                'secret-key' => 'required|max:256',
                'public-key' => 'required|max:256',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }

            $portfolios = $this->api->getProfiles();
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

                ApiKey::create([
                    'portfolio_id' => $selected->id,
                    'passphrase' => Crypt::encryptString($request->input('passphrase')),
                    'secret_key' => Crypt::encryptString($request->input('secret-key')),
                    'public_key' => Crypt::encryptString($request->input('public-key')),
                    'transfer' => true,
                    'trade' => true,
                    'view' => true,
                ]);

                // $this->api->updateAPIKeys($api);

                // $accounts = $this->api->getAccounts();
                // $ordinal = 1;

                // foreach ($accounts as $account) {
                //     $dbCheck = Wallet::find($account->id);
                //     if (!isset($dbCheck)) {
                //         // Only concerned in USD wallets
                //         $bhmWallet = Product::where([
                //             ['base_currency', '=', $account->currency],
                //             ['quote_currency', '=', 'USD']
                //         ])->first();

                //         if (isset($bhmWallet)) {
                //             $wallet = Wallet::create([
                //                 'id' => Str::uuid(),
                //                 'coinbase_id' => $account->id,
                //                 'name' => $account->name,
                //                 'currency' => $account->currency,
                //             ]);

                //             Have::create([
                //                 'portfolio_id' => $portfolio->id,
                //                 'wallet_id' => $wallet->id,
                //                 'ordinal' => $ordinal
                //             ]);

                //             // Increment by one
                //             $ordinal = $ordinal + 1;
                //         }
                //     }
                // }
            } else {
                // Add Error
            }
        } catch (Exception $ex) {
            // Log Exception
        }

        return redirect()->route('portfolios');
    }

    // [HttpPost, route('portfolios.update')]
    public function update(Request $request)
    {
        // TODO
    }
}
