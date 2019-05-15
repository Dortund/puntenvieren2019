<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::insert('Octopus', '#009900');
        self::insert('Kurk', '#990000');
        self::insert('Quast', '#000099');
        self::insert('Schranz', '#999900');
        self::insert('Spetter', '#009999');
        self::insert('Asene', '#990099');
        self::insert('Apollo', '#33FF99');
        self::insert('Chaos', '#FF8000');
        self::insert('Krat', '#808080');
        self::insert('McClan', '#00FF00');
        self::insert('Kielzog', '#000000');
        self::insert('Nobel', '#0000FF');
        self::insert('Scorpios', '#FF0000');
        self::insert('Fabula', '#FF00FF');
        self::insert('Bestuur 122', '#00FFFF');
        self::insert('OC19', '#FFFF00');
    }
    
    private function insert($name, $colour = '#00FF00', $avatar = '/') {
        DB::table('parties')->insert([
            'name' => $name,
            'screenname' => $name,
            'colour' => $colour,
            'avatar' => $avatar,
        ]);
    }
}
