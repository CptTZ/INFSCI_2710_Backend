<?php

namespace App\Http\Controllers\Back;

use App\{
    Http\Controllers\Controller
};
use Illuminate\Support\Facades\ {
    DB
};
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function reportPosts(Request $request)
    {
        DB::table('reports')->insert(
            ['er_userID' => $request->input('er_userID'),
                'ee_userID' => $request->input('ee_userID'),
                'pid' => $request->input('pid'),
                'reasons' => $request->input('reasons'),
                'timestamp' => Carbon::now(-4)->format('Y-m-d H:i:s')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }
}