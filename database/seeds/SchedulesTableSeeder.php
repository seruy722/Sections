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
        for ($i = 1; $i <= 26; $i++) {
            $t=rand(8, 18);
            DB::table('schedules')->insert([
                'day_of_week' => $faker->dayOfWeek(),
                'event_name' => $faker->text($maxNbChars = 20),
                'event_start' => $t . ':00',
                'event_end' => ($t+1) . ':00',
                'section_id' => rand(1, 26),
            ]);
        }
    }
}


