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
        //$faker = Faker\Factory::create();
        /*for ($i = 1; $i <= 9; $i++) {
            DB::table('category')->insert([
                'name' => $faker->title,
                'image' => str_random(10) . '.jpg',
            ]);
        }*/
        DB::table('category')->delete();
        $category = array(
            array(
                'id' => '1',
                'name' => 'Танцевальные секции',
                'image' => 'tanc.jpg',
            ),
            array(
                'id' => '2',
                'name' => 'Спортивные секции',
                'image' => 'sport.jpg',
            ),
            array(
                'id' => '3',
                'name' => 'Художественные школы',
                'image' => 'hudozh.jpg',
            ),
            array(
                'id' => '4',
                'name' => 'Музыкальные школы',
                'image' => 'muz.jpg',
            ),
            array(
                'id' => '5',
                'name' => 'Театральные школы',
                'image' => 'teatralnyj.png',
            ),
            array(
                'id' => '6',
                'name' => 'Кружки по технике',
                'image' => 'tehn.jpg',
            ),
            array(
                'id' => '7',
                'name' => 'Языковые кружки',
                'image' => 'yazuk.jpg',
            ),
            array(
                'id' => '8',
                'name' => 'Кружки рукоделия',
                'image' => 'rukod.jpg',
            ),
            array(
                'id' => '9',
                'name' => 'Образовательные кружки',
                'image' => 'obraz.jpg',
            ),
        );
        DB::table('category')->insert($category);
    }
}
