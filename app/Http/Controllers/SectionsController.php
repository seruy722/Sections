<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedules;
use App\News;
use App\User;
use App\Sections;
use Illuminate\Support\Facades\Input;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       // $sections = Users::join('sections', 'sections.user_id', '=', 'users.id')->get();
        $users = User::findOrFail($id);
        $origin = urlencode($users->address);
        $a=file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=.$origin.&key=AIzaSyBmQ6H_TOpkaAEWB1et1mIHre07Kocfugs");
        $d= json_decode($a);
        $lat=($d->results[0]->geometry->location->lat);
        $lng=($d->results[0]->geometry->location->lng);

        return view('section', ['lat' => $lat, 'lng' => $lng, 'users' => $users]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
