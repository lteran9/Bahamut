<?php

namespace App\Http\Controllers;

use Exception;
use App\Pivots\Have;
use App\Models\ApiKey;
use App\Models\Bahamut;
use App\Models\ProductTicker;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $product = 'BTC-USD';

        try {
            $ticker = $this->system->getTicker($product);

            if (isset($ticker)) {
                ProductTicker::create([
                    'trade_id' => $ticker['trade_id'],
                    'product_id' => $product,
                    'price' => $ticker['price'],
                    'size' => $ticker['size'],
                    'bid' => $ticker['bid'],
                    'ask' => $ticker['ask'],
                    'volume' => $ticker['volume'],
                    'time' => date('Y-m-d H:i:s', strtotime($ticker['time']))
                ]);
            }

            $portfolios = Portfolio::all();

            return view('portfolios.list', compact('portfolios'));
        } catch (Exception $ex) {
            //
        }

        return abort(500);
    }

    // [HttpGet, route('porfolios.add')]
    public function add()
    {
        try {
            $portfolios = $this->system->getProfiles();

            return view('portfolios.add', compact('portfolios'));
        } catch (Exception $ex) {
            //
        }

        return abort(500);
    }

    // [HttpGet, route('porfolios.edit')]
    public function edit($id)
    {
        try {
            $portfolio = Portfolio::find($id);

            return view('portfolios.edit', compact('portfolio'));
        } catch (Exception $ex) {
            //
        }

        return abort(500);
    }

    // [HttpGet, route('portfolios.find')]
    public function find($id)
    {
        try {
            $wallets = DB::table('wallets')
                ->join('have', 'wallets.id', '=', 'have.wallet_id')
                ->orderBy('have.ordinal')
                ->get();
            $portfolio = Portfolio::find($id);

            if (isset($portfolio)) {
                return view('portfolios.index', compact('portfolio', 'wallets'));
            }
        } catch (Exception $ex) {
            //
        }

        return view('portfolios.index');
    }

    // [HttpPost, route('portfolios.create')]
    public function create(Request $request)
    {
        try {
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
                $portfolio = Portfolio::create([
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
                $ordinal = 1;

                foreach ($accounts as $account) {
                    $dbCheck = Wallet::find($account->id);
                    if (!isset($dbCheck)) {
                        // Only concerned in USD wallets
                        $bhmWallet = Product::where([
                            ['base_currency', '=', $account->currency],
                            ['quote_currency', '=', 'USD']
                        ])->first();

                        if (isset($bhmWallet)) {
                            $wallet = Wallet::create([
                                'id' => Str::uuid(),
                                'coinbase_id' => $account->id,
                                'name' => $account->name,
                                'currency' => $account->currency,
                            ]);

                            Have::create([
                                'portfolio_id' => $portfolio->id,
                                'wallet_id' => $wallet->id,
                                'ordinal' => $ordinal
                            ]);

                            // Increment by one
                            $ordinal = $ordinal + 1;
                        }
                    }
                }
            } else {
                // Add Error
            }
        } catch (Exception $ex) {
            // Add Error
        }

        return redirect()->route('portfolios');
    }

    // [HttpPost, route('portfolios.update')]
    public function update(Request $request)
    {
        //
    }
}
