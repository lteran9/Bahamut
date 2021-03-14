<?php

namespace App\Jobs;

use App\Bahamut;
use App\Models\ProductTicker;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Shared\Log\Error;

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
        try {
            $product = 'BTC-USD';

            $ticker = $bhm->getProductTicker($product);

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
        } catch (Exception $ex) {
            // not reaching log
            Error::Log('0.0.0.0', 'Hearbeat@handle', $ex);
        }
    }
}
