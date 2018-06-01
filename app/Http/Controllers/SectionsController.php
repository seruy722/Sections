<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\MailClass;
use App\Sections;
use App\User;
use Illuminate\Http\Request;
use App\ImageGallery;

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

        $monday = $users->schedules()->where('day_of_week', 'Monday')->orderBy('event_start', 'asc')->get();
        $tuesday = $users->schedules()->where('day_of_week', 'Tuesday')->orderBy('event_start', 'asc')->get();
        $wednesday = $users->schedules()->where('day_of_week', 'Wednesday')->orderBy('event_start', 'asc')->get();
        $thursday = $users->schedules()->where('day_of_week', 'Thursday')->orderBy('event_start', 'asc')->get();
        $friday = $users->schedules()->where('day_of_week', 'Friday')->orderBy('event_start', 'asc')->get();
        $saturday = $users->schedules()->where('day_of_week', 'Saturday')->orderBy('event_start', 'asc')->get();

        return view('section', ['lat' => $lat, 'lng' => $lng, 'users' => $users, 'news' => $news,
            'monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday, 'thursday' => $thursday,
            'friday' => $friday, 'saturday' => $saturday, 'photos'=>$photos]);
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
        $sections = User::find($request->id)->sections->toArray();
        foreach ($sections as $key => $elem) {
            $sections[$key]['created_at'] = $this->needDate($elem['created_at']);
        }
        $categories = Category::all();
        return response()->json(['status' => true, 'sections' => $sections, 'categories' => $categories]);

    }

    public function needDate($date)
    {
        $newDate = date('d-m-Y', strtotime($date));
        return $newDate;
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'section_name' => 'required|min:2|max:255',
            'info' => 'required|min:2|max:2000',
            'fupload' => 'mimes:jpg,jpeg,png|dimensions:max:5120',
            'images' => 'jpeg, png, bmp, gif',
            'category_id' => 'integer',
            'address' => 'required|max:255',

        ], [
            'category_id.integer' => 'Поле категория обьзательное для заполнения.'
        ]);
        $data = $this->cleanData($request->all());
        $file = $request->fupload;
        $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
        $file->move('images', $filename);
        $data['img_logo'] = $filename;
        Sections::create($data);
        return response()->json(['status' => true, 'message' => 'Запись успешно добавлена.']);
    }

    function cleanData($value)
    {
        $arr = array_map("trim", $value);
        $arr = array_map("strip_tags", $arr);
        $arr = array_map("stripcslashes", $arr);
        return $arr;
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
    public function update(Request $request)
    {
        $this->validate($request, [
            'section_name' => 'required|min:2|max:255',
            'info' => 'required|min:2|max:2000',
            'images' => 'jpeg, png, bmp, gif',
            'category_id' => 'integer',

        ], [
            'category_id.integer' => 'Поле категория обьзательное для заполнения.'
        ]);

        $data = $this->cleanData($request->all());
        $section = Sections::findOrFail($data['id']);
        if ($section) {
            if (is_object($request->fupload)) {
                $this->validate($request, [
                    'fupload' => 'mimes:jpg,jpeg,png|dimensions:max:5120',
                ]);
                unlink(public_path() . '/images/' . $section->img_logo);
                $file = $request->fupload;
                $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
                $file->move('images', $filename);
                $data['img_logo'] = $filename;
            } else {
                unset($data['fupload']);
            }

            if (!$data['address']) {
                unset($data['address']);
            }

            $section->update($data);
            return response()->json(['status' => true, 'message' => 'Запись успешно обновлена.']);
        }
        return response()->json(['status' => false, 'message' => 'Ошибка при обновлении записи.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Sections::find($id);
        if ($section) {
            if ($section->img_logo) {
                unlink(public_path() . '/images/' . $section->img_logo);
            }
            $section->delete();
            return response()->json(['status' => true, 'message' => 'Запись успешно удалена.']);
        }
    }

    public function gallery($id)
    {
        $img = Sections::findOrFail($id);
        return view('gallery', ['img' => $img]);
    }

}
