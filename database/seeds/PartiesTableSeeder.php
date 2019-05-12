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
        self::insert('H.I.C. Octopus');
        self::insert('S.M.N. Kurk');
        self::insert('Quast');
        self::insert('Schranz');
        self::insert('Spetter');
        self::insert(utf8_encode('Åsene'));
        self::insert('Apollo');
        self::insert('Chaos');
        self::insert('Kielzog');
        self::insert('C.H.T. Krat!');
        self::insert('McClan');
        self::insert('H.C. Nobel');
        self::insert('Scorpios');
        self::insert('Fabula');
        self::insert('Bestuur 122');
        self::insert('OC19');
    }
    
    private function insert($name, $colour = '#00FF00', $avatar = '/') {
        DB::table('parties')->insert([
            'name' => $name,
            'colour' => $colour,
            'avatar' => $avatar,
        ]);
    }
}
