<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Schedules;
use App\News;
use App\Sections;
use Illuminate\Support\Facades\Input;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monday = Schedules::join('sections', 'sections.id', '=', 'schedules.sections_id')
            ->where('days_of_week', 'Monday')->orderBy('data_start', 'asc')->get()
            //  $monday = Schedules::where('days_of_week', 'Monday')->orderBy('data_start', 'asc')->get()
            ->groupby('sections_name');

        $tuesday = Schedules::join('sections', 'sections.id', '=', 'schedules.sections_id')
            ->where('days_of_week', 'Tuesday')->orderBy('data_start', 'asc')->get()
            ->groupby('sections_name');

        $wednesday = Schedules::join('sections', 'sections.id', '=', 'schedules.sections_id')
            ->where('days_of_week', 'Wednesday')->orderBy('data_start', 'asc')->get()
            ->groupby('sections_name');
        $thursday = Schedules::join('sections', 'sections.id', '=', 'schedules.sections_id')
            ->where('days_of_week', 'Thursday')->orderBy('data_start', 'asc')->get()
            ->groupby('sections_name');

        $friday = Schedules::join('sections', 'sections.id', '=', 'schedules.sections_id')
            ->where('days_of_week', 'Friday')->orderBy('data_start', 'asc')->get()
            ->groupby('sections_name');

        $saturday = Schedules::join('sections', 'sections.id', '=', 'schedules.sections_id')
            ->where('days_of_week', 'Saturday')->orderBy('data_start', 'asc')->get()
            ->groupby('sections_name');

        $news = News::orderBy('id', 'desc')->limit(10)->get();

        $category = Category::all();

        return view('index', ['monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday,
            'thursday' => $thursday, 'friday' => $friday, 'saturday' => $saturday, 'news' => $news,
            'category' => $category]);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = News::where('id', $id)->firstOrFail();
        return view('article', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function searchAll(Request $request)
    {
        $q = Input::get('q');
        $news = News::where('title', 'LIKE', '%' . $q . '%')
            ->orWhere('description', 'LIKE', '%' . $q . '%')
            ->orWhere('content', 'LIKE', '%' . $q . '%')
            ->get();
        $sections = Sections::where('sections_name', 'LIKE', '%' . $q . '%')
            ->orWhere('info', 'LIKE', '%' . $q . '%')
            ->get()
            ->groupby('sections_name');
        if ((count($sections) > 0) || (count($news) > 0))
            return view('search')->withDetail($sections)->withDetails($news)->withQuery($q);
        else
            return redirect('/')->with('msg', 'Нет результатов поиска. Попробуйте снова!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
