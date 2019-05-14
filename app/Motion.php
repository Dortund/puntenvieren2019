<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motion extends Model
{
    // No timestamp
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'time_of_vote', 'vote_value_type',
    ];
    
    public static function currentMotion() {
        return Motion::where('time_of_vote', '>', \DB::raw('NOW()'))->orderBy('time_of_vote', 'asc')->first();
    }
    
    public static function previousMotion() {
        return Motion::where('time_of_vote', '<', \DB::raw('NOW()'))->orderBy('time_of_vote', 'desc')->first();
    }
    
    public function voteValueType() {
        return $this->belongsTo(VoteValueType::class);
    }
    
    public function results() {
        return $this->hasMany(Result::class);
    }
    
    public function votes() {
        return $this->hasMany(Vote::class);
    }
}
