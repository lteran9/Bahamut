<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Share a single instance of the Bahamut class
        $this->app->singleton(\App\Bahamut::class, function ($app) {
            // Create a reference to the Coinbase API
            $api = new \Coinbase\Pro\Client(
                config('coinbase.public_key'),
                config('coinbase.secret_key'),
                config('coinbase.passphrase')
            );

            // Initialize our API wrapper (which does more things than that)
            return new \App\Bahamut($api);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Boot settings
    }
}
