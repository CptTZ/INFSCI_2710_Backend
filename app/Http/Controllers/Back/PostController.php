<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Models\User,
    Models\Post,
    Images
};
use Illuminate\Support\Facades\ {
    DB,
    File,
    Validator,
    Storage,
    Auth
};
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    public function post(Request $request)
    {
        $pic_id = $request->input('pic_id');
        $filename = $request->input('filename');
        if ($pic_id != null && $filename != null) {
            $pic_id = $this->base64_to_img($pic_id, '/images/posts/', $filename);
        }
        DB::table('posts')->insert(
            ['userID' => $request->input('userID'),
                'contents' => $request->input('contents'),
                'pic_id' => $pic_id,
                'timestamp' => Carbon::now(-4)->format('Y-m-d H:i:s')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    /**
     * @param string $base64_string
     * @param $path /images/ or /images/avatars
     * @param $filename original filename
     * @return path in db
     */
    public function base64_to_img($base64_string, $path, $filename)
    {
        $output_file = md5(time() . rand(0, 10000)) . '.' . $filename;
        $absPath = public_path() . $path . $output_file;
        $ifp = fopen($absPath, "wb");
        fwrite($ifp, base64_decode($base64_string));
        fclose($ifp);
        return $path . $output_file;
    }

    // exclude blocked posts and blocked users' posts
    public function getPosts($uid)
    {
        $results = DB::select('SELECT
                                pid,
                                p.userID,
                                u.nickname,
                                contents,
                                pic_id,
                                timestamp,
                                u.avatar
                                FROM
                                users u
                                JOIN
                                posts p ON u.userID = p.userID
                                ORDER BY p.timestamp DESC');
        $arrays = array();
        foreach ($results as $result) {
            $array = get_object_vars($result);
            $if_liked = DB::select('SELECT
                            COUNT(*) AS if_liked
                            FROM
                            likes
                            WHERE
                            pid = :pid
                            AND
                            userID = :userID', ['pid' => $array['pid'],
                'userID' => $uid])[0];
            $arr = array($array, $if_liked);
            array_push($arrays, $arr);
        }
        return response()->json([
            'status' => 200,
            'data' => $arrays
        ]);
    }
}