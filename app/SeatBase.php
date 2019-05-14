<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seatbase extends Model
{
    public $timestamps = false;

    public function turnout() {
        return $this->belongsTo(Turnout::class);
    }
    
}
