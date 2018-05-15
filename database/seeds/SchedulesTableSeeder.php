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
        for ($i = 1; $i <= 100; $i++) {
            $t=rand(8, 18);
            DB::table('schedules')->insert([
                'days_of_week' => str_random(20),
                'event_name' => str_random(20),
                'event_info' => str_random(300),
                'data_start' => $t . ':00',
                'data_end' => ($t+1) . ':00',
            ]);
        }
    }
}

