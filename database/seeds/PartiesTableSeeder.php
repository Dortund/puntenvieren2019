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
        self::insert('Octopus', '#009999');
        self::insert('Kurk', '#990000');
        self::insert('Quast', '#FFFF33');
        self::insert('Schranz', '#999900');
        self::insert('Spetter', '#000099');
        self::insert('Asene', '#990099');
        self::insert('Apollo', '#00FFFF');
        self::insert('Chaos', '#FF8000');
        self::insert('Krat', '#808080');
        self::insert('McClan', '#00FF00');
        self::insert('Kielzog', '#000000');
        self::insert('Nobel', '#FF0000');
        self::insert('Scorpios', '#0000FF');
        self::insert('Fabula', '#FF00FF');
        self::insert('Bestuur 122', '#009900');
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
