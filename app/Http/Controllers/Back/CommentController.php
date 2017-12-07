<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Models\User,
    Models\Post
};
use Illuminate\Support\Facades\ {
    DB,
    Auth
};
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function comment(Request $request)
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
}