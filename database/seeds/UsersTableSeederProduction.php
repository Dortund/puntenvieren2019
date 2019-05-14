<?php

use App\User;
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
        //self::insert('asdf', 'asdf', true, 1234);
    }
    
    private function insert($username, $password, $is_admin, $party_id = null) {
        if (!User::where('username', $username)->exists()) {
            DB::table('users')->insert([
                'username' => $username,
                'password' => bcrypt($password),
                'is_admin' => $is_admin,
                'party_id' => $party_id,
            ]);
        }
    }
}
