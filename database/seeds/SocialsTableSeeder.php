<?php

use Illuminate\Database\Seeder;

class SocialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = range(1, 18);
        shuffle($arr);
        foreach ($arr as $val) {
            DB::table('socials')->insert([
                'fb' => 'https://www.facebook.com/',
                'vk' => 'https://vk.com/',
                'tw' => 'https://twitter.com/',
                'inst' => 'https://www.instagram.com/',
                'section_id' => $val,
            ]);
        }
    }
}
