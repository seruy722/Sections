<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::where('active', false)->get();
        return NewsResource::collection($news);
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
    public function show(News $news)
    {
        return new NewsResource($news);
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
        $data = $request->all();
        $data['created_at'] = $this->needDate($request->created_at);
        $user = News::find($id);
        if ($user) {
            $user->update($data);
            return response()->json(['status' => 'success', 'message' => 'Запись успешно активирована']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ошибка при активации записи']);
        }
    }

    public function needDate($date)
    {
        return $newDate = date('Y-m-d H:i:s', strtotime($date));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        if ($news) {
            $news->delete();
            return response()->json(['status' => 'success', 'message' => 'Запись успешно удалена']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ошибка при удалении записи']);
        }
    }
}
