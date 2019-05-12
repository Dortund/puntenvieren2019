<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PartiesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DefaultVotesSeeder::class);
        $this->call(VoteValueTypesSeeder::class);
        $this->call(MultipliersSeeder::class);
    }
}
