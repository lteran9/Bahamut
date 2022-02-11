<?php

namespace App\Http\Sessions;

use Exception;
use Illuminate\Session\Store;

/**
 * A base class to handle repetitive logic when it comes to session management.
 */
class BahamutSession
{
    /**
     * Should override this name locally.
     *
     * @var string
     */
    public static $sessionName = 'ESession';

    /**
     * Return the object in session. If not in session create's a new object and puts in session.
     *
     * @return \App\Http\Sessions\BahamutSession
     */
    public static function Get(Store $store): BahamutSession
    {
        if ($store->get(static::$sessionName) == null) {
            BahamutSession::Put($store, static::Build());
        }

        return $store->get(static::$sessionName);
    }

    /**
     * Put an object in session.
     */
    public static function Put(Store $store, ?BahamutSession $session): void
    {
        $store->put($session::$sessionName, $session);
    }

    /**
     * Destroy the object from session by creating a new instance of the same object.
     */
    public static function Destroy(Store $store): void
    {
        BahamutSession::Put($store, static::Build());
    }

    /**
     * Destroys all sessions managed by Bahamut.
     */
    public static function DestroyAll(Store $store): void
    {
        // Delete all sessions
    }

    /**
     *
     *
     * @return \App\Http\Sessions\BahamutSession
     */
    public static function Build(): BahamutSession
    {
        return static::Build();
    }
}
