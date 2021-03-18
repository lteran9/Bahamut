<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    /**
     * Defines the table name of the eloquent model.
     *
     * @var string
     */
    protected $table = 'Place';
}
