<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordClass;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only('logout', 'editProfile', 'updateProfile');
    }

    public function allUsers()
    {
        dd('dfas');

    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:6,100|confirmed'
        ]);
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|between:6,100'
        ]);
        $user = User::whereEmail($request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $user->api_token = str_random(60);
            $user->save();
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }
        return response()->json([
            'errors' => [
                'email' => 'Email не зарегестрирован!'
            ]
        ], 422);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->api_token = null;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }

    public function editProfile(Request $request)
    {
        $user = $request->user();
        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }
        return response()->json(['success' => false]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        switch ($request->action) {
            case 'photo':
                $file = $request->profilephoto;
                $filename = 'IMG-' . md5(microtime() . rand()) . '.' . $file->getClientOriginalExtension();
                $file->move('users', $filename);
                $user->photo = '/users/' . $filename;
                $user->save();
                return response()->json([
                    'success' => true,
                    'user' => $user
                ]);
                break;
            case 'profile':
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'address' => 'max:255',
                    'phone'=>'regex:/^\+380\d{3}\d{2}\d{2}\d{2}$/'
                ]);
                if ($user) {
                    $user->name = $request->name;
                    $user->phone = $request->phone;
                    $user->save();

                    return response()->json([
                        'success' => true,
                        'user' => $user
                    ]);
                }
                break;
            case 'password':
                $this->validate($request, [
                    'old_password' => 'required|between:6,25',
                    'password' => 'required|between:6,25|confirmed'
                ]);

                if ($user && Hash::check($request->old_password, $user->password)) {
                    $user->password = bcrypt($request->password);
                    $user->save();
                    return response()->json([
                        'success' => true,
                        'user' => $user
                    ]);
                }
                return response()->json([
                    'errors' => [
                        'old_password' => 'Old password is not correct.'
                    ]
                ]);
                break;
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $randPassword = str_shuffle('$#asdSRTD');
            $user->password = Hash::make($randPassword);
            $user->save();

            $url = $request->url;
            $title = 'Был произведен запрос на восстановления пароля.';
            $subject = 'Восстановление пароля';
            $password = 'Ваш новый пароль: ' . $randPassword;

            Mail::to($request->email)->send(new ResetPasswordClass($title, $subject, $url, $password));
            return response()->json([
                'status' => true,
                'message' => 'Пароль отправлен на почту!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email не зарегестрирован!'
            ]);
        }
    }
}