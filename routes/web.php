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

// login, register
Route::namespace('Back')->group(function () {
    Route::name('login')->post('/login', 'MainController@login');
    Route::name('register')->post('/register', 'MainController@register');
});
// post, getPost
Route::prefix('post')->namespace('Back')->group(function () {
    Route::name('post')->post('/', 'PostController@post');
    Route::name('getPost')->get('/{userID}', 'PostController@getPosts');
});
// comment
Route::prefix('comment')->namespace('Back')->group(function () {
    Route::name('comment')->post('/', 'CommentController@comment');
});
// like
Route::prefix('like')->namespace('Back')->group(function () {
//    Route::name('like')->post('/', 'LikeController@like');
});
// collection
Route::prefix('collection')->namespace('Back')->group(function () {
//    Route::name('collect')->post('/collect', 'CollectionController@collect');
//    Route::name('getCollections')->get('/getCollections', 'CollectionController@getCollections');
//    Route::name('removeCollection')->post('/removeCollection', 'CollectionController@removeCollection');
});
// admin dashboard
Route::prefix('admin')->namespace('Back')->group(function () {
    Route::name('getStat')->get('/', 'AdminController@getStat');
    Route::name('getUsers')->get('/users', 'AdminController@getUsers');
    Route::name('getPosts')->get('/posts', 'AdminController@getPosts');
    Route::name('getReports')->get('/reports', 'AdminController@getReports');
    Route::name('blockOrRecoverUsers')->post('/blockOrRecoverUsers', 'AdminController@blockOrRecoverUsers');
    Route::name('deletePosts')->post('/deletePosts', 'AdminController@deletePosts');
});
// report
Route::prefix('reportPosts')->namespace('Back')->group(function () {
    Route::name('reportPosts')->post('/', 'ReportController@reportPosts');
});
// personal info and settings
Route::prefix('my')->namespace('Back')->group(function () {
    Route::name('myinfo')->get('/{userID}', 'PersonalController@getUserInfo');
    Route::name('personal')->post('/info', 'PersonalController@modifyPersonalInfo');
    Route::name('whatsup')->post('/whatsup', 'PersonalController@modifyWhatsup');
    Route::name('avatar')->post('/avatar', 'PersonalController@modifyAvatar');
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