<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
       /* for ($i = 1; $i <= 26; $i++) {
            DB::table('sections')->insert([
                'user_id' => rand(1, 26),
                'section_name' => $faker->company,
                'category_id' => rand(1, 9),
                'address' => $faker->address,
                'img_logo' => str_random(10) . '.jpg',
                'info' => $faker->text($maxNbChars = 300),
            ]);
        }*/
        DB::table('sections')->delete();
        $sections = array(
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок «Историки-краеведы»',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '9',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Детская астрономическая обсерватория',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '9',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => '',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '1',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => '',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '1',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Хореографический ансамбль "Вітерець"',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '2',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Ансамбль спортивного бального танца «Серпантин»',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '2',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок декоративно-прикладного творчества «Художественная мозайка»',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '3',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок изобразительного искусства',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '3',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок самодеятельной песни',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '4',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Образцовый ансамбль эстрадной песни "Барви"',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '4',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Театр-студия «Маскарад»',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '5',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Детский театр танца «Солнечная сторона»',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '5',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Aвиамодельный кружок',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '6',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок телекоммуникационных технологий',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '6',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок «Английский язык»',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '7',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок «Английский язык»',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '7',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок «Современное вязание спицами», секция химии МАН',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '8',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),
            array(
                'user_id' => rand(1, 26),
                'section_name' => 'Кружок «Техника рукоделия», «Бисероплетение»',
                'address' => 'ул. Парковая, 12а, Краматорск, Донецкая область',
                'category_id' => '8',
                'img_logo' => 'placeholder.png',
                'info' => $faker->text($maxNbChars = 300),
            ),

        );
        DB::table('sections')->insert($sections);
    }
}