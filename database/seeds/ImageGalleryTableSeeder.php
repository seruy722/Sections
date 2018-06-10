<?php

use Illuminate\Database\Seeder;

class ImageGalleryTableSeeder extends Seeder
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
            for ($i = 1; $i <= 8; $i++) {
                DB::table('image_galleries')->insert([
                    [
                        'name' => "img$i.jpg",
                        'section_id' => $val,
                    ],
                ]);
            }
        }
    }
}
