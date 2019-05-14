<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multiplier extends Model
{
    // No timestamp
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product', 'value',
    ];
}
