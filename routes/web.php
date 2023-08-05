<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\PostController::class, 'list']);

Route::get('/post', [\App\Http\Controllers\PostController::class, 'create']);
Route::post('/post', [\App\Http\Controllers\PostController::class, 'store']);

Route::get('/new', [\App\Http\Controllers\PostController::class, 'newest']);

Route::get('/post/{id}', [\App\Http\Controllers\PostController::class, 'show']);
Route::get('/post/{id}/delete', [\App\Http\Controllers\PostController::class, 'delete']);

Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'store']);

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate']);
Route::get('/signup', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/signup', [\App\Http\Controllers\UserController::class, 'store']);
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout']);

Route::get('/upvote/{id}', [\App\Http\Controllers\VoteController::class, 'upvote']);

Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'getPosts']);

// social auth
use Laravel\Socialite\Facades\Socialite;
 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
 
    // if user doesn't exist, create one
    $user_model = \App\Models\User::where('email', $user->email)->first();

    if (!$user_model) {
        $user_model = new \App\Models\User;
        $user_model->name = $user->name;
        $user_model->email = $user->email;
        $user_model->password = \Hash::make(\Str::random(24));
        $user_model->save();
    }

    \Auth::login($user_model);
});