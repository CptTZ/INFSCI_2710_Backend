<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Models\User
};
use Illuminate\Support\Facades\ {
    DB,
    Auth
};
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function getUserInfo($uid)
    {
        $users = User::select(DB::raw('userID, nickname, firstname, lastname,
        gender, DOB, whatsup, avatar, email, created_at, updated_at'))
            ->whereColumn([
                ['userID', $uid]
            ])->get();
        return response()->json([
            'status' => 200,
            'data' => $users
        ]);
    }

    // except password, whatsup, avatar
    public function modifyPersonalInfo(Request $request)
    {
        DB::table('users')
            ->where('userID', $request->input('userID'))
            ->update(['nickname' => $request->input('nickname'),
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function modifyWhatsup(Request $request)
    {
        DB::table('users')
            ->where('userID', $request->input('userID'))
            ->update(['whatsup' => $request->input('whatsup')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function modifyAvatar(Request $request)
    {
        $avatarPath = app(PostController::class)->base64_to_img($request->input('avatar'), '/images/avatars/',
            $request->input('filename'));
        DB::table('users')
            ->where('userID', $request->input('userID'))
            ->update(['avatar' => $avatarPath]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

}