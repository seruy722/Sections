<?php

namespace App\Http\Controllers;

use App\ImageGallery;
use Illuminate\Http\Request;

class ImageGalleryController extends Controller
{

    public function getImages(Request $request)
    {

        $images = ImageGallery::where('section_id', $request->section_id)->get();
        if ($images) {
            return response()->json(['status' => true, 'images' => $images]);
        } else {
            return response()->json(['status' => false, 'error' => 'Нет изображений.']);
        }
    }

    public function store(Request $request)
    {
        $allowedImges = 100;
        $countImages = ImageGallery::where('section_id', $request->section_id)->count();

        if ($countImages != $allowedImges) {
            $count = $allowedImges - $countImages;
        } else {
            return response()->json(['status' => false, 'message' => "Нельзя загрузить больше $allowedImges изображений."]);
        }

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

        $countIterations = 1;
        foreach ($data as $key => $elem) {
            if ($key != 'section_id') {
                if($countIterations > $count) break;
                $countIterations++;
                $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $elem->getClientOriginalExtension();
                $elem->move('images', $filename);
                $newFile = [
                    'name' => $filename,
                    'section_id' => $data['section_id']
                ];
                ImageGallery::create($newFile);
            }
        }
        $countImages = ImageGallery::where('section_id', $request->section_id)->count();
        return response()->json(['status' => true, 'message' => "Загружено: $countImages/$allowedImges изображений."]);
    }

    public function destroy($id)
    {
        $image = ImageGallery::findOrFail($id);
        if ($image) {
            unlink(public_path() . '/images/' . $image->name);
            $image->delete();
            return response()->json(['status' => true, 'message' => 'Изображение успешно удалено.']);
        }
        return response()->json(['status' => false, 'message' => 'Ошибка при удвлении изображения.']);
    }
}
