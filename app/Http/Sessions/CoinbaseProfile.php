<?php

namespace App\Http\Sessions;

class CoinbaseProfile implements BahamutSession
{

    /**
     * @var uuid
     */
    public $id;

    public function __construct()
    {
        $this->id = '';
    }

    // Static

    public static $sessionName = 'BahamutSession.CoinbaseProfile';

    public static function Build(): BahamutSession
    {
        return new CoinbaseProfile;
    }
}
