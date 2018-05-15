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
        for ($i = 1; $i <= 99; $i++) {
            DB::table('users')->insert([
                'name' => str_random(20),
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
                'category' => str_random(20),
            ]);
        }
    }
}
