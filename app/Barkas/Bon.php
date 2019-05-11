<?php

namespace App\Barkas;

use Illuminate\Database\Eloquent\Model;

class Bon extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'bon';

    protected $primaryKey = 'Bon_ID';

    public $timestamps = false;

    public function debiteur()
    {
        return $this->belongsTo('App\Barkas\Debiteur', 'Bon_Debiteur');
    }

    public function bestellingen()
    {
        return $this->hasMany('App\Barkas\Bestelling', 'Bestelling_Bon');
    }
}
