<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home

//Route::name('home')->get('/', 'Back\MainController@mainpage');

//Route::post('/login', 'Back\MainController@login');
//Route::post('/register', 'Back\MainController@register');
// Posts
//Route::post('/post', 'Back\PostController@post');
//Route::get('/index/{userID}', 'Back\PostController@getPosts');

Route::namespace('Back')->group(function () {
    Route::name('login')->post('/login', 'MainController@login');
    Route::name('register')->post('/register', 'MainController@register');
    Route::name('post')->post('/post', 'PostController@post');
    Route::name('getPost')->get('main/{userID}', 'PostController@getPosts');
    Route::name('getStat')->get('/admin', 'AdminController@getStat');
    Route::name('getUsers')->get('/admin/users', 'AdminController@getUsers');
});

// welcome
Route::get('/', function () {
    return view('welcome');
});

//Route::get('index', function () {
//    return 'Hello World';
//});

// Route::get('user/{id}', function($id){
//     return 'Hello User ' . $id;
// });

// Route::get('user/{id}/{name?}', function($id, $name = 'Eason'){
//     return 'Hello ' . $name . ' - ' . $id;
// })->where(['id'=>'[0-9]+', 'name'=>'[A-Za-z]+']);

//route::get('user/membercenter', ['as' => 'center', function () {
//    return route('center');
//}]);
//
//route::group(['prefix' => 'member'], function () {
//    Route::get('index', function () {
//        return 'Hello World';
//    });
//    Route::get('user/{id}', function ($id) {
//        return 'Hello User ' . $id;
//    });
//});

// route::get('main', 'MainController@info');

//route::get('info/{id}', ['uses' => 'Back\MainController@info', 'as' => 'maininfo'])->where('id', '[0-9]+');
//route::get('test', 'Back\MainController@test');
//route::get('orm2', ['uses' => 'Back\MainController@orm2']);