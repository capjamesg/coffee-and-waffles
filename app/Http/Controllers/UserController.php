<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function getPosts(Request $request)
    {
        // get posts from user
        $posts_and_votes = Post::withCount('votes')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        $user = User::where('name', $request->id)->first();

        return view('index', [
            'posts' => $posts_and_votes,
            'user' => $user,
            'postsByUser' => true,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = $request->password;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/login');
    }

    public function logout()
    {
        \Auth::logout();

        return redirect('/');
    }
}
