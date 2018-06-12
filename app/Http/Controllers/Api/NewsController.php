<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\News;
use App\User;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::where('active', false)->get();
        return NewsResource::collection($news);
    }

    public function userNews(Request $request)
    {
        $news = User::find($request->id)->news->toArray();
        $sections = User::find($request->id)->sections->toArray();
        foreach ($sections as $key => $elem) {
            $sections[$key]['created_at'] = $this->needDates($elem['created_at']);
        }

        foreach ($news as $key => $elem) {
            $news[$key]['created_at'] = $this->needDates($elem['created_at']);
        }

        return response()->json(['status' => true, 'news' => $news, 'sections' => $sections]);
    }

    public function needDates($date)
    {
        $newDate = date('d-m-Y', strtotime($date));
        return $newDate;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:10|max:255',
            'description' => 'required|min:10|max:1500',
            'content' => 'max:3000',
            'fupload' => 'mimes:jpg,jpeg,png|dimensions:max:5120'
        ]);

        $file = $request->fupload;
        $data = $this->cleanData($request->all());
        $data = [
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'section_id' => $data['section_id']
        ];

        if (!is_string($file)) {
            $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $data['image_name'] = $filename;
            News::create($data);
            return response()->json(['status' => true, 'message' => 'Запись успешно добавлена.']);
        } else {
            News::create($data);
            return response()->json(['status' => false, 'message' => 'Запись успешно добавлена.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Ошибка при добавлении записи.']);
    }

    public function show(News $news)
    {
        return new NewsResource($news);
    }

    public function update(Request $request, $id)
    {
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
        $this->validate($request, [
            'title' => 'required|min:10|max:255',
            'description' => 'required|min:10|max:1500',
            'content' => 'max:3000'
        ]);

        $news = News::find($request->id);
        $file = $request->fupload;
        $data = $this->cleanData($request->all());
        $data = [
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content']
        ];
        if (!is_string($file)) {
            $this->validate($request, [
                'fupload' => 'mimes:jpg,jpeg,png|dimensions:max:5120'
            ]);

            $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $data['image_name'] = $filename;
            if ($news) {
                if (file_exists(public_path() . '/images/' . $news->image_name)) {
                    unlink(public_path() . '/images/' . $news->image_name);
                }
                $news->update($data);
                return response()->json(['status' => true, 'message' => 'Данные успешно обновлены.']);
            }
        } else {
            if ($news) {
                $news->update($data);
                return response()->json(['status' => true, 'message' => 'Данные успешно обновлены.']);
            }
        }
        return response()->json(['status' => false, 'message' => 'Ошибка при обновлении.']);
    }

    function cleanData($value)
    {
        $arr = array_map("trim", $value);
        $arr = array_map("strip_tags", $arr);
        $arr = array_map("stripcslashes", $arr);
        return $arr;
    }

    public function needDate($date)
    {
        return $newDate = date('Y-m-d H:i:s', strtotime($date));
    }

    public function destroy($id)
    {
        $news = News::find($id);
        if ($news) {
            if (file_exists(public_path() . '/images/' . $news->image_name)) {
                unlink(public_path() . '/images/' . $news->image_name);
            }
            $news->delete();

            return response()->json(['status' => true, 'message' => 'Запись успешно удалена']);
        } else {

            return response()->json(['status' => false, 'message' => 'Ошибка при удалении записи']);
        }
    }
}
