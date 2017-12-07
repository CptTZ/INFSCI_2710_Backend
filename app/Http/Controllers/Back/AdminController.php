<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Models\User,
    Models\Post,
    Models\Comment
};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * count users
     * count blocked user
     * count posts
     * count comments
     */
    public function getStat(Request $request)
    {
        $countUsers = User::select(DB::raw('count(*) AS countUsers'))->get();
        $countBlockedUsers = User::select(DB::raw('count(*) AS countBlockedUsers'))
            ->whereColumn([
                ['is_active', 0]
            ])->get();
        $countPosts = DB::select('SELECT count(*) from posts');
        $countComments = DB::select('SELECT count(*) from comments');
        return response()->json([
            'status' => 200,
            'data' => array($countUsers[0], $countBlockedUsers[0], $countPosts[0], $countComments[0])]);
    }

    public function getUsers(Request $request)
    {
        $results = DB::select('SELECT userID, nickname, email, is_active, 
                              created_at, updated_at FROM users');
        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }
}