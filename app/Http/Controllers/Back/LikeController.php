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

class LikeController extends Controller
{
    public function like(Request $request)
    {
        DB::table('likes')->insert(
            ['pid' => $request->input('pid'),
                'userID' => $request->input('userID'),
                'timestamp' => Carbon::now(-4)->format('Y-m-d H:i:s')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function cancelLike(Request $request)
    {
        DB::table('likes')->whereColumn([
            ['pid', $request->input('pid')],
            ['userID', $request->input('userID')]])
            ->delete();
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }
}