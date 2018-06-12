<?php

namespace App\Http\Controllers;

use App\Category;
use App\ImageGallery;
use App\MailExchange;
use App\News;
use App\Schedules;
use App\Sections;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SectionsController extends Controller
{
    public function index($id)
    {
        $users = Sections::findOrFail($id);

        $origin = urlencode($users->address);
        $a = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=.$origin.&key=AIzaSyB1Ths24pUitBJWCL2hVzX58hz4qMjsKGA");
        $d = json_decode($a);
        $lat = ($d->results[0]->geometry->location->lat);
        $lng = ($d->results[0]->geometry->location->lng);


        $news = $users->news()->where('active', 1)->paginate(10);

        $monday = $users->schedules()->where('day_of_week', 'Monday')->orderBy('event_start', 'asc')->get();
        $tuesday = $users->schedules()->where('day_of_week', 'Tuesday')->orderBy('event_start', 'asc')->get();
        $wednesday = $users->schedules()->where('day_of_week', 'Wednesday')->orderBy('event_start', 'asc')->get();
        $thursday = $users->schedules()->where('day_of_week', 'Thursday')->orderBy('event_start', 'asc')->get();
        $friday = $users->schedules()->where('day_of_week', 'Friday')->orderBy('event_start', 'asc')->get();
        $saturday = $users->schedules()->where('day_of_week', 'Saturday')->orderBy('event_start', 'asc')->get();

        $photos = ImageGallery::where('section_id', $id)->orderBy('id', 'desc')->limit(10)->get();
        return view('section', ['lat' => $lat, 'lng' => $lng, 'users' => $users, 'news' => $news,
            'monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday, 'thursday' => $thursday,
            'friday' => $friday, 'saturday' => $saturday, 'photos' => $photos]);
    }

    public function sections($id)
    {
        $sections = Category::findOrFail($id);

        return view('sections', ['sections' => $sections]);

    }

    public function mail(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email_to' => $request->imail,
            'email_from' => $request->email,
            'subject' => $request->subject,
            'msg' => $request->msg,
            'phone' => $request->phone,
            'email' => $request->email

        ];

        Mail::send('mail', $data, function ($message) use ($data) {
            $message->from($data['email_from']);
            $message->to($data['email_to']);
            $message->subject($data['subject']);
        });

        $data['msg'] = "$request->msg. Телефон: $request->phone";
        MailExchange::create($data);
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

        if (is_object($request->fupload)) {
            $this->validate($request, [
                'fupload' => 'mimes:jpg,jpeg,png|dimensions:max:5120',
            ]);

            if (file_exists(public_path() . '/images/' . $section->img_logo)) {
                unlink(public_path() . '/images/' . $section->img_logo);
            }

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


    public function destroy($id)
    {
        $section = Sections::findOrFail($id);

        $images = Sections::find($id)->image;
        if ($images->count() > 0) {
            $arr = $images->toArray();
            foreach ($arr as $item) {
                if (file_exists(public_path() . '/images/' . $item['name'])) {
                    unlink(public_path() . '/images/' . $item['name']);
                }
                ImageGallery::destroy($item['id']);
            }
        }

        $news = Sections::find($id)->news;
        if ($news->count() > 0) {
            $arr = $news->toArray();
            foreach ($arr as $item) {
                if (file_exists(public_path() . '/images/' . $item['image_name'])) {
                    unlink(public_path() . '/images/' . $item['image_name']);
                }
                News::destroy($item['id']);
            }
        }

        $schedules = Sections::find($id)->schedules;
        if ($schedules->count() > 0) {
            $arr = $schedules->toArray();
            foreach ($arr as $item) {
                Schedules::destroy($item['id']);
            }
        }


        if (file_exists(public_path() . '/images/' . $section->img_logo)) {
            unlink(public_path() . '/images/' . $section->img_logo);
        }

        $section->delete();
        return response()->json(['status' => true, 'message' => 'Запись успешно удалена.']);
    }

    public function gallery($id)
    {
        $img = Sections::findOrFail($id);
        $name = Sections::where('id', $id)->value('section_name');
        return view('gallery', ['img' => $img, 'name' => $name]);
    }

}
