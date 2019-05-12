<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MultipliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // BIER
        self::insert(' Meter bier','2.6');
        self::insert(' Pul bier met korting','0.5');
        self::insert('Bier','0.2');
        self::insert(' Pul bier','0.5');
        self::insert(' Pitcher bier ','1.4');
        self::insert('Pijpje Twist Off','0');

        // WITBIER
        self::insert('Witte Trappist Meter','0');
        self::insert('Witte Trappist Pitcher','0');
        self::insert('Witte Trappist 0,2L','0');
        self::insert('Witte Trappist 0,5L korting','0');

        // FRIS
        self::insert(' Pul fris','0');
        self::insert('Pul Fris Met Korting', '0');
        self::insert('Fris','0');
        self::insert(' Wijn Wit', '0');
        self::insert('Fristi','0');
        self::insert('Coca Cola (1,25L)','0');
        self::insert("Jus d'orange",'0');
        self::insert('Fanta','0');

        // MALT
        self::insert('Malt Radler (pijpje)','0');

        // BIJZONDER
        self::insert('Mol bierglas','0');
        self::insert('Mol frisglas groot','0');
        self::insert('Koffie (eettafel)','0');
        self::insert('Koffie (glas)','0');
        self::insert('Thee (glas)','0');
        self::insert('Spelkaarten (1x)','0');
        self::insert('Bondsdas','0');
        self::insert('Mol pitcher (glas)','0');
        self::insert('Kaderpul steen','0');
        self::insert('Kaderpul glas', '0');
        self::insert('Citroensap','0');
        self::insert('Smirnoff ice','0');

        // FRITUUR
        self::insert(' Chips (zakje)','0');
        self::insert(' Kleffe reep (stuk)', '0');
        self::insert('Bitterballen (5)', '0');
        self::insert('Vlammetjes (5)', '0');
        self::insert('Kipnuggets (20)', '0');
        self::insert('Kaassouflees-mini (5)', '0');
        self::insert('Kipnuggets (5)', '0');

        // STERK
        self::insert('Gordon Dry Gin','0');
        self::insert('Apfelkorn','0');
        self::insert('Wisselwhisky','0');
        self::insert('Jaegermeister','0');
        self::insert('Jenever Ketel 1 Jonge','0');
        self::insert('Likeur 43','0');
        self::insert('Puschkin Whipped Cream ','0');
        self::insert('De Kuyper Peachtree','0');
        self::insert('Whisky Glen Fiddich','0');
        self::insert('Goldstrike','0');
        self::insert('Amaretto Disaronno','0');
        self::insert('Wodka Puschkin', '0');
        self::insert('Rum Bacardi Razz', '0');
        self::insert('Sambuca Luxardo', '0');
        self::insert('Bols Creme de Cassis', '0');
        self::insert('Mede honingwijn', '0');
        self::insert('Sourz Apple', '0');
        self::insert('Rum Captain Morgan','0');
        self::insert('Jenever Hooghoudt Dubbele','0');

        // SPECIAALBIER
        self::insert('Steenbrugge Blond 0,33L', '0');
        self::insert('DBBG 0,375L Cider Troebel in Paradies', '0');
        self::insert('Palm Sessions IPA 0,33L', '0');
        self::insert('La Trappe Blond 0,2L','0');
        self::insert('Cornet 0,25L','0');
        self::insert('La Trappe Dubbel 0,25L', '0');
        self::insert('Le Fort Fles', '0');
        self::insert('Cornet 0,33L', '0');
        self::insert('De Molen Hop & Liefde 0,33L', '0');
        self::insert('Steenbrugge Witbier 0,5L korting', '0');
        self::insert('Hamer & Sikkel 0,33L', '0');
        self::insert('Kriek Max 0,25L', '0');
        self::insert('La Trappe Blond 0,25L', '0');
        self::insert('La Trappe Tripel Fles', '0');
        self::insert('Op & Top 0,33L', '0');
        self::insert('Urthel Hop It Fles', '0');
        self::insert('Steenbrugge Witbier 0,33L', '0');
        self::insert('Luxardo Limoncello', '0');
        self::insert('Steenbrugge Witbier 0,25L', '0');
        self::insert("La Trappe Isid'or 0,33L", '0');
        self::insert('La Trappe Quadruppel 0,33L', '0');
        self::insert('Steenbrugge Dubbel Bruin 0,33L', '0');
    }
    
    private function insert($product, $value) {
        DB::table('multipliers')->insert([
            'product' => $product,
            'value' => $value,
        ]);
    }
}
