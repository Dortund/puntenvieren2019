<?php

namespace App\Barkas;

use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'bestelling';

    protected $primaryKey = 'Bestelling_ID';

    public $timestamps = false;

    public function bon()
    {
        return $this->belongsTo('App\Barkas\Bon', 'Bestelling_Bon');
    }

    public function prijs()
    {
        return $this->belongsTo('App\Barkas\Prijs', 'Bestelling_Wat');
    }
}
