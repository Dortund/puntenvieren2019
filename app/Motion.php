<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motion extends Model
{
    public function getCurrentMotionAttribute() {
        //return Motion::whereTime('time_of_vote', '>', date('m/d/Y h:i:s a', time()))
    }
}
