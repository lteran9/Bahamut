<?php

use App\Model\Candlestick;

/// Need to find another name
class Bahamut
{

   function __construct($priceData)
   {
      $this->priceData = $priceData;
      $this->candlesticks = $this->createCandlestickArray($priceData);
      $this->movingAverages = new EMA();
   }

   ///
   /// Takes in an array of price points [high,low,open,close]
   ///
   private function createCandlestickArray($data)
   {
      $candlestickArray = [];

      if (isset($data) && count($data) > 0) {
         foreach($data as $dp) {
            array_push($candlestickArray, new Candlestick($dp[0], $dp[1], $dp[2], $dp[3]));
         }
      }

      return $candlestickArray;
   }


}
