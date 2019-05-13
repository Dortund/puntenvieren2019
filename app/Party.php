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
        'name', 'screenname', 'colour', 'avatar',
    ];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['seats'];
    
    public function party() {
        return $this->hasMany(User::class);
    }
    
    public function getSeatsAttribute($value)
    {
        $seatbase = Seatbase::where('party_id', '=', $this->id)->orderBy('entry_added', 'desc')->first();
        if (isset($seatbase)) {
            return $seatbase->seats;
        }
        else {
            //return 0;
            return mt_rand(0, 10);
        }
    }
    
    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        
        $array['id'] = str_replace(" ", "", $array['name']);
        
        return $array;
    }
}
