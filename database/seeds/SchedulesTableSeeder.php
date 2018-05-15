<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
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
            $t=rand(8, 18);
            DB::table('schedules')->insert([
                'days_of_week' => $faker->dayOfWeek(),
                'event_name' => $faker->text($maxNbChars = 20),
                'event_info' => $faker->text($maxNbChars = 100),
                'data_start' => $t . ':00',
                'data_end' => ($t+1) . ':00',
                'data_end' => ($t+1) . ':00',
                'users_id' => rand(1, 100),
            ]);
        }
    }
}


