<?php

namespace App\Barkas;

use Illuminate\Database\Eloquent\Model;

class Debiteur extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'debiteur';

    protected $primaryKey = 'Debiteur_ID';

    public $timestamps = false;

    public function bonnen()
    {
        return $this->hasMany('App\Barkas\Bon', 'Bon_Debiteur');
    }
}
