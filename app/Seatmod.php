<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seatmod extends Model
{
    // No timestamp
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'party_id', 'modifier',
    ];
    
    public function party() {
        return $this->belongsTo(Party::class);
    }
}
