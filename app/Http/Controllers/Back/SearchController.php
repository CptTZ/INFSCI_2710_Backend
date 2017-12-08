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
use function MongoDB\BSON\toJSON;

class SearchController extends Controller
{
    public function search($userID, $keyword)
    {
        $users = DB::select('SELECT
                            userID
                            FROM
                            users u
                            WHERE
                            (userID like :keyword
                            OR
                            email like :keyword
                            OR
                            nickname like :keyword
                            OR
                            firstname like :keyword
                            OR
                            lastname like :keyword)
                            AND
                            userID != :userNow', ['keyword' => '%' . $keyword . '%',
            'userNow' => $userID]);
        $arrays = array();
        foreach ($users as $user) {
            $array = get_object_vars($user);
            $if_followed = DB::select('SELECT
                            COUNT(*) AS if_followed
                            FROM
                            relations
                            WHERE
                            follower_userID = :userNow
                            AND
                            followed_userID = :ee_user', ['userNow' => $userID,
                'ee_user' => $array['userID']])[0];
            $arr = array($array, $if_followed);
            $json = json_encode($arr);
            array_push($arrays, $json);
        }
        return response()->json([
            'status' => 200,
            'data' => $arrays
        ]);
    }
}