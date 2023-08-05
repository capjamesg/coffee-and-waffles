<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register() {
        return view('register');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = new \App\Models\User;
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = $request->password;
        $user->password = \Hash::make($request->password);
        $user->save();
        return redirect('/login');
    }
}
