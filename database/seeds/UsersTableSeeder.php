<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'feedback_email'=>'admin_feedback@example.com',
            'phone' => '',
            'password' => '$2y$10$HDgfuNP5nOJRkPTr3GDPG.kygvycJEAkhhuE5i45/xltawqTrjROC',
            'photo' => '/users/admin.jpg',
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'phone' => '',
            'password' => '$2y$10$vRInDVSRpP5bmZhwQqFfUe9vrg2zdcaNwF9CjT.Bd0AQdni3koTSO',
            'photo' => '/users/user.jpg'
        ]);

    }
}
