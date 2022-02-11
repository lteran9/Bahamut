<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Coinbase Public API Token
    |--------------------------------------------------------------------------
    |
    | Publishable API tokens are meant solely to identify your account with
    | Coinbse Pro, they aren’t secret. They can be published in places like
    | your website JavaScript code, or in an iPhone or Android app.
    |
    */

    'public_key' => env('COINBASE_PUBLIC_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Coinbase Secret API Token
    |--------------------------------------------------------------------------
    |
    | Secret API tokens should be kept confidential and only stored on your
    | own servers. Your account’s secret API token can perform any
    | API request to Coinbse Pro.
    |
    */

    'secret_key' => env('COINBASE_SECRET_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Coinbase Passphrase
    |--------------------------------------------------------------------------
    |
    | Coinbase Pro required that you send the passphrase in the Header of the
    | request being made.
    |
    */

    'passphrase' => env('COINBASE_PASSPHRASE'),

];
