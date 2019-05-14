<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    // No timestamp
    public $timestamps = false;
    
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'id', 'motion_id', 'vote_value',
    ];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['vote_name'];
    
    public function getVoteNameAttribute()
    {
        if ($this->vote_value < 0) {
            return DefaultVote::find(-1*$this->vote_value)->name;
        }
        else {
            if ($this->motion->vote_value_type == 1) {
                if ($this->vote_value == 0) {
                    return "Tegen";
                }
                else {
                    return "Voor";
                }
            }
            elseif ($this->motion->vote_value_type == 2) {
                return Party::find($this->vote_value)->screenname;
            }
        }
    }
    
    public function motion() {
        return $this->belongsTo(Motion::class);
    }
    
    
}
