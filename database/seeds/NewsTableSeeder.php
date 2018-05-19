<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 100; $i++) {
            DB::table('news')->insert([
                'title' => $faker->text($maxNbChars = 20),
                'description' => $faker->text($maxNbChars = 300),
                'content' => $faker->text($maxNbChars = 5000),
                'img_filename' => str_random(10) . '.jpg',
                'user_id' => rand(1, 90),
                'active' => false
            ]);
        }
    }
}