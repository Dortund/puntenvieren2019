<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Motion extends Model
{
    public static function currentMotion() {
        return Motion::where('time_of_vote', '>', \DB::raw('NOW()'))->orderBy('time_of_vote', 'asc')->first();
    }
}
