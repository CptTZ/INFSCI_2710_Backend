<?php

namespace App\Http\Controllers\Back;

use App\{
    Http\Controllers\Controller
};
use Illuminate\Support\Facades\ {
    DB,
    Auth
};
use Illuminate\Http\Request;
use Carbon\Carbon;

class RelationController extends Controller
{
    public function follow(Request $request)
    {
        DB::table('relations')->insert(
            ['follower_userID' => $request->input('er_userID'),
                'followed_userID' => $request->input('ee_userID'),
                'timestamp' => Carbon::now(-4)->format('Y-m-d H:i:s')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function unfollow(Request $request)
    {
        DB::table('relations')->whereColumn([
            ['follower_userID', $request->input('er_userID')],
            ['followed_userID', $request->input('ee_userID')]])
            ->delete();
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }
}