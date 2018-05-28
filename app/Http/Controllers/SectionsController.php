<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\MailClass;
use Illuminate\Http\Request;
use App\Schedules;
use App\News;
use App\User;
use App\Sections;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

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
        $users = Sections::findOrFail($id);

        $origin = urlencode($users->address);
        $a = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=.$origin.&key=AIzaSyB1Ths24pUitBJWCL2hVzX58hz4qMjsKGA");
        $d = json_decode($a);
        $lat = ($d->results[0]->geometry->location->lat);
        $lng = ($d->results[0]->geometry->location->lng);

        $news = $users->news()->paginate(10);

        $monday = $users->schedules()->where('days_of_week', 'Monday')->orderBy('data_start', 'asc')->get();
        $tuesday = $users->schedules()->where('days_of_week', 'Tuesday')->orderBy('data_start', 'asc')->get();
        $wednesday = $users->schedules()->where('days_of_week', 'Wednesday')->orderBy('data_start', 'asc')->get();
        $thursday = $users->schedules()->where('days_of_week', 'Thursday')->orderBy('data_start', 'asc')->get();
        $friday = $users->schedules()->where('days_of_week', 'Friday')->orderBy('data_start', 'asc')->get();
        $saturday = $users->schedules()->where('days_of_week', 'Saturday')->orderBy('data_start', 'asc')->get();

        return view('section', ['lat' => $lat, 'lng' => $lng, 'users' => $users, 'news' => $news,
            'monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday, 'thursday' => $thursday,
            'friday' => $friday, 'saturday' => $saturday]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sections($id)
    {
        $sections = Category::findOrFail($id);
        // $sections = $category->sections();
        return view('sections', ['sections' => $sections]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function mail(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $msg = $request->msg;
        $imail = $request->imail;
        Mail::to($imail)->send(new MailClass($name, $email, $phone, $subject, $msg));
    }


    public function getUserSections(Request $request)
    {
        $sections = User::find($request->id)->sections;
        return response()->json(['status'=>true,'sections'=>$sections]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
