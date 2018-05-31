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
        $data = $request->all();
        foreach ($data as $key => $element) {
            if ($key != 'section_id') {
                $this->validate($request, [
                    $key => 'mimes:jpg,jpeg,png|dimensions:max:5120',
                ], [
                    "$key.mimes" => 'Один из файлов не является изображением.'
                ]);
            }
        }
        $this->validate($request, [
            'section_id' => 'required|integer',
        ], [
            'section_id.integer' => 'Поле Секция обьзательное для заполнения.'
        ]);
        dd('ok');

        $section_id = $request->section_id;
//        $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
//        $file->move('images', $filename);
//        $newFile = [
//            'name' => $filename,
//            'section_id' => $section_id
//        ];
        ImageGallery::create();
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
        //
    }
}
