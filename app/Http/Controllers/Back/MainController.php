<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Models\User
};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MainController extends Controller
{
    public function mainpage()
    {
        var_dump(123);
    }

    public function login(Request $request)
    {
        $users = User::select(DB::raw('*'))
            ->whereColumn([
                ['userID', $request->input('userID')],
                ['password', $request->input('password')]
            ])
            ->get();
        if ($users->isEmpty()) {
            return response()->json([
                'status' => 404,
                'data' => []
            ]);
        }
        foreach ($users as $user) {
            if ($user->is_active == 1) {
                DB::table('users')
                    ->where('userID', $user->userID)
                    ->update(['updated_at' => Carbon::now(-4)
                        ->format('Y-m-d H:i:s')]);
                return response()->json([
                    'status' => 200,
                    'data' => $users->toJSON()
                ]);
            } else {
                return response()->json([
                    'status' => 403,
                    'data' => []
                ]);
            }
        }
    }

    public function register(Request $request)
    {
        $users = User::select(DB::raw('userID'))
            ->whereColumn([
                ['userID', $request->input('userID')]
            ])->get();
        if (!$users->isEmpty()) {
            return response()->json([
                'status' => 404,
                'data' => []
            ]);
        }
        DB::table('users')->insert(
            ['userID' => $request->input('userID'),
                'password' => $request->input('password'),
                'nickname' => $request->input('nickname'),
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'gender' => $request->input('gender'),
                'DOB' => $request->input('DOB'),
                'email' => $request->input('email'),
                'created_at' => Carbon::now(-4)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now(-4)->format('Y-m-d H:i:s')]);
        return response()->json([
            'status' => 200,
            'data' => []
        ]);
    }

    public function info($id)
    {
//        return Post::getPost();
        return $id;
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