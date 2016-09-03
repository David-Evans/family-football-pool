<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Chat;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the table (start fresh)
        Chat::truncate();

        // Pre-load this data
        $faker = Faker::create();

		foreach (range(1,30) as $index) {
			Chat::create([
				'user_id' => mt_rand(1,2),
				'message' => $faker->sentence(mt_rand(3,8)),
				'created_at' => date('Y-m-d H:i:s')
			]);
		}
    }
}
