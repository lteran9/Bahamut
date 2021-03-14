<?php

namespace App\Mail;

use App\Bahamut;
use App\Mail\Reports\Coin;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CoinReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *
     */
    public $coins;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bahamut $api)
    {
        $this->coins = array();

        $favorites = Product::where('rank', '>', 0)->get();
        foreach($favorites as $fav)
        {
            array_push($this->coins, new Coin($fav->id, $api));
            // Prevent a 429 response from service
            sleep(1);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.reports.coin');
    }
}
