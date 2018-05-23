<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function upload(Request $request)
    {
        $result = ['success' => true];
        if ($request->fupload) {
            $name = $request->name;
            $file = $request->fupload;
            $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
            try {
                $file->move('images', $filename);
                $newFile = [
                    'name' => $name,
                    'file_name' => $filename
                ];
                if (File::where('name', $name)->first()) {
                    File::where('name', $name)->update($newFile);
                } else {
                    File::create($newFile);
                }

            } catch (Exception $e) {
                $result['success'] = false;
                $result['error'] = $e->getMessage();
            }
        }
        return response()->json($result);
    }

    public function list()
    {
        return File::latest()->get();
    }

    public function delete(File $file)
    {
        $result = ['success' => true];

        if ($file) {
            unlink(public_path() . '/images/' . $file->file_name);
            $file->delete();
        } else {
            $result['success'] = false;
        }
        return response()->json($result);
    }
}