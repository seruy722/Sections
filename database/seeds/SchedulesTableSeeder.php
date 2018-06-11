<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    public function run()
    {
        $arr = range(1, 18);
        shuffle($arr);
        foreach ($arr as $val) {
            if (($val % 2) == 0) {
                DB::table('schedules')->insert([
                    [
                        'day_of_week' => 'Monday',
                        'event_name' => 'Занятие 1',
                        'event_start' => '08:00',
                        'event_end' => '09:00',
                        'section_id' => $val,
                    ],

                    [
                        'day_of_week' => 'Wednesday',
                        'event_name' => 'Занятие 1',
                        'event_start' => '08:00',
                        'event_end' => '09:00',
                        'section_id' => $val,
                    ],

                    [
                        'day_of_week' => 'Friday',
                        'event_name' => 'Занятие 1',
                        'event_start' => '08:00',
                        'event_end' => '09:00',
                        'section_id' => $val,
                    ],
                    [
                        'day_of_week' => 'Monday',
                        'event_name' => 'Занятие 2',
                        'event_start' => '15:00',
                        'event_end' => '16:00',
                        'section_id' => $val,
                    ],

                    [
                        'day_of_week' => 'Wednesday',
                        'event_name' => 'Занятие 2',
                        'event_start' => '15:00',
                        'event_end' => '16:00',
                        'section_id' => $val,
                    ],

                    [
                        'day_of_week' => 'Friday',
                        'event_name' => 'Занятие 2',
                        'event_start' => '15:00',
                        'event_end' => '16:00',
                        'section_id' => $val,
                    ],
                ]);
            } else {
                DB::table('schedules')->insert([
                    [
                        'day_of_week' => 'Tuesday',
                        'event_name' => 'Занятие 1',
                        'event_start' => '08:00',
                        'event_end' => '09:00',
                        'section_id' => $val,
                    ],

                    [
                        'day_of_week' => 'Thursday',
                        'event_name' => 'Занятие 1',
                        'event_start' => '08:00',
                        'event_end' => '09:00',
                        'section_id' => $val,
                    ],


                    [
                        'day_of_week' => 'Saturday',
                        'event_name' => 'Занятие 1',
                        'event_start' => '08:00',
                        'event_end' => '09:00',
                        'section_id' => $val,
                    ],

                    [
                        'day_of_week' => 'Tuesday',
                        'event_name' => 'Занятие 2',
                        'event_start' => '16:00',
                        'event_end' => '17:00',
                        'section_id' => $val,
                    ],

                    [
                        'day_of_week' => 'Thursday',
                        'event_name' => 'Занятие 2',
                        'event_start' => '16:00',
                        'event_end' => '17:00',
                        'section_id' => $val,
                    ],

                    [
                        'day_of_week' => 'Saturday',
                        'event_name' => 'Занятие 2',
                        'event_start' => '16:00',
                        'event_end' => '17:00',
                        'section_id' => $val,
                    ],

                ]);
            }
        }
    }
}


