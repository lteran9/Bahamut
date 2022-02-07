<?php

namespace App\Mail\Reports;

class Coin
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var \Illuminate\Support\Collection
     */
    public $stats;

    /**
     * @var \Illuminate\Support\Collection
     */
    public $history;

    public function __construct($id, \App\Bahamut $api)
    {
        $this->id = $id;
        $this->stats = collect([]);
        $this->history = collect([]);

        if (isset($api)) {
            // 24 hour stats
            $this->stats = $api->getStats($id);

            // Closing prices at midnight 7, 28, and 90 days ago
            $price7days = $api->getTradeHistory($id, date('Y-m-d 00:00:00', strtotime('-7 day')), date('Y-m-d 00:00:00', strtotime('-7 day')), 5)[0];
            $price28days = $api->getTradeHistory($id, date('Y-m-d 00:00:00', strtotime('-28 day')), date('Y-m-d 00:00:00', strtotime('-28 day')), 5)[0];
            $price90days = $api->getTradeHistory($id, date('Y-m-d 00:00:00', strtotime('-90 day')), date('Y-m-d 00:00:00', strtotime('-90 day')), 5)[0];

            $this->history->add($price7days);
            $this->history->add($price28days);
            $this->history->add($price90days);
        }
    }
}
