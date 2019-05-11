<?php

namespace App\Barkas;

use Illuminate\Database\Eloquent\Model;

class Prijs extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'prijs';

    protected $primaryKey = 'Prijs_ID';

    public $timestamps = false;
}
