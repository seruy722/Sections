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
        for ($i = 1; $i <= 26; $i++) {
            DB::table('users')->insert([
                'name' => $faker->company,
                'email' => $faker->email,
                'phone' => $faker->e164PhoneNumber,
                'password' => $faker->password,
                'photo' => $faker->shuffle('$Ukraine$, $Kramatorsk$'),
                'api_token'=>$faker->shuffle('hello, world'),
            ]);
        }
    }
}
