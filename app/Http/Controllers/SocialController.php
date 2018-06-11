<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'section_id' => 'required|integer',
            'fb' => 'max:255',
            'vk' => 'max:255',
            'inst' => 'max:255',
            'tw' => 'max:255',
        ], [
            'section_id.integer' => 'Поле сеция обьязательное для заполнения'
        ]);

        $social = Social::where('section_id', $request->section_id);
        if ($social->count() > 0) {
            $social->update($request->all());
        } else {
            Social::create($request->all());
        }
        return response()->json(['status' => true, 'message' => 'Данные сохранены']);
    }


    public function getSocialsLinks(Request $request)
    {
        $socials = Social::where('section_id', $request->id)->get();

        return response()->json(['socials' => $socials]);
    }
}
