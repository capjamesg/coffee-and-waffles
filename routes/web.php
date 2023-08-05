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

Route::get('/post/{id}', [\App\Http\Controllers\PostController::class, 'show']);

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate']);
Route::get('/signup', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/signup', [\App\Http\Controllers\UserController::class, 'store']);