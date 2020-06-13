<?php

namespace App;

use Illuminate\Support\Str;
use \Coinbase\Pro\Client;

class Bahamut
{

   private $coinbaseAPI;

   function __construct(Client $client)
   {
      $this->coinbaseAPI = $client;
   }

   function getProfiles()
   {
      $coinbaseProfiles = new \Coinbase\Pro\Profiles\Profiles($this->coinbaseAPI);
      $coinbaseProfiles = $coinbaseProfiles->get();

      if (count($coinbaseProfiles) > 0) {
         foreach ($coinbaseProfiles as $profile) {
            $dbProfile = Portfolio::find($profile->id);
            if (!isset($dbProfile)) {
               Portfolio::create([
                  'id' => (string) Str::uuid(),
                  'coinbase_id' => $profile->id,
                  'name' => $profile->name,
                  'active' => $profile->active,
                  'is_default' => $profile->is_default,
                  'coinbase_created_at' => date('Y-m-d H:i:s', strtotime($profile->created_at))
               ]);
            }
         }
      }

      return $coinbaseProfiles;
   }

   function getAccounts()
   {
      $coinbaseAccounts = new \Coinbase\Pro\CoinbaseAccounts\CoinbaseAccounts($this->coinbaseAPI);
      $coinbaseAccounts = $coinbaseAccounts->get();
      return $coinbaseAccounts;
   }

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

   function getStats($product)
   {
      if (strlen($product) > 0) {
         $stats24hour = new \Coinbase\Pro\MarketData\Products\Stats($this->coinbaseAPI);
         $stats24hour->product_id = $product;

         return $stats24hour->get();
      }

      return null;
   }

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
}
