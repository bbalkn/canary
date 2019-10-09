<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class UserController extends Controller
{

    public function adminshow(Request $request, User $user)
    {
        dd($request);
        return view('admin', compact('user'));
    }


    public function show(Request $request, User $user)
    {
        return view('user', compact('user'));
    }

    public function sendUser(User $user){
        dd($user);
        return view('user', compact('user'));
    }

    public function follow(Request $request, User $user)
    {
        if($request->user()->canFollow($user)) {
            $request->user()->following()->attach($user);
        }
        return redirect()->back();
    }

    public function unFollow(Request $request, User $user)
    {
        if($request->user()->canUnFollow($user)) {
            $request->user()->following()->detach($user);
        }
        return redirect()->back();
    }

    public function postCounter() {
        $users = User::all();
        foreach ($users as $user) {
            echo $user->name . "----" . $user->posts->count() . "<br>";
        }
    }

    /*public function changeUserName(Request $request, User $user) {
        $users = User::all();


        if($request->user()->isAdmin) {
            foreach ($users as $user) {
                echo $user->name . " Change Username?: " . "<br>";
                //$request->user()->syncChanges($user->name);
            }
            //$request->user()->syncChanges($user->name);
            //dd($user->name);
        }



    }*/

    public function edit(Request $request)
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //dd(request()->post());
        }

        if($request->name !== null){
        //    $user = DB::table('users')->where('name', 'test')->first();
        }
        $users = User::all();
        return view('/admin', compact('users'));
    }

    public function edited(Request $request, $id){
        //$user = DB::table('users')->where('id', $id)->first();
        //dd( $user);
        User::where('id', $id)->update(['name' => $request->username]);
        return redirect('/admin');
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminControl');
    }


}
