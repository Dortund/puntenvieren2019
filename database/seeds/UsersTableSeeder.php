<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::insert('admin', 'admin', 'admin');
        self::insert('kielzog', 'Pirate Party', 'Kielzog');
    }
    
    private function insert($name, $screenName, $password) {
        DB::table('users')->insert([
            'name' => $name,
            'screenName' => $screenName,
            'password' => bcrypt($password),
        ]);
    }
}
