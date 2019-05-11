<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    // No timestamp
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'party_id', 'motion_id', 'vote_value',
    ];
    
    public function party() {
        return $this->belongsTo(Party::class);
    }
    
    public function motion() {
        return $this->belongsTo(Motion::class);
    }
}
