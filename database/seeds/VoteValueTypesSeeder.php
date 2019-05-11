<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteValueTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::insert('Yes-No voting');
        self::insert('All Party voting');
    }
    
    private function insert($name) {
        DB::table('vote_value_types')->insert([
            'name' => $name,
        ]);
    }
}
