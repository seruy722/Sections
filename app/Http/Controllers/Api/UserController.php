<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\ImageGallery;
use App\News;
use App\Schedules;
use App\Sections;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return UserResource::collection($users);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',

        ]);

        $data = $this->cleanData($request->all());
        $data['password'] = Hash::make($request->password);
        if (User::create($data)) {
            return response()->json(['status' => 'success', 'message' => 'Запись успешно обновлена']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ошибка при обновлении записи']);
        }
    }

    function cleanData($value)
    {
        $arr = array_map("trim", $value);
        $arr = array_map("strip_tags", $arr);
        $arr = array_map("stripcslashes", $arr);
        return $arr;
    }


    public function show(User $user)
    {
        return new UserResource($user);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email',
            'role' => 'required',

        ]);

        $data = $this->cleanData($request->all());
        $user = User::findOrFail($id);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
            $user->update($data);
        } else {
            $user->update($request->except('password'));
        }
        return response()->json(['status' => true, 'message' => 'Запись успешно обновлена']);

    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $sections = $user->sections->toArray();

        if ($sections) {
            foreach ($sections as $elem) {
                $images = Sections::find($elem['id'])->image;
                if ($images->count() > 0) {
                    $arr = $images->toArray();
                    foreach ($arr as $item) {
                        if (file_exists(public_path() . '/images/' . $item['name'])) {
                            unlink(public_path() . '/images/' . $item['name']);
                        }
                        ImageGallery::destroy($item['id']);
                    }
                }

                $news = Sections::find($elem['id'])->news;
                if ($news->count() > 0) {
                    $arr = $news->toArray();
                    foreach ($arr as $item) {
                        if (file_exists(public_path() . '/images/' . $item['image_name'])) {
                            unlink(public_path() . '/images/' . $item['image_name']);
                        }
                        News::destroy($item['id']);
                    }
                }

                $schedules = Sections::find($elem['id'])->schedules;
                if ($schedules->count() > 0) {
                    $arr = $schedules->toArray();
                    foreach ($arr as $item) {
                        Schedules::destroy($item['id']);
                    }
                }


                if (file_exists(public_path() . '/images/' . $elem['img_logo'])) {
                    unlink(public_path() . '/images/' . $elem['img_logo']);
                }

                if ($elem['id']) {
                    Sections::destroy($elem['id']);
                }


            }
        }

        $user->delete();
        return response()->json(['status' => true, 'message' => 'Пользователь успешно удален.']);

    }
}
