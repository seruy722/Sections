<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
                'category' => $faker->word,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'info' => $faker->text($maxNbChars = 300),
            ]);
        }
    }
}
