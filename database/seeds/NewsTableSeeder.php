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
        for ($i = 1; $i <= 26; $i++) {
            DB::table('news')->insert([
                'title' => $faker->text($maxNbChars = 20),
                'description' => $faker->text($maxNbChars = 300),
                'content' => $faker->text($maxNbChars = 5000),
                'image_name' => str_random(10) . '.jpg',
                'section_id' => rand(1, 26),
                'active' => false
            ]);
        }
    }
}