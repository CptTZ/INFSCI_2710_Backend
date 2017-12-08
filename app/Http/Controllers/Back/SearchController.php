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

class SearchController extends Controller
{
    public function search($keyword)
    {
        $users = DB::select('SELECT
                            userID
                            FROM
                            users u
                            WHERE
                            userID like \'%:keyword%\'
                            OR
                            email like \'%:keyword%\'
                            OR
                            nickname like \'%:keyword%\'
                            OR
                            firstname like \'%:keyword%\'
                            OR
                            lastname like \'%:keyword%\'', ['keyword' => $keyword]);
        return response()->json([
            'status' => 200,
            'data' => $users
        ]);
    }
}