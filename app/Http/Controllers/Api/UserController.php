<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use App\News;
use App\Schedules;
use App\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return UserResource::collection($users);
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
        $data['password'] = Hash::make($request->password);
        if(User::create($data)){
            return response()->json(['status' => 'success', 'message' => 'Запись успешно обновлена']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Ошибка при обновлении записи']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
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
        $user = User::find($id);
        if ($user) {
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
                $user->update($data);
            } else {
                $user->update($request->except('password'));
            }
            return response()->json(['status' => 'success', 'message' => 'Запись успешно обновлена']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ошибка при обновлении записи']);
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
//        $allSections = User::find($id)->sections;
//        $sections = [];
//        $schedules = [];
//
//        foreach ($allSections as $key => $item) {
//            $sections[] = (object)array('id' => $item->id, 'name' => $item->section_name);
//            if ($item->schedules->count() > 0) {
//                foreach ($item->schedules as $elem) {
//                    $schedules[] = $elem;
//                }
//            }
//        }

        $user = User::find($id);
        if ($user->count()>0) {
            $res = $user->sections;
            foreach ($res as $elem){
                if($elem->news->count()>0){
                    dd($elem->news);
                }
            }
            dd('ok');
            Sections::where('user_id',$id)->delete();
            News::where('user_id',$id)->delete();
            Schedules::where('user_id',$id)->delete();
            $user->delete();
            return response()->json(['status' => true, 'message' => 'Запись успешно удалена']);
        } else {
            return response()->json(['status' => false, 'message' => 'Ошибка при удалении записи']);
        }
    }
}
