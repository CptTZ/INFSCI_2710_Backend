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
        if ($pic_id != null) {
            $validator = Validator::make($request->all(), [
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
                $savePath = 'app/Images/' . $fileName;//存储到指定文件，例如image/.filename public/.filename
                Storage::put($savePath, File::get($file));//通过Storage put方法存储   File::get获取到的是文件内容
                if (Storage::exists($savePath)) {
                    Image::create([
                        'user_id' => $request->input('userID'),
                        'pic_id' => $savePath
                    ]);
                    $pic_id = $savePath;
                }
            }
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

    public function info($id)
    {
        return Post::getPost();
        // return route('maininfo');
        // return 'id = ' . $id;
        /*return view('mainpage/info',[
            'name' => 'Eason',
            'age' => 18,
            'id' => $id
        ]);*/
    }

    /*public function test()
    {
        $user = DB::select('select * from users');
        dd($user);
    }*/
    public function test()
    {
        $user = User::all();
        dd($user);

//        $user = User::find(1);
//        dd($user);

//        $user = User::get();
//        dd($user);

//        $user = User::where('id', '>=', '1')->orderBy('id', 'desc')->first();
//        dd($user);

        //chunk
//        echo '<pre>';
//        User::chunk(2, function ($user){
//            dd($user);
//        });

        //aggregate
//        $num = User::count();
//        $max = User::where('id', '>=', 1)->max('password');
//        dd($max);
    }

    public function orm2()
    {
        // model
//        $user = new User();
//        $user->name='Sean';
//        $user->email='@';
//        $user->password='123';
//        $bool = $user->save();
//        dd($user);

//        $user = User::find(2);
//        echo date('Y-m-d H:i:s', $user->created_at);

        // create method
//        $user = User::create([
//            'name' => 'im',
//            'email' => 'gm',
//            'password' => '0',
//        ]);
//        dd($user);
    }
}