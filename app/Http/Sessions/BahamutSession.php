<?php

namespace App\Http\Sessions;

use Exception;
use Illuminate\Session\Store;

class BahamutSession
{
    public static $sessionName = 'ESession';

    public static function Get(Store $store)
    {
        if ($store->get(static::$sessionName) == null) {
            BahamutSession::Put($store, static::Build());
        }

        return $store->get(static::$sessionName);
    }

    public static function Put(Store $store, ?BahamutSession $session)
    {
        $store->put($session::$sessionName, $session);
    }

    public static function Destroy(Store $store)
    {
        BahamutSession::Put($store, static::Build());
    }

    public static function DestroyAll(Store $store)
    {
        // Delete all sessions
    }

    public static function Build(): BahamutSession
    {
        return static::Build();
    }
}
