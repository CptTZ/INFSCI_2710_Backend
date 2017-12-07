<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Models\User,
    Models\Post,
    Models\Comment
};
use Illuminate\Support\Facades\ {
    DB,
    Auth
};
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

    public function getPosts(Request $request)
    {
        $results = DB::select('SELECT pid, userID, contents, timestamp, 
                              pic_id FROM posts');
        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }

    public function getReports(Request $request)
    {
        $results = DB::select('SELECT er_userID, ee_userID, pid, reasons, timestamp FROM reports');
        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }

    public function blockOrRecoverUsers(Request $request)
    {
        $is_active = User::select(DB::raw('is_active'))
            ->whereColumn([
                ['userID', $request->input('userID')]
            ])
            ->get();
        $temp = 0;
        if ($is_active[0]->is_active == 0) {
            $temp = 1;
        }
        DB::table('users')
            ->where('userID', $request->input('userID'))
            ->update(['is_active' => $temp]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    // delete posts by pid, one item once
    public function deletePosts(Request $request)
    {
        DB::table('posts')->where('pid', $request->input('pid'))->delete();
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }
}