<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'name' => 'required|min:2|max:255',
            'image' => 'mimes:jpg,jpeg,png|dimensions:max:5120'
        ]);

        $category = Category::find($request->id);

        if ($category->count() > 0) {
            $data = $this->cleanData($request->all());
            $file = $request->image;
            if ($file) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->count() > 0) {
            if ($category->image) {
                unlink(public_path() . '/images/' . $category->image);
            }
            $category->delete();
            return response()->json(['status' => true, 'message' => 'Запись успешно удалена.']);
        }
    }
}
