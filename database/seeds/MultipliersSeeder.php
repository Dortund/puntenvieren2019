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
        self::insert('bier', '1');
    }
    
    private function insert($product, $value) {
        DB::table('multipliers')->insert([
            'product' => $product,
            'value' => $value,
        ]);
    }
}
