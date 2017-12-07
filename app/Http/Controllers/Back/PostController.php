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
            $pic_id = $this->base64_to_img($pic_id, public_path() . '/images/', $filename);
            /*$validator = Validator::make($request->all(), [
                'file' => 'required|image'
            ]);
            if ($validator->fails()) {
                Response::json([
                    'status' => 403,
                    'message' => $validator->errors()
                ]);
                echo 'fail to upload image'; // debug
            } else {
                $file = $request->file('file');//获取文件
                $fileName = md5(time() . rand(0, 10000)) . '.' . $file->getClientOriginalName();//随机名称+获取客户的原始名称
                $savePath = 'public/images/' . $fileName;//存储到指定文件，例如image/.filename public/.filename
                Storage::put($savePath, File::get($file));//通过Storage put方法存储   File::get获取到的是文件内容
                if (Storage::exists($savePath)) {
                    Image::create([
                        'user_id' => $request->input('userID'),
                        'pic_id' => $savePath
                    ]);
                    $pic_id = $savePath;
                }
            }*/
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
     * base64字符串转换成图片
     * @param string $base64_string base64字符串
     * @param unknown $path 图片保存路径
     * @param string $prefix 图片前缀
     * @return boolean
     */
    public function base64_to_img($base64_string, $path, $filename)
    {
        $output_file = md5(time() . rand(0, 10000)) . '.' . $filename;
        $path = $path . $output_file;
        $ifp = fopen($path, "wb");
        fwrite($ifp, base64_decode($base64_string));
        fclose($ifp);
        return '/images/' . $output_file;
    }

    public function getPosts($uid)
    {
        $results = DB::select('SELECT
                                pid,
                                userID,
                                contents,
                                pic_id,
                                timestamp
                                FROM
                                posts,
                                (SELECT r.followed_userID AS ee
                                    FROM relations r
                                    WHERE follower_userID = :userID AND if_notify = 1
                                    ) AS r
                                WHERE
                                userID = r.ee
                                AND
                                pid NOT IN (SELECT b.pid
                                    FROM blocks b
                                    WHERE b.userID = :userID)', ['userID' => $uid]);
        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }
}