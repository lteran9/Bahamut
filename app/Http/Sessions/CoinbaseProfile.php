<?php

namespace App\Http\Sessions;

class CoinbaseProfile implements BahamutSession
{

    /**
     * UUID
     *
     * @var string
     */
    public $id;

    public function __construct()
    {
        $this->id = '';
    }

    // Static //

    /**
     * Specify unique session name.
     */
    public static $sessionName = 'BahamutSession.CoinbaseProfile';

    /**
     * Overwrite parent function.
     */
    public static function Build(): BahamutSession
    {
        return new CoinbaseProfile;
    }
}
