<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedules;
use App\News;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monday = Schedules::join('users', 'users.id', '=', 'schedules.user_id')
            ->where('days_of_week', 'Monday')->orderBy('data_start', 'asc')->get()
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

        $news = News::orderBy('id', 'desc')->limit(10)->get();

        return view('index', ['monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday, 'thursday' => $thursday, 'friday' => $friday, 'saturday' => $saturday, 'news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=News::where('id', $id)->firstOrFail();
        return view('article', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $all = News::orderBy('id', 'desc')->paginate(10);
        return view('articles', ['all' => $all]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
