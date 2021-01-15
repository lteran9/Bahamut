<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
   /**
    * Indicates if the IDs are auto-incrementing.
    *
    * @var bool
    */
   public $incrementing = false;

   protected $guarded = [];
   protected $casts = [
      'id' => 'string'
   ];

   public function have()
   {
      return $this->hasOne('App\Pivots\Have', 'wallet_id', 'id');
   }

}
