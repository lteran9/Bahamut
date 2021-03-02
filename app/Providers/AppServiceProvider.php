<?php

namespace App\Providers;

use Shared\Settings;
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
      $this->app->singleton(\App\Bahamut::class, function ($app) {
         $api = new \Coinbase\Pro\Client();

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
      Settings::init('Bahamut');
   }
}
