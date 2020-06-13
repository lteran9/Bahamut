<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];
    protected $casts = [
        'id' => 'string'
    ];
}
