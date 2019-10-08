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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('tweet/save', 'PostController@store');

Route::get('/user_id', function(){
    //$user = Auth::user();
    //dd($user);*/
    $users = DB::table('users')->get();
    // $users = DB::table('users')->pluck('email');
    dd($users);
});




Route::get('users/{user}/follow', 'UserController@follow')->name('user.follow');

Route::get('users/{user}/unfollow', 'UserController@unfollow')->name('user.unfollow');

Route::get('posts', 'PostController@index')->name('posts.index');

Route::get('/user_tweets', 'UserController@postCounter');

Route::post('/users/change', 'UserController@change')->name('changename');


Route::get('/api/tweets', function (){

    $users = App\User::all();
    foreach ($users as $user) {
        echo $user->posts . "<br>";
        //$myJSON = json_encode($user->posts);
        //echo $myJSON;
    }
});


/*Route::get('/admin', 'AdminController@admin')
    ->middleware('is_admin')
    ->name('admin');*/

//Route::get('/admin/users', 'UserController@changeUserName')->name('user.changeUserName');

/*Route::get('/admin', function () {
    return view('admin');
});*/

//Route::get('/admin', 'UserController@edit')->name('');

Route::post('/admin/{userid}', 'UserController@edited');
Route::get('/admin', [ 'as' => 'user.edit', 'uses' => 'UserController@edit']);


Route::get('users/{user}', 'UserController@show')->name('user.show');