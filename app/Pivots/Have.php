<?php

namespace App\Pivots;

use Illuminate\Database\Eloquent\Model;

class Have extends Model
{
    protected $table = 'have';
    protected $guarded = [];

   public function wallet()
   {
      return $this->hasOne('App\Wallet', 'id', 'wallet_id');
   }

   public function profile() 
   {
      return $this->belongsTo('App\Portfolio', 'id', 'portfolio_id');
   }
}
