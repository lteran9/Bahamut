<?php

namespace App\Jobs;

use App\Bahamut;
use App\ProductTicker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Heartbeat implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


   /**
    * Create a new job instance.
    *
    * @return void
    */
   public function __construct()
   {
      //
   }

   /**
    * Execute the job.
    *
    * @return void
    */
   public function handle(Bahamut $bhm)
   {
      $product = 'BTC-USD';

      $ticker = $bhm->getTicker($product);

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
   }
}
