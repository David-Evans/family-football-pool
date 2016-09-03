<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Eloquent::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(LiveScoresTableSeeder::class);
        $this->call(PicksTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
    }
}
