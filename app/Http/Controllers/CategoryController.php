<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get()->toArray();
        foreach ($categories as $key => $elem) {
            $categories[$key]['created_at'] = $this->needDate($elem['created_at']);
        }
        return response()->json(['status' => true, 'categories' => $categories]);
    }

    public function needDate($date)
    {
        $newDate = date('d-m-Y', strtotime($date));
        return $newDate;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'image' => 'mimes:jpg,jpeg,png|dimensions:max:5120'
        ]);

        $data = $this->cleanData($request->all());
        $file = $request->image;
        $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
        $file->move('images', $filename);
        $data['image'] = $filename;
        Category::create($data);

        return response()->json(['status' => true, 'message' => 'Категория успешно добавлена.']);
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
            'name' => 'required|min:2|max:255',
        ]);


        $category = Category::findOrFail($request->id);

        if ($category->count() > 0) {
            $data = $this->cleanData($request->all());
            $file = $request->image;
            if (file_exists(public_path() . '/images/' . $category->image)) {
                unlink(public_path() . '/images/' . $category->image);
            }
            if (is_object($request->image)) {
                $this->validate($request, [
                    'image' => 'mimes:jpg,jpeg,png|dimensions:max:5120'
                ]);
                $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
                $file->move('images', $filename);
                $data['image'] = $filename;
            }
            $category->update($data);

            return response()->json(['status' => true, 'message' => 'Категория успешно обновлена.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Ошибка при обновлении категории.']);
        }


    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->count() > 0) {
            if (file_exists(public_path() . '/images/' . $category->image)) {
                unlink(public_path() . '/images/' . $category->image);
            }
            $category->delete();
            return response()->json(['status' => true, 'message' => 'Запись успешно удалена.']);
        }
    }
}
