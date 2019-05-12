<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      
        self::insert(-1, "Blanco");
        self::insert(-2, "Onthouden van stemmen");
    }
    
    private function insert($value, $name) {
        DB::table('default_votes')->insert([
            'value' => $value,
            'name' => $name,
        ]);
    }
}
