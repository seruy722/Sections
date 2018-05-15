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
        for ($i = 1; $i <= 100; $i++) {
            DB::table('news')->insert([
                'title' => str_random(20),
                'description' => str_random(300),
                'content' => str_random(1000),
                'img_filename' => str_random(10). '.jpg',
            ]);
        }
    }
}