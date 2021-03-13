<?php

namespace App;

use Exception;
use Shared\Log\Error;
use App\Models\ApiKey;
use App\Models\Order;
use App\Models\Product;
use Coinbase\Pro\Client;
use Illuminate\Support\Str;
use Coinbase\Pro\Requests\Headers;
use Illuminate\Support\Facades\Crypt;

/**
 * This class takes care of synicing data between Coinbase and Bahamut.
 */
class Bahamut
{
    private $coinbaseAPI;

    function __construct(Client $client)
    {
        $this->coinbaseAPI = $client;
    }

    /**
     * Get all available profiles for the main account.
     */
    function getProfiles()
    {
        $coinbaseProfiles = new \Coinbase\Pro\Profiles\Profiles($this->coinbaseAPI);
        $coinbaseProfiles = $coinbaseProfiles->get();

        return $coinbaseProfiles;
    }

    /**
     * Get the accounts for the profile public key.
     */
    function getAccounts()
    {
        $accounts = new \Coinbase\Pro\Accounts\Accounts($this->coinbaseAPI);
        $accounts = $accounts->get();

        return $accounts;
    }

    /**
     *
     */
    function getCoins()
    {
        $coinbaseProducts = new \Coinbase\Pro\MarketData\Products\Products($this->coinbaseAPI);
        $coinbaseProducts = $coinbaseProducts->get();

        if (isset($coinbaseProducts) && count($coinbaseProducts) > 0) {
            foreach ($coinbaseProducts as $product) {
                $dbProduct = Product::find($product->id);

                if (!isset($dbProduct)) {
                    Product::create([
                        'id' => $product->id,
                        'base_currency' => $product->base_currency,
                        'quote_currency' => $product->quote_currency,
                        'base_min_size' => $product->base_min_size,
                        'base_max_size' => $product->base_max_size,
                        'quote_increment' => $product->quote_increment,
                        'base_increment' => $product->base_increment,
                        'display_name' => $product->display_name,
                        'min_market_funds' => $product->min_market_funds,
                        'max_market_funds' => $product->max_market_funds
                    ]);
                }
            }
        }

        return $coinbaseProducts;
    }

    /**
     *
     */
    function getCurrency()
    {
        $currency = new \Coinbase\Pro\MarketData\Currencies\Currencies($this->coinbaseAPI);
        $currency = $currency->get();

        return $currency;
    }

    /**
     *Get 24-Hour stats for product.
     */
    function getStats(string $product)
    {
        if (strlen($product) > 0) {
            $stats24hour = new \Coinbase\Pro\MarketData\Products\Stats($this->coinbaseAPI);
            $stats24hour->product_id = $product;

            return $stats24hour->get();
        }

        return null;
    }

    /**
     * Get  trade history for product during the specified time period.
     */
    function getTradeHistory($product, $start, $end, $granularity)
    {
        if (isset($product) && isset($start) && isset($end) && isset($granularity)) {
            $coinbaseTradeHistory = new \Coinbase\Pro\MarketData\Products\History($this->coinbaseAPI);

            $granularity = ctype_digit($granularity) ? intval($granularity) * 60 : 3600;

            $coinbaseTradeHistory->product_id = $product;
            $coinbaseTradeHistory->start = $start;
            $coinbaseTradeHistory->end = $end;
            $coinbaseTradeHistory->granularity = $granularity;

            return $coinbaseTradeHistory->get();
        }

        return null;
    }

    /**
     *
     */
    function getProductBook(string $product)
    {
        if (isset($product)) {
            $productBook = new \Coinbase\Pro\MarketData\Products\Book($this->coinbaseAPI);
            $productBook->product_id = $product;

            return $productBook->get();
        }

        return null;
    }

    /**
     *
     */
    function updateAPIKeys(ApiKey $keys): bool
    {
        if (isset($keys)) {
            $newHeaders = new Headers(
                Crypt::decryptString($keys->public_key),
                Crypt::decryptString($keys->secret_key),
                Crypt::decryptString($keys->passphrase)
            );

            $this->coinbaseAPI->updateHeaders($newHeaders);

            return true;
        }

        return false;
    }

    /**
     * Snapshot information about the last trade (tick), best bid/ask and 24h volume.
     */
    function getProductTicker($product)
    {
        $tickerRequest = new \Coinbase\Pro\MarketData\Products\Ticker($this->coinbaseAPI);
        $tickerRequest->product_id = $product;

        $tickerResponse = $tickerRequest->get();

        return $tickerResponse;
    }

    /**
     * @return float
     */
    function getPrice($product): float
    {
        $ticker = $this->getProductTicker($product);
        if (isset($ticker)) {
            return $ticker['price'];
        }

        return 0;
    }


    // <LOCAL> //

    /**
     * @return float
     */
    public function getHoldingSize($product): float
    {
        $orders = Order::where('product_id', '=', $product)->get();

        $bought = $orders->where('side', '=', 'buy')->sum('size') ?? 0;
        $sold = $orders->where('side', '=', 'sell')->sum('size') ?? 0;

        return $bought - $sold;
    }

    /**
     * @return App\Models\Order
     */
    public function placeOrder(string $product, string $side, float $size, float $price)
    {
        Order::create([
            'coinbase_id' => Str::uuid(),
            'price' => $price,
            'size' => $size,
            'side' => $side,
            'product_id' => $product,
        ]);
    }
}
