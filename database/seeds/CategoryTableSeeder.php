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
        DB::table('category')->delete();
        $category = [
            [
                'id' => '1',
                'name' => 'Танцевальные секции',
                'image' => 'tanc.jpg',
            ],
            [
                'id' => '2',
                'name' => 'Спортивные секции',
                'image' => 'sport.jpg',
            ],
            [
                'id' => '3',
                'name' => 'Художественные школы',
                'image' => 'hudozh.jpg',
            ],
            [
                'id' => '4',
                'name' => 'Музыкальные школы',
                'image' => 'muz.jpg',
            ],
            [
                'id' => '5',
                'name' => 'Театральные школы',
                'image' => 'teatralnyj.png',
            ],
            [
                'id' => '6',
                'name' => 'Кружки по технике',
                'image' => 'tehn.jpg',
            ],
            [
                'id' => '7',
                'name' => 'Языковые кружки',
                'image' => 'yazuk.jpg',
            ],
            [
                'id' => '8',
                'name' => 'Кружки рукоделия',
                'image' => 'rukod.jpg',
            ],
            [
                'id' => '9',
                'name' => 'Образовательные кружки',
                'image' => 'obraz.jpg',
            ],
        ];

        DB::table('category')->insert($category);
    }
}
