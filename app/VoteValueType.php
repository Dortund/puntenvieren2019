<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteValueType extends Model
{
    // No timestamp
    public $timestamps = false;
    
    protected $table = 'vote_value_types';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
