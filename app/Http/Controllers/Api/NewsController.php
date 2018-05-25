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

    public function userNews(Request $request)
    {
        $news = News::where('user_id', $request->id)->orderBy('id', 'DESC')->get();
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
        $file = $request->fupload;
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'user_id' => $request->user_id
        ];

        if (!is_string($file)) {
            $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $data['img_filename'] = $filename;
            News::create($data);
            return response()->json(['status' => 'success', 'message' => 'Запись успешно добавлена.']);
        } else {
            News::create($data);
            return response()->json(['status' => 'success', 'message' => 'Запись успешно добавлена.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Ошибка при добавлении записи.']);
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
            return response()->json(['status' => 'success', 'message' => 'Запись успешно активирована.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ошибка при активации записи.']);
        }
    }

    public function userUpdateNews(Request $request)
    {
        $news = News::find($request->id);
        $file = $request->fupload;
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'user_id' => $request->user_id
        ];
        if (!is_string($file)) {
            $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $data['img_filename'] = $filename;
            if ($news) {
                if(is_string($news->img_filename)){
                    unlink(public_path() . '/images/' . $news->img_filename);
                }
                $news->update($data);
                return response()->json(['status' => 'success', 'message' => 'Данные успешно обновлены.']);
            }
        } else {
            if ($news) {
                $news->update($data);
                return response()->json(['status' => 'success', 'message' => 'Данные успешно обновлены.']);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Ошибка при обновлении.']);
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
            if ($news->img_filename) {
                unlink(public_path() . '/images/' . $news->img_filename);
            }
            $news->delete();
            return response()->json(['status' => 'success', 'message' => 'Запись успешно удалена']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ошибка при удалении записи']);
        }
    }
}
