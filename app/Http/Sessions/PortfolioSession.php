<?php

namespace App\Http\Sessions;

class PortfolioSession extends BahamutSession
{
    /**
     * @var \Illuminate\Support\Collection
     */
    public $coinbaseProfiles;

    /**
     * @var \Illuminate\Support\Collection
     */
    public $bahamutProfiles;

    // Static //

    /**
     * Specify unique session name.
     */
    public static $sessionName = 'BahamutSession.PortfolioSession';

    /**
     * Overwrite parent function.
     */
    public static function Build(): BahamutSession
    {
        return new PortfolioSession;
    }
}
