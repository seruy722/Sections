<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use App\Schedules;
use App\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FrontController extends Controller
{

    public function index()
    {
        $monday = Schedules::join('sections', 'sections.id', '=', 'schedules.section_id')
            ->where('day_of_week', 'Monday')->orderBy('event_start', 'asc')->get()
            //  $monday = Schedules::where('days_of_week', 'Monday')->orderBy('data_start', 'asc')->get()
            ->groupby('section_name');

        $tuesday = Schedules::join('sections', 'sections.id', '=', 'schedules.section_id')
            ->where('day_of_week', 'Tuesday')->orderBy('event_start', 'asc')->get()
            ->groupby('section_name');

        $wednesday = Schedules::join('sections', 'sections.id', '=', 'schedules.section_id')
            ->where('day_of_week', 'Wednesday')->orderBy('event_start', 'asc')->get()
            ->groupby('section_name');
        $thursday = Schedules::join('sections', 'sections.id', '=', 'schedules.section_id')
            ->where('day_of_week', 'Thursday')->orderBy('event_start', 'asc')->get()
            ->groupby('section_name');

        $friday = Schedules::join('sections', 'sections.id', '=', 'schedules.section_id')
            ->where('day_of_week', 'Friday')->orderBy('event_start', 'asc')->get()
            ->groupby('section_name');

        $saturday = Schedules::join('sections', 'sections.id', '=', 'schedules.section_id')
            ->where('day_of_week', 'Saturday')->orderBy('event_start', 'asc')->get()
            ->groupby('section_name');

        $news = News::orderBy('id', 'desc')->limit(10)->get();

        $category = Category::all();

        return view('index', ['monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday,
            'thursday' => $thursday, 'friday' => $friday, 'saturday' => $saturday, 'news' => $news,
            'category' => $category]);
    }


    public function show($id)
    {
        $post = News::where('id', $id)->firstOrFail();
        return view('article', compact('post'));
    }


    public function all()
    {
        $all = News::orderBy('id', 'desc')->paginate(10);
        return view('articles', ['all' => $all]);
    }


    public function searchAll(Request $request)
    {
        $q = Input::get('q');
        $news = News::where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->orWhere('content', 'LIKE', '%' . $q . '%')
            ->get();
        $sections = Sections::where('section_name', 'LIKE', '%' . $q . '%')
            ->orWhere('info', 'LIKE', '%' . $q . '%')
            ->get()
            ->groupby('section_name');
        if ((count($sections) > 0) || (count($news) > 0))
            return view('search')->withDetail($sections)->withDetails($news)->withQuery($q);
        else
            return redirect('/')->with('msg', 'Нет результатов поиска. Попробуйте снова!');
    }


    public function search(Request $request)
    {
        $q = Input::get('q');
        $news = News::where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->orWhere('content', 'LIKE', '%' . $q . '%')
            ->get();
        if (count($news) > 0)
            return view('search')->withDetails($news)->withQuery($q);
        else
            return redirect('/articles')->with('msg', 'Нет результатов поиска. Попробуйте снова!');
    }
}
