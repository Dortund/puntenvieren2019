<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Party extends Authenticatable
{
    use Notifiable;
    
    // No timestamp
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'colour', 'avatar',
    ];
    
    public function party() {
        return $this->hasMany(User::class);
    }
}
