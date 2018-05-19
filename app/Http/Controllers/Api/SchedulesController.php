<?php

namespace App\Http\Controllers\Api;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchedulesResource;
use App\Schedules;

class SchedulesController extends Controller
{
    public function index()
    {
        $schedules = Schedules::where('days_of_week', 'Monday')->get();
        return SchedulesResource::collection($schedules);
    }

    public function show(Schedules $schedule)
    {
        return new SchedulesResource($schedule);
    }
}
