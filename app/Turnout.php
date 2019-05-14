<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turnout extends Model
{
    public $timestamps = false;

    public function seatbases() {
        return $this->hasMany(Seatbase::class);
    }
}
