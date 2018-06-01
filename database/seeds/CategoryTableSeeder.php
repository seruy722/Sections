<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 9; $i++) {
            DB::table('category')->insert([
                'name' => $faker->title,
                'image' => str_random(10) . '.jpg',
            ]);
        }
    }
}
