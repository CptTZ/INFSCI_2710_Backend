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

class CollectionController extends Controller
{
    public function collect(Request $request)
    {
        DB::table('collections')->insert(
            ['userID' => $request->input('userID'),
                'pid' => $request->input('pid'),
                'timestamp' => Carbon::now(-4)->format('Y-m-d H:i:s')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function getCollections($userID)
    {
        $collections = DB::select('SELECT * FROM collections WHERE userID = :userID', ['userID' => $userID]);
        return response()->json([
            'status' => 200,
            'data' => $collections
        ]);
    }
}