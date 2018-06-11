<?php

namespace App\Http\Controllers;

use App\Schedules;
use App\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function getSchedules(Request $request)
    {
        $allSections = User::find($request->id)->sections;
        $sections = [];
        $schedules = [];

        foreach ($allSections as $key => $item) {
            $sections[] = (object)array('id' => $item->id, 'name' => $item->section_name);
            if ($item->schedules->count() > 0) {
                foreach ($item->schedules as $elem) {
                    $schedules[] = $elem;
                }
            }
        }

        return response()->json(['status' => true, 'schedules' => $schedules, 'sections' => $sections]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'section_id' => 'required|integer',
            'day_of_week' => 'required|string',
            'event_start' => 'required',
            'event_end' => 'required',
            'event_name' => 'required|min:2|max:255'

        ], [
            'section_id.integer' => 'Поле секция обьзательное для заполнения.'
        ]);
        $data = $this->cleanData($request->all());
        Schedules::create($data);

        return response()->json(['status' => true, 'message' => 'Запись успешно добавлена.']);
    }

    function cleanData($value)
    {
        $arr = array_map("trim", $value);
        $arr = array_map("strip_tags", $arr);
        $arr = array_map("stripcslashes", $arr);
        return $arr;
    }

    public function update(Request $request)
    {
        $schedule = Schedules::findOrFail($request->id);

        $this->validate($request, [
            'section_id' => 'required|integer',
            'day_of_week' => 'required|string',
            'event_start' => 'required',
            'event_end' => 'required',
            'event_name' => 'required|min:2|max:255'

        ], [
            'section_id.integer' => 'Поле секция обьзательное для заполнения.'
        ]);

        $data = $this->cleanData($request->all());
        $schedule->update($data);

        return response()->json(['status' => true, 'message' => 'Запись успешно обновлена.']);


    }

    public function destroy($id)
    {
        $schedule = Schedules::find($id);
        if ($schedule->count() > 0) {
            $schedule->delete();
            return response()->json(['status' => true, 'message' => 'Запись успешно удалена.']);
        }
    }
}
