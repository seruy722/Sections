<?php

namespace App\Http\Controllers;

use App\ImageGallery;
use Illuminate\Http\Request;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getImages(Request $request)
    {
        $images = ImageGallery::where('section_id', $request->section_id)->get();
        if ($images) {
            return response()->json(['status' => true, 'images' => $images]);
        } else {
            return response()->json(['status' => false, 'error' => 'Нет изображений.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $element) {
            $this->validate($request, [
                $key => 'required|mimes:jpg,jpeg,png|dimensions:max:5120',
                'section_id' => 'required|integer',
            ], [
                "$key.mimes" => 'Один из файлов не является изображением.',
                "$key.required" => 'Выбирите изображение.',
                'section_id.integer' => 'Поле секция обьзательное для заполнения.'
            ]);
        }

        foreach ($data as $key => $elem) {
            if ($key != 'section_id') {
                $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $elem->getClientOriginalExtension();
                $elem->move('images', $filename);
                $newFile = [
                    'name' => $filename,
                    'section_id' => $data['section_id']
                ];
                ImageGallery::create($newFile);
            }
        }

        return response()->json(['status' => true, 'message' => 'Изображения успешно загружены.']);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ImageGallery::findOrFail($id);
        if ($image) {
            $image->delete();
            return response()->json(['status' => true, 'message' => 'Изображение успешно удалено.']);
        }
        return response()->json(['status' => false, 'message' => 'Ошибка при удвлении изображения.']);
    }
}
