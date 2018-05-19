<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedules;

class SchedulesController extends Controller
{
    public function days()
    {
        $monday = Schedules::join('users', 'users.id', '=', 'schedules.user_id')->where('days_of_week', 'Monday')->orderBy('data_start', 'asc')->get()
      //  $monday = Schedules::where('days_of_week', 'Monday')->orderBy('data_start', 'asc')->get()
            ->groupby('name');

        $tuesday = Schedules::join('users', 'users.id', '=', 'schedules.user_id')
            ->where('days_of_week', 'Tuesday')->orderBy('data_start', 'asc')->get()
            ->groupby('name');

        $wednesday = Schedules::join('users', 'users.id', '=', 'schedules.user_id')
            ->where('days_of_week', 'Wednesday')->orderBy('data_start', 'asc')->get()
            ->groupby('name');
        $thursday = Schedules::join('users', 'users.id', '=', 'schedules.user_id')
            ->where('days_of_week', 'Thursday')->orderBy('data_start', 'asc')->get()
            ->groupby('name');

        $friday = Schedules::join('users', 'users.id', '=', 'schedules.user_id')
            ->where('days_of_week', 'Friday')->orderBy('data_start', 'asc')->get()
            ->groupby('name');

        $saturday = Schedules::join('users', 'users.id', '=', 'schedules.user_id')
            ->where('days_of_week', 'Tuesday')->orderBy('data_start', 'asc')->get()
            ->groupby('name');

        return view('index', ['monday'=>$monday, 'tuesday'=>$tuesday, 'wednesday'=>$wednesday, 'thursday'=>$thursday, 'friday'=>$friday, 'saturday'=>$saturday]);
    }

}
